<?
	require_once("business/pengeluaran_setoran.class.php");
	require_once("function/format_tanggal.php");

	$tmpl->setBasedir("module/pengeluaran_setoran/templates");
	$tmpl->readTemplatesFromFile("detil_view.html");
	
	//print_r($code);
	$stId = $code['idSt'];
	
	$view = new Setoran;
	$view->connect();
	
	$view->get_nama_setoran($stId);
	$stNama = $view->get_array();
	$tmpl->addVar("article", "HEADLINE", "Histori Penyetoran ".$stNama['NAMA']);
	
	
	$view->get_history_setoran_detil($stId);

	$row=0;
	while($result=$view->get_array()){
		$number=$row+1;
		if ($number % 2 ==0){
			$class_name='table-common-even';
		}else{
			$class_name='';
		}
		
		$disp[$row]=array('NO'=>$number,
								'ID'=>$result['ID'],
								'TANGGAL'=>format_tanggal($result['TANGGAL']),
								'TOTAL'=>number_format($result['TOTAL'],2,',','.'), 
								'KETERANGAN'=>$result['JUMLAH_MASUK'], 
								'CLASS_NAME'=>$class_name); 
		$row++;
	}
	#print_r($disp);
	foreach ($disp as $data){
		$param="module=pengeluaran_setoran&file=edit_view&idTr=".$data['ID'];
		$urlEd=$crypt->paramEncrypt($param);
		
		$tmpl->addVars("data", $data);
		$tmpl->addVar("data", "URL_EDIT", "index.php?".$urlEd);
		$tmpl->parseTemplate("data","a");
	}
?>