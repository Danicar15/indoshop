<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = Product::with('category')->when($request->filled('q'), function ($q) use ($request) {
            $term = trim($request->q); $q->where(fn($w) => $w->where('name','like',"%{$term}%")->orWhere('slug','like',"%{$term}%"));
        })->latest()->paginate(12)->withQueryString();
        return view('admin.products.index', compact('products'));
    }
    public function create() { return view('admin.products.create', ['product' => new Product(), 'categories' => Category::orderBy('name')->get()]); }
    public function store(Request $request) {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name']);
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'محصول با موفقیت ایجاد شد.');
    }
    public function edit(Product $product) { return view('admin.products.edit', ['product' => $product, 'categories' => Category::orderBy('name')->get()]); }
    public function update(Request $request, Product $product) {
        $data = $this->validated($request, $product);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name'], $product->id);
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'محصول ویرایش شد.');
    }
    public function destroy(Product $product) {
        if ($product->orderItems()->exists()) return back()->with('error', 'این محصول در سفارش ثبت شده و قابل حذف نیست؛ آن را غیرفعال کنید.');
        $product->delete(); return back()->with('success', 'محصول حذف شد.');
    }
    private function validated(Request $request, ?Product $product = null): array {
        return $request->validate([
            'category_id' => ['required','integer', Rule::exists('categories','id')],
            'name' => ['required','string','max:255'], 'slug' => ['nullable','string','max:255', Rule::unique('products','slug')->ignore($product?->id)],
            'description' => ['nullable','string','max:10000'], 'price' => ['required','numeric','min:0','max:999999999999'],
            'stock' => ['required','integer','min:0','max:100000000'], 'image_url' => ['nullable','url','max:2048'],
            'is_active' => ['nullable','boolean'],
        ]) + ['is_active' => $request->boolean('is_active')];
    }
    private function uniqueSlug(string $source, ?int $ignoreId = null): string {
        $base = Str::slug($source) ?: 'product'; $slug = $base; $n = 2;
        while (Product::where('slug',$slug)->when($ignoreId, fn($q)=>$q->where('id','!=',$ignoreId))->exists()) $slug = $base.'-'.$n++;
        return $slug;
    }
}
