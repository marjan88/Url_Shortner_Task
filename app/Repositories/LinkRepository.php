<?php
/**
 * Created by PhpStorm.
 * User: mvaradjanin
 * Date: 18.11.19.
 * Time: 21.17
 */

namespace App\Repositories;


use App\Exceptions\LinkNotFoundException;
use App\Models\Link;

class LinkRepository extends EloquentAbstractRepository implements \App\Repositories\Contracts\LinkRepository {

    /**
     * @param string $email
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function findByCode(string $code) {
        $link = $this->getModel()->where('code', $code)->first();
        if(!$link) {
            throw new LinkNotFoundException();
        }

        $link->increment('used_count');

        $link->touchTimestamp('last_used');

        return $link;
    }

    /**
     * @param array $data
     * @param string $code
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|null|object
     */
    public function updateByCode(array $data, string $code) {
        $link = $this->getModel()->where('code', $code)->first();
        if(!$link) {
            throw new LinkNotFoundException();
        }
        $data['original_url'] = $data['url'];
        $link->update($data);
        return $link;
    }

    /**
     * @param string $code
     * @return bool|mixed|null
     * @throws LinkNotFoundException
     */
    public function deleteByCode(string $code) {
        $link = $this->findByCode($code);
        if (!$link) {
            throw new LinkNotFoundException();
        }
        return $link->delete();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getModel() {
        return (new Link())->newQuery();
    }


}
