# Laravel Installation Guide

## Kebutuhan
Sebelum melakukan instalasi sistem ini maka kamu harus mempersiapkan berikut:

- PHP (>= 8.2)
- Composer
- MySQL or PostgreSQL database
- Git ( Opsional)

## Tahap Instalasi

### 1. Install Composer
Jika kamu tidak mempunyai Composer maka kamu dapat mendownloadnya di tautan berikut:
[https://getcomposer.org/](https://getcomposer.org/)

### 2. Meng-clone repository 
Jalankan di terminal CMD sesuai direktori yang anda butuhkan:
```bash
git clone https://github.com/
```
Setelah selesai buka folder tersebut dengan perintah
```bash
cd 
```

### 3. Atur Environment
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
jika tidak bisa maka dilakukan manual 

### 5. Atur database di file .env
perbarui `.env` sesuai dengan pengaturan database anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```


membuat key pada aplikasi:
```bash
php artisan key:generate
```
( **Opsional**)
jalankan migrasi database:
```bash
php artisan migrate
```

### 6. Jalankan Aplikasi anda
Start the development server:
```bash
php artisan serve
```
Your Laravel application should now be accessible at `http://127.0.0.1:8000`


## Additional Commands
- **Clear cache:** `php artisan cache:clear`
- **Seed database:** `php artisan db:seed`
- **Run tests:** `php artisan test`

