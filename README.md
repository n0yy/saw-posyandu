# SPK Posyandu (Metode SAW)

## Struktur Project

- `index.php` — Form & tabel data makanan
- `pages/home.php` — Halaman Home (latar belakang, tujuan, dll)
- `kriteria.php` — Kelola kriteria & bobot
- `hasil.php` — Hasil perhitungan SAW & export PDF
- `components/navbar.php` — Komponen navigasi utama
- `utils/export_pdf.php` — Export hasil SAW ke PDF (menggunakan dompdf)
- `config/db.php` — Koneksi database
- `assets/` — (opsional) untuk gambar, custom CSS, dsb
- `vendor/` — Library composer (otomatis)

## Dependensi

- PHP >= 7.4
- MySQL
- [dompdf/dompdf](https://github.com/dompdf/dompdf) (untuk export PDF)
- Tailwind CSS (CDN)

## Cara Menjalankan

1. Import `db.sql` ke MySQL.
2. Jalankan project di XAMPP/Laragon/localhost.
3. Akses `pages/home.php` untuk halaman utama.
4. Navigasi menggunakan navbar.
5. Untuk export PDF hasil SAW, klik tombol "Export ke PDF" di halaman hasil.

---

UI sudah didesain minimalis dan elegan dengan Tailwind CSS. Struktur project lebih modular dan mudah dikembangkan.
