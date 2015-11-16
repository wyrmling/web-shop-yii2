<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Country;

class CountryController extends Controller
{
    public function actionIndex()
    {
        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }  
    
    
    public function actionNew()
    {
       $countrie = new Country();
       $countrie->name = 'Gonduras';
       $countrie->code = 'GS';
       $countrie->population = '44000000';
       $countrie->save();
       
       return $this->actionIndex();
    }  
    
    public function actionDelete()
    {
       $countrie = Country::findOne('GS');
       $countrie-> delete();
       
       return $this->actionIndex();
    }  
    
    public function actionRename()
    {
       $countrie = Country::findOne('GS');
       $countrie->name = 'Ukraine';
       $countrie->save();
       
       return $this->actionIndex();
    }  
}

