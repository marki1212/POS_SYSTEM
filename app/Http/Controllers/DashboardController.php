<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $username = Session::get('username');
        return view('dashboard', compact('products', 'categories', 'username'));
    }

    // New method to show a specific category by ID
    public function showCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('category.show', compact('category'));
    }
}
