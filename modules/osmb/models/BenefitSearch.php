<?php

namespace app\modules\osmb\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\osmb\models\Benefit;

/**
 * BenefitSearch represents the model behind the search form about `app\modules\osmb\models\Benefit`.
 */
class BenefitSearch extends Benefit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'percent'], 'integer'],
            [['name'], 'safe'],
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
        $query = Benefit::find();

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
            'percent' => $this->percent,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
