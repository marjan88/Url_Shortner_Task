<?php

namespace App\Helpers;

class MathBasePattern implements UrlPatternInterface {

    private $base = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * @param int $id
     * @return string
     */
    public function create(int $id) {
        $base   = 62;
        $r      = $id % $base;
        $result = $this->base[$r];
        $q      = floor($id / $base);

        while ($q) {
            $r      = $q % $base;
            $q      = floor($q / $base);
            $result = $this->base[$r] . $result;
        }

        return $result;
    }
}
