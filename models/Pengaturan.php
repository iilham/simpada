<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengaturan".
 *
 * @property int $id
 * @property string $satker
 * @property string $kodesatker
 * @property string $alamat
 * @property string $alamatlengkap
 * @property string $kabupaten
 * @property string $provinsi
 */
class Pengaturan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pengaturan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'satker', 'kodesatker', 'alamat', 'alamatlengkap', 'kabupaten', 'provinsi'], 'required'],
            [['id'], 'integer'],
            [['satker', 'alamat', 'alamatlengkap', 'kabupaten', 'provinsi'], 'string'],
            [['kodesatker'], 'string', 'max' => 4],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'satker' => 'Satker',
            'kodesatker' => 'Kodesatker',
            'alamat' => 'Alamat',
            'alamatlengkap' => 'Alamatlengkap',
            'kabupaten' => 'Kabupaten',
            'provinsi' => 'Provinsi',
        ];
    }
}
