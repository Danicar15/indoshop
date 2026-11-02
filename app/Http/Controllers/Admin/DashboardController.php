<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke() {
        return view('admin.dashboard', [
            'productsCount' => Product::count(), 'categoriesCount' => Category::count(),
            'customersCount' => User::where('role', 'customer')->count(), 'ordersCount' => Order::count(),
            'recentOrders' => Order::with('user')->latest()->take(8)->get(),
        ]);
    }
}
