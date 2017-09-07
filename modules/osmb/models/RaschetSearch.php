<?php

namespace app\modules\osmb\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\osmb\models\Raschet;

/**
 * RaschetSearch represents the model behind the search form about `app\modules\osmb\models\Raschet`.
 */
class RaschetSearch extends Raschet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nachisleno', 'summ_oplata', 'summ_dolg', 'summ_subsid', 'summ_benefit', 'appartment_id'], 'integer'],
            [['date'], 'safe'],
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
        $query = Raschet::find();

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
            'nachisleno' => $this->nachisleno,
            'summ_oplata' => $this->summ_oplata,
            'summ_dolg' => $this->summ_dolg,
            'summ_subsid' => $this->summ_subsid,
            'summ_benefit' => $this->summ_benefit,
            'appartment_id' => $this->appartment_id,
        ]);
        $query->andFilterWhere(['like', 'date', $this->date]);
//var_dump(Yii::$app->request->queryParams);die; //- параметры передаваемые в $query
        return $dataProvider;
    }
}
