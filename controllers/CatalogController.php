<?php

namespace app\controllers;

//use yii\web\Controller;
use app\models\Categories;
use app\models\Products;
use app\components\Controller;
use yii\data\Pagination;
use Yii;
use yii\base\DynamicModel;

class CatalogController extends Controller
{

    public function actionIndex()
    {
        $categories = Yii::$app->db->createCommand('SELECT * FROM product_categories_list
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
        $subcategories = Yii::$app->db->createCommand('SELECT * FROM product_categories_list
                                                       WHERE parent_category_id = :parent_category_id
                                                       ORDER BY name')
                ->bindValue(':parent_category_id', $_GET['id'])
                ->queryAll();

        $fullPach = Categories::findAll(Categories::getFullPath($id));

        $filterinfo = Yii::$app->db->createCommand('SELECT * FROM products
                                                     LEFT JOIN product_brands
                                                            ON product_brands.brand_id = products.brand_id
                                                     WHERE category_id = :category_id AND status = :status
                                                     ORDER BY title')
                ->bindValue(':category_id', $_GET['id'])
                ->bindValue(':status', 1)
                ->queryAll();

        $query = (new \yii\db\Query())
                ->select(['*'])
                ->from('products')
                ->leftJoin('product_brands', 'product_brands.brand_id = products.brand_id')
                ->where(['category_id' => $_GET['id'], 'status' => 1]);

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        $products = $query
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->orderBy('title')
                ->all();

        //фильтр по брендам
        $brands = [];
        foreach ($filterinfo as $pi) {
            $brands[$pi['brand_id']] = $pi['brand_name'];
        }
        asort($brands);
        
        // модель для динамической формы фильтра
        $filtermodel = (new DynamicModel(['brand1', 'brand2']));

        return $this->render('category', [
                    'subcategories' => $subcategories,
                    'fullPach' => $fullPach,
                    'products' => $products,
                    'pagination' => $pagination,
                    'brands' => $brands,
                    'filtermodel' => $filtermodel,
                        ]
        );
    }

}
