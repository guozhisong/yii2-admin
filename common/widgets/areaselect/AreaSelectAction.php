<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KindEditorAction
 *
 * @author Qinn Pan <Pan JingKui, pjkui@qq.com>
 * @link http://www.pjkui.com
 * @QQ 714428042
 * @date 2015-3-4

 */

namespace common\widgets\areaselect;

use Yii;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use common\widgets\kindeditor\Services_JSON;

class AreaSelectAction extends Action {

    /**
     *
     * @var Array 保存配置的数组
     */
    public $config = [];

    //public $save_path;
    public function init() {
        //close csrf
        Yii::$app->request->enableCsrfValidation = false;
        $bundle = Yii::$app->assetManager->getBundle(AreaSelectAsset::className());
        $_config = [
            'themes' => 'default',
            'path' => $bundle->sourcePath.'..//'
            
        ];
        unset($bundle);
        //默认设置
        $this->config = ArrayHelper::merge($_config, $this->config);
        parent::init();
    }

    public function run() {
        $this->handAction();
    }

    /**
     * 处理动作
     */
    public function handAction() {
        //获得action 动作
        $action = Yii::$app->request->get('action');
        AreaSelectAsset::register($this->controller->view);        
        $itemTemplate = $this->config['path'].'/views/'.$this->config['themes'].'/index.php';
        $bundle = Yii::$app->assetManager->getBundle(AreaSelectAsset::className());
        $hotArea = Yii::$app->areaCache->getHotArea();
        $parentArea = Yii::$app->areaCache->getTreeArr();
		$jobCategory = Yii::$app->attributeCache->getArrByKey('job_category');
        $data = ['assetPath' => $bundle->baseUrl,'themesPath' => $bundle->baseUrl.'/'.$this->config['themes'], 'hotArea'=>$hotArea, 'parentArea' => $parentArea,'jobCategory'=>$jobCategory];
        echo $this->controller->view->renderFile($itemTemplate, $data);
    }


    public function alert($msg) {
            header('Content-type: text/html; charset=UTF-8');
            $json = new Services_JSON();
            echo $json->encode(array('error' => 1, 'message' => $msg));
            exit;
        }

}

?>
