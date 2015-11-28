<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
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
//        echo 123;
//        $list = \Yii::$app->runAction('migrate/history');
        return $this->render('index', ['migrations' => $list, 'new' => $new]);
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
}
