<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dipabulanan".
 *
 * @property int $id
 * @property int $dipa_id
 * @property string $kode
 * @property string $program
 * @property string $kegiatan
 * @property string $output
 * @property string $suboutput
 * @property string $komponen
 * @property string $subkomp
 * @property string $akun
 * @property int $vol
 * @property string $sat
 * @property string $uraian
 * @property string $januari
 * @property string $februari
 * @property string $maret
 * @property string $april
 * @property string $mei
 * @property string $juni
 * @property string $juli
 * @property string $agustus
 * @property string $september
 * @property string $oktober
 * @property string $november
 * @property string $desember
 *
 * @property Dipa $dipa
 */
class Dipabulanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dipabulanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dipa_id', 'uraian'], 'required'],
            [['dipa_id', 'vol', 'januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'], 'integer'],
            [['kode', 'akun'], 'string', 'max' => 20],
            [['program', 'kegiatan', 'output', 'suboutput', 'komponen'], 'string', 'max' => 10],
            [['sat'], 'string', 'max' => 10],
            [['subkomp'], 'string', 'max' => 15],
            [['uraian'], 'string', 'max' => 300],
            [['dipa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dipa::className(), 'targetAttribute' => ['dipa_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dipa_id' => 'Dipa ID',
            'kode' => 'Kode',
            'program' => 'Program',
            'kegiatan' => 'Kegiatan',
            'output' => 'Output',
            'suboutput' => 'Suboutput',
            'komponen' => 'Komponen',
            'subkomp' => 'Subkomp',
            'akun' => 'Akun',
            'vol' => 'Vol',
            'sat' => 'sat',
            'uraian' => 'Uraian',
            'januari' => 'Januari',
            'februari' => 'Februari',
            'maret' => 'Maret',
            'april' => 'April',
            'mei' => 'Mei',
            'juni' => 'Juni',
            'juli' => 'Juli',
            'agustus' => 'Agustus',
            'september' => 'September',
            'oktober' => 'Oktober',
            'november' => 'November',
            'desember' => 'Desember',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDipa()
    {
        return $this->hasOne(Dipa::className(), ['id' => 'dipa_id']);
    }
}
