<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dipa".
 *
 * @property int $id
 * @property int $baris
 * @property string $kode
 * @property string $program
 * @property string $kegiatan
 * @property string $output
 * @property string $suboutput
 * @property string $komponen
 * @property string $subkomp
 * @property string $akun
 * @property string $uraian
 * @property int $vol
 * @property string $sat
 * @property string $hargasat
 * @property string $jumlah
 * @property string $sisa
 * @property int $dipamaster_id
 *
 * @property Diparealisasi[] $diparealisasis
 */
class Dipa extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'dipa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['baris', 'uraian', 'dipamaster_id'], 'required'],
                [['baris', 'vol', 'hargasat', 'jumlah', 'sisa', 'dipamaster_id'], 'integer'],
                [['kode', 'sat'], 'string', 'max' => 20],
                [['program', 'kegiatan', 'output', 'suboutput', 'komponen'], 'string', 'max' => 10],
                [['subkomp'], 'string', 'max' => 15],
                [['akun'], 'string', 'max' => 20],
                [['uraian'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'baris' => 'Baris',
            'kode' => 'Kode',
            'program' => 'Program',
            'kegiatan' => 'Kegiatan',
            'output' => 'Output',
            'suboutput' => 'Suboutput',
            'komponen' => 'Komponen',
            'subkomp' => 'Subkomp',
            'akun' => 'Akun',
            'uraian' => 'Uraian',
            'vol' => 'Vol',
            'sat' => 'Sat',
            'hargasat' => 'Hargasat',
            'jumlah' => 'Jumlah',
            'sisa' => 'Sisa',
            'dipamaster_id' => 'Dipamaster ID',
        ];
    }

    public function databases($id, $bulan) {
//Your logic here to generate totalDays
        $mode = static::findOne(['id' => $id]);
        $realis = (new \yii\db\Query())
                ->select(['realisasi', 'bulan_id'])
                ->from('diparealisasi')
                ->where([
                    'program' => $mode->program,
                    'kegiatan' => $mode->kegiatan,
                    'output' => $mode->output,
                    'suboutput' => $mode->suboutput,
                    'komponen' => $mode->komponen,
                    'subkomp' => $mode->subkomp,
                    'akun' => $mode->akun,
                    'uraian' => $mode->uraian,
                    'bulan_id' => $bulan,
                ])
                ->sum('realisasi');
//                ->all();
                

        return $realis;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiparealisasis() {
        return $this->hasMany(Diparealisasi::className(), ['dipa_id' => 'id']);
    }

}
