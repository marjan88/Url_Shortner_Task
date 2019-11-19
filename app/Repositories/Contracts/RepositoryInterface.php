<?php
/**
 * Created by PhpStorm.
 * User: mvaradjanin
 * Date: 18.11.19.
 * Time: 21.24
 */

namespace App\Repositories\Contracts;


use Illuminate\Http\Request;

interface RepositoryInterface {
    /**
     * @param Request $request
     * @return mixed
     */
    public function all(Request $request);

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data = []);

    /**
     * @param array $data
     * @param int|null $id
     * @return mixed
     */
    public function update(array $data = [], int $id = null);

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id);
}
