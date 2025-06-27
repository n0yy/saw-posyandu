<?php
require_once './config/db.php';

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $pdo->prepare("DELETE FROM makanan WHERE id = ?")->execute([$id]);
    header("Location: form.php");
    exit;
}

$editing_makanan = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $editing_makanan = $pdo->prepare("SELECT * FROM makanan WHERE id = ?");
    $editing_makanan->execute([$id]);
    $editing_makanan = $editing_makanan->fetch();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['id'])) {
        $stmt = $pdo->prepare("UPDATE makanan SET nama=?, kalori=?, protein=?, lemak=?, zat_besi=?, zinc=?, biaya=? WHERE id=?");
        $stmt->execute([
            $_POST['nama'],
            $_POST['kalori'],
            $_POST['protein'],
            $_POST['lemak'],
            $_POST['zat_besi'],
            $_POST['zinc'],
            $_POST['biaya'],
            $_POST['id']
        ]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO makanan (nama, kalori, protein, lemak, zat_besi, zinc, biaya) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['nama'],
            $_POST['kalori'],
            $_POST['protein'],
            $_POST['lemak'],
            $_POST['zat_besi'],
            $_POST['zinc'],
            $_POST['biaya']
        ]);
    }
    header("Location: form.php");
    exit;
}

$makanan = $pdo->query("SELECT * FROM makanan")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Form Data Makanan | SPK Posyandu</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">
  <?php require_once './components/navbar.php'; ?>
  <div class="max-w-5xl mx-auto space-y-12">
    
    <!-- Form Input -->
    <div class="bg-white p-6 rounded-xl shadow-md mt-10">
      <h2 class="text-2xl font-semibold mb-6"><?php echo $editing_makanan ? 'Edit Data Makanan' : 'Tambah Data Makanan'; ?></h2>
      <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php if($editing_makanan): ?>
          <input type="hidden" name="id" value="<?= $editing_makanan['id']; ?>">
        <?php endif; ?>
        <input type="text" name="nama" placeholder="Nama Makanan" value="<?= $editing_makanan['nama'] ?? '' ?>" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" required>
        <input type="number" step="any" name="kalori" placeholder="Kalori (kkal)" value="<?= $editing_makanan['kalori'] ?? '' ?>" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" required>
        <input type="number" step="any" name="protein" placeholder="Protein (g)" value="<?= $editing_makanan['protein'] ?? '' ?>" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" required>
        <input type="number" step="any" name="lemak" placeholder="Lemak (g)" value="<?= $editing_makanan['lemak'] ?? '' ?>" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" required>
        <input type="number" step="any" name="zat_besi" placeholder="Zat Besi (mg)" value="<?= $editing_makanan['zat_besi'] ?? '' ?>" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" required>
        <input type="number" step="any" name="zinc" placeholder="Zinc (mg)" value="<?= $editing_makanan['zinc'] ?? '' ?>" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" required>
        <input type="number" name="biaya" placeholder="Biaya (Rp)" value="<?= $editing_makanan['biaya'] ?? '' ?>" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" required>
        <div class="col-span-2 mt-4">
          <button type="submit" class="bg-black text-white rounded px-4 py-2 transition hover:shadow-lg hover:-translate-y-1 w-full md:w-auto"><?php echo $editing_makanan ? 'Update' : 'Simpan'; ?></button>
        </div>
      </form>
    </div>

    <!-- Tabel Makanan -->
    <div class="bg-white p-6 rounded-xl shadow-md">
      <h2 class="text-2xl font-semibold mb-6">Daftar Makanan</h2>
      <div class="overflow-x-auto">
        <table class="w-full table-auto border text-sm">
          <thead class="bg-gray-100 uppercase text-xs tracking-wide text-left">
            <tr>
              <th class="border px-3 py-2 text-sm text-center">No</th>
              <th class="border px-3 py-2 text-sm text-center">Nama</th>
              <th class="border px-3 py-2 text-sm text-center">Kalori</th>
              <th class="border px-3 py-2 text-sm text-center">Protein</th>
              <th class="border px-3 py-2 text-sm text-center">Lemak</th>
              <th class="border px-3 py-2 text-sm text-center">Zat Besi</th>
              <th class="border px-3 py-2 text-sm text-center">Zinc</th>
              <th class="border px-3 py-2 text-sm text-center">Biaya</th>
               <th class="border px-3 py-2 text-sm text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($makanan as $i => $m): ?>
              <tr class="hover:bg-gray-50">
                <td class="border px-3 py-2 text-sm text-center"><?= $i + 1 ?></td>
                <td class="border px-3 py-2 text-sm text-center"><?= htmlspecialchars($m['nama']) ?></td>
                <td class="border px-3 py-2 text-sm text-center"><?= $m['kalori'] ?></td>
                <td class="border px-3 py-2 text-sm text-center"><?= $m['protein'] ?></td>
                <td class="border px-3 py-2 text-sm text-center"><?= $m['lemak'] ?></td>
                <td class="border px-3 py-2 text-sm text-center"><?= $m['zat_besi'] ?></td>
                <td class="border px-3 py-2 text-sm text-center"><?= $m['zinc'] ?></td>
                <td class="border px-3 py-2 text-sm text-center">Rp<?= number_format($m['biaya'], 0, ',', '.') ?></td>
                 <td class="border px-3 py-2 text-sm text-center space-x-2">
                   <a href="form.php?edit=<?= $m['id'] ?>" class="text-blue-600 hover:underline"><i class="fas fa-edit"></i></a>
                   <a href="form.php?delete=<?= $m['id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('Hapus data ini?')"><i class="fas fa-trash"></i></a>
                 </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="flex flex-wrap gap-2 mt-6">
        <a href="kriteria.php" class="bg-black text-white rounded px-4 py-2 transition hover:shadow-lg hover:-translate-y-1 hover:duration-200">Kelola Kriteria</a>
        <a href="hasil.php" class="bg-gray-400 text-white rounded px-4 py-2 hover:bg-gray-800 hover:-translate-y-1 hover:duration-200">Lihat Hasil</a>
      </div>
    </div>
  </div>
</body>
</html>
