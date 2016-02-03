<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Products;
use app\models\Categories;
use yii\helpers\ArrayHelper;
use app\models\AttributesList;
use app\models\AttributesCategories;

class ProductsController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd()
    {
        $products = (new Products)->loadDefaultValues();

        if ($products->load(Yii::$app->request->post()) && $products->validate()) {
            $res = $products->save();
            $productParams = ArrayHelper::toArray($products);

            if ($productParams['status'] == Products::VISIBLE) {
                Categories::setCategoriesCounters($productParams['category_id'], 1, 0);
            }
            if ($productParams['status'] == Products::HIDDEN) {
                Categories::setCategoriesCounters($productParams['category_id'], 0, 1);
            }
            return $this->redirect('/admin/products/edit/' . $products->product_id);
        } else {
            return $this->render('add', ['model' => $products, 'type' => 'add']);
        }
    }

    public function actionEdit($id)
    {
        $products = Products::find()
                ->where(['product_id' => $id])
                ->one();
        $productOldParams = ArrayHelper::toArray($products);

        if ($products->load(Yii::$app->request->post()) && $products->validate()) {
            $results = $products->save();
            $productParams = ArrayHelper::toArray($products);

            if ((int) $productParams['status'] != (int) $productOldParams['status'] && (int) $productParams['category_id'] != (int) $productOldParams['category_id']) {
                AttributesList::deleteAll(['product_id' => $id]);
                if ($productParams['status'] == Products::VISIBLE) {
                    Categories::setCategoriesCounters($productOldParams['category_id'], 0, -1);
                    Categories::setCategoriesCounters($productParams['category_id'], 1, 0);
                }
                if ($productParams['status'] == Products::HIDDEN) {
                    Categories::setCategoriesCounters($productOldParams['category_id'], -1, 0);
                    Categories::setCategoriesCounters($productParams['category_id'], 0, 1);
                }
            } else {
                if ($productParams['status'] == Products::VISIBLE && (int) $productParams['status'] != (int) $productOldParams['status'] && (int) $productParams['category_id'] = (int) $productOldParams['category_id']) {
                    Categories::setCategoriesCounters($productParams['category_id'], 1, -1);
                } elseif ($productParams['status'] == Products::HIDDEN && (int) $productParams['status'] != (int) $productOldParams['status'] && (int) $productParams['category_id'] = (int) $productOldParams['category_id']) {
                    Categories::setCategoriesCounters($productParams['category_id'], -1, 1);
                } elseif ($productParams['status'] == Products::VISIBLE && (int) $productParams['status'] = (int) $productOldParams['status'] && (int) $productParams['category_id'] != (int) $productOldParams['category_id']) {
                    AttributesList::deleteAll(['product_id' => $id]);
                    Categories::setCategoriesCounters($productOldParams['category_id'], -1, 0);
                    Categories::setCategoriesCounters($productParams['category_id'], 1, 0);
                } else {
                    Categories::setCategoriesCounters($productOldParams['category_id'], 0, -1);
                    Categories::setCategoriesCounters($productParams['category_id'], 0, 1);
                }
            }
            return $this->render('edit', ['model' => $products, 'type' => 'edit', 'result' => $results]);
        } else {
            return $this->render('edit', ['model' => $products, 'type' => 'create']);
        }
    }

    public function actionDelete($id)
    {
        // где-то накосячил с удалением: разобраться!
        $productParams = Products::find()
                ->where(['product_id' => $id])
                ->asArray()
                ->one();

        if (Products::deleteAll(['product_id' => $id])) {

            AttributesList::deleteAll(['product_id' => $id]);
            
            if ($productParams['status'] == Products::VISIBLE) {
                Categories::setCategoriesCounters($productParams['category_id'], -1, 0);
            }
            if ($productParams['status'] == Products::HIDDEN) {
                Categories::setCategoriesCounters($productParams['category_id'], 0, -1);
            }
            return $this->redirect('/admin/products');
        }
    }

    public function actionList($id)
    {
        $list_by_product_id = AttributesList::find()
                ->where(['product_id' => $id])
                ->asArray()
                ->all();

        $product = Products::find()
                ->where(['product_id' => $id])
                ->one();

        $att = AttributesCategories::find()
                //->joinWith('attributename')
                ->where(['category_id' => $product->category_id])
                ->orderBy('product_attributes_categories.order')
                ->all();
        // сделать исключение, если для категории не выбраны атрибуты
        if(!$att){
            return $this->redirect(['attributes/list', 'id' => $product->category_id,]);
        }

        foreach ($att as $i) {
            $atributs_list[$i->attribute_id] = (new AttributesList)->loadDefaultValues();
            if ($list_by_product_id) {
                $atributs_list[$i->attribute_id]->value = AttributesList::findOne(['attribute_id' => $i->attribute_id, 'product_id' => $id])->value;
            }
        }

        if (AttributesList::loadMultiple($atributs_list, Yii::$app->request->post()) &&
                AttributesList::validateMultiple($atributs_list)) {
            $counter = 0;

            AttributesList::deleteAll(['product_id' => $id]);

            foreach ($atributs_list as $item) {
                if ($item->save()) {
                    $counter++;
                }
            }
            Yii::$app->session->setFlash('success', "Processed {$counter} records successfully.");
            return $this->redirect(['list', 'id' => $id,]);
        } else {
            return $this->render('list', [
                        'atributs_list' => $atributs_list,
                        'product' => $product,
            ]);
        }
    }

}
