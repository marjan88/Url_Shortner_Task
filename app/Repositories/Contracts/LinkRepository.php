<?php
/**
 * Created by PhpStorm.
 * User: mvaradjanin
 * Date: 18.11.19.
 * Time: 21.17
 */

namespace App\Repositories\Contracts;


use Illuminate\Http\Request;

interface LinkRepository extends RepositoryInterface {

    /**
     * @param Request $request
     * @return mixed
     */
    public function fetchPublicLinks(Request $request);

    /**
     * @param string $code
     * @return mixed
     */
    public function findByCode(string $code);

    /**
     * @param Request $request
     * @param int $userId
     * @return mixed
     */
    public function fetchByUserId(Request $request, int $userId);

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
