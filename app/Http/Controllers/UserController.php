<?php
namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect; 
use App\Repositories\StoreRepository;

class UserController extends Controller
{
    protected $userRepo;
    protected $storeRepo;

    public function __construct(UserRepository $userRepo,StoreRepository $storeRepo)
    {
        $this->userRepo = $userRepo;
        $this->storeRepo = $storeRepo;
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/', // At least one lowercase, one uppercase, one number, and one special character
            'role' => 'required|in:admin,customer' // Only allow 'admin' or 'customer'
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepo->create($data);

        //return response()->json($user, 201);
        return Redirect::to('login')->with('success', 'Registration successful! You can now log in.');
    }
    public function login(Request $request)
    {
        // Check if the user is already authenticated
        if (Auth::check()) {
            return redirect()->route('profile.show')->with('warning', 'You are already logged in.');
        }
    
        // Validate the request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        // Use the UserRepository to check if the user exists
        $user = $this->userRepo->findByEmail($request->email);
        if (!$user) {
            return Redirect::back()->withErrors([
                'error' => 'Email not registered. Please register.'
            ])->withInput();
        }
    
        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            session(['user_id' => $user->id, 'user_name' => $user->name, 'user_email' => $user->email]);
    
            // Get the user's stores using the StoreRepository
            $stores = $this->storeRepo->getUserStores($user->id);
            $productCount = $stores->count();
    
            if ($productCount > 0) {
                return Redirect::route('products.index')->with('success', 'Login successful! You can view your stores.');
            } else {
                return Redirect::route('products.create')->with('success', 'Login successful! You can create your first store.');
            }
        }
    
        return Redirect::back()->withErrors(['error' => 'Unauthorized'])->withInput();
    }
    
    
    public function logout(Request $request)
    {
        Auth::logout();
        // Clear session data
        $request->session()->forget(['user_id', 'user_name','user_email']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return Redirect::to('login')->with('success', 'Successfully logged out.');
    }

    public function getProfile()
    {
        if (!session('user_id')) {
            return redirect()->route('login')->with('warning', 'Please log in to view your profile.');
        }
    
        $user = Auth::user(); // Retrieve the authenticated user
        return view('users.profile', compact('user'));
    }
    public function listCustomers()
    {
        // Check if the user is logged in via session
        if (!session('user_id')) {
            return redirect()->route('login')->with('warning', 'Please log in to view customer profiles.');
        }

        // Get the authenticated user
        $currentUser = Auth::user();

        // Ensure the current user is an admin
        if ($currentUser->role !== 'admin') {
            return redirect()->route('products.index')->with('warning', 'You do not have permission to view this page.');
        }

        // Retrieve all customers using UserRepository
        $customers = $this->userRepo->getAllCustomers(); // Implement this method in UserRepository

        // Retrieve products for each customer
        foreach ($customers as $customer) {
            $customer->products = $this->storeRepo->getUserStores($customer->id);
        }

        return view('users.customers', compact('customers'));
    }
    public function editProfile()
{
    $user = Auth::user(); // Get the authenticated user
    return view('users.editProfile', compact('user')); // Pass user data to the view
}

public function updateProfile(Request $request)
{
    $user = Auth::user(); // Get the authenticated user

    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    ]);

    // Use the UserRepository to update the user
    if ($this->userRepo->updateProfile($user, $request->only(['name', 'email']))) {
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    return redirect()->route('profile.show')->withErrors(['error' => 'Failed to update profile.']);
}



}


