<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XinGroup\Respository;

use XinGroup\Respository\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class RepositoryImpl implements RepositoryInterface {

    /**
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Get empty model.
     *
     * @return Model
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * Get table name.
     *
     * @return string
     */
    public function getTable() {
        return $this->model->getTable();
    }

    /**
     * Make a new instance of the entity to query on.
     *
     * @param \Illuminate\Database\Eloquent\Builder $with
     */
    public function make(array $with = []) {
        if (method_exists($this->model, 'translations')) {
            if (!in_array('translations', $with)) {
                $with[] = 'translations';
            }
        }
        return $this->model->newQuery()->with($with);
    }

    public function all() {
        
    }

    public function find($id, $with = []) {
        return $this->findOneBy('id', $id, $with);
    }

    public function findOneBy($key, $value, $with = [], $all = false) {
        $query = $this->make($with);
        return $query->where($key, '=', $value)->first();
    }

    public function findBy($key, $value, $with = [], $all = false) {
        $query = $this->make($with);
        if (!$all) {
            $query->online();
        }
        $query->where($key, $value);
        // Query ORDER BY
        $query->order();
        // Get
        $models = $query->get();
        return $models;
    }

    /**
     * Get paginated models.
     *
     * @param int   $page  Number of models per page
     * @param int   $limit Results per page
     * @param bool  $all   get published models or all
     * @param array $with  Eager load related models
     *
     * @return stdClass Object with $items && $totalItems for pagination
     */
    public function getList($page = 1, $limit = 10, array $with = [], $all = false) {
        $result = new stdClass();
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = [];
        $query = $this->make($with);
        if (!$all) {
            $query->online();
        }
        $totalItems = $query->count();
        $query->order()
                ->skip($limit * ($page - 1))
                ->take($limit);
        $models = $query->get();
        // Put items and totalItems in stdClass
        $result->totalItems = $totalItems;
        $result->items = $models->all();
        return $result;
    }

}
