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
    public $status;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','region_id','district_id','status'], 'integer'],
            [['name','address'], 'string']
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
        $query = Object::find()->joinWith(['sale']);//->orderBy(['id' => SORT_DESC]);

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
            'sale.status' => $this->status,
            'sale.district_id' => $this->district_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
