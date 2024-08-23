<?php
namespace Domain\Entities;

class Contact
{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $message;
    public $created_at;
    public $updated_at;

    public function __construct($id, $name, $email, $phone, $message, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->message = $message;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    
}