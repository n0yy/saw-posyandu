<?php
  $current_page = basename($_SERVER['PHP_SELF']);
?>
<style>
  .gradient-bg {
    background: linear-gradient(135deg, #000000 0%, #333333 100%);
  }
  .glass-effect {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(0, 0, 0, 0.1);
  }
</style>
<nav class="glass-effect sticky top-0 z-50 border-b border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 gradient-bg rounded-lg flex items-center justify-center">
          <i class="fas fa-heartbeat text-white text-lg"></i>
        </div>
        <span class="text-xl font-semibold text-gray-800">SPK Posyandu</span>
      </div>
      
      <div class="hidden md:flex items-center space-x-1">
        <a href="index.php" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors <?php echo $current_page === 'index.php' ? 'text-white bg-gray-800' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100'; ?>">
          Beranda
        </a>
        <a href="kriteria.php" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors <?php echo $current_page === 'kriteria.php' ? 'text-white bg-gray-800' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100'; ?>">
          Kelola Kriteria
        </a>
        <a href="hasil.php" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors <?php echo $current_page === 'hasil.php' ? 'text-white bg-gray-800' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100'; ?>">
          Hasil SAW
        </a>
      </div>

      <!-- Mobile menu button -->
      <button class="md:hidden p-2 rounded-lg hover:bg-gray-100">
        <i class="fas fa-bars text-gray-600"></i>
      </button>
    </div>
  </div>
</nav>