<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class AbstractRepository 
{
    /**
     * instance for Model
     *
     * @var Model
     */
    private $model;

    /**
     * setter for model
     *
     * @param Model $model
     * @return self
     */
    protected function setModel(Model $model) {
        $this->model = $model;

        return $this;
    }

    /**
     * getter for model
     *
     * @return Model
     */
    protected function getModel() {
        return $this->model;
    }   

    protected function getById($id) {
        return $this->getModel()->findOrFail($id);
    }

    protected function update($id, array $payload)
    {
        return $this->getModel()->whereId($id)->update($payload);
    }
}