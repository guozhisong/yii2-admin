<?php

namespace common\base;

use yii\web\View;
use common\helpers\Abc;
use common\helpers\Cache;

class BaseView extends View {

	public function setMetaTag($name, $content) {
		$this->registerMetaTag([ 
				'name' => $name,
				'content' => $content 
		]);
	}

}