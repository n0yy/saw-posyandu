<?php
require_once '../vendor/autoload.php';
use Dompdf\Dompdf;

if (!isset($_POST['data'])) {
    die('Data tidak ditemukan.');
}
$hasil = unserialize(base64_decode($_POST['data']));

$html = '<h2 style="text-align:center;">Hasil Rekomendasi Makanan (SAW)</h2>';
$html .= '<table border="1" cellpadding="6" cellspacing="0" width="100%">';
$html .= '<thead><tr><th>Peringkat</th><th>Nama Makanan</th><th>Skor</th></tr></thead><tbody>';
foreach ($hasil as $i => $row) {
    $html .= '<tr'.($i==0?' style="background:#d1fae5;font-weight:bold;"':'').'><td align="center">'.($i+1).'</td><td>'.$row['nama'].'</td><td align="center">'.number_format($row['skor'],4).'</td></tr>';
}
$html .= '</tbody></table>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('hasil_saw_posyandu.pdf', ['Attachment' => 0]);
exit; 