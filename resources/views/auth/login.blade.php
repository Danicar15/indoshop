@extends('layouts.app')

@section('title', 'ورود')

@section('content')
<section class="auth-section container">
    <div class="auth-card">
        <span class="eyebrow">خوش برگشتی</span>
        <h1>ورود به حساب کاربری</h1>
        <p class="auth-intro">برای ادامه خرید وارد حساب خودت شو.</p>

        @if(session('status')) <div class="auth-success">{{ session('status') }}</div> @endif
        @if($errors->any())
            <div class="auth-errors">
                @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="auth-form">
            @csrf
            <label for="email">ایمیل</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            <label for="password">رمز عبور</label>
            <input id="password" name="password" type="password" required autocomplete="current-password">
            <label class="remember-row"><input type="checkbox" name="remember" value="1"> مرا به خاطر بسپار</label>
            <button class="button button-primary auth-submit" type="submit">ورود به حساب <span>←</span></button>
        </form>
        <p class="auth-switch">حساب نداری؟ <a href="{{ route('register') }}">ثبت‌نام کن</a></p>
    </div>
</section>
@endsection
