<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\PageBundle\Model;

use Mautic\CoreBundle\Model\FormModel;
use Mautic\EmailBundle\Entity\Email;
use Mautic\PageBundle\Entity\Redirect;
use Mautic\PageBundle\Entity\Trackable;

/**
 * Class RedirectModel
 */
class RedirectModel extends FormModel
{
    /**
     * {@inheritdoc}
     *
     * @return \Mautic\PageBundle\Entity\RedirectRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('MauticPageBundle:Redirect');
    }

    /**
     * @param $identifier
     *
     * @return null|Redirect
     */
    public function getRedirectById($identifier)
    {
        return $this->getRepository()->findOneBy(array('redirectId' => $identifier));
    }

    /**
     * Generate a Mautic redirect/passthrough URL
     *
     * @param Redirect $redirect
     * @param array    $clickthrough
     * @param bool     $shortenUrl
     *
     * @return string
     */
    public function generateRedirectUrl(Redirect $redirect, $clickthrough = array(), $shortenUrl = false)
    {
        return $this->buildUrl(
            'mautic_url_redirect',
            array('redirectId' => $redirect->getRedirectId()),
            true,
            $clickthrough,
            $shortenUrl
        );
    }

    /**
     * Get a Redirect entity by URL
     *
     * Use Mautic\PageBundle\Model\TrackableModel::getTrackableByUrl() if associated with a channel
     *
     * @param  $url
     *
     * @return Redirect|null
     */
    public function getRedirectByUrl ($url)
    {
        // Ensure the URL saved to the database does not have encoded ampersands
        while (strpos($url, '&amp;') !== false) {
            $url = str_replace('&amp;', '&', $url);
        }

        $repo     = $this->getRepository();
        $redirect = $repo->findOneBy(array('url' => $url));

        if ($redirect == null) {
            $redirect = $this->createRedirectEntity($url);
        }

        return $redirect;
    }

    /**
     * Get Redirect entities by an array of URLs
     *
     * @param array $urls
     *
     * @return array
     */
    public function getRedirectsByUrls (array $urls)
    {
        $redirects   = $this->getRepository()->findByUrls(array_values($urls));
        $newEntities = array();
        $return      = array();
        $byUrl       = array();

        foreach ($redirects as $redirect) {
            $byUrl[$redirect->getUrl()] = $redirect;
        }

        foreach ($urls as $key => $url) {
            if (empty($url)) {

                continue;
            }

            if (isset($byUrl[$url])) {
                $return[$key] = $byUrl[$url];
            } else {
                $redirect = $this->createRedirectEntity($url);
                $newEntities[] = $redirect;
                $return[$key]  = $redirect;
            }
        }

        // Save new entities
        if (count($newEntities)) {
            $this->getRepository()->saveEntities($newEntities);
        }

        unset($redirects, $newEntities, $byUrl);

        return $return;
    }

    /**
     * Create a Redirect entity for URL
     *
     * @param $url
     *
     * @return Redirect
     */
    public function createRedirectEntity($url)
    {
        $redirect = new Redirect();
        $redirect->setUrl($url);
        $redirect->setRedirectId();

        $this->setTimestamps($redirect, true);

        return $redirect;
    }
}
