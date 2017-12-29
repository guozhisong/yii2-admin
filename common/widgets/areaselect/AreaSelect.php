<?php

/**
 * Description of KindEditor
 *
 * @author Qinn Pan <Pan JingKui, pjkui@qq.com>
 * @link http://www.pjkui.com
 * @QQ 714428042
 * @date 2015-3-4

 */

namespace common\widgets\areaselect;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\InputWidget;
use yii\base\Widget;
use common\widgets\areaselect\AreaSelectAsset;

class AreaSelect extends InputWidget {

    //配置选项，参阅KindEditor官网文档(定制菜单等)
    public $clientOptions = [];
    //默认配置
    protected $_options;
    protected $_sourcePath;
    public $template = "{label}\n{input}\n{hint}\n{error}";
    public $config = [];
    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init() {
        $_config = [
            'themes' => 'default',
        ];
        $this->_sourcePath = dirname(__FILE__) . DIRECTORY_SEPARATOR;
        $this->config = ArrayHelper::merge($_config, $this->config);
        $bundle = Yii::$app->assetManager->getBundle(AreaSelectAsset::className());
        $this->config['themesPath'] = $bundle->baseUrl.'/'.$this->config['themes'].'/';
        parent::init();
    }

    public function run() {
        $this->registerClientScript();
       if ($this->hasModel()) {
           
            $input = Html::activeHiddenInput($this->model, $this->attribute, ['id' => $this->id]);
            
            $html = <<<EOT
            <div id="field_{$this->id}">
            <div class="shie_biaotou"><span>*</span>工作地点：</div>
            <div class="inpuen_kuang"  data="{$this->id}">
                <div class="mtest" onClick="initSelected('{$this->id}')"></div>
                {$input}
                <div class="tesgg tmkse"></div>
                
            	<div class="tanchu_img" onClick="initSelected('{$this->id}')"></div> 
            </div>
             </div>
EOT;
            return $html;
        }
    }

    /**
     * 注册客户端脚本
     */
    protected function registerClientScript() {
        AreaSelectAsset::register($this->view);
        $value = Html::getAttributeValue($this->model, $this->attribute);
        $script2 = <<<EOT
                     
var str_{$this->id} = "";
$.each([$value], function(i, n) {            	                  	 
	str_{$this->id} += writeDiva2(areaData[n].areaname, n);                             		                                  
});
$("#field_{$this->id} .tesgg").html(str_{$this->id});
       
    
EOT;
        
$script = <<<EOT
var themesPath = '{$this->config['themesPath']}';
var dialog;
var currDialogId;     	          
EOT;
        $this->view->registerJs($script, View::POS_HEAD);
        $this->view->registerJs($script2, View::POS_END);
    }

}
?>