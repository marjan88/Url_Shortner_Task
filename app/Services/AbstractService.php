<?php
/**
 * Created by PhpStorm.
 * User: mvaradjanin
 * Date: 18.11.19.
 * Time: 21.34
 */

namespace App\Services;


use Illuminate\Http\Request;

abstract class AbstractService {
    /**
     * @var Request
     */
    protected $request;

    abstract public function handle();

    /**
     * @return mixed
     */
    public function getRequest(): Request {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request) {
        $this->request = $request;
        return $this;
    }
}
