<?php
/* @var $this yii\web\View */

print_r($categories);
?>
<h1>product-categories-list/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<?php

foreach ($categories as $v) {
    print_r ($v);
    
    $array[$v['category_id']] = $v['parent_category_id'];
    echo '<br>';
    
}

echo '<br>';
print_r($array);
