<?php
namespace app\models;
use app\models\Pegawai;
use yii\base\Model;
use Yii;
class SignupForm extends Model{
  public $id;
  public $username;
  public $password;
  public $nip;
  public $nip_lama;
  public $nama;
  public $id_jabatan;
  public $pangkat;
  public $golongan;
  public $is_motordinas;
  public function rules()
  {
    return [
      ['username', 'filter', 'filter'=>'trim'],
      ['username','required'],
      ['username','string','min'=>2,'max'=>255],
      ['password','required'],
      ['password','string','min'=>6],
      [['nip','nip_lama' ,'nama', 'id_jabatan','pangkat','golongan','is_motordinas'], 'required'],
      [['nip','nip_lama' ,'nama', 'id_jabatan','pangkat','golongan'], 'string'],
      [['is_motordinas'], 'integer'],
    ];
  }


  public function signup()
  {
    if($this->validate()){
      $user = new Pegawai();
      $user->username=$this->username;
      $user->setPassword($this->password);
      $user->generateAuthKey();
      $user->nip = $this->nip;
      $user->nip_lama = $this->nip_lama;
      $user->nama = $this->nama;
      $user->id_jabatan = $this->id_jabatan;
      $user->pangkat = $this->pangkat;
      $user->golongan = $this->golongan;
      $user->is_motordinas = $this->is_motordinas;
      if($user->save()){
        return $user;
      }
      else{
        var_dump($user->errors);
        print_r('error');
      }
    }
    return null;
  }
  public function edituser($id)
  {
    if($this->validate()){
      $user = Pegawai::findOne($id);
      $user->username=$this->username;
      $user->setPassword($this->password);
      $user->generateAuthKey();
      $user->nip = $this->nip;
      $user->nama = $this->nama;
      $user->nip_lama = $this->nip_lama;
      $user->id_jabatan = $this->id_jabatan;
      $user->pangkat = $this->pangkat;
      $user->golongan = $this->golongan;
      $user->is_motordinas = $this->is_motordinas;
      if($user->save()){
        return $user;
      }
    }
    return null;
  }
}
 ?>
