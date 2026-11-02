<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request) {
        $cart = $request->session()->get('cart', []); $ids = array_keys($cart);
        $products = Product::whereIn('id',$ids)->get()->keyBy('id'); $items=[]; $total=0;
        foreach($cart as $id=>$qty) { if(!$products->has($id)) continue; $p=$products[$id]; $line=(float)$p->price*(int)$qty; $items[]=['product'=>$p,'quantity'=>(int)$qty,'line_total'=>$line]; $total += $line; }
        return view('cart.index',compact('items','total'));
    }
    public function add(Request $request, Product $product) {
        abort_unless($product->is_active,404); $data=$request->validate(['quantity'=>['nullable','integer','min:1','max:99']]); $qty=(int)($data['quantity']??1);
        if($product->stock < $qty) return back()->with('error','موجودی کافی نیست.');
        $cart=$request->session()->get('cart',[]); $new=(int)($cart[$product->id]??0)+$qty;
        if($new>$product->stock) return back()->with('error','تعداد درخواستی بیشتر از موجودی است.');
        $cart[$product->id]=$new; $request->session()->put('cart',$cart); return back()->with('success','محصول به سبد خرید اضافه شد.');
    }
    public function update(Request $request, Product $product) {
        $data=$request->validate(['quantity'=>['required','integer','min:1','max:99']]);
        if($data['quantity']>$product->stock) return back()->with('error','تعداد درخواستی بیشتر از موجودی است.');
        $cart=$request->session()->get('cart',[]); if(isset($cart[$product->id])) { $cart[$product->id]=(int)$data['quantity']; $request->session()->put('cart',$cart); }
        return back()->with('success','سبد خرید به‌روزرسانی شد.');
    }
    public function remove(Request $request, Product $product) { $cart=$request->session()->get('cart',[]); unset($cart[$product->id]); $request->session()->put('cart',$cart); return back()->with('success','محصول از سبد حذف شد.'); }
}
