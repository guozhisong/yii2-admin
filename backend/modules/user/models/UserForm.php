<?php
namespace backend\modules\user\models;

use Yii;
use yii\base\Model;
use common\models\AdminUser;
use common\models\User;
/**
 * Login form
 */
class UserForm extends User
{

    public  $password;
    public  $rememberMe = true;
    public  $verifyCode;
    private $_user;
    public  $role;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password','verifyCode'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['username', 'validateUsername', 'on' => 'login' ],
            ['password', 'validateMd5Password', 'on' => 'login' ],
            ['verifyCode', 'captcha','captchaAction' => '/site/captcha','message'=>'{attribute}不正确！' , 'on' => 'login'],
        ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['login'] = ['username','verifyCode','password'];
        $scenarios['create'] = ['role','username','nickname','password'];
        $scenarios['pass-word-reset'] = ['password'];
        $scenarios['update'] = ['nickname', 'role','username'];
        return $scenarios;
    }
    
    public function validateUsername($attribute,$params){
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
                $this->addError($attribute, '用户名不存在');
            }
        }
    }

    public function validateMd5Password($attribute,$params){
    
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) return false;
            $flag = Yii::$app->security->validateMd5Password($this->password,$user);      
            if (!$flag) {
                $this->addError($attribute, '密码有误');
            }
        }
    
    }
    
    public function passWordReset(){
        if ($this->validate()) {
            $this->setMd5Password($this->password);
            if ($this->save()) {
                return $this;
            }
        }
        return null;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'role' => '角色',
            'nickname' => '昵称',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
			$user = $this->getUser();
			
			if (!$user) return false;            
            return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
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
            $this->_user = UserForm::findByUsername($this->username);
        }

        return $this->_user;
    }
    
    public function saveUser(){
        $this->group_type = USER_GROUP_TYPE_ADMIN;
        $this->generateAuthKey();
        $this->setMd5Password($this->password);
        return $this->save();
    }
    
 
	/**
	 * 组装用户列表搜素条件
	 */
    public static function getConditionForUserList($data){
    	$where['where'] = [];
		$where['name'] = false;
		if(isset($data['roles']) && $data['roles'])
				$where['where']['91yxq_auth_assignment.item_name']=$data['roles'];
		if(isset($data['type'])){
			if($data['type']==0 && !empty($data['keywords'])){
						$where['where']['job_user.id'] = $data['keywords'];
			}elseif($data['type']==1 && !empty($data['keywords'])){
					$where['name'] = true;
					$where['keywords'] = $data['keywords'];
			}
		}
		return $where;
    }
}
