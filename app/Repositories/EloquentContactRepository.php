<?php


namespace App\Repositories;
use Domain\Entities\Contact;
use Domain\Repositories\ContactRepositoryInterface;
use App\Models\Contact as EloquentContact;
use Illuminate\Support\Facades\DB;

class EloquentContactRepository implements ContactRepositoryInterface
{
    public function find(int $id): ?Contact
    {
        $eloquentContact = EloquentContact::find($id);
        return $eloquentContact ? $this->toDomain($eloquentContact) : null;
    }

    public function save(Contact $contact): void
    {
        DB::transaction(function () use ($contact) {
            $eloquentContact = EloquentContact::find($contact->getId());

            if ($eloquentContact) {
                $eloquentContact->update([
                    'name' => $contact->getName(),
                    'email' => $contact->getEmail(),
                    'phone' => $contact->getPhone(),
                    'message' => $contact->getMessage(),
                ]);
            } else {
                EloquentContact::create([
                    'name' => $contact->getName(),
                    'email' => $contact->getEmail(),
                    'phone' => $contact->getPhone(),
                    'message' => $contact->getMessage(),
                ]);
            }
        });
    }

    public function delete(int $id): void
    {
        EloquentContact::destroy($id);
    }

    public function findById(int $id): ?Contact
    {
        return $this->find($id);
    }

    public function update(Contact $contact): void
    {
        $this->save($contact);
    }

    public function findAll(): array
    {
        $eloquentContacts = EloquentContact::all();
        return $eloquentContacts->map(function ($eloquentContact) {
            return $this->toDomain($eloquentContact);
        })->toArray();
    }
    

    private function toDomain(EloquentContact $eloquentContact): Contact
    {
        return new Contact(
            $eloquentContact->id,
            $eloquentContact->name,
            $eloquentContact->email,
            $eloquentContact->phone,
            $eloquentContact->message,
            $eloquentContact->created_at,
            $eloquentContact->updated_at
        );
    }
}
