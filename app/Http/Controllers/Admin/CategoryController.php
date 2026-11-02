<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index() { $categories = Category::withCount('products')->orderBy('name')->paginate(15); return view('admin.categories.index', compact('categories')); }
    public function create() { return view('admin.categories.create', ['category' => new Category()]); }
    public function store(Request $request) { $data = $this->validated($request); $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name']); Category::create($data); return redirect()->route('admin.categories.index')->with('success','دسته‌بندی ایجاد شد.'); }
    public function edit(Category $category) { return view('admin.categories.edit', compact('category')); }
    public function update(Request $request, Category $category) { $data = $this->validated($request,$category); $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name'],$category->id); $category->update($data); return redirect()->route('admin.categories.index')->with('success','دسته‌بندی ویرایش شد.'); }
    public function destroy(Category $category) { if ($category->products()->exists()) return back()->with('error','این دسته‌بندی محصول دارد؛ ابتدا محصولات را منتقل یا حذف کنید.'); $category->delete(); return back()->with('success','دسته‌بندی حذف شد.'); }
    private function validated(Request $request, ?Category $category = null): array { return $request->validate(['name'=>['required','string','max:255'],'slug'=>['nullable','string','max:255',Rule::unique('categories','slug')->ignore($category?->id)],'description'=>['nullable','string','max:5000'],'is_active'=>['nullable','boolean']]) + ['is_active'=>$request->boolean('is_active')]; }
    private function uniqueSlug(string $source, ?int $ignoreId = null): string { $base=Str::slug($source) ?: 'category'; $slug=$base; $n=2; while(Category::where('slug',$slug)->when($ignoreId,fn($q)=>$q->where('id','!=',$ignoreId))->exists()) $slug=$base.'-'.$n++; return $slug; }
}
