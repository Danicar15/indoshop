<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $request) { $orders=Order::with('user')->when($request->filled('q'),fn($q)=>$q->where('order_number','like','%'.trim($request->q).'%'))->latest()->paginate(15)->withQueryString(); return view('admin.orders.index',compact('orders')); }
    public function show(Order $order) { $order->load(['items','user']); return view('admin.orders.show',compact('order')); }
    public function update(Request $request, Order $order) { $data=$request->validate(['status'=>['required',Rule::in(['pending','processing','shipped','completed','cancelled'])]]); $order->update($data); return back()->with('success','وضعیت سفارش به‌روزرسانی شد.'); }
}
