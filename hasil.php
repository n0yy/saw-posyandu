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
  <meta charset="UTF-8" />
  <title>Hasil SAW</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      font-family: 'Inter', sans-serif;
    }

    .highlight-winner {
      background-color: #f5f5f5;
      font-weight: 600;
    }

    .btn {
      background-color: #000000;
      color: #ffffff;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      transition: all 0.2s ease-in-out;
    }

    .btn:hover {
      background-color: #1a1a1a;
      transform: translateY(-2px);
    }

    .link {
      color: #000000;
      text-decoration: underline;
    }

    .link:hover {
      color: #333333;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <?php require_once './components/navbar.php'; ?>
  <div class="max-w-4xl mx-auto space-y-6 mt-10">
    <!-- Header -->
    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-semibold">Hasil Rekomendasi Makanan (SAW)</h1>
      <a href="index.php" class="link">← Kembali</a>
    </div>

    <form action="utils/export_pdf.php" method="post" target="_blank">
      <input type="hidden" name="data" value='<?= base64_encode(serialize($hasil)) ?>'>
      <div class="bg-white p-6 rounded-xl shadow">
        <table class="w-full border-collapse border text-sm">
          <thead class="bg-gray-100 text-xs uppercase">
            <tr>
              <th class="border p-2">Peringkat</th>
              <th class="border p-2 text-left">Nama Makanan</th>
              <th class="border p-2">Skor</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($hasil as $i => $row): ?>
              <tr class="border <?= $i === 0 ? 'highlight-winner' : 'hover:bg-gray-50' ?>">
                <td class="border p-2 text-center"><?= $i + 1 ?></td>
                <td class="border p-2"><?= htmlspecialchars($row['nama']) ?></td>
                <td class="border p-2 text-center"><?= number_format($row['skor'], 4) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <div class="text-right mt-4">
        <button type="submit" class="btn">Export ke PDF</button>
      </div>
    </form>
  </div>
</body>
</html>
