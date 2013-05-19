<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");
	
	class Peminjaman extends mysql_db{
		
		function get_all_data_peminjaman(){
			return $this->execute("SELECT
											idPeminjaman AS ID,
											namaPeminjam AS NAMA, 
											tanggalPeminjaman AS TANGGAL,
											nominalPeminjaman AS JUMLAH_PINJAM,
											(SELECT 
                                    SUM(nominalKembali) 
                                 FROM
                                    sis_pengembalian 
                                 WHERE 
                                    idPeminjamanKembali=idPeminjaman) AS JUMLAH_BAYAR
										FROM
											 sis_peminjaman
                              ORDER BY idPeminjaman DESC");
		}
	
		function get_detil_data_peminjaman($idBn){              
			return $this->execute("SELECT
											idPeminjaman AS ID,
											namaPeminjam AS NAMA, 
											tanggalPeminjaman AS TANGGAL,
											nominalPeminjaman AS JUMLAH_PINJAM,
											(SELECT 
                                    SUM(nominalKembali) 
                                 FROM 
                                    sis_pengembalian 
                                 WHERE 
                                    idPeminjamanKembali=idPeminjaman) AS JUMLAH_BAYAR
										FROM
											 sis_peminjaman
										WHERE idPeminjaman = '$idBn'");
		}
		
		function pembayaran_baru($id, $bayar){
         return $this->execute("INSERT INTO 
                                 sis_pengembalian
                              VALUES ( '','$id','$bayar',NOW())");
      }
      
      function get_pembayaran_detil($idBn){
         return $this->execute("SELECT
                                 idPengembalian AS IDBYR,
                                 tanggalKembali AS TANGGAL,
                                 nominalKembali AS NOMINAL
                              FROM
                                 sis_pengembalian
                              WHERE
                                 idPeminjamanKembali = '$idBn'
                              ORDER BY idPengembalian DESC");
      }
      
      function get_detil_pembayaran_by_tanggal($idByr){
         return $this->execute("SELECT
                                  idPengembalian AS ID, 
                                  namaPeminjam AS NAMA,
                                  nominalKembali AS NOMINAL,
                                  tanggalKembali AS TANGGAL
                              FROM
                                  sis_pengembalian
                              JOIN
                                  sis_peminjaman ON idPeminjaman = idPeminjamanKembali
                              WHERE 
                                  idPengembalian = '$idByr'");
      }
      
      function update_peminjaman($idBn, $tanggal, $nama, $nominal){
         return $this->execute("UPDATE 
                                    sis_peminjaman 
                              SET 
                                 tanggalPeminjaman = '$tanggal',
                                 namaPeminjam = '$nama',
                                 nominalPeminjaman = '$nominal'
                              WHERE
                                 idPeminjaman = '$idBn'");
      }
      
      function insert_peminjaman($nama, $nominal){
         return $this->execute("INSERT INTO sis_peminjaman VALUES('', '$nama', '$nominal', NOW())");
      }
      
      function update_cicilan($id, $bayar){
         return $this->execute("UPDATE
                                 sis_pengembalian
                              SET
                                 nominalKembali='$bayar'
                              WHERE
                                 idPengembalian='$id'");
      }
	
	}
?>