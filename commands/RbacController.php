<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\models\Users;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class RbacController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }

    public function actionInit($message = 'hello world')
    {
        $auth = \Yii::$app->getAuthManager();
        $auth->removeAll();

        // Create roles
        $user = $auth->createRole('user');
        $admin = $auth->createRole('adminPanel');
        $auth->add($user);
        $auth->add($admin);
        $auth->addChild($admin, $user);
        $auth->assign($admin, Users::findByUsername('admin')->getId());

        echo $message . "\n";
    }

    public function actionTest($message = 'hello world')
    {
        $auth = \Yii::$app->getAuthManager();
        $auth->removeAll();

        // Create roles
        $user = $auth->createRole('user');
        $admin = $auth->createRole('adminPanel');
        $auth->add($user);
        $auth->add($admin);
        $auth->addChild($admin, $user);
        $auth->assign($admin, Users::findByUsername('admin')->getId());

        echo $message . "\n";
    }
}