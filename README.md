# Ecommerce Gozeal Store

Proyek ini merupakan aplikasi ecommerce sederhana bernama **Gozeal Store** yang dikembangkan sebagai tugas dan bahan ajar untuk mata kuliah **Pemrograman Web 2** di Politeknik Harapan Bersama Tegal.

## Fitur Utama

- Manajemen Product Category
- Manajemen Product
- Login & Register Customer
- Keranjang Belanja
- Proses Checkout
- Dashboard Customer

## Instalasi

1. Clone repository ini:
    ```bash
    git clone https://github.com/NurAjiPurnomo/gozealstore.git
    cd gozealstore
    ```
2. Jalankan perintah berikut untuk menginstall dependency PHP:
    ```bash
    composer install
    ```
3. Jalankan perintah berikut untuk menginstall dependency frontend dan menjalankan development server:
    ```bash
    npm install
    ```
4. Atur konfigurasi database pada file `.env` sesuai dengan pengaturan database Anda.
5. Jalankan migrasi database:
    ```bash
    php artisan migrate
    ```
6. Jalankan perintah berikut untuk membuka hasilnya di browser:
    ```bash
    composer run dev
    ```

## Kontribusi

Kontribusi sangat terbuka untuk pengembangan lebih lanjut. Silakan buat pull request atau issue.

## Lisensi

Proyek ini dibuat hanya untuk keperluan pembelajaran.
