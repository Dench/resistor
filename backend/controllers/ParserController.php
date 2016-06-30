<?php

namespace backend\controllers;

use backend\models\Parse;
use backend\models\ParseImage;
use backend\models\ParserAlias;
use common\models\Lang;
use common\models\Sale;
use common\models\SaleLang;
use common\models\SalePhoto;
use Yii;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\web\Controller;

class ParserController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function  actionPafilia($url, $lang)
    {
        Lang::setCurrent($lang);

        $type_list = ParserAlias::type();

        $file = $url;
        $file = '../../upload/pafilia';

        $ids = Parse::saveXml($file, Parse::SCENARIO_PAFILIA);

        $temp = Parse::find()->with('content')->where(['id' => $ids])->all();

        $items = [];
        foreach ($temp as $t) {
            $data = Json::decode($t->content->data);
            if ($t->sale_id) {
                $sale = Sale::findOne(['id' => $t->sale_id]);
                $content = SaleLang::findOne(['id' => $t->sale_id, 'lang_id' => Lang::getCurrent()->id]);
            } else {
                $sale = new Sale();
                $sale->user_id = $t->user_id;
                $content = new SaleLang();
                $content->lang_id = Lang::getCurrent()->id;
            }

            $content->name = $data['propertyname'];
            $sale->bedroom = $data['bedrooms'];
            $sale->bathroom = $data['bathrooms'];
            $sale->price = round($data['price']);

            $origin = [];
            if (isset($type_list[$data['propertyType']])) {
                $sale->type_id = $type_list[$data['propertyType']];
            } else {
                $origin['type'] = $data['propertyType'];
            }

            $image_array = [];
        }

    }
    
    public function actionAristo($url, $lang)
    {
        Lang::setCurrent($lang);

        $type_list = ParserAlias::type();
        $view_list = ParserAlias::view();
        $region_list = ParserAlias::region();
        $district_list = ParserAlias::district();
        $vat_list = ParserAlias::vat();
        $stage_list = ParserAlias::stage();

        //$file = '../../upload/xml';
        $file = $url;

        $ids = Parse::saveXml($file, Parse::SCENARIO_ARISTO);

        $temp = Parse::find()->with('content')->where(['id' => $ids])->all();

        $items = [];
        foreach ($temp as $t) {
            $data = Json::decode($t->content->data);
            if ($t->sale_id) {
                $sale = Sale::findOne(['id' => $t->sale_id]);
                $content = SaleLang::findOne(['id' => $t->sale_id, 'lang_id' => Lang::getCurrent()->id]);
            } else {
                $sale = new Sale();
                $sale->user_id = $t->user_id;
                $content = new SaleLang();
                $content->lang_id = Lang::getCurrent()->id;
            }

            $sale->covered = round($data['propertyTotalCoveredArea']);
            $sale->gps = $data['gpsLat'].', '.$data['gpsLong'];
            $sale->bedroom = $data['propertyBedrooms'];
            $sale->price = round($data['propertyPrice']);

            $origin = [];
            if (isset($type_list[$data['propertyType']])) {
                $sale->type_id = $type_list[$data['propertyType']];
            } else {
                $origin['type'] = $data['propertyType'];
            }
            if (isset($region_list[$data['area']])) {
                $sale->region_id = $region_list[$data['area']];
            } else {
                $origin['region'] = $data['area'];
            }
            if (isset($district_list[$data['city']])) {
                $sale->district_id = $district_list[$data['city']];
            } else {
                $origin['district'] = $data['city'];
            }

            if (!empty($data['views'])) {
                $view_ids = [];
                $views = explode(',', $data['views']);
                foreach ($views as $view) {
                    $view = trim($view);
                    if (isset($view_list[$view])) {
                        $view_ids[] = $view_list[$view];
                    }
                }
                $sale->view_ids = $view_ids;
            }
            if (!empty($data['constructionStatus'])) {
                $stage_ids = [];
                $stages = explode(',', $data['constructionStatus']);
                foreach ($stages as $stage) {
                    $stage = trim($stage);
                    if (isset($stage_list[$stage])) {
                        $stage_ids[] = $stage_list[$stage];
                    }
                }
                $sale->stage_ids = $stage_ids;
            }

            if (isset($vat_list[$data['vat']])) {
                $sale->vat = $vat_list[$data['vat']];
            } else {
                $origin['vat'] = $data['vat'];
            }



            $content->description = $data['longDesc'];
            $content->name = $data['propertyName'];

            $image_array = [];
            if (isset($data['ImagesGallery']['mainImage'])) {
                $image_array[] = $data['ImagesGallery']['mainImage'];
            }
            foreach ($data['ImagesGallery']['image'] as $img) {
                $image_array[] = $img;
            }

            $image = ParseImage::find()->where(['parse_id' => $t->id])->indexBy('url')->all();
            foreach ($image as $key => $value) {
                $image[$key]->url = '';
            }
            foreach ($image_array as $key) {
                if (!isset($image[$key])) {
                    $image[$key] = new ParseImage();
                    $image[$key]->parse_id = $t->id;
                }
                $image[$key]->url = $key;
            }

            $sale->validate();
            $content->validate();

            $items[] = [
                'sale' => $sale,
                'content' => $content,
                'image' => $image,
                'origin' => $origin,
                'parse' => $t
            ];
        }

        return $this->render('prepare', [
            'items' => $items
        ]);
    }

    public function actionSend()
    {
        $data = Yii::$app->request->post();

        if (!empty($data['Parse']['id'])) {
            $parse = Parse::findOne($data['Parse']['id']);
        } else {
            return false;
        }

        if (!empty($data['Sale']['id'])) {
            $sale = Sale::findOne($data['Sale']['id']);
            $content = $sale->content;
        }

        if (empty($sale)) {
            $sale = new Sale();
            $sale->user_id = @$data['Sale']['user_id'];
        }

        if (empty($content)) {
            $content = new SaleLang();
            $content->lang_id = Lang::getCurrent()->id;
            $content->id = 0;
        }



        if ($sale->load($data) && $content->load($data) && $sale->validate() && $content->validate()) {
            $sale->save(false);
            if (!$content->id) {
                for ($i = 1; $i <= Lang::find()->count(); $i++) {
                    $model_content[$i] = new SaleLang();
                    $model_content[$i]['lang_id'] = $i;
                    $model_content[$i]['id'] = $sale->id;
                    $model_content[$i]['description'] = $content->description;
                    $model_content[$i]['name'] = $content->name;
                    $model_content[$i]->save(false);
                }
                $parse->sale_id = $sale->id;
                $parse->save();
            } else {
                $content->save(false);
            }
            return true;
        } else {
            Yii::trace(print_r($sale->errors, true));
            Yii::trace(print_r($content->errors, true));
            return false;
        }
    }

    public function actionPhoto()
    {
        Yii::beginProfile('action');

        $data = Yii::$app->request->post();

        if (empty($data['ParseImage']) || empty($data['id'])) {
            return false;
        }
        
        $parse = Parse::findOne($data['id']);
        
        if (empty($parse)) {
            return false;
        }

        //sleep(1);
        
        foreach ($data['ParseImage'] as $key => $url) {
            $url = @$url['url'];
            if (empty($key)) {
                $image = new ParseImage();
                $image->parse_id = $parse->id;
                $image->url = $url;
                Yii::beginProfile('get');
                if ($file = file_get_contents($url)) {
                    Yii::endProfile('get');
                    $path = Yii::$app->params['uploadSalePath'].DIRECTORY_SEPARATOR.$parse->sale_id;
                    BaseFileHelper::createDirectory($path);
                    $photo = new SalePhoto();
                    $photo->sale_id = $parse->sale_id;
                    if ($photo->save()) {
                        $photo->sort = $photo->id;
                        $name = $photo->id.'.jpg';
                        if ($photo->save()) {
                            if (!file_put_contents($path.DIRECTORY_SEPARATOR.$name, $file)) {
                                $photo->delete();
                            } else {
                                $photo->hash = md5_file($path.DIRECTORY_SEPARATOR.$name);
                                $photo->save();
                                $image->photo_id = $photo->id;
                                $image->save();
                            }
                        }
                    }
                }
            } elseif (empty($url)) {
                $image = ParseImage::findOne($key);
                if (!empty($image)) {
                    if ($image->photo_id) {
                        $photo = SalePhoto::findOne($image->photo_id);
                        $photo->delete();
                    }
                    $image->delete();
                }
            }
        }

        Yii::endProfile('action');

        return true;
    }
}
