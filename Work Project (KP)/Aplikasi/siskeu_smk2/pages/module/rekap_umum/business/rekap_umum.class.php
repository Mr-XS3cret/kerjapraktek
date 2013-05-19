<?

require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");

class rekap_umum extends mysql_db{

   function get_rekap_umum($start, $end){
      return $this->execute("SELECT
                               TANGGAL_TRANSAKSI,
                               SUM(NOMINAL_IURAN) AS TOTAL_IURAN,
                               SUM(NOMINAL_KEMBALI) AS TOTAL_PENGEMBALIAN,
                               SUM(NOMINAL_SETORAN) AS TOTAL_SETORAN,
                               SUM(NOMINAL_PINJAM) AS TOTAL_PEMINJAMAN,
                               (SUM(NOMINAL_IURAN)+SUM(NOMINAL_KEMBALI)-SUM(NOMINAL_SETORAN)-SUM(NOMINAL_PINJAM)) AS SALDO
                           FROM(
                              SELECT
                                 tanggalPenyetoran AS TANGGAL_TRANSAKSI,
                                 0 AS NOMINAL_IURAN,
                                 0 AS NOMINAL_KEMBALI,
                                 SUM(nominalRekapSetoran) AS NOMINAL_SETORAN,
                                 0 AS NOMINAL_PINJAM
                              FROM
                                 sis_rekap_setoran
                              WHERE 
                                 tanggalPenyetoran BETWEEN '$start' AND '$end' 
                              GROUP BY tanggalPenyetoran
                              
                              UNION
                              
                              SELECT
                                 tanggalKembali AS TANGGAL_TRANSAKSI,
                                 0 AS NOMINAL_IURAN,
                                 SUM(nominalKembali) AS NOMINAL_KEMBALI,
                                 0 AS NOMINAL_SETORAN,
                                 0 AS NOMINAL_PINJAM
                              FROM
                                 sis_pengembalian
                              WHERE 
                                 tanggalKembali BETWEEN '$start' AND '$end' 
                              GROUP BY tanggalKembali
                              
                              UNION
                              
                              SELECT
                                 tanggal AS TANGGAL_TRANSAKSI,
                                 SUM(nominalRekap) AS NOMINAL_IURAN,
                                 0 AS NOMINAL_KEMBALI,
                                 0 AS NOMINAL_SETORAN,
                                 0 AS NOMINAL_PINJAM
                              FROM
                                 sis_rekap_iuran
                              WHERE 
                                 tanggal BETWEEN '$start' AND '$end' 
                              GROUP BY tanggal
                              
                              UNION
                              
                              SELECT
                                 tanggalPeminjaman AS TANGGAL_TRANSAKSI,
                                 0 AS NOMINAL_IURAN,
                                 0 AS NOMINAL_KEMBALI,
                                 0 AS NOMINAL_SETORAN,
                                 SUM(nominalPeminjaman) AS NOMINAL_PINJAM
                              FROM
                                 sis_peminjaman
                              WHERE 
                                 tanggalPeminjaman BETWEEN '$start' AND '$end' 
                              GROUP BY tanggalPeminjaman )tmp
                           GROUP BY TANGGAL_TRANSAKSI");
   }

}

?>