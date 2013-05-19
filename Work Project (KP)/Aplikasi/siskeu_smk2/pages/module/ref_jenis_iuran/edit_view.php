<?
	require_once("business/jenisIuran.class.php");
	
	$tmpl->setBasedir("module/ref_jenis_iuran/templates");
	$tmpl->readTemplatesFromFile("edit_view.html");

	$tmpl->addVar("article", "HEADLINE", "Edit Jenis Iuran Siswa");
	$tmpl->addVar("article", "URL_PROSES", "module/ref_jenis_iuran/process_request.php");

	//print_r($code);
	$id=$code['idEd'];
	$jn=$code['jenjang'];
		
	$edit=new jenisIuran;
	$edit->connect();
	$edit->get_iuran($id, $jn);
	
	$row=0;
	while($result=$edit->get_array()){
		$disp[$row]=array(
						'ID'=>$result['Id'],
						'NAMA'=>$result['Nama'], 
						'JENJANG'=>$result['Jenjang'], 
						'JENIS'=>$result['Jenis'],
						'NOMINAL'=>$result['Nominal'], 
						'UTS'=>$result['Syarat_UTS'], 
						'UAS'=>$result['Syarat_UAS']); 
		$row++;
	}
	//print_r($disp);
	foreach($disp as $data){
		$tmpl->addVars("data", $data);
	}

	$edit->get_jenis();
	$sel=0;
	while($select=$edit->get_array()){
		if ($select['Jenis_Iuran']==$disp[0]['JENIS']) {
			$checked = 'CHECKED';
		} else {
			$checked = '';
		}
		$jenis[$sel]=array('JENIS_IURAN'=>$select['Jenis_Iuran'], 'CHECKED'=>$checked);
		$sel++;
	}
	
	foreach($jenis as $pilih){
		$tmpl->addVars("jenis", $pilih);
		$tmpl->parseTemplate("jenis", "a");
	}
?>