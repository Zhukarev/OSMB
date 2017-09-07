<?php

namespace app\modules\osmb\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\osmb\models\Access;

/**
 * AccessSearch represents the model behind the search form about `app\modules\osmb\models\Access`.
 */
class AccessSearch extends Access
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'appartment_id', 'user_id'], 'integer'],
            [['date_create', 'date_change', 'comment'], 'safe'],
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
        $query = Access::find();

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
            'status' => $this->status,
            'appartment_id' => $this->appartment_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'date_create', $this->date_create])
            ->andFilterWhere(['like', 'date_change', $this->date_change])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
