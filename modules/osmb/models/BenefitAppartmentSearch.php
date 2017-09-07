<?php

namespace app\modules\osmb\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\osmb\models\BenefitAppartment;

/**
 * BenefitAppartmentSearch represents the model behind the search form about `app\modules\osmb\models\BenefitAppartment`.
 */
class BenefitAppartmentSearch extends BenefitAppartment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'area_benefit', 'benefit_id', 'appartment_id'], 'integer'],
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
        $query = BenefitAppartment::find();

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
            'area_benefit' => $this->area_benefit,
            'benefit_id' => $this->benefit_id,
            'appartment_id' => $this->appartment_id,
        ]);

        return $dataProvider;
    }
}
