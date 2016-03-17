<?php

namespace app\components;

use app\models\Titles;
use yii\helpers\Inflector;

class Controller extends \yii\web\Controller
{

    public function generateTitle()
    {
        if ($this->module->id === 'admin') {
            return Inflector::camelize($this->id) . ' - Admin panel';
        } else {
            $title = Titles::findOne(['title_id' => $this->action->uniqueId]);
            return ($title) ? $title->pattern : Inflector::camelize($this->id) . ' - Иишница';
        }
    }

    public function beforeAction($action)
    {
        $this->view->title = $this->generateTitle();
        return parent::beforeAction($action);
    }

}