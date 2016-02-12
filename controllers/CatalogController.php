<?php

namespace app\controllers;

//use yii\web\Controller;
use app\models\Categories;
use app\components\Controller;
use app\models\Products;
use yii\data\Pagination;
use Yii;
use yii\base\DynamicModel;

class CatalogController extends Controller
{

    public function actionIndex()
    {
        $categories = Yii::$app->db->createCommand(
            'SELECT * FROM product_categories_list
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
            'SELECT * FROM product_categories_list
             WHERE parent_category_id = :parent_category_id
             ORDER BY name')
            ->bindValue(':parent_category_id', $_GET['id'])
            ->queryAll();

        $fullPath = Categories::findAll(Categories::getFullPath($id));

        $query = (new \yii\db\Query())
            ->select('*')
            ->from('products')
            ->leftJoin('product_brands', 'product_brands.brand_id = products.brand_id')
            ->where([
                'category_id' => $_GET['id'],
                'status' => 1,
                //'products.brand_id' => 1,
            ]);

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        $products = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('title')
            ->all();

        $filterinfo = Yii::$app->db->createCommand(
            'SELECT * FROM products pr
             LEFT JOIN product_brands pr_b ON pr_b.brand_id = pr.brand_id
             WHERE pr.category_id = :category_id AND pr.status = :status
             ORDER BY pr.title')
            ->bindValue(':category_id', $_GET['id'])
            ->bindValue(':status', Products::VISIBLE)
            ->queryAll();

        //фильтр по брендам
        $brands = [];
        foreach ($filterinfo as $pi) {
            $brands['brand'.$pi['brand_id']] = $pi['brand_name'];
        }
        asort($brands);

        // модель для динамической формы фильтра
        $filtermodel = (new DynamicModel($brands));

        return $this->render('category', [
                'subcategories' => $subcategories,
                'fullPath' => $fullPath,
                'products' => $products,
                'pagination' => $pagination,
                'brands' => $brands,
                'filtermodel' => $filtermodel,
            ]
        );
    }

}
