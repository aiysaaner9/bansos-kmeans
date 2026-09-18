# 📊 Bansos K-Means Clustering System

**Bansos K-Means** adalah aplikasi web analisis data yang dirancang untuk mengelompokkan (*clustering*) data calon penerima Bantuan Sosial (Bansos) menggunakan algoritma **K-Means Clustering**. Sistem ini membantu memvalidasi dan memetakan tingkat kelayakan warga secara transparan dan objektif berdasarkan kriteria ekonomi maupun sosial.

---

## 🌟 Fitur Utama / Key Features

- **Manajemen Data Kriteria:** Mengelola data kependudukan dan kriteria penilaian kelayakan warga.
- **Proses Algoritma K-Means:**
  - Penentuan nilai $k$ (jumlah kelompok) dan inisialisasi pusat cluster (*centroid*).
  - Perhitungan jarak variabel menggunakan pendekatan *Euclidean Distance*.
  - Pengelompokan data secara otomatis hingga mencapai kondisi konvergen.
- **Hasil & Analisis Klaster:** Membagi penerima ke dalam tingkatan kelayakan (contoh: *Prioritas Utama / Layak / Tidak Layak*).
- **Laporan & Laporan PDF/Excel:** Ringkasan hasil klasterisasi yang siap diekspor untuk kebutuhan administrasi.

---

## 🛠️ Teknologi yang Digunakan / Tech Stack

- **Backend & Frontend:** PHP, HTML, CSS, JavaScript
- **Database:** MySQL
- **Tools:** VS Code, phpMyAdmin
