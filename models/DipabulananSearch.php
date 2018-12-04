<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dipabulanan;

/**
 * DipabulananSearch represents the model behind the search form of `app\models\Dipabulanan`.
 */
class DipabulananSearch extends Dipabulanan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'], 'integer'],
            [['program', 'kegiatan', 'output', 'suboutput', 'komponen', 'subkomp', 'uraian', 'vol', 'sat'], 'safe'],
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
        $query = Dipabulanan::find();

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
            'januari' => $this->januari,
            'februari' => $this->februari,
            'maret' => $this->maret,
            'april' => $this->april,
            'mei' => $this->mei,
            'juni' => $this->juni,
            'juli' => $this->juli,
            'agustus' => $this->agustus,
            'september' => $this->september,
            'oktober' => $this->oktober,
            'november' => $this->november,
            'desember' => $this->desember,
        ]);

        $query->andFilterWhere(['like', 'program', $this->program])
            ->andFilterWhere(['like', 'kegiatan', $this->kegiatan])
            ->andFilterWhere(['like', 'output', $this->output])
            ->andFilterWhere(['like', 'suboutput', $this->suboutput])
            ->andFilterWhere(['like', 'komponen', $this->komponen])
            ->andFilterWhere(['like', 'subkomp', $this->subkomp])
            ->andFilterWhere(['like', 'vol', $this->vol])
            ->andFilterWhere(['like', 'uraian', $this->uraian]);

        return $dataProvider;
    }
}
