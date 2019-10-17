<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\SmsBundle\Broadcast;

use Mautic\CampaignBundle\Executioner\ContactFinder\Limiter\ContactLimiter;
use Mautic\ChannelBundle\Event\ChannelBroadcastEvent;
use Mautic\SmsBundle\Entity\Sms;
use Mautic\SmsBundle\Model\SmsModel;
use Symfony\Component\Translation\TranslatorInterface;

class BroadcastExecutioner
{
    /**
     * @var SmsModel
     */
    private $smsModel;

    /**
     * @var ContactLimiter
     */
    private $contactLimiter;

    /**
     * @var BroadcastQuery
     */
    private $broadcastQuery;

    /**
     * @var BroadcastResult
     */
    private $result;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * BroadcastExecutioner constructor.
     *
     * @param SmsModel            $smsModel
     * @param BroadcastQuery      $broadcastQuery
     * @param TranslatorInterface $translator
     */
    public function __construct(SmsModel $smsModel, BroadcastQuery $broadcastQuery, TranslatorInterface $translator)
    {
        $this->smsModel       = $smsModel;
        $this->broadcastQuery = $broadcastQuery;
        $this->translator     = $translator;
    }

    /**
     * @param ChannelBroadcastEvent $event
     */
    public function execute(ChannelBroadcastEvent $event)
    {
        // Get list of published broadcasts or broadcast if there is only a single ID
        $smses = $this->smsModel->getRepository()->getPublishedBroadcasts($event->getId());
        while (($next = $smses->next()) !== false) {
            $sms                  = reset($next);
            $this->contactLimiter = new ContactLimiter($event->getBatch(), null, $event->getMinContactIdFilter(), $event->getMaxContactIdFilter(), [], null, null, $event->getLimit());
            $this->result         = new BroadcastResult();
            try {
                $this->send($sms);
            } catch (\Exception $exception) {
            }

            $event->setResults(
                sprintf('%s: %s', $this->translator->trans('mautic.sms.sms'), $sms->getName()),
                $this->result->getSentCount(),
                $this->result->getFailedCount()
            );
        }
    }

    /**
     * @param Sms $sms
     *
     * @throws LimitQuotaException
     * @throws \Mautic\CampaignBundle\Executioner\Exception\NoContactsFoundException
     */
    private function send(Sms $sms)
    {
        $contactIds = $this->broadcastQuery->getPendingContactsIds($sms, $this->contactLimiter);
        while (!empty($contactIds)) {
            $results    = $this->smsModel->sendSms($sms, $contactIds, ['channel'=>['sms', $sms->getId()]]);
            $this->result->process($results);

            $nextContactMinBatch = end($contactIds);
            $this->contactLimiter->setBatchMinContactId($nextContactMinBatch + 1);

            if ($this->contactLimiter->hasCampaignLimit()) {
                $this->contactLimiter->reduceCampaignLimitRemaining(count($results));
            }

            // Next batch
            $contactIds = $this->broadcastQuery->getPendingContactsIds($sms, $this->contactLimiter);
        }
    }
}
