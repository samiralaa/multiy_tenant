<?php
namespace App\Services\Contact;
use App\Models\Contact;

class ContactService
{
    private $model ;
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getOne($id)
    {
        return $this->model->find($id);
    }   

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
    
}