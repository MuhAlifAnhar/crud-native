<?php 

require 'vendor/autoload.php';
require 'config/app.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();
$activeWorksheet->setCellValue('A2', 'No')->getColumnDimension('A')->setAutoSize(true);
$activeWorksheet->setCellValue('B2', 'Title')->getColumnDimension('B')->setAutoSize(true);
$activeWorksheet->setCellValue('C2', 'Slug')->getColumnDimension('C')->setAutoSize(true);
$activeWorksheet->setCellValue('D2', 'Created At')->getColumnDimension('D')->setAutoSize(true);

$no = 1;
$loc = 3;

$kategori = query("SELECT * FROM kategori ORDER BY create_at DESC");

foreach ($kategori as $key) {
    $activeWorksheet->setCellValue('A'.$loc, $no++);
    $activeWorksheet->setCellValue('B'.$loc, $key['name']);
    $activeWorksheet->setCellValue('C'.$loc, $key['slug']);
    $activeWorksheet->setCellValue('D'.$loc, $key['create_at']);
    $loc++;
}


$penulisan = new Xlsx($spreadsheet);
$nama_file = "Kategori_List.xlsx";
$penulisan->save($nama_file);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); 
header("Content-Length: " . filesize($nama_file));
header('Content-Disposition: attachment; filename=' . $nama_file);
readfile($nama_file);
unlink($nama_file);
?>