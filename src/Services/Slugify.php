<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 21/11/18
 * Time: 10:15
 */

namespace App\Services;


class Slugify
{
    public function generate($string='') :string
    {
        $string = preg_replace('/-{2,}/', '-', $string);
        $string = preg_replace('/[^a-z0-9-]/', '', $string);
        $result = strtolower(ltrim(preg_replace('/-{2,}/','-', $string)));
        return $result;
    }
}