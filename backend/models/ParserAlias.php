<?php

namespace backend\models;

use common\models\District;
use common\models\Region;
use common\models\Sale;
use common\models\Stage;
use common\models\View;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "parser_alias".
 *
 * @property string $name
 * @property string $category
 * @property integer $id
 */
class ParserAlias extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parser_alias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category', 'id'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['category'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'category' => Yii::t('app', 'Category'),
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * @param $category
     * @return array
     */
    public static function getCategory($category)
    {
        $temp = static::find()->where(['category' => $category])->asArray()->all();
        
        $items = [];
        foreach ($temp as $t) {
            $items[$t['name']] = $t['id'];
        }
        return $items;
    }

    public static function stage()
    {
        $alias = static::getCategory('stage');

        $temp = Stage::getList();

        $origin = [];
        foreach ($temp as $id => $value) {
            $origin[$value] = $id;
        }

        return array_merge($origin, $alias);
    }

    public static function vat()
    {
        $alias = static::getCategory('vat');

        $temp = Sale::getVatList();

        $origin = [];
        foreach ($temp as $id => $value) {
            $origin[$value] = $id;
        }

        return array_merge($origin, $alias);
    }
    
    public static function type()
    {
        $alias = static::getCategory('type');

        $temp = Sale::getTypeList();

        $origin = [];
        foreach ($temp as $id => $value) {
            $origin[$value] = $id;
        }

        return array_merge($origin, $alias);
    }

    public static function view()
    {
        $alias = static::getCategory('view');

        $temp = View::getList();

        $origin = [];
        foreach ($temp as $id => $value) {
            $origin[$value] = $id;
        }

        return array_merge($origin, $alias);
    }

    public static function region()
    {
        $alias = static::getCategory('region');
        
        $temp = Region::find()->with('content')->all();
        
        $origin = [];
        foreach ($temp as $t) {
            $origin[$t->content->name] = $t->id;
        }
        
        return array_merge($origin, $alias);
    }

    public static function district()
    {
        $alias = static::getCategory('district');

        $temp = District::find()->with('content')->all();

        $origin = [];
        foreach ($temp as $t) {
            $origin[$t->content->name] = $t->id;
        }

        return array_merge($origin, $alias);
    }
}
