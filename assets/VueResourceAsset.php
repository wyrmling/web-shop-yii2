<?php
namespace app\assets;

use yii\web\AssetBundle;
/**
 * Class VueResourceAsset
 */
class VueResourceAsset extends AssetBundle
{
    public $sourcePath = '@bower/vue-resource/dist';
    public function init()
    {
        $this->js[] = YII_ENV_DEV ? 'vue-resource.js' : 'vue-resource.min.js';
    }
}


