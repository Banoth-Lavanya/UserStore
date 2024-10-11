<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Store;

class UserRepository
{
    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->find($id);
        $user->update($data);
        return $user;
    }
    public function delete($id)
    {
        $user = $this->find($id);
        $user->delete();
    }
    public function getUserStores($userId)
    {
        return Store::where('userId', $userId)->get(); // Assuming you have a Product model
    }
    public function getAllCustomers()
    {
        return User::where('role', 'customer')->get();
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}


?>