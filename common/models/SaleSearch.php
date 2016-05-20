<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SaleSearch represents the model behind the search form about `common\models\Sale`.
 */
class SaleSearch extends Sale
{
    public $year_from;
    public $year_to;
    public $covered_from;
    public $covered_to;
    public $uncovered_from;
    public $uncovered_to;
    public $plot_from;
    public $plot_to;
    public $bathroom_from;
    public $bathroom_to;
    public $bedroom_from;
    public $bedroom_to;
    public $price_from;
    public $price_to;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'id', 'code', 'object_id', 'region_id', 'district_id', 'type_id', 'parking_id', 'bathroom', 'bedroom',
                'solarpanel', 'sauna', 'furniture', 'conditioner', 'heating',
                'year_from', 'year_to',
                'covered_from', 'covered_to',
                'uncovered_from', 'uncovered_to',
                'plot_from', 'plot_to',
                'bathroom_from', 'bathroom_to',
                'bedroom_from', 'bedroom_to',
                'price_from', 'price_to',
                'storage', 'tennis', 'status', 'sold', 'created_at', 'updated_at', 'top', 'title'
            ], 'integer'],
            [[
                'name', 'commission', 'gps', 'contacts', 'owner', 'address', 'view_ids', 'facility_ids'
            ], 'safe'],
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
        $query = Sale::find();

        //$query->joinWith(['views', 'facilities']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 20,
                //'validatePage' => false,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->view_ids) {
            $query->leftJoin('sale_view', 'sale_view.sale_id = sale.id');
            $query->groupBy('sale.id');
        }
        if ($this->facility_ids) {
            $query->leftJoin('sale_facilities', 'sale_facilities.sale_id = sale.id');
            $query->groupBy('sale.id');
        }

        $query->andFilterWhere([
            'sale.id' => $this->id,
            'code' => $this->code,
            'object_id' => $this->object_id,
            'region_id' => $this->region_id,
            'district_id' => $this->district_id,
            'type_id' => $this->type_id,
            'parking_id' => $this->parking_id,
            'bathroom' => $this->bathroom,
            'bedroom' => $this->bedroom,
            'solarpanel' => $this->solarpanel,
            'sauna' => $this->sauna,
            'furniture' => $this->furniture,
            'conditioner' => $this->conditioner,
            'heating' => $this->heating,
            'storage' => $this->storage,
            'tennis' => $this->tennis,
            'status' => $this->status,
            'sold' => $this->sold,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'top' => $this->top,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'commission', $this->commission])
            ->andFilterWhere(['like', 'gps', $this->gps])
            ->andFilterWhere(['like', 'contacts', $this->contacts])
            ->andFilterWhere(['like', 'owner', $this->owner])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['>=', 'price', $this->price_from])
            ->andFilterWhere(['<=', 'price', $this->price_to])
            ->andFilterWhere(['>=', 'year', $this->year_from])
            ->andFilterWhere(['<=', 'year', $this->year_to])
            ->andFilterWhere(['>=', 'covered', $this->covered_from])
            ->andFilterWhere(['<=', 'covered', $this->covered_to])
            ->andFilterWhere(['>=', 'uncovered', $this->uncovered_from])
            ->andFilterWhere(['<=', 'uncovered', $this->uncovered_to])
            ->andFilterWhere(['>=', 'plot', $this->plot_from])
            ->andFilterWhere(['<=', 'plot', $this->plot_to])
            ->andFilterWhere(['>=', 'bathroom', $this->bathroom_from])
            ->andFilterWhere(['<=', 'bathroom', $this->bathroom_to])
            ->andFilterWhere(['>=', 'bedroom', $this->bedroom_from])
            ->andFilterWhere(['<=', 'bedroom', $this->bedroom_to])
            ->andFilterWhere(['in', 'sale_view.view_id', $this->view_ids])
            ->andFilterWhere(['in', 'sale_facilities.facility_id', $this->facility_ids]);
        //$command = $query->createCommand();
        //echo $command->sql;
        return $dataProvider;
    }
}