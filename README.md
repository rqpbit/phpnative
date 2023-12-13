# Halo, Selamat datang di repositori phpnative 🎉

Repositori ini merupakan kerangka kerja dalam pembuatan website dengan menggunakan PHP Native, yaitu membuat dari awal tanpa bantuan dari framework atau library tambahan, mulai dari struktur folder, penamaan file ini diatur oleh saya sendiri selaku pengembang.

Framework ini saya pakai untuk mengerjakan website application yang cenderung sederhana dan membutuhkan waktu pembuatan secara cepat, jika kamu tertarik untuk berkontribusi kamu bisa melakukkan fork dan pr, gomawo ^_^

## Struktur folder dan Files
```
├── assets
│   ├── controller
│   │   ├── **/*.css
│   ├── views
│   ├── model
│   ├── index.js
├── config
│   ├── css
│   │   ├── **/*.css
│   ├── images
│   ├── js
│   ├── index.html
├── crud
│   ├── css
│   │   ├── **/*.css
│   ├── images
│   ├── js
│   ├── index.html
├── db
│   ├── phpnative.sql
├── libraries
│   ├── bootstrap-4
│   ├── dataTables
│   ├── font-awesome-4
│   ├── jquery-3
├── signin
│   ├── index.php
├── signup
│   ├── index.php
├── .gitignore 
├── index.php
```


## Database (phpnative.sql)
| users | persons | config |
| --- | --- | --- |
| id | id | data3 |
| username | first_name | name_apps |
| email | last_name | author |
| password | email | maintenance |
| active | updated_at | updated_at |
|  | created_at |  |
|  | active |  |


 > Pada table <i>config</i> dan <i>users</i> memiliki 1 data default pada file .sql tersebut

## Catatan Perubahan
13 Desember 2023
- Menghapus file docs.log
- Membuat README.md
- Rilis untuk publik

31 Desember 2020
- CRUD
- Helpers
- Frontend (Login and Welcoe)
- Libraries (bootstrap, datatables, font-awesome, & jquery)

<hr>

> ⚠ <b>INFORMASI PENTING</b> : kerangka kerja ini tidak memiliki keamanan yang layak untuk dapat mengudara di Internet, kamu perlu melakukkan konfigurasi tambahan dalam segi keamanan, repositori ini ditujukan untuk bahan belajar, perbandingan, atau aplikasi yang dijalankan secara local
