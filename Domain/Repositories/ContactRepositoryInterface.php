<?php
namespace Domain\Repositories;
use Domain\Entities\Contact;
 interface ContactRepositoryInterface
 {
     public function findById(int $id): ?Contact;
     public function save(Contact $contact): void;
     public function update(Contact $contact): void;
     public function findAll(): array;
     public function delete(int $id): void;
 }