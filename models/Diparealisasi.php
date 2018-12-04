<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "diparealisasi".
 *
 * @property string $id
 * @property int $user_id
 * @property int $bulan_id
 * @property string $program
 * @property string $kegiatan
 * @property string $output
 * @property string $suboutput
 * @property string $komponen
 * @property string $subkomp
 * @property string $akun
 * @property string $uraian
 * @property string $realisasi
 * @property string $keterangan
 * @property string $timestamp
 *
 * @property User $user
 * @property Dipabulanan $dipabulanan
 */
class Diparealisasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diparealisasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bulan_id', 'uraian', 'realisasi'], 'required'],
            [['user_id', 'bulan_id', 'realisasi'], 'integer'],
            [['timestamp'], 'safe'],
            [['program', 'kegiatan', 'subkomp', 'output', 'suboutput', 'komponen'], 'string', 'max' => 10],
            [['akun'], 'string', 'max' => 15],
            [['uraian'], 'string', 'max' => 300],
            [['keterangan'], 'string', 'max' => 500],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'bulan_id' => 'Bulan',
            'program' => 'Program',
            'kegiatan' => 'Kegiatan',
            'output' => 'Output',
            'suboutput' => 'Suboutput',
            'komponen' => 'Komponen',
            'subkomp' => 'Subkomp',
            'akun' => 'Akun',
            'uraian' => 'Uraian',
            'realisasi' => 'Realisasi',
            'keterangan' => 'Keterangan',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
}
