<?php
namespace common\widgets;

use Yii;
use yii\helpers\Html;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\data\Pagination;

/*
 * 使用方法
 * $pagination 对象
 * location 是否有输入页码直接跳转
echo CustomPager::widget([
    'pagination' => $pagination,
    'location' => true,

]);
*/

class CustomPager extends \yii\widgets\LinkPager{
	
    public $options = ['class' => 'custom-pager'];
    
    public $activePageCssClass = 'current';
    
    public $nextPageLabel = '下一页';
    public $prevPageLabel = '上一页';
    public $firstPageLabel = '|<';
    public $lastPageLabel = '>|';
    
    public $prevPageCssClass = 'custom_prev';
    public $nextPageCssClass = 'custom_next';
    
    public $maxButtonCount = 5;
    public $step = 3;
    
    public $selectsql = '';
    public $location = false; //添加输入框定位到某页
    
    protected function renderPageButtons($location = false, $selectsql = '')
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        $buttons = [];
        $buttons[] = Html::beginTag('div', ['class' => 'pagerbar']);
        
        $currentPage = $this->pagination->getPage();

        // 第一页
        $firstPageLabel = $this->firstPageLabel === true ? '1' : $this->firstPageLabel;
        if ($firstPageLabel !== false) {
        	$buttons[] = $this->renderPageButton($firstPageLabel, 0, $this->firstPageCssClass, $currentPage <= 0, false);
        }

        // 上一页
        if ($this->prevPageLabel !== false) {
            if (($page = $currentPage - 1) < 0) {
                $page = 0;
            }
            $buttons[] = $this->renderPageButton($this->prevPageLabel, $page, $this->prevPageCssClass, $currentPage <= 0, false);
        }

        list($beginPage, $endPage) = $this->getPageRange();
        
        for ($i = $beginPage; $i <= $endPage; ++$i) { 
        	$buttons[] = $this->renderPageButton($i + 1, $i, null, false, $i == $currentPage);
        }
        
        if($pageCount > 5 && $pageCount > ($currentPage + 3)){
            $buttons[] = '<span class="ellipsis">&#8230;</span>';
        }
        
        // 下一页
        if ($this->nextPageLabel !== false) {
            if (($page = $currentPage + 1) >= $pageCount - 1) {
                $page = $pageCount - 1;
            }
            $buttons[] = $this->renderPageButton($this->nextPageLabel, $page, $this->nextPageCssClass, $currentPage >= $pageCount - 1, false);
        }

        // 最后一页
        $lastPageLabel = $this->lastPageLabel === true ? $pageCount : $this->lastPageLabel;
        if ($lastPageLabel !== false) {
        	$buttons[] = $this->renderPageButton($lastPageLabel, $pageCount - 1, $this->lastPageCssClass, $currentPage >= $pageCount - 1, false);
        }
        
        if($this->location && ($this->pagination->getPageCount() > $this->maxButtonCount)){
            $html = '<span class="addition">';
        	$html .= '<span class="redirect">跳转到';
        	$html .= '<input class="pn" name="pn" type="text" value="'.($this->pagination->getPage() + 1).'" />页';
        	$html .= '<a class="go custom_paper_ref" href="javascript:;" ref="'.($this->pagination->createUrl($this->pagination->getPage())).'">确定</a>';
        	$html .= '</span>';
        	$html .= '</span>';
        	$buttons[] = $html;
        }
        $buttons[] = Html::tag('div', '', ['class' => 'clear']);
        $buttons[] = Html::endTag('div');
        
        $buttons[] = Html::cssFile('@web_frontend/css2/custom-pager.css', ['rel' => 'stylesheet']);
        $buttons[] = Html::jsFile('@web_frontend/js2/custom-paper.js');

        return Html::tag('div', implode("\n", $buttons), $this->options);
    }

   protected function renderPageButton($label, $page, $class, $disabled, $active)
    {
        $options = ['class' => $class === '' ? null : $class];
        if ($active) {
            Html::addCssClass($options, $this->activePageCssClass);
        }
        
        if ($disabled) {
            Html::addCssClass($options, $this->disabledPageCssClass);
            return Html::a($label, 'javascript:void(0);', $options);
        }
        
        $linkOptions = $this->linkOptions;
        $linkOptions['data-page'] = $page;
        
        return Html::a($label, $this->pagination->createUrl($page), $options);
    }

    protected function getPageRange()
    {
        $currentPage = $this->pagination->getPage();
        $pageCount = $this->pagination->getPageCount();

        $beginPage = max(0, $currentPage - (int) ($this->maxButtonCount / 2));
        if (($endPage = $beginPage + $this->maxButtonCount - 1) >= $pageCount) {
            $endPage = $pageCount - 1;
            $beginPage = max(0, $endPage - $this->maxButtonCount + 1);
        }

        return [$beginPage, $endPage];
    }
}
