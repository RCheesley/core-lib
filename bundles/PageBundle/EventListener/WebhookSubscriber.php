<?php
/**
 * @copyright   2014 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\PageBundle\EventListener;

use Mautic\CoreBundle\EventListener\CommonSubscriber;
use Mautic\PageBundle\PageEvents;
use Mautic\WebhookBundle\Event\WebhookBuilderEvent;
use Mautic\WebhookBundle\WebhookEvents;

/**
 * Class WebhookSubscriber.
 */
class WebhookSubscriber extends CommonSubscriber
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            WebhookEvents::WEBHOOK_ON_BUILD => ['onWebhookBuild', 0],
        ];
    }

    /**
     * Add event triggers and actions.
     *
     * @param WebhookBuilderEvent $event
     */
    public function onWebhookBuild(WebhookBuilderEvent $event)
    {
        // add checkbox to the webhook form for new leads
        $pageHit = [
            'label'       => 'mautic.page.webhook.event.hit',
            'description' => 'mautic.page.webhook.event.hit_desc',
        ];

        // add it to the list
        $event->addEvent(PageEvents::PAGE_ON_HIT, $pageHit);
    }
}
