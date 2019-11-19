<?php
/**
 * Created by PhpStorm.
 * User: mvaradjanin
 * Date: 18.11.19.
 * Time: 21.17
 */

namespace App\Repositories\Contracts;


interface UserRepository extends RepositoryInterface {

    public function findByEmail(string $email);
}
