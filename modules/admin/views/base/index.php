<?php
use yii\bootstrap\ButtonGroup;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\db\Query;
?>
<div class="admin-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <?php
    echo ButtonGroup::widget([
        'buttons' => [
            ['label' => 'A'],
            ['label' => 'B'],
            ['label' => 'C', 'visible' => false],
        ]
    ]);
    ?>

    <?php

    var_dump($new);
    foreach ($new as $key => $val) {
        echo $val.'<br>';
    }
    ?>

    <?php
// * $query = new Query;
// * $provider = new ActiveDataProvider([
// *     'query' => $query->from('post'),
// *     'pagination' => [
// *         'pageSize' => 20,
// *     ],
// * ]);
    $dataProvider = new ActiveDataProvider([
        'query' => (new Query)->from('migration')->where(['<>', 'version', 'm000000_000000_base'])->orderBy('apply_time'),
        'pagination' => [
            'pageSize' => 10,
        ],
    ]);

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'version',
            'apply_time:datetime',
            ['class' => 'yii\grid\ActionColumn']
//            'password',
        ]
    ]);
    ?>

    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <?php // foreach ($migrations['new'] as $k => $v) {
//            echo $k . $v;
//        }
        ?>
        <code><?php // foreach ($migrations['list'] as $k => $v) {
//            echo $k . $v;
//        }
        ?>
        </code>
    </p>

<div class="row">
    <div class="col-xs-6 col-md-3">
        <a href="/gii/" class="thumbnail">
            Gii
        </a>
    </div>
    <div class="col-xs-6 col-md-3">
        <a href="#" class="thumbnail">
            <img src="..." alt="...">
        </a>
    </div>
</div>

</div>
