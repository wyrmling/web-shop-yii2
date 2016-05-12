<?php

namespace app\controllers;

use Yii;
use app\components\Controller;
use app\models\Categories;
use app\models\Products;
use app\models\Filters;
use yii\data\Pagination;
use yii\base\DynamicModel;

class CatalogController extends Controller
{

    public function actionIndex()
    {
        $categories = Yii::$app->db->createCommand(
            'SELECT * FROM {{product_categories_list}}
             WHERE parent_category_id = :parent_category_id
             ORDER BY name')
            ->bindValue(':parent_category_id', 0)
            ->queryAll();
        return $this->render('index', ['categories' => $categories]);
    }

    public function actionCategory($id)
    {
        if ($id == 0) {
            return $this->redirect(['/catalog/index']);
        }
        $subcategories = Yii::$app->db->createCommand(
            'SELECT * FROM {{product_categories_list}}
             WHERE parent_category_id = :parent_category_id
             ORDER BY name')
            ->bindValue(':parent_category_id', $_GET['id'])
            ->queryAll();

        $fullPath = Categories::findAll(Categories::getFullPath($id));

        $filterquery = Yii::$app->db->createCommand(
            'SELECT * FROM {{products}} pr
             LEFT JOIN {{product_brands}} pr_b ON pr_b.brand_id = pr.brand_id
             WHERE pr.category_id = :category_id AND pr.status = :status
             ORDER BY pr.title')
            ->bindValue(':category_id', $_GET['id'])
            ->bindValue(':status', Products::VISIBLE)
            ->queryAll();

        $brands = Filters::getBrandsForFilterForm($filterquery);

        $br = Filters::getBrandsForDynamicModel($filterquery);

        $post = \Yii::$app->request->post();
        $filtermodel = (new DynamicModel(array_merge($br, $post)));
        $filtermodel->addRule($br, 'integer')->validate();

        $brands_from_filter = Filters::getBrandsForFilterQuery($post);

        // извлечение списка товаров
        $query = (new \yii\db\Query())
            ->select('*')
            ->from('products')
            ->leftJoin('product_brands', 'product_brands.brand_id = products.brand_id')
            ->where([
                'category_id' => $_GET['id'], // для данной категории
                'status' => Products::VISIBLE,
            ]);

        // если отправлен post из фильтра, в запрос добавляется еще одно условие:
        // извлечь товары согласно списку брендов из фильтра
        if ($post && isset ($brands_from_filter)) {
            $query->andWhere([
                'products.brand_id' => $brands_from_filter,
            ]);
        }

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        $products = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('title')
            ->all();

        return $this->render('category', [
                'subcategories' => $subcategories,
                'fullPath' => $fullPath,
                'products' => $products,
                'pagination' => $pagination,
                'brands' => $brands,
                'filtermodel' => $filtermodel,
                'brands_from_filter' => $brands_from_filter,
            ]
        );
    }

}