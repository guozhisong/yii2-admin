<?php
	namespace common\models; 
	use Yii;
	use yii\base\Model;
	use yii\web\UploadedFile;
	class UploadForm extends Model
	{
		public $logo;
		public $license;
		public $pic;
		
		public function scenarios()
		{
		    return [
		        'logo' => ['logo'],
		        'license' => ['license'],
		        'pic' => ['pic'],
		        'all' => ['all'],
		    ];
		}

		public function rules()
		{
		     return [
		        ['logo','file',
		            'extensions'=>['jpg','png','gif'],'wrongExtension'=>'只能上传{extensions}类型文件！',
		            'maxSize'=>Yii::$app->setting->get('company_logo_size'),'tooBig'=>'文件上传过大！',
		            'skipOnEmpty'=>false,'uploadRequired'=>'请上传文件！',
		            'message'=>'上传失败！','on'=>['logo','all'],
		         ],
		         ['license','file',
		            'extensions'=>['jpg','png','gif'],'wrongExtension'=>'只能上传{extensions}类型文件！',
		            'maxSize'=>Yii::$app->setting->get('company_license_size'),'tooBig'=>'文件上传过大！',
		            'skipOnEmpty'=>false,'uploadRequired'=>'请上传文件！',
		            'message'=>'上传失败！','on'=>['license','all'],
		         ],
		         ['pic', 'file',
		            'extensions'=>['jpg','png','gif'], 'wrongExtension'=>'只能上传{extensions}类型文件！',
		            'skipOnEmpty'=>false, 'uploadRequired'=>'请上传文件！',
		            'message'=>'上传失败！', 'on'=>['pic','all'],
		         ],
		         
		    ];
		}
		
		public function zoomUpload($root,$path,$name,$type,$width,$height)
		{
			$file=$root.$path.$name;
			$zoomName=$root.$path.'zoom_'.$name;
			$imagedata = getimagesize($file);
			$olgWidth = $imagedata[0];
			$oldHeight = $imagedata[1];
			$newWidth = $width;
			$newHeight = $height;
			switch ($type)     
			{     
				case 'gif':     
				    $image=imagecreatefromgif($file);     
				break;     
				case 'jpg':     
				    $image=imagecreatefromjpeg($file);     
				break;     
				case 'png':     
				    $image=imagecreatefrompng($file);     
				break;     
			} 
			$thumb = imagecreatetruecolor ($newWidth, $newHeight); 
			imagecopyresized ($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight, $olgWidth, $oldHeight);
			imagepng($thumb,$zoomName); 
			imagedestroy($thumb);
			imagedestroy($image);
			return $path.'zoom_'.$name;
			
		}	
		
		
		
		
		
	
	}
?>