<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Repo\UserInterface;
use App\User;

class UserEloquent implements UserInterface
{
   // model property on class instances
   protected $model;

   // Constructor to bind model to repo
    public function __construct(User $model)
   {
       $this->model = $model;
   }

   // Get all instances of model
   public function getAll()
   {
       return $this->model->all();
   }

   // Get id instances of model
   public function getById($id)
   {
       return $this->model->findOrFail($id);
   }

   public function create(array $attributes)
   {
       return $this->model->create($attributes);
   }


   public function update($id, array $attributes)
   {
       $this->model->findOrFail($id);
       return $this->model->update($attributes);
   }


   public function delete($id)
   {
       $this->model->findOrFail($id);
       return $this->model->delete();
   }

}
