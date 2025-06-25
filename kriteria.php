<?php
require_once './config/db.php';

$error = "";
$success = "";

// Proses update bobot
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $total_bobot = array_sum($_POST['bobot']);

    if (abs($total_bobot - 1.0) > 0.001) {
        $error = "Jumlah total bobot harus tepat 1.00. Saat ini: " . number_format($total_bobot, 2);
    } else {
        foreach ($_POST['bobot'] as $id => $bobot) {
            $stmt = $pdo->prepare("UPDATE kriteria SET bobot = ? WHERE id = ?");
            $stmt->execute([$bobot, $id]);
        }
        $success = "Bobot berhasil disimpan.";
        header("Refresh:1");
    }
}

$kriteria = $pdo->query("SELECT * FROM kriteria")->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Kriteria</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-6">
  <div class="max-w-3xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
      <h1 class="text-xl font-bold">Daftar Kriteria & Bobot</h1>
      <a href="index.php" class="text-blue-600 hover:underline">← Kembali</a>
    </div>

    <?php if ($error): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        ⚠️ <?= $error ?>
      </div>
    <?php elseif ($success): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
        ✅ <?= $success ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-6 rounded shadow">
      <table class="w-full text-sm border">
        <thead class="bg-gray-200 text-xs uppercase">
          <tr>
            <th class="border p-2">Nama</th>
            <th class="border p-2">Atribut</th>
            <th class="border p-2">Bobot</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($kriteria as $k): ?>
          <tr class="border">
            <td class="border p-2"><?= htmlspecialchars($k['nama']) ?></td>
            <td class="border p-2 text-center"><?= $k['atribut'] ?></td>
            <td class="border p-2 text-center">
              <input type="number" step="0.01" min="0" max="1" name="bobot[<?= $k['id'] ?>]" value="<?= $k['bobot'] ?>" class="w-24 border rounded p-1 text-center">
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="mt-4 text-right">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          Simpan Perubahan
        </button>
      </div>
    </form>

  </div>
</body>
</html>
