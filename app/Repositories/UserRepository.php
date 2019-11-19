<?php
/**
 * Created by PhpStorm.
 * User: mvaradjanin
 * Date: 18.11.19.
 * Time: 21.17
 */

namespace App\Repositories;


use App\Models\User;

class UserRepository extends EloquentAbstractRepository implements \App\Repositories\Contracts\UserRepository {

    /**
     * @param string $email
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function findByEmail(string $email) {
        return $this->getModel()->where('email', $email)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getModel() {
        return (new User())->newQuery();
    }


}
