<?php

namespace app\modules\osmb\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\osmb\models\Oplata;

/**
 * OplataSearch represents the model behind the search form about `app\modules\osmb\models\Oplata`.
 */
class OplataSearch extends Oplata
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'oplata', 'subsid', 'raschet_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Oplata::find();

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
            'oplata' => $this->oplata,
            'subsid' => $this->subsid,
            'raschet_id' => $this->raschet_id,
        ]);

        return $dataProvider;
    }
}
