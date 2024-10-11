<?php
namespace App\Http\Controllers;

use App\Repositories\StoreRepository;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $storeRepo;

    public function __construct(StoreRepository $storeRepo)
    {
        $this->storeRepo = $storeRepo;
    }

    public function index()
    {
        // Get the logged-in user's ID
        $userId = session('user_id'); 
    
        // Fetch only the products for the logged-in user
        $products = $this->storeRepo->getUserProducts($userId);
    
        return view('store.index', compact('products'));
    }
    
    public function create()
    {
        return view('store.create');
    }
    public function show($id)
    {
        $product = $this->storeRepo->find($id);
        
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }
        
        return view('store.show', compact('product'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);
        $data['userId'] = session('user_id');
        $product = $this->storeRepo->create($data);
        
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
         //return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
        ]);

        $product = $this->storeRepo->update($id, $data);
        return response()->json($product);
    }

    public function destroy($id)
    {
        // Find the product
        $product = $this->storeRepo->find($id);
    
        // Check if the product exists and belongs to the logged-in user
        if (!$product || $product->userId !== session('user_id')) {
            return response()->json(['message' => 'Unauthorized or product not found.'], 403);
        }
    
        // Delete the product
        $this->storeRepo->delete($id);
        return response()->json(['message' => 'Product deleted successfully']);
    }
    
}

