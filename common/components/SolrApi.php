<?php
namespace common\components;

class SolrApi
{
//    static $solrApiBaseUrl = 'http://localhost:8080/solr-api';
    static $solrApiBaseUrl = 'http://192.168.16.27:8080/solr-api';
    static $defaultPagesize = 15;

    public static function createIndex($modules, $delta)
    {
        if (!$modules) throw new \yii\base\ErrorException('模块参数不能为空');
        $url = self::$solrApiBaseUrl.'/'.$modules.'-create-index?delta='.$delta;
        $data = Curl::callWebServer($url);
        return $data;
    }

    public static function getAnalysis($keyword)
    {
        $begin = microtime(TRUE);
        $url = self::$solrApiBaseUrl.'/jobs-Analysis';
        $data = Curl::callWebServer($url, ['keyword' => $keyword]);
        $end   = microtime(TRUE);
        $time  = $end-$begin;
        //echo "执行了".$time."s";
        return $data;
    }

    public static function getQueryByKeyword($modules, $params, $offset, $pagesize = self::defaultPagesize)
    {
        if (!$modules) throw new \yii\base\ErrorException('模块参数不能为空');
        $url = self::$solrApiBaseUrl.'/'.$modules.'-query';
        $_params = ['pager.pagesize' => $pagesize, 'pager.offset' => $offset];
        if (!empty($params)) {
            $_params = array_merge($_params, $params);
        }
        $data = Curl::callWebServer($url, $_params);
        return $data;

    }
    
}

?>