<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Object;

/**
 * ObjectSearch represents the model behind the search form about `common\models\Object`.
 */
class ObjectSearch extends Object
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','region_id','district_id'], 'integer'],
            [['name'], 'string']
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
        $query = Object::find()->joinWith(['sale']);

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
            'object.id' => $this->id,
            'sale.region_id' => $this->region_id,
            'sale.district_id' => $this->district_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
