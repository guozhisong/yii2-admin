<?php

namespace common\helpers;

use yii\helpers\VarDumper;
use Yii;
use yii\helpers\Url;
use yii\helpers\File;
use yii\data\Pagination;

/**
 * 笑看风云旦 
 */
class Abc {
	
	//坑爹的Yii写起来蛋疼，封装常用组件调用
	public static function getApp() {return \Yii::$app;}
	public static function getView() {return \Yii::$app->getView();}
	public static function getRequest() {return \Yii::$app->request;}
	public static function getResponse() {return \Yii::$app->response;}
	public static function getCache() {return \Yii::$app->cache;}
	public static function getUser() {return Yii::$app->user;}
	public static function getIdentity() {return Yii::$app->user->getIdentity();}
	public static function getIsGuest() {return Yii::$app->user->isGuest;}
	public static function getDB() {return \Yii::$app->db;}
	public static function getBaseUrl() {return \Yii::$app->request->getBaseUrl();}
	public static function getHomeUrl() {return \Yii::$app->getHomeUrl();}
	public static function getWebUrl() {return \Yii::getAlias('@web');}
	public static function getWebPath() {return \Yii::getAlias('@webroot');}
	
	public static function getAppParam($key, $defaultValue = null) {
		$params = \Yii::$app->params;
		if (array_key_exists($key,$params)) {
			return $params [$key];
		}
		return $defaultValue;
	}
	
	public static function setAppParam($array) {
		foreach ( $array as $key => $value ) {
			\Yii::$app->params [$key] = $value;
		}
	}
	
	public static function getViewParam($key, $defaultValue = null) {
		$view = \Yii::$app->getView();
		if (isset($view->params [$key])) {
			return $view->params [$key];
		}
		return $defaultValue;
	}
	
	public static function setViewParam($array) {
		$view = \Yii::$app->getView();
		foreach ( $array as $name => $value ) {
			$view->params [$name] = $value;
		}
	}
	
	public static function setFalsh($type, $message) {
		\Yii::$app->session->setFlash($type,$message);
	}
	
	public static function setWarningMessage($message) {
		\Yii::$app->session->setFlash('warning',$message);
	}
	
	public static function setSuccessMessage($message) {
		\Yii::$app->session->setFlash('success',$message);
	}
	
	public static function setErrorMessage($message) {
		\Yii::$app->session->setFlash('error',$message);
	}
	
	public static function info($var, $category = 'application') {
		$dump = VarDumper::dumpAsString($var);
		Yii::info($dump,$category);
	}
	
	public static function checkIsGuest($loginUrl = null) {
		$isGuest = Yii::$app->user->isGuest;
		if ($isGuest) {
			if ($loginUrl == false) {
				return false;
			}
			if ($loginUrl == null) {
				$loginUrl = [ 
						'site/login' 
				];
			}
			return Yii::$app->getResponse()->redirect(Url::to($loginUrl),302);
		}
		return true;
	}
	
	public static function checkAuth($permissionName, $params = [], $allowCaching = true) {
		$user = Yii::$app->user;
		return $user->can($permissionName,$params,$allowCaching);
	}
	
	public static function createCommand($sql = null) {
		$db = \Yii::$app->db;
		if ($sql !== null) {
			return $db->createCommand($sql);
		}
		return $db->createCommand();
	}
	
	public static function execute($sql) {
		$db = \Yii::$app->db;
		$command = $db->createCommand($sql);
		return $command->execute();
	}
	
	public static function queryAll($sql) {
		$db = \Yii::$app->db;
		$command = $db->createCommand($sql);
		return $command->queryAll();
	}
	
	public static function queryOne($sql) {
		$db = \Yii::$app->db;
		$command = $db->createCommand($sql);
		return $command->queryOne();
	}
	
	public static function getPagedRows($query, $config = []) {
		$countQuery = clone $query;
		$pages = new Pagination([ 
				'totalCount' => $countQuery->count() 
		]);
		if (isset($config ['page'])) {
			$pages->setPage($config ['page'],true);
		}
		
		if (isset($config ['pageSize'])) {
			$pages->setPageSize($config ['pageSize'],true);
		}
		
		$rows = $query->offset($pages->offset)->limit($pages->limit);
		
		if (isset($config ['order'])) {
			$rows = $rows->orderBy($config ['order']);
		}
		$rows = $rows->all();
		
		$rowsLable = 'rows';
		$pagesLable = 'pages';
		
		if (isset($config ['rows'])) {
			$rowsLable = $config ['rows'];
		}
		if (isset($config ['pages'])) {
			$pagesLable = $config ['pages'];
		}
		
		$ret = [ ];
		$ret [$rowsLable] = $rows;
		$ret [$pagesLable] = $pages;
		
		return $ret;
	}

	public static function getStatus($id = null){
		$status = ['1' => '通过', '0' => '审核'];
	
		if($id !== null){
			return $status[$id];
		}
	
		return $status;
	}	
	
	public static function blank($count){
		$count=intval($count);
		return str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $count);
	}
	
	public static function string2array($data){
		return preg_split('/\s*,\s*/',trim($data),-1,PREG_SPLIT_NO_EMPTY);
	}
	
	public static function array2string($data){
		return implode(', ',$data);
	}	

	//截取中文
	public static function truncate_utf8_string($string, $length, $etc = '...')
	{
		$result = '';
		$string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
		$strlen = strlen($string);
		for ($i = 0; (($i < $strlen) && ($length > 0)); $i++)
		{
			if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0'))
			{
				if ($length < 1.0)
				{
					break;
				}
				$result .= substr($string, $i, $number);
				$length -= 1.0;
				$i += $number - 1;
			}
			else
			{
				$result .= substr($string, $i, 1);
				$length -= 0.5;
			}
		}
		$result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
		if ($i < $strlen)
		{
			$result .= $etc;
		}
		return $result;
	}
	
}



