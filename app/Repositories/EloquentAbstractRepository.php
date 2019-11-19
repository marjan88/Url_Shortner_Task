<?php
/**
 * Created by PhpStorm.
 * User: mvaradjanin
 * Date: 18.11.19.
 * Time: 21.23
 */

namespace App\Repositories;


use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Http\Request;

abstract class EloquentAbstractRepository implements RepositoryInterface {
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * EloquentAbstractRepository constructor.
     * @throws \Exception
     */
    public function __construct() {
        $this->model = $this->resolveModel();
    }

    /**
     * @return mixed
     */
    public function all(Request $request) {
        $paginate = $request->get('paginate', null);
        $limit    = config('app.default_pagination');
        if ($paginate) {
           return $this->getModel()->paginate($limit);
        }
        return $this->getModel()->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id) {
        return $this->getModel()->find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data = []) {
        return $this->getModel()->create($data);
    }

    /**
     * @param array $data
     * @param int|null $id
     * @return bool
     */
    public function update(array $data = [], int $id = null) {
        $item = $this->findItem($id);
        if (!$item) {
            return false;
        }
        $item->update($data);
        return $item;
    }

    /**
     * Delete items by column id .
     *
     * @param int $id
     * @return boolean
     */
    public function deleteById(int $id) {
        $item = $this->findById($id);
        if (!$item) {
            return false;
        }
        return $item->delete();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function resolveModel() {
        if (!method_exists($this, 'getModel')) {
            throw new \Exception('No model defined');
        }
        return $this->getModel();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public abstract function getModel();
}
