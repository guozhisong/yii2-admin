<?php
	namespace common\models; 
	use Yii;
	use yii\base\Model;
	use yii\web\UploadedFile;
	class UploadImg extends Model
	{
		public $file;
		public function rules()
		{
		     return [
		        ['file','file',
		            'extensions'=>['jpg','png','gif'],'wrongExtension'=>'只能上传{extensions}类型文件！',
		            'maxSize'=>Yii::$app->setting->get('company_logo_size'),'tooBig'=>'文件上传过大！',
		            'skipOnEmpty'=>false,'uploadRequired'=>'请上传文件！',
		            'message'=>'上传失败！'
		         ]
		    ];
		}
		
		
		
		
		
		
		public function upload($file,$home='',$tp,$company_config)
		{
				$root = Yii::getAlias('@web_img');
				$path = '/UploadFiles/company/'.$home.'/'.date('Ymd',time()).'/';
				$save_path = $root.$path;
				if(!file_exists($save_path)) 
				{ 
				  mkdir($save_path, 0777); 
				}
				
				if ($file["name"]) 
				{ 
			        $file1 = $file["name"]; 
			        $file2 = $save_path.time().$file1; 
			        $flag = 1; 
				}
				if($flag) $result = move_uploaded_file($file["tmp_name"],$file2); 
				return $path.time().$file1;
			
		}	
		
		public function zoomUpload($file,$home='',$tp,$company_config,$width,$height)
		{
				$root = Yii::getAlias('@web_img');
				$path = '/UploadFiles/company/'.$home.'/'.date('Ymd',time()).'/';
				$save_path = $root.$path;
				if(!file_exists($save_path)) 
				{ 
				  mkdir($save_path, 0777); 
				}
				$name=md5(uniqid());
				$type=strrchr($file['name'],'.');
				
				
				if ($name) 
				{ 
			        $file1 = $name.$type; 
			        $file2 = $save_path.time().$file1; 
					$file3 = $save_path.'zoom_'.time().$file1;
			        $flag = 1; 
				}
				
				
				if($flag) $result = move_uploaded_file($file["tmp_name"],$file2); 
 
				$imagedata = getimagesize($file2);
				$olgWidth = $imagedata[0];
				$oldHeight = $imagedata[1];
				$newWidth = $width;
				$newHeight = $height;
				switch ($type)     
				{     
				    case '.gif':     
				        $image=imagecreatefromgif($file2);     
				        break;     
				    case '.jpg':     
				        $image=imagecreatefromjpeg($file2);     
				        break;     
				    case '.png':     
				        $image=imagecreatefrompng($file2);     
				    break;     
				} 
				$thumb = imagecreatetruecolor ($newWidth, $newHeight); 
				imagecopyresized ($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight, $olgWidth, $oldHeight);
				imagepng($thumb,$file3); 
				imagedestroy($thumb);
				imagedestroy($image);
				return $file3;
			
		}	
		
		
		
		
		
	
	}
?>