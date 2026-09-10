# Ringkasan Proyek: Sorgumology

Proyek ini adalah aplikasi web berbasis **Laravel 12** yang terintegrasi dengan **Livewire 3** untuk frontend dinamis, **Vite 7** untuk bundling aset, dan **Filament Admin 4** sebagai panel admin untuk mengelola konten web.

---

## 1. Struktur Utama Folder Proyek

Berikut adalah penjelasan mengenai isi dari folder-folder utama dalam proyek ini:

*   **`app/`**: Berisi logika aplikasi inti.
    *   **`Filament/Resources/`**: Berisi konfigurasi dan kelas Filament resource untuk mengelola konten di admin panel (seperti Header, Footer, HeroSection, Product, dll).
    *   **`Http/`**: Berisi controller dasar.
    *   **`Livewire/`**: Kelas komponen Livewire yang menangani interaksi dinamis di frontend (seperti `ProductMarketplace`, `ProductDetail`, `HeroPage`, dll).
    *   **`Models/`**: Representasi database tabel (seperti `Product`, `HeroSection`, `User`, dll).
    *   **`Providers/`**: Berisi service providers, termasuk `AdminPanelProvider.php` yang mengonfigurasi admin panel Filament.
*   **`config/`**: Folder konfigurasi aplikasi Laravel (database, session, mail, services, dll).
*   **`database/`**: Berisi migrasi tabel, seeder, dan factory database.
    *   **`migrations/`**: Berisi skema database untuk tabel pengguna, produk, hero section, tim, dll.
    *   **`seeders/`**: Pengisian data awal database (seperti `DatabaseSeeder` untuk membuat user tes, dan `ProductSeeder` untuk mengisi data produk sorghum).
*   **`resources/`**: Aset frontend.
    *   **`css/`** & **`js/`**: Berisi file styling (menggunakan TailwindCSS) dan JavaScript (Flowbite).
    *   **`views/`**: Template Blade. Halaman utama berada di `landingpage.blade.php`, dan komponen Livewire berada di folder `views/livewire/`.
*   **`routes/`**: Menangani routing URL.
    *   **`routes/web.php`**: Berisi rute frontend aplikasi (`/`, `/marketplace`, dan `/product/{slug}`).
*   **`.env`**: Konfigurasi environment (koneksi database, konfigurasi mail, app key, dll).

---

## 2. Alur Kerja Aplikasi (Workflow)

Aplikasi memiliki dua alur utama: **Frontend** (sisi pengguna umum) dan **Backend** (sisi admin).

### A. Alur Frontend (Pengguna)
1.  **Halaman Utama (`/`)**:
    *   Pengguna mengakses URL utama. Rute mengarahkan ke view `landingpage.blade.php`.
    *   Di halaman ini, data diambil secara dinamis dari database menggunakan komponen-komponen Livewire:
        *   `HeaderPage` (Menu navigasi)
        *   `HeroPage` (Bagian Hero / Banner utama)
        *   `FeaturesPage` (Fitur & Keunggulan)
        *   `CompanyPage` (Profil perusahaan)
        *   `PartnerPage` (Mitra / Partner)
        *   `TeamPage` (Anggota tim)
        *   `FooterPage` (Bagian bawah/footer)
2.  **Marketplace (`/marketplace`)**:
    *   Pengguna dapat melihat daftar produk sorghum yang terdaftar di database melalui komponen Livewire `ProductMarketplace`.
3.  **Detail Produk (`/product/{slug}`)**:
    *   Pengguna mengklik salah satu produk untuk diarahkan ke halaman detail produk (`ProductDetail.php`). Informasi produk dimuat secara dinamis berdasarkan slug produk tersebut.

### B. Alur Backend (Admin)
1.  Admin mengakses URL `/admin` dan diarahkan ke halaman login Filament.
2.  Setelah berhasil login, admin masuk ke Dashboard Filament.
3.  Admin dapat melakukan CRUD (Create, Read, Update, Delete) pada konten web melalui menu-menu resource yang tersedia di sisi kiri dashboard. Setiap perubahan data pada resource ini langsung mengubah konten yang ditampilkan di Frontend.

---

## 3. Panel Admin (Mengubah Konten Web)

**Ya, aplikasi ini memiliki Admin Panel** untuk mengelola isi konten web. Panel admin dibangun menggunakan **Filament Admin (v4)**.

*   **URL Akses Admin Panel**: `http://127.0.0.1:8000/admin` (atau `/admin` di domain lokal Anda).
*   **Konten yang dapat diubah oleh Admin**:
    *   **Companies**: Mengubah deskripsi profil perusahaan.
    *   **Features**: Menambah/mengubah item fitur dan keunggulan.
    *   **Footers**: Mengubah informasi kontak, link sosial media, dan copyright.
    *   **Headers**: Mengubah item menu navigasi.
    *   **Hero Sections**: Mengubah teks judul, sub-judul, deskripsi, dan gambar banner utama di landing page.
    *   **Partners**: Mengelola logo mitra kerja sama.
    *   **Products**: Menambah, mengedit, mengaktifkan/menonaktifkan, atau menghapus produk sorgum di marketplace (termasuk deskripsi, harga, stok, gambar, dan slug).
    *   **Team Members**: Mengelola daftar anggota tim (nama, posisi, foto, dll).

---

## 4. Akun Admin Default

Akun admin bawaan yang disediakan oleh sistem (dibuat melalui seeder database pada `DatabaseSeeder.php` dan `UserFactory.php`) adalah:

*   **Email**: `test@example.com`
*   **Password**: `password`

---

## 5. Integrasi API AI (Artificial Intelligence)

Berdasarkan analisis menyeluruh pada file konfigurasi (`config/services.php`), dependensi (`composer.json` & `package.json`), serta struktur folder `app/`, **saat ini belum ada integrasi API AI (seperti Google Gemini API, OpenAI, dll) di dalam proyek ini.**

Jika Anda berencana menambahkan fitur AI (seperti Chatbot Asisten Sorgum, generator deskripsi produk sorgum otomatis, dll), kita dapat mengintegrasikannya dengan menginstal package API client (misalnya `google-gemini-php/client` atau `openai-php/client`) dan membuat komponen chat di frontend.
