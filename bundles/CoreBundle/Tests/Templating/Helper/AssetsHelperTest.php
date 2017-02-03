<?php

/*
 * @copyright   2016 Mautic Contributors. All rights reserved
 * @author      Mautic, Inc.
 *
 * @link        https://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\CoreBundle\Tests\Helper;

use Mautic\CoreBundle\Helper\PathsHelper;
use Symfony\Component\Asset\Packages;

class AssetsHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testAssetContext()
    {
        $packagesMock = $this->getMockBuilder(Packages::class)
            ->disableOriginalConstructor()
            ->getMock();
        $packagesMock->method('getUrl')
            ->will($this->returnCallback(function () {
                $args = func_get_args();

                return $args[0];
            }));

        $pathsHelper = $this->getMockBuilder(PathsHelper::class)
             ->disableOriginalConstructor()
             ->getMock();
        $pathsHelper->method('getSystemPath')
            ->willReturn('');

        $assetHelper = new \Mautic\CoreBundle\Templating\Helper\AssetsHelper($packagesMock);
        $assetHelper->setPathsHelper($pathsHelper);

        $assetHelper->addStylesheet('/app.css');
        $head = $assetHelper->getHeadDeclarations();

        $this->assertContains('app.css', $head);

        $assetHelper->setContext(\Mautic\CoreBundle\Templating\Helper\AssetsHelper::CONTEXT_BUILDER)
            ->addStylesheet('/builder.css')
            ->setContext();

        $head = $assetHelper->getHeadDeclarations();
        $this->assertNotContains('builder.css', $head);

        $head = $assetHelper->setContext(\Mautic\CoreBundle\Templating\Helper\AssetsHelper::CONTEXT_BUILDER)
            ->getHeadDeclarations();
        $this->assertContains('builder.css', $head);
        $this->assertNotContains('app.css', $head);
    }
}
