<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPK Posyandu - Beranda</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    * {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .gradient-bg {
      background: linear-gradient(135deg, #000000 0%, #333333 100%);
    }

    .gradient-subtle {
      background: linear-gradient(135deg, #f9f9f9 0%, #eaeaea 100%);
    }

    .animate-fade-in {
      animation: fadeIn 1s ease-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .hover-lift {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .hover-lift:hover {
      transform: translateY(-8px);
    }

    .card-shadow {
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.05);
    }

    .card-shadow:hover {
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .btn-primary {
      background: #000000;
      color: #ffffff;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .icon-container {
      background: #111111;
    }

    .glass-effect {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.9);
      border: 1px solid rgba(0, 0, 0, 0.1);
    }
  </style>

</head>
<body class="bg-gray-50">
  <!-- Navigation -->
  <?php include 'components/navbar.php'; ?>

  <!-- Hero Section -->
  <section class="gradient-bg text-white py-24 lg:py-32">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center animate-fade-in">
        <div class="mb-6">
          <span class="inline-block px-4 py-2 text-black bg-white bg-opacity-20 rounded-full text-sm font-medium mb-4">
            Sistem Pendukung Keputusan
          </span>
        </div>
        
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
          Pemilihan Makanan Bergizi
          <span class="block text-yellow-300 mt-2">untuk Balita</span>
        </h1>
        
        <p class="text-lg md:text-xl mb-12 text-gray-100 max-w-3xl mx-auto font-light leading-relaxed">
          Membantu kader Posyandu Kenanga Cimanggis menentukan makanan bergizi terbaik menggunakan metode Simple Additive Weighting (SAW)
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
          <a href="form.php" class="btn-primary text-white px-8 py-4 rounded-xl font-medium text-base shadow-lg flex items-center">
            <i class="fas fa-plus mr-3"></i>
            Tambah Data Makanan
          </a>
          <a href="hasil.php" class="bg-white text-gray-800 px-8 py-4 rounded-xl font-medium text-base shadow-lg hover:bg-gray-50 transition-all duration-300 flex items-center">
            <i class="fas fa-chart-line mr-3 text-gray-600"></i>
            Lihat Hasil Analisis
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-20">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Fitur Unggulan
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto font-light">
          Sistem yang dirancang untuk membantu pengambilan keputusan objektif dan terukur
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Feature 1 -->
        <div class="group">
          <div class="card-shadow hover-lift bg-white rounded-2xl p-8 text-center border border-gray-100 min-h-[300px]">
            <div class="w-16 h-16 icon-container rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 ">
              <i class="fas fa-calculator text-white text-xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Metode SAW</h3>
            <p class="text-gray-600 leading-relaxed font-light">
              Menggunakan Simple Additive Weighting untuk perhitungan akurat dan objektif berdasarkan kriteria yang ditentukan
            </p>
          </div>
        </div>

        <!-- Feature 2 -->
        <div class="group">
          <div class="card-shadow hover-lift bg-white rounded-2xl p-8 text-center border border-gray-100 min-h-[300px]">
            <div class="w-16 h-16 icon-container rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
              <i class="fas fa-leaf text-white text-xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Gizi Seimbang</h3>
            <p class="text-gray-600 leading-relaxed font-light">
              Mempertimbangkan kriteria penting: kalori, protein, lemak, zat besi, zinc, dan biaya untuk rekomendasi terbaik
            </p>
          </div>
        </div>

        <!-- Feature 3 -->
        <div class="group">
          <div class="card-shadow hover-lift bg-white rounded-2xl p-8 text-center border border-gray-100 min-h-[300px]">
            <div class="w-16 h-16 icon-container rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
              <i class="fas fa-file-pdf text-white text-xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Export PDF</h3>
            <p class="text-gray-600 leading-relaxed font-light">
              Hasil analisis dapat diekspor ke format PDF untuk dokumentasi dan laporan profesional
            </p>
          </div>
        </div>

        <!-- Feature 4 -->
        <div class="group">
          <div class="card-shadow hover-lift bg-white rounded-2xl p-8 text-center border border-gray-100 min-h-[300px]">
            <div class="w-16 h-16 icon-container rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
              <i class="fas fa-baby text-white text-xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Khusus Balita</h3>
            <p class="text-gray-600 leading-relaxed font-light">
              Dirancang khusus untuk kebutuhan gizi balita (1-5 tahun) sesuai standar kesehatan
            </p>
          </div>
        </div>

        <!-- Feature 5 -->
        <div class="group">
          <div class="card-shadow hover-lift bg-white rounded-2xl p-8 text-center border border-gray-100 min-h-[300px]">
            <div class="w-16 h-16 icon-container rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
              <i class="fas fa-clock text-white text-xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Cepat & Akurat</h3>
            <p class="text-gray-600 leading-relaxed font-light">
              Mengatasi perhitungan manual yang memakan waktu dengan sistem otomatis yang efisien
            </p>
          </div>
        </div>

        <!-- Feature 6 -->
        <div class="group">
          <div class="card-shadow hover-lift bg-white rounded-2xl p-8 text-center border border-gray-100 min-h-[300px]">
            <div class="w-16 h-16 icon-container rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
              <i class="fas fa-shield-alt text-white text-xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Reliable</h3>
            <p class="text-gray-600 leading-relaxed font-light">
              Sistem yang handal dan konsisten untuk mendukung keputusan penting dalam kesehatan balita
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="gradient-subtle py-12 border-t border-gray-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <div class="flex items-center justify-center space-x-3 mb-4">
          <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
            <i class="fas fa-heartbeat text-white text-sm"></i>
          </div>
          <span class="text-lg font-semibold text-gray-800">SPK Posyandu</span>
        </div>
        <p class="text-gray-600 font-light">
          © 2025 built by Fachrizal Alamsyah.
        </p>
      </div>
    </div>
  </footer>
</body>
</html>