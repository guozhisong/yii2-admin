<?php

namespace backend\base;

use common\base\BaseView;

class BaseBackView extends BaseView {
	
	/**
	 * 作者：笑看风云旦
	 * 描述：登录表单的样式模板
	 */
	public function getLoginStyle() {
		return [ 
				'options' => [ 
						'tag' => 'dl' 
				],
				'template' => '<dt>{label}:</dt><dd>{input}</dd><dd class="e"></dd>' 
		];
	}

	/**
	 * 作者：笑看风云旦
	 * 描述：后台表单的样式模板
	 */
	public function getBackStyle() {
		return [
				'options' => [
						'tag' => 'dl',
				],
				'template' => '<dt>{label}:</dt><dd>{input}</dd><dd class="t">{error}</dd>',
		];
	}
	
	/**
	 * 描述：后台文本域默认样式
	 */
	public function getAreaStyle(){
		return ['style' => 'width:400px;height:100px;','class'=>'int'];
	}

}