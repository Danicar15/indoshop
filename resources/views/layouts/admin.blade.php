<!doctype html>
<html lang="fa" dir="rtl"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>@yield('title','مدیریت Indo Shop')</title><link rel="stylesheet" href="{{ asset('css/admin.css') }}"></head><body>
<header class="admin-top"><a href="{{ route('admin.dashboard') }}">Indo Shop <small>مدیریت فروشگاه</small></a><nav><a href="{{ route('home') }}">مشاهده فروشگاه</a><span>{{ auth()->user()->name }}</span><form method="POST" action="{{ route('logout') }}">@csrf<button>خروج</button></form></nav></header>
<div class="admin-shell"><aside class="admin-side"><a href="{{ route('admin.dashboard') }}">داشبورد</a><a href="{{ route('admin.products.index') }}">محصولات</a><a href="{{ route('admin.categories.index') }}">دسته‌بندی‌ها</a><a href="{{ route('admin.orders.index') }}">سفارش‌ها</a></aside><main class="admin-main">
@if(session('success'))<div class="notice success">{{ session('success') }}</div>@endif @if(session('error'))<div class="notice error">{{ session('error') }}</div>@endif
@if($errors->any())<div class="notice error"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
@yield('content')</main></div></body></html>
