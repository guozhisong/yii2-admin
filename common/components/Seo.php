<?php
namespace common\components;
use yii;
use yii\helpers\Html;
/**
 * SEO助手类
 * Yii::$app->controller->id.'_'.Yii::$app->controller->action->id.SeoTdk
 */

class Seo {
		/*首页seoTDK*/
		public static function site_indexSeoTdk()
		{
			$TDK                = [];
			$TDK['title']       = '猎才医药网_中国最大的医药人才招聘网_最新医药招聘信息_医药英才网';
			$TDK['keywords']    = '医药招聘，医药人才网，医药英才网';
			$TDK['description'] = '猎才医药网是中国最大的医药招聘网,中国医药联盟旗下专业的医药人才招聘网,提供医药代表招聘,医药销售招聘、生物医药招聘、医药猎头服务等最新医药招聘信息。';
			return $TDK;
		} 
   		/*职位首页*/
   		public static function jobs_indexSeoTdk($keywords,$action)
   		{
   			$TDK                = [];
   			if(!empty($keywords) && !empty($action['job_class'])){
   				//职能
				$TDK['title']       = '最新'.$keywords.'岗位招聘信息_招聘'.$keywords.'人才-猎才医药网';
				$TDK['keywords']    = $keywords.'招聘信息';
				$TDK['description'] ='猎才医药网为全国'.$keywords.'人才提供最新'.$keywords.'岗位招聘信息，找'.$keywords.'工作就上猎才医药网。'; 
   			}elseif(!empty($keywords) && !empty($action['functype'])){
   				//岗位
				$TDK['title']       ='最新'.$keywords.'招聘信息_招聘'.$keywords.'人才-猎才医药网'; 
				$TDK['keywords']    = $keywords.'招聘信息';
				$TDK['description'] ='猎才医药网为全国'.$keywords.'人才提供最新'.$keywords.'招聘信息，找'.$keywords.'就上猎才医药网。'; 
   			}else{
   				$TDK['title']       = '医药公司招聘信息_医疗人才招聘信息网_医药行业最新招聘信息-猎才医药网';
				$TDK['keywords']    = '医药公司招聘，医疗人才招聘网，医药行业招聘';
				$TDK['description'] = '医药公司招聘信息、医疗人才招聘信息网、医药行业最新招聘信息-医药人才找工作就上猎才医药网。';
   			}
   			
			
			return $TDK;
   		}
		/*职位详情*/
   		public static function jobs_showSeoTdk($job_name,$com_name,$work_place)
   		{
   			$TDK                = [];
			$TDK['title']       = $job_name.'招聘_'.$com_name.'最新招聘信息-猎才医药网';
			$TDK['keywords']    = $job_name.'招聘，'.$com_name.'最新招聘信息';
			$TDK['description'] = $com_name.'诚聘'.$job_name.'，工作地点'.$work_place.'。猎才医药网提供'.$com_name.'最新'.$job_name.'招聘信息。';
			return $TDK;
   		}
		/*企业首页*/
   		public static function com_indexSeoTdk()
   		{
   			$TDK                = [];
			$TDK['title']       = '医药企业招聘_医药公司招聘_医药网招聘-猎才医药网';
			$TDK['keywords']    = '医药企业招聘，医药公司招聘，医药网招聘';
			$TDK['description'] = '医药招聘企业列表，医药招聘公司，医药招聘企业，医药招聘网，猎才医药网。';
			return $TDK;
   		}
		/*企业详情*/
		public static function com_showSeoTdk($com_name)
		{
			$TDK                = [];
			$TDK['title']       = $com_name.'官方招聘网站_最新招聘信息-猎才医药网';
			$TDK['keywords']    = $com_name.'，'.$com_name.'招聘';
			$TDK['description'] = $com_name.'官方最新招聘职位信息。猎才医药网提供'.$com_name.'简介、电话、地址等公司详细资料,帮助求职者全面了解'.$com_name.'。';
			return $TDK;
		}
		/*资讯首页*/
		public static function news_indexSeoTdk()
		{
			$TDK                = [];
			$TDK['title']       = '最新医药人才资讯_医药新闻_猎才医药网';
			$TDK['keywords']    = '医药资讯，医药新闻，医药招聘会，面试技巧，简历指导，职业规划，毕业生就业，创业指南，医药职场，医药HR';
			$TDK['description'] = '猎才医药网医药资讯、医药新闻频道为广大的医药从业人员提供医药招聘会,面试技巧,简历指导,职业规划,毕业生就业创业指导等信息,为您的事业发展提供专业的指导与帮助';
			return $TDK;
		}
		/*资讯分类*/
		public static function news_listSeoTdk($class)
		{
			$TDK                = [];
			$TDK['title']       = $class.'-医药人才资讯-猎才医药网';
			$TDK['keywords']    = $class;
			$TDK['description'] = '猎才医药网'.$class.'频道提供最新'.$class.'资讯，为您的事业发展提供专业的指导与帮助。';
			return $TDK;
		}
		/*资讯详情*/
		public static function news_showSeoTdk($title,$introduce)
		{
			$TDK                = [];
			$TDK['title']       = $title.'-猎才医药网';
			$TDK['keywords']    = $title;
			$TDK['description'] = mb_substr(strip_tags($introduce),0,120,'utf-8').'。';
			return $TDK;
		}
		/*医疗卫士*/
		public static function yl_indexSeoTdk()
		{
			$TDK                = [];
			$TDK['title']       = '医疗人才招聘_医疗卫生招聘_医疗人才网_医疗卫生人才网-猎才医药网';
			$TDK['keywords']    = '医疗人才招聘，医疗卫生招聘，医疗人才网，医疗卫生人才网';
			$TDK['description'] = '猎才医药网医疗卫生人才招聘频道-做中国最好的医疗人才招聘网、医疗卫生人才网站。这里有最新最全的医疗人才招聘信息和医疗卫生招聘信息。找医疗卫生类工作就上猎才医药网。';
			return $TDK;
		}
		/*医疗器械*/
		public static function qx_indexSeoTdk()
		{
			$TDK                = [];
			$TDK['title']       = '医疗器械公司招聘_医疗器械招聘信息_医疗器械招聘网-猎才医药网';
			$TDK['keywords']    = '医疗器械公司招聘，医疗器械招聘信息，医疗器械招聘网';
			$TDK['description'] = '猎才医药网医疗器械招聘频道-做中国最好的医疗器械招聘网。这里有最新最全的医疗器械公司招聘信息和医疗器械招聘信息。找医疗器械类工作就上猎才医药网。';
			return $TDK;
		}
		/*企业多属性筛选*/
		public static function qiye_indexSeoTdk($areaKV,$proKV)
		{
			$TDK                = [];
			$map =[1=>537,2=>538,3=>539];
			$new_pro = empty($map[Yii::$app->request->get('pro')])?0:$map[Yii::$app->request->get('pro')];
			$area=empty($areaKV[Yii::$app->request->get('area')]['areaname'])?false:Yii::$app->request->get('area');
			$pro=empty($proKV[$new_pro])?false:$new_pro;
			if(!empty($area) && empty($pro)){
				$TDK['title']       = $areaKV[$area]['areaname'].'医药公司招聘_'. $areaKV[$area]['areaname'].'医药企业信息-猎才医药网';
				$TDK['keywords']    =  $areaKV[$area]['areaname'].'医药公司招聘，'. $areaKV[$area]['areaname'].'医药企业';
				$TDK['description'] = '最新'. $areaKV[$area]['areaname'].'医药公司名录，'. $areaKV[$area]['areaname'].'医药企业招聘信息、医药公司简介、联系方式、地址等信息由猎才医药网独家提供。';
			}elseif(empty($area) && !empty($pro)){
				$TDK['title']       = $proKV[$pro].'公司招聘_'.$proKV[$pro].'企业信息-猎才医药网';
				$TDK['keywords']    = $proKV[$pro].'公司招聘，'.$proKV[$pro].'企业';
				$TDK['description'] = '最新'.$proKV[$pro].'公司名录，'.$proKV[$pro].'企业招聘信息、'.$proKV[$pro].'公司简介、联系方式、地址等信息由猎才医药网独家提供。';
			}elseif(!empty($area) && !empty($pro)){
				$TDK['title']       = $areaKV[$area]['areaname'].$proKV[$pro].'公司招聘_'.$areaKV[$area]['areaname'].$proKV[$pro].'企业信息-猎才医药网';
				$TDK['keywords']    = $areaKV[$area]['areaname'].$proKV[$pro].'公司招聘，'.$areaKV[$area]['areaname'].$proKV[$pro].'企业';
				$TDK['description'] = '最新'.$areaKV[$area]['areaname'].$proKV[$pro].'公司名录，'.$areaKV[$area]['areaname'].$proKV[$pro].'企业招聘信息、'.$areaKV[$area]['areaname'].$proKV[$pro].'公司简介、联系方式、地址等信息由猎才医药网独家提供。';
			}else{
				$TDK['title']       = '医药公司招聘_医药企业信息-猎才医药网';
				$TDK['keywords']    = '医药公司招聘，医药企业信息';
				$TDK['description'] = '最新医药公司名录，医药企业招聘信息、医药公司简介、联系方式、地址等信息由猎才医药网独家提供。';
			}
			
			return $TDK;
		}
		/*职位多属性筛选*/
		public static function zhiwei_indexSeoTdk($areaKV,$functypeKV)
		{
			$TDK=[];
			$area=empty($areaKV[Yii::$app->request->get('area')]['areaname'])?false:Yii::$app->request->get('area');
			$functype=empty($functypeKV[Yii::$app->request->get('functype')])?false:Yii::$app->request->get('functype');
			$job_class=empty($functypeKV[Yii::$app->request->get('functype')]['child'][Yii::$app->request->get('job_class')])?false:Yii::$app->request->get('job_class');
			//地区
			if(!empty($area) && empty($functype)){
				$TDK['title']       = '最新'.$areaKV[$area]['areaname'].'医药招聘信息_'.$areaKV[$area]['areaname'].'医药人才招聘信息_'.$areaKV[$area]['areaname'].'医药行业招聘信息-猎才医药网';
				$TDK['keywords']    = $areaKV[$area]['areaname'].'医药招聘信息，'.$areaKV[$area]['areaname'].'医药人才招聘信息，'.$areaKV[$area]['areaname'].'医药行业招聘信息';
				$TDK['description'] = '猎才医药网最新'.$areaKV[$area]['areaname'].'医药招聘信息，'.$areaKV[$area]['areaname'].'医药人才招聘信息。找医药类职位、找医药人才，了解'.$areaKV[$area]['areaname'].'医药行业招聘信息就上猎才医药网。';
			}elseif(!empty($functype) && empty($area) && empty($job_class)){
				//职能
				$TDK['title']       = $functypeKV[$functype]['name'].'招聘_最新'.$functypeKV[$functype]['name'].'岗位招聘信息-猎才医药网';
				$TDK['keywords']    = $functypeKV[$functype]['name'].'招聘';
				$TDK['description'] ='猎才医药网'.$functypeKV[$functype]['name'].'招聘信息,了解最新'.$functypeKV[$functype]['name'].'招聘求职信息就上猎才医药网。';
			}elseif(empty($area) && !empty($job_class)){
				//岗位
				$TDK['title']       =$functypeKV[$functype]['child'][$job_class]['name'].'招聘_最新'.$functypeKV[$functype]['child'][$job_class]['name'].'招聘信息-猎才医药网';
				$TDK['keywords']    = $functypeKV[$functype]['child'][$job_class]['name'].'招聘';
				$TDK['description'] ='猎才医药网提供'.$functypeKV[$functype]['child'][$job_class]['name'].'招聘信息,了解最新'.$functypeKV[$functype]['child'][$job_class]['name'].'招聘求职信息就上猎才医药网。';
			}elseif(!empty($functype) && !empty($area) && empty($job_class)){
				//职能+岗位
				$TDK['title']       = $areaKV[$area]['areaname'].$functypeKV[$functype]['name'].'招聘_最新'.$areaKV[$area]['areaname'].$functypeKV[$functype]['name'].'岗位招聘信息-猎才医药网';
				$TDK['keywords']    = $areaKV[$area]['areaname'].$functypeKV[$functype]['name'].'招聘';
				$TDK['description'] = '猎才医药网'.$areaKV[$area]['areaname'].$functypeKV[$functype]['name'].'招聘信息,了解最新'.$areaKV[$area]['areaname'].$functypeKV[$functype]['name'].'招聘求职信息就上猎才医药网。';
			}elseif(!empty($area) && !empty($job_class)){
				//地区+岗位
				$TDK['title']       = $areaKV[$area]['areaname'].$functypeKV[$functype]['child'][$job_class]['name'].'招聘_最新'.$areaKV[$area]['areaname'].$functypeKV[$functype]['child'][$job_class]['name'].'招聘信息-猎才医药网';
				$TDK['keywords']    = $areaKV[$area]['areaname'].$functypeKV[$functype]['child'][$job_class]['name'].'招聘，'.$areaKV[$area]['areaname'].$functypeKV[$functype]['child'][$job_class]['name'].'招聘信息';
				$TDK['description'] = '猎才医药网提供'.$areaKV[$area]['areaname'].$functypeKV[$functype]['child'][$job_class]['name'].'招聘信息,了解最新'.$areaKV[$area]['areaname'].$functypeKV[$functype]['child'][$job_class]['name'].'招聘求职信息就上猎才医药网。';
			}else{
				//没有参数
				
				$TDK['title']       = '最新医药招聘信息_医药人才招聘信息_医药行业招聘信息-猎才医药网';
				$TDK['keywords']    = '医药招聘信息，医药人才招聘信息，医药行业招聘信息';
				$TDK['description'] = '猎才医药网最新医药招聘信息，医药人才招聘信息。找医药类职位、找医药人才，了解医药行业招聘信息就上猎才医药网。';
			}
				return $TDK;
		}
		/*标签*/
		public static function tags_indexSeoTdk()
		{
			$TDK                = [];
			$TDK['title']       = '热门职位搜索-猎才医药网';
			$TDK['keywords']    = '热门职位搜索';
			$TDK['description'] = '热门职位搜索关键词由猎才医药网提供，方便医药人才快捷搜索查看热招岗位。';
			return $TDK;
		}
		/*标签*/
		public static function tags_showSeoTdk($keyword)
		{
			$TDK                = [];
			$TDK['title']       = $keyword.'招聘_最新'.$keyword.'职位信息-猎才医药网';
			$TDK['keywords']    = $keyword;
			$TDK['description'] = '最新'.$keyword.'职位招聘信息由猎才医药网提供，为'.$keyword.'人才提供便捷的医药求职服务，合作热线：025-68678201。';
			return $TDK;
		}
		/*猎头首页*/
		public static function lietou_indexSeoTdk()
		{
			$TDK                = [];
			$TDK['title']       = '中国医药猎头网:医药猎头公司_医药人才外包-猎才医药网';
			$TDK['keywords']    = '医药猎头网,医药猎头公司,医药猎头,医药猎头顾问,医药人才外包';
			$TDK['description'] = '中国医药猎头网成立于2003年，凭借多年在医药行业的的积累，成为中国最大的医药猎头公司，服务客户覆盖医药行业很多知名500强企业，相信我们的医药猎头顾问可以给你提供最好的医药猎头和医药人才外包服务';
			return $TDK;
		}
		/*猎头顾问*/
		public static function lietou_counselorSeoTdk()
		{
			$TDK                = [];
			$TDK['title']       = '医药猎头顾问-医药猎头-猎才医药网';
			$TDK['keywords']    = '';
			$TDK['description'] = '';
			return $TDK;
		}
		/*猎头服务*/
		public static function lietou_serviceSeoTdk()
		{
			$TDK                = [];
			$TDK['title']       = '医药猎头服务-医药猎头-猎才医药网';
			$TDK['keywords']    = '';
			$TDK['description'] = '';
			return $TDK;
		}
		/*合作企业*/
		public static function lietou_companySeoTdk()
		{
			$TDK                = [];
			$TDK['title']       = '合作企业-医药猎头-猎才医药网';
			$TDK['keywords']    = '';
			$TDK['description'] = '';
			return $TDK;
		}
		/*发展历程*/
		public static function lietou_lietoufzlcSeoTdk()
		{
			$TDK                = [];
			$TDK['title']       = '发展历程-医药猎头-猎才医药网';
			$TDK['keywords']    = '';
			$TDK['description'] = '';
			return $TDK;
		}
		public static function acrio()
		{
			
				//职能
				$TDK['title']       = '最新'.$functypeKV[$functype]['name'].'岗位招聘信息_招聘'.$functypeKV[$functype]['name'].'人才-猎才医药网';
				//$functypeKV[$functype]['name'].'招聘_最新'.$functypeKV[$functype]['name'].'岗位招聘信息-猎才医药网';
				$TDK['keywords']    = $functypeKV[$functype]['name'].'招聘信息';
				$TDK['description'] ='猎才医药网为全国'.$functypeKV[$functype]['name'].'人才提供最新'.$functypeKV[$functype]['name'].'岗位招聘信息，找'.$functypeKV[$functype]['name'].'工作就上猎才医药网。'; 
				//'猎才医药网'.$functypeKV[$functype]['name'].'招聘信息,了解最新'.$functypeKV[$functype]['name'].'招聘求职信息就上猎才医药网。';
			
				//岗位
				$TDK['title']       ='最新'.$functypeKV[$functype]['child'][$job_class]['name'].'招聘信息_招聘'.$functypeKV[$functype]['child'][$job_class]['name'].'人才-猎才医药网'; 
				//$functypeKV[$functype]['child'][$job_class]['name'].'招聘_最新'.$functypeKV[$functype]['child'][$job_class]['name'].'招聘信息-猎才医药网';
				$TDK['keywords']    = $functypeKV[$functype]['child'][$job_class]['name'].'招聘信息';
				$TDK['description'] ='猎才医药网为全国'.$functypeKV[$functype]['child'][$job_class]['name'].'人才提供最新'.$functypeKV[$functype]['child'][$job_class]['name'].'招聘信息，找'.$functypeKV[$functype]['child'][$job_class]['name'].'就上猎才医药网。'; 
				//'猎才医药网提供'.$functypeKV[$functype]['child'][$job_class]['name'].'招聘信息,了解最新'.$functypeKV[$functype]['child'][$job_class]['name'].'招聘求职信息就上猎才医药网。';
		}

		//简历预览
		public static function resume_indexSeoTdk($resume)
		{
			$TDK                = [];
			$TDK['title']       = $resume['job_class_text'].'求职_'.$resume['live_area_text'].$resume['realname'].'的个人求职简历-猎才医药网';
			$TDK['keywords']    = '';
			$TDK['description'] = $resume['realname'].'求职'.$resume['address_text'].$resume['job_class_text'].'，来猎才医药网，更多医药行业人才等你选。';
			return $TDK;
		}
}

?>
