<?php
require_once './config/db.php';

$makanan = $pdo->query("SELECT * FROM makanan")->fetchAll(PDO::FETCH_ASSOC);
$kriteria = $pdo->query("SELECT * FROM kriteria")->fetchAll(PDO::FETCH_ASSOC);

$normalisasi = [];
foreach ($kriteria as $k) {
    $nama = $k['nama'];
    $kolom = array_column($makanan, $nama);
    foreach ($makanan as $i => $m) {
        if (!isset($normalisasi[$i])) {
            $normalisasi[$i] = $m;
        }
        if ($k['atribut'] == 'benefit') {
            $normalisasi[$i][$nama] = $m[$nama] / max($kolom);
        } else {
            $normalisasi[$i][$nama] = min($kolom) / $m[$nama];
        }
    }
}

$hasil = [];
foreach ($normalisasi as $i => $row) {
    $skor = 0;
    foreach ($kriteria as $k) {
        $skor += $k['bobot'] * $row[$k['nama']];
    }
    $hasil[] = [
        'nama' => $row['nama'],
        'skor' => $skor
    ];
}

usort($hasil, fn($a, $b) => $b['skor'] <=> $a['skor']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil SAW</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-6">
  <div class="max-w-4xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
      <h1 class="text-xl font-bold">Hasil Rekomendasi Makanan (SAW)</h1>
      <a href="index.php" class="text-blue-600 hover:underline">← Kembali</a>
    </div>

    <form action="export_pdf.php" method="post">
      <input type="hidden" name="html" value="<?= htmlspecialchars(ob_start()); ?>">
      <div class="bg-white p-6 rounded shadow" id="hasil-table">
        <table class="w-full table-auto text-sm border">
          <thead class="bg-gray-200 text-xs uppercase">
            <tr>
              <th class="border p-2">Peringkat</th>
              <th class="border p-2">Nama Makanan</th>
              <th class="border p-2">Skor</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($hasil as $i => $row): ?>
              <tr class="border <?= $i === 0 ? 'bg-green-100 font-semibold' : '' ?>">
                <td class="border p-2 text-center"><?= $i + 1 ?></td>
                <td class="border p-2"><?= $row['nama'] ?></td>
                <td class="border p-2 text-center"><?= number_format($row['skor'], 4) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="text-right mt-4">
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 hover:cursor-pointer">
          Export ke PDF
        </button>
      </div>
      <?php ob_end_flush(); ?>
    </form>

  </div>
</body>
</html>
