<?
//print_r($_POST);
require_once("business/rekap_umum.class.php");
require_once("function/format_tanggal.php");

$tmpl->setBasedir("module/rekap_umum/templates");
$tmpl->readTemplatesFromFile("detil_view.html");

$tmpl->addVar("article", "HEADLINE", "Rekapitulasi Umum");

$tanggal_mulai = $_POST['tahun']."-".$_POST['bulan']."-1";
$tanggal_selesai = $_POST['tahun']."-".$_POST['bulan']."-31";

$tmpl->addVar("article", "URL_XLS", "module/rekap_umum/cetak_excel_rekap.php?j=".$tanggal_mulai."&i=".$tanggal_selesai."");

$view = new rekap_umum;
$view->connect();

$view->get_rekap_umum($tanggal_mulai, $tanggal_selesai);
$row=0;
$Acc=0;
while($result=$view->get_array()) {
   $number=$row+1;
		if ($number % 2 ==0){
			$class_name='table-common-even';
		}else{
			$class_name='';
		}
      
      $Acc = $Acc + $result['SALDO'];		
		$disp[$row]=array('NO'=>$number,
						'TANGGAL'=>format_tanggal($result['TANGGAL_TRANSAKSI']), 
						'TOTAL_IURAN'=>number_format($result['TOTAL_IURAN'],2,',','.'),
						'TOTAL_PENGEMBALIAN'=>number_format($result['TOTAL_PENGEMBALIAN'],2,',','.'),
						'TOTAL_SETORAN'=>number_format($result['TOTAL_SETORAN'],2,',','.'),
						'TOTAL_PEMINJAMAN'=>number_format($result['TOTAL_PEMINJAMAN'],2,',','.'),
						'SALDO'=>number_format($Acc,2,',','.'),
						'CLASS_NAME'=>$class_name); 
		$row++;
}

foreach ($disp as $data){
		$param="module=rekap_siswa&file=detil_siswa_view&nis=".$data[TANGGAL];
		$urlDtl=$crypt->paramEncrypt($param);
		
		$tmpl->addVars("data", $data);
		$tmpl->addVar("data", "URL_DETIL", "index.php?".$urlDtl);
		$tmpl->parseTemplate("data","a");
	}
?>