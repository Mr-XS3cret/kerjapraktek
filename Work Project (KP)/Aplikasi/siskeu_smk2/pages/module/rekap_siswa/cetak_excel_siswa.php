<?
   //ini_set('max_execution_time', 0);
   set_time_limit(10);
   
   require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/lib/WriteExcel/Worksheet.php");
   require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/lib/WriteExcel/Workbook.php");
   require_once("headering_excel.php");
   require_once("business/rekap_siswa.class.php");
   
   $idKelas = $_GET['i'];
   $jenjangKelas = $_GET['j'];
   
   $nama_file = 'presensi.ods';
   HeaderingExcel($nama_file);
   
   $workbook = new Workbook('-');
   
   $h3 = & $workbook->add_format();
   $h3->set_bold();
   $h3->set_size(11);
   $h3->set_align('center');
   $h3->set_align('vcenter');
   $h3->set_text_wrap();
   
   $h4 = & $workbook->add_format();
   $h4->set_bold();
   $h4->set_size(10);
   $h4->set_align('center');
   $h4->set_align('vcenter');
   $h4->set_border(1);
   $h4->set_text_wrap();
   
   $hk = & $workbook->add_format();
   $hk->set_bold();
   $hk->set_size(10);
   $hk->set_align('right');
   $hk->set_align('vcenter');
   $hk->set_text_wrap();
		
	$content =& $workbook->add_format();
	$content->set_align('top');
	$content->set_size(8);
	$content->set_color('black');
	$content->set_border(1);
   
  	$worksheet =& $workbook->add_worksheet();
   $worksheet->set_landscape();
   $worksheet->set_paper(5);
   $worksheet->hide_gridlines();
   $worksheet->set_margin_left(2.5);
   $worksheet->set_margin_top(0.5);
   $worksheet->set_margin_right(0);
   $worksheet->set_margin_bottom(0);
   
   $view = new rekap_siswa;
   $view->get_kelas_detil($idKelas);
	$namaKelas = $view->get_array();
	
	$worksheet->merge_cells(1, 0, 2, 8);
   $worksheet->write_string(1, 0, 'SMK N 2 TEMANGGUNG', $h3);
   
   $worksheet->merge_cells(3, 0, 3, 8);
   $worksheet->write_string(3, 0, 'Rekapitulasi Dana Iuran Siswa', $h3);
   
   $worksheet->set_column(0, 0, 3);
   $worksheet->set_column(1, 1, 10);
   $worksheet->set_column(2, 2, 20);
   $worksheet->set_column(3, 3, 15);
   $worksheet->set_column(4, 4, 15);
   $worksheet->set_column(5, 5, 15);
   $worksheet->set_column(6, 6, 15);
   $worksheet->set_column(7, 7, 15);
   $worksheet->set_column(8, 8, 15);
   
   $worksheet->merge_cells(6, 7, 6, 8);
   $worksheet->write_string(6, 7, "Kelas : ".$jenjangKelas." - ".$namaKelas['NAMA'], $hk);
      
   $worksheet->merge_cells(7, 0, 8, 0);
   $worksheet->write_string(7, 0, 'No', $h4);
   
   $worksheet->merge_cells(7, 1, 8, 1);
   $worksheet->write_string(7, 1, 'NIS', $h4);
   
   $worksheet->merge_cells(7, 2, 8, 2);
   $worksheet->write_string(7, 2, 'Nama Siswa', $h4);
   
   $worksheet->merge_cells(7, 3, 7, 7);
   $worksheet->write_string(7, 3, 'Total Dana Iuran yang Sudah Dibayarakan', $h4);
   
   $worksheet->merge_cells(8, 3, 8, 3);
   $worksheet->write_string(8, 3, 'Komite', $h4);
   
   $worksheet->merge_cells(8, 4, 8, 4);
   $worksheet->write_string(8, 4, 'Tabungan Akhir', $h4);
   
   $worksheet->merge_cells(8, 5, 8, 5);
   $worksheet->write_string(8, 5, 'Prakerin', $h4);
   
   $worksheet->merge_cells(8, 6, 8, 6);
   $worksheet->write_string(8, 6, 'Kesiswaan', $h4);
   
   $worksheet->merge_cells(8, 7, 8, 7);
   $worksheet->write_string(8, 7, 'Sumbangan', $h4);
   
   $worksheet->merge_cells(7, 8, 8, 8);
   $worksheet->write_string(7, 8, 'Nominal Sumbangan', $h4);
   
   $view->get_list_siswa($jenjangKelas,  $idKelas);
	$row=9;
	$number=1;
	while($result=$view->get_array()){
		$worksheet->write_string($row, 0, $number, $content);
      $worksheet->write_string($row, 1, $result['NIS'], $content);
      $worksheet->write_string($row, 2, $result['NAMA'], $content);
      $worksheet->write_string($row, 3, number_format($result['TOTAL_KOMITE'],2,',','.'), $content);
      $worksheet->write_string($row, 4, number_format($result['TOTAL_TA'],2,',','.'), $content);
      $worksheet->write_string($row, 5, number_format($result['TOTAL_PRAKERIN'],2,',','.'), $content);
      $worksheet->write_string($row, 6, number_format($result['TOTAL_OSIS'],2,',','.'), $content);
      $worksheet->write_string($row, 7, number_format($result['TOTAL_DPS'],2,',','.'), $content);	
      $worksheet->write_string($row, 8, number_format($result['NoMINAL_DPS'],2,',','.'), $content);
      $row++;$number++;
	}
   
   $workbook->close();
?>