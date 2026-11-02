INDO SHOP - MILESTONE 1 PATCH
=============================

این بسته فایل‌های پایه فروشگاه و کاتالوگ را برای Laravel 13 اضافه می‌کند:
- صفحه اصلی فارسی و RTL
- دسته‌بندی محصولات
- فهرست محصولات، جستجو و فیلتر دسته‌بندی
- صفحه جزئیات محصول
- مدل‌ها، Migrationها و Seederهای نمونه

قبل از اعمال:
1) از فایل routes/web.php فعلی یک کپی بگیر.
2) فایل‌ها را در ریشه پروژه Laravel یعنی /home/peyman/project/indoshop استخراج کن.
3) فایل‌های هم‌نام را جایگزین کن.

تنظیم دیتابیس در .env:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=indoshop
DB_USERNAME=نام_کاربر_دیتابیس
DB_PASSWORD=رمز_عبور

نکته: دیتابیس و کاربر را باید جداگانه ایجاد کنید؛ این بسته هیچ تغییری در سرویس MariaDB نمی‌دهد.

بعد از استخراج و تنظیم .env، از مسیر پروژه اجرا کن:
php artisan migrate --seed
php artisan optimize:clear

سپس برای تست موقت:
php artisan serve --host=127.0.0.1 --port=8000

این milestone شامل ورود/ثبت‌نام، سبد خرید، ثبت سفارش و پنل ادمین نیست؛ آن‌ها در milestoneهای بعدی اضافه می‌شوند.
