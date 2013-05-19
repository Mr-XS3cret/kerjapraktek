<?
   require_once("business/pengeluaran_bon.class.php");
	require_once("function/format_tanggal.php");

	$tmpl->setBasedir("module/pengeluaran_bon/templates");
	$tmpl->readTemplatesFromFile("detil_bayar_view.html");
	
	//print_r($code);
	$idBn=$code['idBn'];
	$nama=$code['nama'];

   $tmpl->addVar("article", "HEADLINE", "Histori Pembayaran ".$nama);
	
	$view = new Peminjaman;
	$view->connect();
	
	$view->get_pembayaran_detil($idBn);

	$row=0;
	while($result=$view->get_array()){
		$number=$row+1;
		if ($number % 2 ==0){
			$class_name='table-common-even';
		}else{
			$class_name='';
		}
		
		$disp[$row]=array('NO'=>$number,
								'IDBYR'=>$result['IDBYR'],
								'TANGGAL'=>format_tanggal($result['TANGGAL']),
								'NOMINAL'=>number_format($result['NOMINAL'],2,',','.'), 
								'CLASS_NAME'=>$class_name); 
		$row++;
	}
	#print_r($disp);
	foreach ($disp as $data){
		$param="module=pengeluaran_bon&file=edit_detil_view&idByr=".$data['IDBYR'];
		$urlEd=$crypt->paramEncrypt($param);
		
		$tmpl->addVars("data", $data);
		$tmpl->addVar("data", "URL_EDIT", "index.php?".$urlEd);
		$tmpl->parseTemplate("data","a");
	}
?>