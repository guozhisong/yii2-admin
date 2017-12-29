<?php

namespace common\widgets\areaselect;
use yii\web\AssetBundle;
class AreaSelectAsset extends AssetBundle {
    //put your code here
    public $js=[
        'common/areaData.js',
        'common/select.js', 
              
    ];
    public $css=[
        //'default/default.css'
    ];
    
    public $jsOptions=[
        'charset'=>'utf8',
    ];


    public function init() {
        //资源所在目录
        $this->sourcePath = dirname(__FILE__) . DIRECTORY_SEPARATOR .'themes'. DIRECTORY_SEPARATOR ;
    }
}

?>
