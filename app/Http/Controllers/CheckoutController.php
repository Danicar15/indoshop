<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function create(Request $request) { if(empty($request->session()->get('cart',[]))) return redirect()->route('cart.index')->with('error','سبد خرید خالی است.'); return view('cart.checkout'); }
    public function store(Request $request) {
        $data=$request->validate(['customer_name'=>['required','string','max:255'],'customer_email'=>['required','email','max:255'],'customer_phone'=>['required','string','max:30'],'shipping_address'=>['required','string','max:3000'],'notes'=>['nullable','string','max:2000']]);
        $cart=$request->session()->get('cart',[]); if(!$cart) return redirect()->route('cart.index')->with('error','سبد خرید خالی است.');
        $order=DB::transaction(function() use($cart,$data,$request) {
            $products=Product::whereIn('id',array_keys($cart))->lockForUpdate()->get()->keyBy('id'); $subtotal=0; $lines=[];
            foreach($cart as $id=>$qty) { $p=$products->get($id); if(!$p || !$p->is_active) throw ValidationException::withMessages(['cart'=>'یکی از محصولات دیگر در دسترس نیست.']); $qty=(int)$qty; if($qty<1 || $p->stock<$qty) throw ValidationException::withMessages(['cart'=>'موجودی یکی از محصولات کافی نیست: '.$p->name]); $line=(float)$p->price*$qty; $subtotal+=$line; $lines[]=[$p,$qty,$line]; }
            $order=Order::create(['user_id'=>$request->user()->id,'order_number'=>'IND-'.strtoupper(Str::random(10)),'status'=>'pending','subtotal'=>$subtotal,'total'=>$subtotal,'customer_name'=>$data['customer_name'],'customer_email'=>$data['customer_email'],'customer_phone'=>$data['customer_phone'],'shipping_address'=>$data['shipping_address'],'notes'=>$data['notes']??null]);
            foreach($lines as [$p,$qty,$line]) { $order->items()->create(['product_id'=>$p->id,'product_name'=>$p->name,'unit_price'=>$p->price,'quantity'=>$qty,'line_total'=>$line]); $p->decrement('stock',$qty); }
            return $order;
        });
        $request->session()->forget('cart'); return redirect()->route('orders.show',$order)->with('success','سفارش شما ثبت شد.');
    }
}
