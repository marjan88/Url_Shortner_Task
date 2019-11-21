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
use Illuminate\Http\Request;

class LinkRepository extends EloquentAbstractRepository implements \App\Repositories\Contracts\LinkRepository {

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function fetchPublicLinks(Request $request) {
        $paginate = $request->get('paginate', null);
        $order = $request->get('order', null);
        $limit    = config('app.default_pagination');

        $model = $this->getModel()->where('private', 0);

        if($order) {
            $model = $model->orderBy('created_at', $order);
        }

        if ($paginate) {
            return $model->paginate($limit);
        }
        return $model->get();
    }

    /**
     * @param string $email
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function findByCode(string $code) {
        $link = $this->getModel()->where('code', $code)->first();
        if (!$link) {
            throw new LinkNotFoundException();
        }

        $link->increment('used_count');

        $link->touchTimestamp('last_used');

        return $link;
    }

    /**
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function fetchByUserId(Request $request, int $userId) {
        $paginate = $request->get('paginate', null);
        $limit    = config('app.default_pagination');
        $order = $request->get('order', null);
        $model    = $this->getModel()->where('user_id', $userId);

        if($order) {
            $model = $model->orderBy('created_at', $order);
        }

        if ($paginate) {
            return $model->paginate($limit);
        }
        return $model->get();
    }

    /**
     * @param array $data
     * @param string $code
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|null|object
     */
    public function updateByCode(array $data, string $code) {
        $link = $this->getModel()->where('code', $code)->first();
        if (!$link) {
            throw new LinkNotFoundException();
        }
        $data['original_url'] = $data['url'];
        $data['private'] = $data['private'] ?? 0;
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
