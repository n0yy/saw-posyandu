<?php
require_once './config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO makanan (nama, kalori, protein, lemak, zat_besi, zinc, biaya)
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['nama'],
        $_POST['kalori'],
        $_POST['protein'],
        $_POST['lemak'],
        $_POST['zat_besi'],
        $_POST['zinc'],
        $_POST['biaya']
    ]);
    header("Location: index.php");
    exit;
}

$makanan = $pdo->query("SELECT * FROM makanan")->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Posyandu</title>
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-6">
  <div class="max-w-4xl mx-auto space-y-10">
    
    <!-- Form Input -->
    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-xl font-bold mb-4">Tambah Data Makanan</h2>
      <form method="POST" class="grid grid-cols-2 gap-4">
        <input type="text" name="nama" placeholder="Nama Makanan" class="border rounded p-2" required>
        <input type="number" step="any" name="kalori" placeholder="Kalori (kkal)" class="border rounded p-2" required>
        <input type="number" step="any" name="protein" placeholder="Protein (g)" class="border rounded p-2" required>
        <input type="number" step="any" name="lemak" placeholder="Lemak (g)" class="border rounded p-2" required>
        <input type="number" step="any" name="zat_besi" placeholder="Zat Besi (mg)" class="border rounded p-2" required>
        <input type="number" step="any" name="zinc" placeholder="Zinc (mg)" class="border rounded p-2" required>
        <input type="number" name="biaya" placeholder="Biaya (Rp)" class="border rounded p-2" required>
        <div class="col-span-2">
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
      </form>
    </div>

    <!-- Tabel Makanan -->
    <div class="bg-white px-6 py-3 rounded-lg shadow">
      <h2 class="text-xl font-bold mb-4">Daftar Makanan</h2>
      <table class="w-full table-auto border text-sm">
        <thead class="bg-gray-200 text-xs uppercase">
          <tr>
            <th class="border p-2">No</th>
            <th class="border p-2">Nama</th>
            <th class="border p-2">Kalori</th>
            <th class="border p-2">Protein</th>
            <th class="border p-2">Lemak</th>
            <th class="border p-2">Zat Besi</th>
            <th class="border p-2">Zinc</th>
            <th class="border p-2">Biaya</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($makanan as $i => $m): ?>
          <tr class="border hover:bg-gray-50">
            <td class="border p-2 text-center"><?= $i + 1 ?></td>
            <td class="border p-2"><?= htmlspecialchars($m['nama']) ?></td>
            <td class="border p-2 text-center"><?= $m['kalori'] ?></td>
            <td class="border p-2 text-center"><?= $m['protein'] ?></td>
            <td class="border p-2 text-center"><?= $m['lemak'] ?></td>
            <td class="border p-2 text-center"><?= $m['zat_besi'] ?></td>
            <td class="border p-2 text-center"><?= $m['zinc'] ?></td>
            <td class="border p-2 text-center">Rp<?= number_format($m['biaya'], 0, ',', '.') ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="flex gap-2 mb-4 mt-5">
        <a href="kriteria.php" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700">Kelola Kriteria</a>
        <a href="hasil.php" class="bg-gray-400 text-white px-4 py-2 rounded">Lihat Hasil</a>
     </div>
    </div>

  </div>
</body>
</html>