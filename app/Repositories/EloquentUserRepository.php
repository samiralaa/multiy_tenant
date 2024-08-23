<?php
namespace App\Repositories;

use Domain\Repositories\UserRepositoryInterface;
use Domain\Entities\User;
use App\Models\User as EloquentUser;

class EloquentUserRepository  implements UserRepositoryInterface
{
    public function findById(int $id): ?User
    {
        $eloquentUser = EloquentUser::find($id);
        return $eloquentUser ? $this->toDomain($eloquentUser) : null;
    }

    public function findByEmail(string $email): ?User
    {
        $eloquentUser = EloquentUser::where('email', $email)->first();
        return $eloquentUser ? $this->toDomain($eloquentUser) : null;
    }

    public function save(User $user): void
    {
        $eloquentUser = new EloquentUser();
        $eloquentUser->name = $user->getName();
        $eloquentUser->email = $user->getEmail();
        $eloquentUser->password = bcrypt($user->getPassword());
       
        $eloquentUser->save();
    }

    public function update(User $user): void
    {
        $eloquentUser = EloquentUser::find($user->getId());
        if ($eloquentUser) {
            $eloquentUser->name = $user->getName();
            $eloquentUser->email = $user->getEmail();
            $eloquentUser->password = bcrypt($user->getPassword());
            $eloquentUser->save();
        }
    }

    public function delete(int $id): void
    {
        EloquentUser::destroy($id);
    }

    private function toDomain(EloquentUser $eloquentUser): User
    {
        return new User(
            $eloquentUser->id,
            $eloquentUser->name,
            $eloquentUser->email,
            $eloquentUser->password,
            new \DateTime($eloquentUser->created_at),
            new \DateTime($eloquentUser->updated_at)
        );
    }
}
