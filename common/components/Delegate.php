<?php
namespace common\components;
use yii\base\Object;
use Yii;
class Delegate extends Object
{
    
    /**
     * 获取代理用户
     */
    public function getDelegateUser() {
        return Yii::$app->getSession()->get('delegateUser') ? Yii::$app->getSession()->get('delegateUser') : Yii::$app->getUser()->getIdentity();
    }
    public function setDelegateUser($user) {
    
        Yii::$app->getSession()->set('delegateUser', $user);
    }
    
    public function getUrlList(){
        $url = ['home' => '/' , 'message' => '', 'setting' => ''];
        switch ($this->getDelegateUser()->group_type){
            case USER_GROUP_TYPE_PER:
                if (Yii::$app->controller->module->id == 'app-mobile') {
                    $url['home'] = yii::$app->urlManager->createUrl(['/person/index/index']);
                } else {
                    $url['home'] = yii::$app->urlManager->createUrl(['person/resume']);
                }
                $url['message'] = yii::$app->urlManager->createUrl(['/person/index/message']);
                $url['setting'] = yii::$app->urlManager->createUrl(['/person/resume/setting']);                
                break;
            case USER_GROUP_TYPE_COM: 
                $url['home'] = yii::$app->urlManager->createUrl(['company/member']);
                $url['message'] = yii::$app->urlManager->createUrl(['company/message']);
                $url['setting'] = yii::$app->urlManager->createUrl(['company/setting']);
                break;
            default: ;
        }
        return $url;
    }
}

?>