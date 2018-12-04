<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "pegawai".
 *
 * @property string $id
 * @property string $nip
 * @property string $nama
 * @property string $jabatan
 *
 * @property Tugas[] $tugas
 */
class Pegawai extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pegawai';
    }

    public function behaviors()
    {
      return [
        TimestampBehavior::className(),
      ];
    }

    public static function findIdentity($id)
    {
      return static::findOne(['id'=>$id]);
    }

    public static function findIdentityByAccessToken($token, $type=null)
    {

    }

    public function getId()
    {
      return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
      return $this->auth_key;
    }



    public function validateAuthKey($authKey)
    {
      return $this->getAuthKey() === $authKey;
    }

    public static function findByUsername($username)
    {
      return static::findOne(['username'=>$username]);
    }

    public function validatePassword($password)
    {
      return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function generatePasswordResetToken()
    {
      $this->password_reset_token = Yii::$app->security->generateRandomString().'_'.time();
    }

    public function removePasswordResetToken()
    {
      $this->password_reset_token=null;
    }

    public function setPassword($password)
    {
      $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
      $this->auth_key = Yii::$app->security->generateRandomString();
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nip', 'nama', 'id_jabatan','pangkat','golongan','nip_lama'], 'required'],
            [['nip', 'nama', 'id_jabatan','pangkat','golongan','nip_lama'], 'string'],
            [['is_motordinas','level'],'integer'],
            [['id_jabatan'], 'exist', 'skipOnError' => true, 'targetClass' => Jabatan::className(), 'targetAttribute' => ['id_jabatan' => 'id_jabatan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nip' => 'Nip',
            'nip_lama' => 'NIP Lama',
            'nama' => 'Nama',
            'id_jabatan' => 'Jabatan',
            'pangkat' => 'Pangkat',
            'golongan' => 'Golongan',
            'is_motordinas'=> 'Motor Dinas',
            'level'=> 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTugas()
    {
        return $this->hasMany(Tugas::className(), ['id_pegawai' => 'id']);
    }

    public function getIdJabatan()
      {
          return $this->hasOne(Jabatan::className(), ['id_jabatan' => 'id_jabatan']);
      }

      public function getIjincutis()
   {
       return $this->hasMany(Ijincuti::className(), ['id_pegawai' => 'id']);
   }

   /**
    * @return \yii\db\ActiveQuery
    */
   public function getMemos()
   {
       return $this->hasMany(Memo::className(), ['id_pegawai' => 'id']);
   }
    public function level($i) {
        if ($i == 0) {
            return 'Admin';
        } else if ($i != 0) {
            return 'Pengguna';
        }
    }
    public function kelamin($ii) {
        if ($ii == 1) {
            return 'Laki-Laki';
        } else if ($ii == 2) {
            return 'Perempuan';
        }
    }
    public function status($iii) {
        if ($iii == 10) {
            return 'Aktif';
        } else if ($iii == 0) {
            return 'Tidak Aktif';
        }
    }
}
