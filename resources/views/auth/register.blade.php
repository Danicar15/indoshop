@extends('layouts.app')

@section('title', 'ثبت‌نام')

@section('content')
<section class="auth-section container">
    <div class="auth-card">
        <span class="eyebrow">به خانواده ایندو خوش اومدی</span>
        <h1>ساخت حساب کاربری</h1>
        <p class="auth-intro">چند قدم کوتاه تا تجربه خرید بهتر.</p>

        @if($errors->any())
            <div class="auth-errors">
                @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}" class="auth-form">
            @csrf
            <label for="name">نام و نام خانوادگی</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name">
            <label for="email">ایمیل</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username">
            <label for="password">رمز عبور (حداقل ۸ کاراکتر)</label>
            <input id="password" name="password" type="password" required autocomplete="new-password">
            <label for="password_confirmation">تکرار رمز عبور</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
            <button class="button button-primary auth-submit" type="submit">ساخت حساب <span>←</span></button>
        </form>
        <p class="auth-switch">قبلاً ثبت‌نام کردی؟ <a href="{{ route('login') }}">وارد شو</a></p>
    </div>
</section>
@endsection
