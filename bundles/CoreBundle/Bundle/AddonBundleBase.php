<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\CoreBundle\Bundle;

use Mautic\AddonBundle\Entity\Addon;
use Mautic\CoreBundle\Factory\MauticFactory;
use Mautic\CoreBundle\Helper\AddonHelper;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Base Bundle class which should be extended by addon bundles
 */
abstract class AddonBundleBase extends Bundle
{
    /**
     * Checks if the bundle is enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        $name   = str_replace('Mautic', '', $this->getName());
        $helper = new AddonHelper($this->container->get('mautic.factory'));

        return $helper->isEnabled($name);
    }

    /**
     * Called by AddonController::reloadAction when adding a new addon that's not already installed
     *
     * @param MauticFactory $factory
     */
    static public function onInstall(MauticFactory $factory)
    {

    }

    /**
     * Called by AddonController::reloadAction when the addon version does not match what's installed
     *
     * @param Addon         $addon
     * @param MauticFactory $factory
     */
    static public function onUpdate(Addon $addon, MauticFactory $factory)
    {

    }

    /**
     * Called by AddonController::reloadAction when an addon is uninstalled
     *
     * @param Addon         $addon
     * @param MauticFactory $factory
     */
    static public function onUninstall(Addon $addon, MauticFactory $factory)
    {

    }
}
