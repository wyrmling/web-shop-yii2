<?php

namespace app\modules\admin\controllers;

use Yii;
use app\components\Controller;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class BaseController extends Controller
{

    public $migrationTable = '{{%migration}}';
    public $migrationPath = '@app/migrations';

    const BASE_MIGRATION = 'm000000_000000_base';

    public function actionIndex()
    {
//        $migrations = new MigrateController('test_id', 'admin');
        $list = $this->getMigrationHistory(0);
        $new = $this->getNewMigrations();
//        foreach ($new as $key => $val) {
//            if ($this->hasUp($val)) $has[] = $val;
//        }
        $all = $this->getAllMigrations(5, 3);
//        echo 123;
//        $list = \Yii::$app->runAction('migrate/history');
        return $this->render('index', ['migrations' => $list, 'new' => $new, 'all' => $all]);
    }

    protected function getMigrationHistory($limit)
    {
//        if (Yii::$app->db->schema->getTableSchema($this->migrationTable, true) === null) {
//            $this->createMigrationHistoryTable();
//        }
        $query = new Query;
        $rows = $query->select(['version', 'apply_time'])
            ->from($this->migrationTable)
            ->orderBy('apply_time DESC, version DESC')
            ->limit($limit)
            ->createCommand(Yii::$app->db)
            ->queryAll();
        $history = ArrayHelper::map($rows, 'version', 'apply_time');
        unset($history[self::BASE_MIGRATION]);

        return $history;
    }

    /**
     * Returns the migrations that are not applied.
     * @return array list of new migrations
     */
    protected function getNewMigrations()
    {
        $applied = [];
        foreach ($this->getMigrationHistory(null) as $version => $time) {
            $applied[substr($version, 1, 13)] = true;
        }

        $migrations = [];
        $migrationPath = Yii::getAlias($this->migrationPath);

        $handle = opendir($migrationPath);
        while (($file = readdir($handle)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $path = $migrationPath . DIRECTORY_SEPARATOR . $file;
            if (preg_match('/^(m(\d{6}_\d{6})_.*?)\.php$/', $file, $matches) && !isset($applied[$matches[2]]) && is_file($path)) {
                $migrations[] = $matches[1];
            }

        }
        closedir($handle);
        sort($migrations);

        return $migrations;
    }

    public function getAllMigrations($limit, $start) {
        $migrations = [];
        $migrationPath = Yii::getAlias($this->migrationPath);

        $file_count = 0;
        $counter = 0;
        $handle = opendir($migrationPath);
        while (($file = readdir($handle)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $file_count++;
            if ($file_count >= $start) $counter++;
            $path = $migrationPath . DIRECTORY_SEPARATOR . $file;
            if (preg_match('/^(m(\d{6}_\d{6})_.*?)\.php$/', $file, $matches) && is_file($path)) {
                if ($counter < $limit && $file_count >= $start) {
                    $migrations[] = [$matches[1], $this->hasSmth($matches[1])];
                } else {
                    $migrations[] = [$matches[1]];
                }
            }

        }
        closedir($handle);
        sort($migrations);

        return $migrations;
    }

    public function hasSmth($class) {
        $migrationPath = Yii::getAlias($this->migrationPath);
        require_once $migrationPath . DIRECTORY_SEPARATOR . $class . '.php';
        $refl = new \ReflectionClass($class);
        $has['up'] = $refl->hasMethod('up');
        $has['down'] = $refl->hasMethod('down');
        $has['safeUp'] = $refl->hasMethod('safeUp');
        $has['safeDown'] = $refl->hasMethod('safeDown');
        return $has;
    }

    protected function hasUp($class) {
        $migrationPath = Yii::getAlias($this->migrationPath);
//        $path = $migrationPath . DIRECTORY_SEPARATOR . $class;

        $file = $migrationPath . DIRECTORY_SEPARATOR . $class . '.php';
        require_once($file);
        return method_exists(new $class(), 'up');
    }

}