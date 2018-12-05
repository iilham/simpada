<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dipamaster".
 *
 * @property int $id
 * @property string $tahun
 * @property int $user_id
 * @property string $file
 * @property string $timestamp
 *
 * @property User $user
 */
class DipaMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dipamaster';
    }

    /**
     * {@inheritdoc}
     */


    public function rules()
    {
        return [
            // [['tahun', 'file'], 'required'],
            [['user_id'], 'integer'],
            [['timestamp','file'], 'safe'],
            [['tahun'], 'string', 'max' => 4],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx, xlx, xls'],
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
            'tahun' => 'Tahun',
            'user_id' => 'User ID',
            'filee' => 'File',
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
}
