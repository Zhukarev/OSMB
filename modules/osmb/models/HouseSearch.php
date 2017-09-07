<?php

namespace app\modules\osmb\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\osmb\models\House;

/**
 * HouseSearch represents the model behind the search form about `app\modules\osmb\models\House`.
 */
class HouseSearch extends House
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'quan_app', 'cost_on_m', 'buchg_id'], 'integer'],
            [['city', 'street', 'num_house'], 'safe'],
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
        $query = House::find();

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
            'quan_app' => $this->quan_app,
            'cost_on_m' => $this->cost_on_m,
            'buchg_id' => $this->buchg_id,
        ]);

        $query->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'num_house', $this->num_house]);

        return $dataProvider;
    }

    public function searchOne($params, $id)
    {
        $query = House::find();

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
            'id' => $id,
            'quan_app' => $this->quan_app,
            'cost_on_m' => $this->cost_on_m,
            'buchg_id' => $this->buchg_id,
        ]);

        $query->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'num_house', $this->num_house]);

        return $dataProvider;
    }
}
