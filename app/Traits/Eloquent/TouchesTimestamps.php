<?php
/**
 * Created by PhpStorm.
 * User: mvaradjanin
 * Date: 18.11.19.
 * Time: 22.45
 */

namespace App\Traits\Eloquent;


trait TouchesTimestamps {
    /**
     * @param string $column
     */
    public function touchTimestamp(string $column) {
        $this->{$column} = $this->freshTimestamp();
        $this->save();
    }
}
