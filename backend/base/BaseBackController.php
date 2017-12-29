<?php

namespace backend\base;

use common\base\BaseController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class BaseBackController extends BaseController {
	
	public $layout  = '/admin';
	
	public function behaviors() {
		return [ 
				'access' => [ 
						'class' => AccessControl::className(),
						'except' => [ 
								'login' 
						],
						'rules' => [ 
								[ 
										'allow' => true,
										'roles' => [ 
												'@' 
										] 
								] 
						] 
				],
				'verbs' => [ 
						'class' => VerbFilter::className(),
						'actions' => [ 
								'logout' => [ 
										'post' 
								] 
						] 
				] 
		];
	}
	
	public function actions() {
		return [ 
				'error' => [ 
						'class' => 'yii\web\ErrorAction' 
				] 
		];
	}
}