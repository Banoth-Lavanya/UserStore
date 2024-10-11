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
    public function edit($id)
    {
        // Check if the user is authenticated and is an admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('products.index')->with('warning', 'Unauthorized action.');
        }
    
        // Retrieve the product using the StoreRepository
        $product = $this->storeRepo->find($id);
        
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }
    
        return view('store.edit', compact('product'));
    }
    
    public function update(Request $request, $id)
    {
        // Check if the user is authenticated and is an admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        // Validate the incoming request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);
    
        // Update the product using the repository
        $product = $this->storeRepo->update($id, $data);
    
        // Check if the update was successful
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found or update failed.');
        }
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
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
    public function manage()
{
    $products = $this->storeRepo->getAllProducts(); // Implement this in your StoreRepository
    return view('store.manage', compact('products'));
}

    
}

