<?
require_once('../lib/AES/AES.class.php');

//created by : Rosihan Ari Yuana
//modified by : Muhammad Rifqi Ma'arif

class Enkripsi{
	function paramEncrypt($x){
	   $Cipher = new AES();
	   $key_128bit = '2b7e151628aed2a6abf7158809cf4f3c';// kunci enkripsi 
		$n = ceil(strlen($x)/16); // membagi panjang string yang akan dienkripsi dengan panjang 16 karakter
	   $encrypt = "";

	   for ($i=0; $i<=$n-1; $i++){
	      $cryptext = $Cipher->encrypt($Cipher->stringToHex(substr($x, $i*16, 16)), $key_128bit);// mengenkripsi setiap 16 karakter
		   $encrypt .= $cryptext;// menggabung hasil enkripsi setiap 16 karakter menjadi satu string enkripsi utuh   
	   } 
	   return $encrypt;
	}

	function paramDecrypt($x){
	   $Cipher = new AES();
		$key_128bit = '2b7e151628aed2a6abf7158809cf4f3c'; // kunci dekripsi (kunci ini harus sama dengan kunci enkripsi)
		$n = ceil(strlen($x)/32); // karena string hasil enkripsi memiliki panjang 32 karakter, maka untuk proses dekripsi ini panjang string dipotong2 dulu menjadi 32 karakter
	   $decrypt = "";

	   for ($i=0; $i<=$n-1; $i++){
	      $result = $Cipher->decrypt(substr($x, $i*32, 32), $key_128bit); // mendekrip setiap 32 karakter hasil enkripsi
			$decrypt .= $Cipher->hexToString($result); // menggabung hasil dekripsi 32 karakter menjadi satu string dekripsi utuh
	   }
	   return $decrypt; 
	}

	function decode($x){
		$pecahURI = explode('?', $x); // proses decoding: memecah parameter dan masing-masing value yang terkait
		$parameter = $pecahURI[1];
		$crypt = new Enkripsi;
		$pecahParam = explode('&', $crypt->paramDecrypt($parameter));

		for ($i=0; $i <= count($pecahParam)-1; $i++){
	     $decode = explode('=', $pecahParam[$i]);
	     $var[$decode[0]] = $decode[1];  
		}
		return $var;
	}
}
?>