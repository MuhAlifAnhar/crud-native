<?php 

require 'vendor/autoload.php';
require 'config/app.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();
$activeWorksheet->setCellValue('A2', 'No')->getColumnDimension('A')->setAutoSize(true);
$activeWorksheet->setCellValue('B2', 'Nama')->getColumnDimension('B')->setAutoSize(true);
$activeWorksheet->setCellValue('C2', 'Studio')->getColumnDimension('C')->setAutoSize(true);
$activeWorksheet->setCellValue('D2', 'Kategori')->getColumnDimension('D')->setAutoSize(true);
$activeWorksheet->setCellValue('E2', 'Status')->getColumnDimension('E')->setAutoSize(true);
$activeWorksheet->setCellValue('F2', 'Waktu')->getColumnDimension('F')->setAutoSize(true);

$styleBorder = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$no = 1;
$loc = 3;

$kategori = query("SELECT f.id_film, f.title, f.studio, f.created_at, f.private, k.name AS kategori_nama 
               FROM film f 
               JOIN kategori k 
               ON f.kategori_id = k.id_kategori 
               WHERE f.private = 0 
               ORDER BY f.created_at DESC");


foreach ($kategori as $key) {
    $activeWorksheet->setCellValue('A'.$loc, $no++);
    $activeWorksheet->setCellValue('B'.$loc, $key['title']);
    $activeWorksheet->setCellValue('C'.$loc, $key['studio']);
    $activeWorksheet->setCellValue('D'.$loc, $key['kategori_nama']);
    $status = $key['private'] == 0 ? 'Publik' : 'Privat';
    $activeWorksheet->setCellValue('E'.$loc, $status);
    $activeWorksheet->setCellValue('F'.$loc, $key['created_at']);
    $loc++;
}

$activeWorksheet->getStyle('A2:F'. ($loc - 1))->applyFromArray($styleBorder);

$penulisan = new Xlsx($spreadsheet);
$nama_file = "Film_List.xlsx";
$penulisan->save($nama_file);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); 
header("Content-Length: " . filesize($nama_file));
header('Content-Disposition: attachment; filename=' . $nama_file);
readfile($nama_file);
unlink($nama_file);
?>