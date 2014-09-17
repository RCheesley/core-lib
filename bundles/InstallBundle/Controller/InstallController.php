<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic, NP. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 *
 * Based on Sensio\DistributionBundle
 */

namespace Mautic\InstallBundle\Controller;

use Mautic\CoreBundle\Controller\CommonController;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * InstallController.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class InstallController extends CommonController
{
    /**
     * @return Response A Response instance
     */
    public function stepAction($index = 0)
    {
        /** @var \Mautic\InstallBundle\Configurator\Configurator $configurator */
        $configurator = $this->container->get('mautic.configurator');

        $action = $this->generateUrl('mautic_installer_step', array('index' => $index));
        $step   = $configurator->getStep($index);
        $form   = $this->container->get('form.factory')->create($step->getFormType(), $step, array('action' => $action));

        $request = $this->container->get('request');
        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            if ($form->isValid()) {
                $configurator->mergeParameters($step->update($form->getData()));
                $configurator->write();

                $index++;

                if ($index < $configurator->getStepCount()) {
                    return new RedirectResponse($this->container->get('router')->generate('mautic_installer_step', array('index' => $index)));
                }

                return new RedirectResponse($this->container->get('router')->generate('mautic_installer_final'));
            }
        }

        $tmpl = $this->request->isXmlHttpRequest() ? $this->request->get('tmpl', 'index') : 'index';

        // Always pass the requirements into the templates
        $majors = $configurator->getRequirements();
        $minors = $configurator->getOptionalSettings();

        return $this->delegateView(array(
            'viewParameters'  =>  array(
                'form'    => $form->createView(),
                'index'   => $index,
                'count'   => $configurator->getStepCount(),
                'version' => $this->getVersion(),
                'tmpl'    => $tmpl,
                'majors'  => $majors,
                'minors'  => $minors,
            ),
            'contentTemplate' => $step->getTemplate(),
            'passthroughVars' => array(
                'activeLink'     => '#mautic_install_index',
                'mauticContent'  => 'install',
                'route'          => $this->generateUrl('mautic_installer_step', array('index' => $index)),
                'replaceContent' => ($tmpl == 'list') ? 'true' : 'false'
            )
        ));
    }

    public function finalAction()
    {
        /** @var \Mautic\InstallBundle\Configurator\Configurator $configurator */
        $configurator = $this->container->get('mautic.configurator');

        try {
            $welcomeUrl = $this->container->get('router')->generate('mautic_core_index');
        } catch (\Exception $e) {
            $welcomeUrl = null;
        }

        $tmpl = $this->request->isXmlHttpRequest() ? $this->request->get('tmpl', 'index') : 'index';

        return $this->delegateView(array(
            'viewParameters'  =>  array(
                'welcome_url' => $welcomeUrl,
                'parameters'  => $configurator->render(),
                'config_path' => $this->container->getParameter('kernel.root_dir') . '/config/local.php',
                'is_writable' => $configurator->isFileWritable(),
                'version'     => $this->getVersion(),
                'tmpl'        => $tmpl,
            ),
            'contentTemplate' => 'MauticInstallBundle:Install:final.html.php',
            'passthroughVars' => array(
                'activeLink'     => '#mautic_install_index',
                'mauticContent'  => 'install',
                'route'          => $this->generateUrl('mautic_installer_step', array('index' => 0)),
                'replaceContent' => ($tmpl == 'list') ? 'true' : 'false'
            )
        ));
    }

    protected function getVersion()
    {
        $kernel = $this->container->get('kernel');

        return $kernel::VERSION;
    }
}
