<?php

namespace app\modules\osmb\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\osmb\models\Appartment;

/**
 * AppartmentSearch represents the model behind the search form about `app\modules\osmb\models\Appartment`.
 */
class AppartmentSearch extends Appartment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'num_app', 'propisano', 'area', 'house_id', 'subsidStasus'], 'integer'],
            [['FIO', 'telefon'], 'safe'],
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
        $query = Appartment::find();

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
            'num_app' => $this->num_app,
            'propisano' => $this->propisano,
            'area' => $this->area,
            'house_id' => $this->house_id,
            'subsidStasus' => $this->subsidStasus,
        ]);

        $query->andFilterWhere(['like', 'FIO', $this->FIO])
            ->andFilterWhere(['like', 'telefon', $this->telefon]);

        return $dataProvider;
    }
    public function searchHouse($params, $id)
    {
        $query = Appartment::find();

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
            'num_app' => $this->num_app,
            'propisano' => $this->propisano,
            'area' => $this->area,
            'house_id' => $id,
            'subsidStasus' => $this->subsidStasus,
        ]);

        $query->andFilterWhere(['like', 'FIO', $this->FIO])
            ->andFilterWhere(['like', 'telefon', $this->telefon]);

        return $dataProvider;
    }
}
