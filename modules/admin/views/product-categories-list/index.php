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
    print_r($v);

    $array[$v['category_id']] = $v['parent_category_id'];
    echo '<br>';
}

echo '<br>';
print_r($array);

function form_tree($mess)
{
    if (!is_array($mess)) {
        return false;
    }
    $tree = array();
    foreach ($mess as $value) {
        $tree[$value['parent_category_id']][] = $value;
    }
    return $tree;
}

function build_tree($cats, $parent_id)
{
    if (is_array($cats) && isset($cats[$parent_id])) {
        $tree = '<ul>';
        foreach ($cats[$parent_id] as $cat) {
            $tree .= '<li>' . $cat['name'];
            $tree .= build_tree($cats, $cat['category_id']);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
    } else {
        return false;
    }
    return $tree;
}

$tree = form_tree($categories);
echo '<br><br>';
var_dump($tree);
echo build_tree($tree, 0);

