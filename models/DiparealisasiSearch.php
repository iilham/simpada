<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Diparealisasi;

/**
 * DiparealisasiSearch represents the model behind the search form of `app\models\Diparealisasi`.
 */
class DiparealisasiSearch extends Diparealisasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'bulan_id', 'realisasi'], 'integer'],
            [['program', 'kegiatan', 'output', 'suboutput', 'komponen', 'subkomp', 'akun', 'uraian', 'keterangan', 'timestamp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Diparealisasi::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'bulan_id' => $this->bulan_id,
            'realisasi' => $this->realisasi,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'program', $this->program])
            ->andFilterWhere(['like', 'kegiatan', $this->kegiatan])
            ->andFilterWhere(['like', 'output', $this->output])
            ->andFilterWhere(['like', 'suboutput', $this->suboutput])
            ->andFilterWhere(['like', 'komponen', $this->komponen])
            ->andFilterWhere(['like', 'subkomp', $this->subkomp])
            ->andFilterWhere(['like', 'akun', $this->akun])
            ->andFilterWhere(['like', 'uraian', $this->uraian])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
    public function search1($params,$program, $kegiatan, $output, $suboutput, $komponen, $subkomp, $akun, $uraian)
    {
        $query = Diparealisasi::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'program' => $program,
            'kegiatan' => $kegiatan,
            'uraian' => $uraian,
            'realisasi' => $this->realisasi,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'program', $this->program])
            ->andFilterWhere(['like', 'kegiatan', $this->kegiatan])
            ->andFilterWhere(['like', 'output', $this->output])
            ->andFilterWhere(['like', 'suboutput', $this->suboutput])
            ->andFilterWhere(['like', 'komponen', $this->komponen])
            ->andFilterWhere(['like', 'subkomp', $this->subkomp])
            ->andFilterWhere(['like', 'akun', $this->akun])
            ->andFilterWhere(['like', 'uraian', $this->uraian])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
