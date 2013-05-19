<?
   set_time_limit(10);
   require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/lib/WriteExcel/Worksheet.php");
   require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/lib/WriteExcel/Workbook.php");
   require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/pages/function/format_tanggal.php");
   require_once("headering_excel.php");
   require_once("business/rekap_umum.class.php");  
   
   
   $tanggal_selesai = $_GET['i'];
   $tanggal_mulai = $_GET['j'];
   
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
   
   $worksheet->merge_cells(1, 0, 2, 6);
   $worksheet->write_string(1, 0, 'SMK N 2 TEMANGGUNG', $h3);
   
   $worksheet->merge_cells(3, 0, 3, 6);
   $worksheet->write_string(3, 0, 'Rekapitulasi Umum Bendahara Iuran', $h3);
   
   $worksheet->set_column(0, 0, 3);
   $worksheet->set_column(1, 1, 30);
   $worksheet->set_column(2, 2, 15);
   $worksheet->set_column(3, 3, 15);
   $worksheet->set_column(4, 4, 15);
   $worksheet->set_column(5, 5, 15);
   $worksheet->set_column(6, 6, 15);
   
   $worksheet->merge_cells(5, 0, 6, 0);
   $worksheet->write_string(5, 0, 'No', $h4);
   
   $worksheet->merge_cells(5, 1, 6, 1);
   $worksheet->write_string(5, 1, 'Tanggal Transaksi', $h4);
   
   $worksheet->merge_cells(5, 2, 5, 3);
   $worksheet->write_string(5, 2, 'Pemasukan', $h4);
   
   $worksheet->merge_cells(5, 4, 5, 5);
   $worksheet->write_string(5, 4, 'Pengeluaran', $h4);
   
   $worksheet->merge_cells(6, 2, 6, 2);
   $worksheet->write_string(6, 2, 'Iuran', $h4);
   
   $worksheet->merge_cells(6, 3, 6, 3);
   $worksheet->write_string(6, 3, 'Pengembalian', $h4);
   
   $worksheet->merge_cells(6, 4, 6, 4);
   $worksheet->write_string(6, 4, 'Setoran', $h4);
   
   $worksheet->merge_cells(6, 5, 6, 5);
   $worksheet->write_string(6, 5, 'Pinjaman', $h4);
   
   $worksheet->merge_cells(5, 6, 6, 6);
   $worksheet->write_string(5, 6, 'Saldo', $h4);
   
   $view = new rekap_umum;
   $view->connect();
   $view->get_rekap_umum($tanggal_mulai, $tanggal_selesai);
   
   $row=7;
   $Acc=0;
   $number=1;
   while($result=$view->get_array()) {
      $Acc = $Acc + $result['SALDO'];		
   	  
      $worksheet->write_string($row, 0, $number, $content);
      $worksheet->write_string($row, 1, format_tanggal($result['TANGGAL_TRANSAKSI']), $content);
      $worksheet->write_string($row, 2, number_format($result['TOTAL_IURAN'],2,',','.'), $content);
      $worksheet->write_string($row, 3, number_format($result['TOTAL_PENGEMBALIAN'],2,',','.'), $content);
      $worksheet->write_string($row, 4, number_format($result['TOTAL_SETORAN'],2,',','.'), $content);
      $worksheet->write_string($row, 5, number_format($result['TOTAL_PEMINJAMAN'],2,',','.'), $content);
      $worksheet->write_string($row, 6, number_format($Acc,2,',','.'), $content);	
   	$row++;$number++;
   }
   
   $workbook->close();
?>