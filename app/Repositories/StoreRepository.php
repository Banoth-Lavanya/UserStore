<?php
// app/Repositories/ProductRepository.php
namespace App\Repositories;

use App\Models\Store;

class StoreRepository
{
    public function all()
    {
        return Store::all();
    }
    public function getUserProducts($userId)
    {
        return Store::where('userId', $userId)->get(); // Adjust according to your database schema
    }
    
    public function find($id)
    {
        return Store::findOrFail($id);
    }

    public function create(array $data)
    {
        return Store::create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }
    public function getUserStores($userId)
    {
        return Store::where('userId', $userId)->get(); // Fetch stores associated with the user
    }

    public function delete($id)
    {
        $product = $this->find($id);
        $product->delete();
    }
}

?>