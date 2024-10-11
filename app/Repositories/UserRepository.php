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
    public function findById($id)
    {
        return User::find($id);
    }
    public function updateProfile($user, array $data)
    {
        $user->name = $data['name'];
        $user->email = $data['email'];

    try {
        return $user->save();
    } catch (\Exception $e) {
        // Log the error or handle it as needed
        return false;
    }
    }
}


?>