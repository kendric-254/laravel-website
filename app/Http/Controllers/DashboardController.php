<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Role;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch data to display on the dashboard, like counts or recent items
        $productCount = Product::count();
        $roleCount = Role::count();
        $recentProducts = Product::latest()->take(5)->get();
        $recentRoles = Role::latest()->take(5)->get();

        return view('dashboard.index', compact('productCount', 'roleCount', 'recentProducts', 'recentRoles'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View
     */
    public function createProduct()
    {
        return view('dashboard.createProduct');
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeProduct(Request $request)
    {
        // Validate and store the product
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Product::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\View\View
     */
    public function createRole()
    {
        return view('dashboard.createRole');
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRole(Request $request)
    {
        // Validate and store the role
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('dashboard')->with('success', 'Role created successfully.');
    }
}
