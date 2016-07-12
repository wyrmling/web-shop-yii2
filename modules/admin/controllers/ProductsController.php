<?php

namespace app\modules\admin\controllers;

use Yii;
use app\components\Controller;
use app\models\Products;
use app\models\Categories;
use app\models\AttributesList;
use app\models\AttributesCategories;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

class ProductsController extends Controller
{

    public function actionIndex()
    {
        $query = Products::find()
            ->with(['brand', 'category']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
        ]);
        $dataProvider->sort->attributes['brand.brand_name'] = [
            'asc' => ['product_brands.brand_name' => SORT_ASC],
            'desc' => ['product_brands.brand_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['category.name'] = [
            'asc' => ['product_categories_list.name' => SORT_ASC],
            'desc' => ['product_categories_list.name' => SORT_DESC],
        ];
        return $this->render('index', ['dataProvider' => $dataProvider]);
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
        $products = Products::findOne(['product_id' => $id]);
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

        $product = Products::findOne(['product_id' => $id]);

        $attr = AttributesCategories::find()
            ->joinWith('attributename')
            ->where(['category_id' => $product->category_id])
            ->orderBy('product_attributes_categories.order')
            ->all();
        if (!$attr) {
            return $this->redirect(['attributes/list', 'id' => $product->category_id]);
        }

        foreach ($attr as $i) {
            $atributs_list[$i->attribute_id] = (new AttributesList)->loadDefaultValues();
            if ($list_by_product_id) {
                $value = AttributesList::findOne([
                    'attribute_id' => $i->attribute_id,
                    'product_id' => $id
                ]);
                if ($value) {
                    $atributs_list[$i->attribute_id]->value = $value->value;
                }
            }
        }

        if (AttributesList::loadMultiple($atributs_list, Yii::$app->request->post()) &&
            AttributesList::validateMultiple($atributs_list)
        ) {
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

    public function actionView($id)
    {
        $product = Yii::$app->db->createCommand(
            'SELECT * FROM {{products}} pr
            LEFT JOIN {{product_brands}} pr_b ON pr.brand_id = pr_b.brand_id
            WHERE product_id=:product_id AND status=:status')
            ->bindValue(':product_id', $_GET['id'])
            ->bindValue(':status', Products::VISIBLE)
            ->queryOne();

        $fullPath = Categories::findAll(Categories::getFullPath($product['category_id']));

        $attributes = Yii::$app->db->createCommand(
            'SELECT [[pr_a_c.attribute_id]],
                    [[pr_a.attribute_name]],
                    [[pr_a.unit]],
                    [[pr_a_l.value]]
            FROM {{product_attributes_categories}} pr_a_c
            LEFT JOIN {{product_attributes}} pr_a ON pr_a_c.attribute_id = pr_a.attribute_id
            LEFT JOIN {{product_attributes_list}} pr_a_l ON pr_a_c.attribute_id = pr_a_l.attribute_id
            WHERE category_id=:category_id AND product_id=:product_id
            ORDER BY pr_a_c.order')
            ->bindValue(':product_id', $_GET['id'])
            ->bindValue(':category_id', $product['category_id'])
            ->queryAll();

        return $this->render('view', [
            'id' => $id,
            'product' => $product,
            'fullPath' => $fullPath,
            'attributes' => $attributes,
        ]);
    }

    public function actionProductslist()
    {
        if (isset($_POST['id'])) {
            echo json_encode(Yii::$app->request->post('id'));
        } else {
            echo json_encode('nok');
        }
    }
    
}