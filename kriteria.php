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
  <meta charset="UTF-8" />
  <title>Kelola Kriteria</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      font-family: 'Inter', sans-serif;
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

    .input-field {
      border: 1px solid #ccc;
      padding: 0.25rem 0.5rem;
      border-radius: 0.375rem;
      text-align: center;
      width: 5rem;
    }

    .alert {
      padding: 1rem;
      border-radius: 0.5rem;
      margin-bottom: 1rem;
    }

    .alert-error {
      background-color: #fef2f2;
      border: 1px solid #fca5a5;
      color: #b91c1c;
    }

    .alert-success {
      background-color: #f0fdf4;
      border: 1px solid #86efac;
      color: #166534;
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

  <div class="max-w-3xl mx-auto space-y-6 mt-10">

    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-semibold">Daftar Kriteria & Bobot</h1>
      <a href="index.php" class="link">← Kembali</a>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-error">⚠️ <?= $error ?></div>
    <?php elseif ($success): ?>
      <div class="alert alert-success">✅ <?= $success ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-6 rounded-xl shadow">
      <table class="w-full text-sm border border-collapse">
        <thead class="bg-gray-100 text-xs uppercase">
          <tr>
            <th class="border p-2 text-left">Nama</th>
            <th class="border p-2 text-center">Atribut</th>
            <th class="border p-2 text-center">Bobot</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($kriteria as $k): ?>
          <tr class="hover:bg-gray-50">
            <td class="border p-2"><?= htmlspecialchars($k['nama']) ?></td>
            <td class="border p-2 text-center"><?= $k['atribut'] ?></td>
            <td class="border p-2 text-center">
              <input type="number" step="0.01" min="0" max="1" name="bobot[<?= $k['id'] ?>]" value="<?= $k['bobot'] ?>" class="input-field">
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="mt-6 text-right">
        <button type="submit" class="btn">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</body>
</html>