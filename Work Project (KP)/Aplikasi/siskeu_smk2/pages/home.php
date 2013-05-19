<?
session_start();

$x='id=1';
$url1=$crypt->paramEncrypt($x);

$x='id=2';
$url2=$crypt->paramEncrypt($x);

$x='id=3';
$url3=$crypt->paramEncrypt($x);

$x='id=4';
$url4=$crypt->paramEncrypt($x);  

$x='id=5';
$url5=$crypt->paramEncrypt($x); 

$x='id=6';
$url6=$crypt->paramEncrypt($x);

$x='id=7';
$url7=$crypt->paramEncrypt($x);

$x='id=8';
$url8=$crypt->paramEncrypt($x);

$x='id=9';
$url9=$crypt->paramEncrypt($x);

$x='id=10';
$url10=$crypt->paramEncrypt($x);

$x='id=11';
$url11=$crypt->paramEncrypt($x);

if($_SESSION['group']==1){
   echo "<table class='table-common-home'>
           <tr>
               <td><a href='index.php?".$url3."' title='Input Iuran Bulanan'><img src='../images/icon/1.gif'></td>
               <td><a href='index.php?".$url4."' title='Input Iuran Tahunan'><img src='../images/icon/10.gif'></td>
               <td><a href='index.php?".$url8."' title='Input Sumbangan / DPS'><img src='../images//icon/9.gif'></td>
           </tr>
           <tr>
               <td><a href='index.php?".$url6."' title='Manajemen Setoran'><img src='../images/icon/5.gif'></td>
               <td><a href='index.php?".$url5."' title='Manajemen Peminjaman Dana'><img src='../images/icon/6.gif'></td>
               <td><a href='index.php?".$url7."' title='Rekapitulasi Iuran Siswa'><img src='../images/icon/4.gif'></td>
           </tr>
           <tr>
               <td><a href='index.php?".$url9."' title='Rekapitulasi Umum'><img src='../images/icon/7.gif'></td>
               <td><a href='index.php?".$url10."' title='Datfar Black List Ujian'><img src='../images/icon/8.gif'></td>
               <td><a href='index.php?".$url11."' title='Cek Ijin Ujian'><img src='../images//icon/11.gif'></td>
           </tr>
           <tr>
               <td><a href='index.php?".$url1."' title='Referensi Data Jenis Iuran'><img src='../images/icon/3.gif'></td>
               <td><a href='index.php?".$url2."' title='Referensi Data Siswa'><img src='../images/icon/12.gif'></td>
               <td></td>
           </tr>
        </table>
      ";
} elseif ($_SESSION['group']==2){
   echo "<table class='table-common-home'>
           
           <tr>
               <td><a href='index.php?".$url7."' title='Rekapitulasi Iuran Siswa'><img src='../images/icon/4.gif'></td>
               <td><a href='index.php?".$url9."' title='Rekapitulasi Umum'><img src='../images/icon/7.gif'></td>
           </tr>
           <tr>
               <td><a href='index.php?".$url10."' title='Datfar Black List Ujian'><img src='../images/icon/8.gif'></td>
               <td><a href='index.php?".$url11."' title='Cek Ijin Ujian'><img src='../images//icon/11.gif'></td>
           </tr>
           
        </table>
      ";   
} else {
   header('location:index.php?portal=1');
}



?>