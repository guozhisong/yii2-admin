<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\components\XUtils;
/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $group_type;

    public $rememberMe = true;
	private $usernameform='username';
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'group_type'], 'required'],
            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['username', 'validateUsername'],
            ['password', 'validatePassword'],
            
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateUsername($attribute, $params)
	{
			$isEmail        = false; 
			$isMobile       = false;
		if (!$this->hasErrors()) {
			$isMobile = XUtils::mobile($this->username);
			if($isMobile){
				$this->usernameform = 'mobile';
			}else{
				$this->usernameform = 'username';
			}
			
            $user = $this->getUser();

			if(!empty($user) && $user['status']!=10){
				$this->addError($attribute, '此用户已冻结');
			}
            if (!$user) {
                $this->addError($attribute, '此用户尚未注册');
            }elseif($user->group_type != $this->group_type){
                if($this->group_type == USER_GROUP_TYPE_PER) $this->addError($attribute, '此账号为企业账号，不能在此登录!');
                elseif($this->group_type == USER_GROUP_TYPE_COM) $this->addError($attribute, '此账号为个人账号，不能在此登录!');
            }
        }
	}
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validateMd5Password($this->password,$user)) {
                $this->addError($attribute, '用户名密码不匹配');
            }else{
            	if(!Yii::$app->user->isGuest){
            		Yii::$app->user->logout();
            	}
            	
            }
        }
    }
	
	

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
     
     
    public function login()
    {
        if ($this->validate()) {
        	Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
			$id = Yii::$app->delegate->getDelegateUser()->id;
			$model =$this->getUser();
			$model->login_time=time();
			$model->login_ip = Yii::$app->request->userIP;
			return $model->update();
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
             $this->_user = User::find()->where([$this->usernameform=>$this->username,'group_type'=>$this->group_type])->orderBy('login_time DESC')->one();
        }

        return $this->_user;
    }
	public function loginGetUser($attr='username',$value='',$group_type='2')
    {
        if ($this->_user === null) {
            $this->_user = User::find()->where([$attr=>$value,'group_type'=>$group_type])->orderBy('login_time DESC')->one();
        }
        return $this->_user;
    }
}
