<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/3/2019
 * Time: 1:15 PM
 */

namespace App\Helper;


class HotDeal
{
   static function getHotdeal($key)
    {
        $config = \App\Hotdeal::where('configuration_key', '=', $key)->first();
        if ($config != null) {
            return $config->configuration_value;
        }
        return null;
    }
}