<?php
namespace app\commands;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use \Datetime;
use \DateInterval;
use \DatePeriod;
class myHelper extends Component
{
  public function indonesian_date ($timestamp = '', $date_format = 'j F Y ', $suffix = 'WIB') {
    if (trim ($timestamp) == '')
    {
        $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
      $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
      '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
      '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
      '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
      '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
      '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
      '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
      '/April/','/June/','/July/','/August/','/September/','/October/',
      '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
      'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
      'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
      'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
      'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} ";
    return $date;
  }
  public function pengaturan()
  {
    $c= \app\models\Pengaturan::findOne([
      'id'=>'1'
    ]);
    return $c;
  }
  public function hitungHari($date1,$date2)
  {
    $date1 = strtotime($date1);
    $date2 = strtotime($date2);

    $difference = $date2 - $date1;
    $day=floor($difference / 86400);
    return $day+1;
    /*
    if($day==0)
    {
      return ($day+1);
    }
    else if($day==1)
    {
      return($day+1);
    }
    else {
      return $day;
    }*/
  }
  public function pegawaiByJabatan($id_jabatan)
  {
    $p=\app\models\Pegawai::findOne([
            'id_jabatan'=>$id_jabatan
          ]);
    return $p;
  }
  public function pegawaiById($id)
  {
    $p=\app\models\Pegawai::findOne([
            'id'=>$id
          ]);
    return $p;
  }
  public function terbilang($x)
  {
    $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    if ($x < 12)
    return " " . $abil[$x];
    elseif ($x < 20)
    return $this->terbilang($x - 10) . "belas";
    elseif ($x < 100)
    return $this->terbilang($x / 10) . " puluh" . $this->terbilang($x % 10);
    elseif ($x < 200)
    return " seratus" . $this->terbilang($x - 100);
    elseif ($x < 1000)
    return $this->terbilang($x / 100) . " ratus" . $this->terbilang($x % 100);
    elseif ($x < 2000)
    return " seribu" . $this->terbilang($x - 1000);
    elseif ($x < 1000000)
    return $this->terbilang($x / 1000) . " ribu" . $this->terbilang($x % 1000);
    elseif ($x < 1000000000)
    return $this->terbilang($x / 1000000) . " juta" . $this->terbilang($x % 1000000);


  }
  public function formatRupiah($rp)
  {
    return number_format( $rp ,0, '' , '.' );
  }
  public function hariIndonesia($tanggal)
  {
    $day = date('D', strtotime($tanggal));
    $dayList = array(
    	'Sun' => 'Minggu',
    	'Mon' => 'Senin',
    	'Tue' => 'Selasa',
    	'Wed' => 'Rabu',
    	'Thu' => 'Kamis',
    	'Fri' => 'Jumat',
    	'Sat' => 'Sabtu'
    );
    return $dayList[$day];
  }
  public function cekTanggal($start_date,$end_date,$userid,$par,$id){
    $queryiftugas='';
    $queryifmemo='';
    $queryifijincuti='';
    $queryand=' AND `id` NOT IN('.$id.')';
    //0 create, 1 tugas, 2 memo, 3 ijincuti, 4 tugaskolektif, 5 Editkolektif
    if($par==1)
    {
      $queryiftugas=$queryand;
    }else if($par==2)
    {
      $queryifmemo=$queryand;
    }
    else if($par==3)
    {
      $queryifijincuti=$queryand;
    }

    $checkdate=false;
    $connection = Yii::$app->getDb();
    $commandtugas='';

    if($par==4)
    {
      $commandtugas = $connection->createCommand("
        SELECT COUNT(id) AS cnt FROM `tugas` WHERE
        '".$start_date."' <= `date_end` AND '".$end_date."' >= `date_start`
        AND `id_pegawai`IN(".$userid.") ".$queryiftugas." AND blok_absen=1
      ");
    }else {
      $commandtugas = $connection->createCommand("
        SELECT COUNT(id) AS cnt FROM `tugas` WHERE
        '".$start_date."' <= `date_end` AND '".$end_date."' >= `date_start`
        AND `id_pegawai` IN(".$userid.") ".$queryiftugas." AND blok_absen=1
      ");
    }

    $result = $commandtugas->queryAll();

    if($result[0]['cnt']>0)
    {
      $checkdate = true;
    }

    $commandmemo='';
    if($par==4)
    {
      $commandmemo = $connection->createCommand("
        SELECT COUNT(id) AS cnt FROM `memo` WHERE
        (`jam_keluar` LIKE '".$start_date."%' OR `jam_pulang` LIKE '".$end_date."%')
        AND `id_pegawai` IN(".$userid.") ".$queryifmemo."
      ");
    }else {
      $commandmemo = $connection->createCommand("
        SELECT COUNT(id) AS cnt FROM `memo` WHERE
        (`jam_keluar` LIKE '".$start_date."%' OR `jam_pulang` LIKE '".$end_date."%')
        AND `id_pegawai`IN(".$userid.") ".$queryifmemo."
      ");
    }


    $result2 = $commandmemo->queryAll();
    if($result2[0]['cnt']>0)
    {
      $checkdate = true;
    }

    $commandijincuti='';
    if($par==4)
    {
      $commandijincuti = $connection->createCommand("
        SELECT COUNT(id) AS cnt FROM `ijincuti` WHERE
        '".$start_date."' <= `date_end` AND '".$end_date."' >= `date_start`
        AND `id_pegawai` IN(".$userid.") ".$queryifijincuti."
      ");
    }
    else{
      $commandijincuti = $connection->createCommand("
        SELECT COUNT(id) AS cnt FROM `ijincuti` WHERE
        '".$start_date."' <= `date_end` AND '".$end_date."' >= `date_start`
        AND `id_pegawai` IN(".$userid.") ".$queryifijincuti."
      ");
    }

    $result3 = $commandijincuti->queryAll();
    if($result3[0]['cnt']>0)
    {
      $checkdate = true;
    }

    return $checkdate;

  }
  public function isWeekend($date)
  {
    $weekDay = date('w', strtotime($date));
    return ($weekDay == 0 || $weekDay == 6);
  }
  function number_of_working_days($from, $to) {
    $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
    $holidayDays = ['*-12-25', '*-01-01', '2013-12-23']; # variable and fixed holidays

    $from = new DateTime($from);
    $to = new DateTime($to);
    $to->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($from, $interval, $to);

    $days = 0;
    foreach ($periods as $period) {
        if (!in_array($period->format('N'), $workingDays)) continue;
        if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
        if (in_array($period->format('*-m-d'), $holidayDays)) continue;
        $days++;
    }
    return $days;
  }
  public function getShift($id)
  {
    $shift=\app\models\Shift::findOne([
            'id'=>$id
          ]);
    return $shift;
  }
  public function getTugasbyid($id)
  {
    $tugas=\app\models\Tugas::findOne([
      'id'=>$id
    ]);
    return $tugas;
  }
  public function getJabatanbyid($id)
  {
    $jabatan=\app\models\Jabatan::findOne([
      'id_jabatan'=>$id
    ]);
    return $jabatan;
  }
  public function getSeksibyidtugas($id)
  {
    $assignee_id=$this->getTugasById($id)->assignee;
    $seksi=\app\models\Seksi::findOne([
      'id'=>$assignee_id
    ]);
    return $seksi;
  }
  public function getSeksibyidgroup($id)
  {
    $tugas=\app\models\Tugas::find()
    ->select('assignee')
    ->where(['id_group'=>$id])
    ->one();
    $seksi=\app\models\Seksi::findOne([
      'id'=>$tugas->assignee
    ]);
    return $seksi;
  }
  public function getKepalaseksibykode($id)
  {
    $jabatan=\app\models\Jabatan::find()
    ->where(['kode_seksi'=>$id])
    ->andWhere(['like', 'jabatan', 'kepala'])
    ->one();
    return $jabatan;
  }
  public function isKepalaseksi($id_jabatan)
  {
    $jabatan=\app\models\Jabatan::find()
    ->select(['jabatan'])
    ->where(['id_jabatan'=>$id_jabatan])
    ->one();
    $jabatan=$jabatan->jabatan;
    if(strpos($jabatan,'Kepala Seksi')!==false||strpos($jabatan,'Tata Usaha')!==false||strpos($jabatan,'Koordinator Seksi')!==false)
    {
      return true;
    }else {
      return false;
    }
  }

}
?>
