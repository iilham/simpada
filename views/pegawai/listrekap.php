<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rekap Absensi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="listrekap-index">
  <div class="box box-solid box-success">
    <div class="box-header with-border">
      <h4 class="box-title">Pengaturan</h4>
    </div>
    <div class="box-body">
      <div class="row" style="padding-bottom:10px">
      <div class="col-md-3">
      <?php
        echo '<label for="datestart">Tanggal Mulai</label>';
        echo DatePicker::widget([
          'attribute' => 'date_start',
          'dateFormat' => 'yyyy-MM-dd',
          'name'=> 'datestart',
          'options' => [
            'class' => 'form-control',
            'style' => [
                'cursor'=>'pointer',
            ],
          ],
          ]);
        ?>
      </div>
      <div class="col-md-3">
      <?php
        echo '<label for="dateend">Tanggal Selesai</label>';
        echo DatePicker::widget([
          'attribute' => 'date_end',
          'dateFormat' => 'yyyy-MM-dd',
          'name'=> 'dateend',
          'options' => [
            'class' => 'form-control',
            'style' => [
                'cursor'=>'pointer',
            ],
            ]
          ]);
        ?>
      </div>
    </div>
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'bordered'=>true,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        'hover'=>true,
        'panel'=>[
            'type'=>GridView::TYPE_SUCCESS,
            'heading'=>'<i class="glyphicon glyphicon-book"></i>  '
        ],
        'toolbar' => [''],
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'default'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'nip:ntext',
            [
              'label'=>'Pegawai',
              'format'=>'raw',
              'attribute' => 'nama',
              'value' => function($dataProvider){
                return Html::a($dataProvider->nama, ['view', 'id' => $dataProvider->id]);
              }
            ],
            [
              'attribute' => 'jabatan',
              'value' => 'idJabatan.jabatan',
            ],
            [
              'class'=>'yii\grid\ActionColumn',
              'template'=>'{view} | {print}',
              'buttons'=>[
                'print' => function ($url,$model) {
                  return Html::a('<span class="glyphicon glyphicon-print"></span> Cetak PDF', ['pegawai/lihatrekapabsen','id_pegawai'=>$model->id,'date_start'=>'dx1','date_end'=>'dx2','ispdf'=>'1'],['name' => 'tampilkanpdf']);
                },
                'view'=>function ($url,$model) {
                  return Html::a('<span class="fa fa-calendar-o"></span> Tampilkan', ['pegawai/lihatrekapabsen','id_pegawai'=>$model->id,'date_start'=>'dx1','date_end'=>'dx2','ispdf'=>'0'],['name' => 'tampilkanweb']);
                },
              ],
            ],
          ],
      ]); ?>
    </div>
  </div>
</div>
<?php
$this->registerJsFile(
  '@web/js/sweetalert-master/dist/sweetalert.min.js'
);
$this->registerCssFile(
  '@web/js/sweetalert-master/dist/sweetalert.css'
);
$this->registerJs(
  '
  $("a[name=\"tampilkanweb\"]").click(function(){
    var tanggalmulai=$("#w0").val();
    var tanggalselesai=$("#w1").val();
    var tempTglMulai="dx1";
    var tempTglSelesai="dx2";
    var temp1;
    var temp2;

    if(!cekTanggal(tanggalmulai,tanggalselesai)){
      return false;
    }

      $(this).attr("href",function(i,origValue){
        temp1=origValue.replace(tempTglMulai,tanggalmulai);
        return temp1;
      });
      $(this).attr("href",function(i,origValue){
        var temp2=origValue.replace(tempTglSelesai,tanggalselesai);
        return temp2;
      });

    var url = $(this).attr("href");
    window.open(url, "_blank");
    $(this).attr("href",function(i,origValue){
      var ini=origValue.replace(tanggalmulai,tempTglMulai);
      return ini;
    });
    $(this).attr("href",function(i,origValue){
      var ini=origValue.replace(tanggalselesai,tempTglSelesai);
      return ini;
    });
    return false;
  });

  $("a[name=\"tampilkanpdf\"]").click(function(){
    var tanggalmulai=$("#w0").val();
    var tanggalselesai=$("#w1").val();
    var tempTglMulai="dx1";
    var tempTglSelesai="dx2";
    var temp1;
    var temp2;
    if(!cekTanggal(tanggalmulai,tanggalselesai)){
      return false;
    }

    $(this).attr("href",function(i,origValue){
      temp1=origValue.replace(tempTglMulai,tanggalmulai);
      return temp1;
    });
    $(this).attr("href",function(i,origValue){
      var temp2=origValue.replace(tempTglSelesai,tanggalselesai);
      return temp2;
      });

    var url = $(this).attr("href");
    window.open(url, "_blank");
    $(this).attr("href",function(i,origValue){
      var ini=origValue.replace(tanggalmulai,tempTglMulai);
      return ini;
    });
    $(this).attr("href",function(i,origValue){
      var ini=origValue.replace(tanggalselesai,tempTglSelesai);
      return ini;
    });
    return false;
  });

  function ambilBulan(d)
  {
    var d=new Date(d);
    var m=d.getMonth()+1;
    return m;
  }
  function cekTanggal(tanggalmulai,tanggalselesai)
  {
    if(tanggalmulai.length==0||tanggalselesai.length==0)
    {
      sweetAlert("Oops...", "Tanggal Harus Diisi", "error");
      return false;
    }
    if(ambilBulan(tanggalmulai)!=ambilBulan(tanggalselesai))
    {
      sweetAlert("Oops...", "Untuk Saat ini Hanya Bisa dalam Rentang 1 Bulan", "error");
      return false;
    }
    return true;
  }
  '
)
  ?>
