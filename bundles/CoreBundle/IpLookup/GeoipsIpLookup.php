<?php
/**
 * @package     Mautic
 * @copyright   2015 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\CoreBundle\IpLookup;


class GeoIpsIpLookup extends AbstractIpLookup
{
    /**
     * @return string
     */
    protected function getUrl()
    {
        return "http://api.geoips.com/ip/{$this->ip}/key/{$this->auth}/output/json";
    }

    /**
     * @param $response
     */
    public function parseData($response)
    {
        $data = json_decode($response);

        if ($data) {
            foreach ($data as $key => $value) {
                switch ($key) {
                    case 'city_name':
                        $key = 'city';
                        break;
                    case 'region_name':
                        $key = 'region';
                        break;
                    case 'country_name':
                        $key = 'country';
                        break;
                }

                $this->$key = $value;
            }
        }
    }
}