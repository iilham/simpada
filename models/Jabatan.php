<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jabatan".
 *
 * @property integer $id_jabatan
 * @property string $jabatan
 * @property string $kode_seksi
 *
 * @property Seksi $kodeSeksi
 */
class Jabatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jabatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jabatan', 'kode_seksi','id_seksi'], 'required'],
            [['jabatan'], 'string'],
            [['kode_seksi'], 'string', 'max' => 5],
            [['kode_seksi'], 'exist', 'skipOnError' => true, 'targetClass' => Seksi::className(), 'targetAttribute' => ['kode_seksi' => 'kode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_jabatan' => 'Id Jabatan',
            'jabatan' => 'Jabatan',
            'kode_seksi' => 'Kode Seksi',
            'id_seksi'=>'Id Seksi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeSeksi()
    {
        return $this->hasOne(Seksi::className(), ['kode' => 'kode_seksi']);
    }
}
