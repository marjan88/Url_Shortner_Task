<?php
/**
 * Created by PhpStorm.
 * User: mvaradjanin
 * Date: 18.11.19.
 * Time: 21.17
 */

namespace App\Repositories\Contracts;


interface LinkRepository extends RepositoryInterface {

    /**
     * @param string $code
     * @return mixed
     */
    public function findByCode(string $code);

    /**
     * @param string $code
     * @return mixed
     */
    public function deleteByCode(string $code);

    /**
     * @param string $code
     * @return mixed
     */
    public function updateByCode(array $data, string $code);
}
