/**
 * 
 */
var a = {};
function _getBasePath() {
	var els = document.getElementsByTagName('script'), src;
	for (var i = 0, len = els.length; i < len; i++) {
		src = els[i].src || '';
		if (/areaselect[\w\-\.]*\.js/.test(src)) {
			return src.substring(0, src.lastIndexOf('/') + 1);
		}
	}
	return '';
}
a.basePath = _getBasePath();

/**
 * 
 */

function dianjitanhcu(id) {
	dialog = art.dialog({id: id,title: false});
	dialog.hide();
	currDialogId = id;
	//dialog.data('targetId', id);
	// jQuery ajax   
	$.ajax({
	    url: '/site/areaselect',
	    success: function (data) {
	        dialog.content(data);
	        dialog.show();
	    },
	    cache: true
    });	
}

function dianjiguanbi () {
	dialog.close();
}





//初始化
function initSelected(id){
	var targetFieldId = "field_"+id;
	//初始化
	/*
	if ($('.areaSelectedBtn').length > 0 ) {
		$.each($('.areaSelectedBtn').toArray(), function(i, n) {
			cancelCheckBtn($(n).attr('data'));                             		                                  
        });
    }*/
	dialog = art.dialog({id: id,title: false});
	dialog.hide();
	currDialogId = id;
	//dialog.data('targetId', id);
	// jQuery ajax   
	$.ajax({
	    url: '/site/areaselect',
	    success: function (data) {
	        dialog.content(data);
			if($('#'+targetFieldId).find('.areaResult_0').length > 0 ){
				clickAll();
				$("#zzc_dqxz").show();
				$("#znxx_dqxz").show();
				return ;
			}
			if ($('#'+targetFieldId).find('.areaResult').length > 0 ) {
				$.each($('#'+targetFieldId).find('.areaResult').toArray(), function(i, n) {            	                  
					 //arr.push($(n).attr('data'));
					checkBtn($(n).attr('data'));                               		                                  
				});
			}
			$("#zzc_dqxz").show();
			$("#znxx_dqxz").show();
	        dialog.show();
	    },
	    cache: true
    });	
	
}


//结果点击事件
$("div").delegate(".areaResult","click",function(){
	var id = $(this).parent().parent().attr('data');
	var targetFieldId = "field_"+id;
	$(this).remove();
	var arr = [];
	$.each($('#'+targetFieldId).find('.areaResult').toArray(), function(i, n) {            	                  
		arr.push($(n).attr('data'));		
	});
	$('#'+id).val(arr ? arr.join() : '');
	return true;

});

$

//选中点击事件
/*
$("div").delegate(".areaSelectedBtn","click",function(){
   var id =  $(this).attr('data');
   //取消全国
	   if (id == 0) {
		  clickAllCancel();
		  return ;
   }
   var inSelecedFlag = inSelecedData(id);
   var inSelecedDataByChildFlag = inSelecedDataByChild(id);
   if(inSelecedFlag) {
	   //batchClearSelectedStatusById(id);
	   $('.areaSelectedBtn_'+id).remove();
	       batchClearSelectedStatusById(id);
   	   settingBtnIsCheck(id,null,false);
       return true;
   }
   if(inSelecedDataByChildFlag) {
	   cancel2(id,null); 
	   batchClearSelectedStatusById(id);  
       settingBtnIsCheck(id,null,false); 
       return true;
   }
   $(this).remove();
});

$(".linst_iut_01 .letgg_divtes").click(function(){
	parentTab(this);
});
$(".tetpo").click(function(){			
	showParentList(this);
});


$('.secondAreaBtn').click(function(){
	selectedBtn($(this));
});
//省份点击事件
$('.parentAreaBtn').click(function(){
	selectedBtn($(this));
	   
});

//热门地区点击事件
$('.hotAreaBtn').click(function(){
	selectedBtn(this);
        
});

$('#didiandiqu .tanchu_img').click(function(){//选择弹出事件
	//initSelected();
});
*/



function showParentList(obj){
	$(obj).removeClass("marti");
	$(".lejt").hide();
	$(".linst_iut").show();
	$(".teset_09h .tesett_88").hide();
}

function parentTab(obj){
	var html=$(obj).html();
	$(".linst_iut").hide();
	$(".lejt").show().text($(obj).text());
	$(".tetpo").addClass("marti");
	var  fds=$(obj).index();
	$(".teset_09h .tesett_88").show().eq(fds).siblings().hide();
	$(".teset_09h .tesett_88").eq(fds).find('.parent_area').html(html);
	
}

//选中全国
function clickAll(){
if ($('.areaSelectedBtn').length > 0 ) {
   	$.each($('.areaSelectedBtn').toArray(), function(i, n) {    
   		cancelCheckBtn($(n).attr('data'));                               		                                  
    });
}    
	writeDiva('全国', 0, '');
	batchSelectedStatusById(0);
	disabledSelectedBtn($('.secondAreaBtn'));
	disabledSelectedBtn($('.hotAreaBtn'));
	disabledSelectedBtn($('.parentAreaBtn'));
}

function clickAllCancel(){
if ($('.areaSelectedBtn').length > 0 ) {
   	$.each($('.areaSelectedBtn').toArray(), function(i, n) {    
   		cancelCheckBtn($(n).attr('data'));                               		                                  
    });
}                	
	$('.areaSelectedBtn_'+0).remove();
	enabledSelectedBtn($('.secondAreaBtn'));
	enabledSelectedBtn($('.hotAreaBtn'));
	enabledSelectedBtn($('.parentAreaBtn'));
}

//
function selectedBtn(ojb){   
var id = $(ojb).attr('data'); 
//选中全国
  if(id == 0){
  	$('.areaSelectedBtn_0').length > 0 ? clickAllCancel() : clickAll();
  	return ;
}       
	//如果不可点跳出
if(isNotallowed(ojb)){
    return false;
}

var inSelecedFlag = inSelecedData(id);
var inSelecedDataByChildFlag = inSelecedDataByChild(id);        
//如果大于3条
if($('.areaSelectedBtn').length > 2 && !inSelecedFlag && !inSelecedDataByChild(id)) {
    //alert("最多只能选3项！"); 
	$(".terse_oi").fadeIn(1000);
	$(".terse_oi").fadeOut(1000);
	return false;
}

	var item = areaData[id];
	//如果在选中框中 删除该条 否则 添加 
	if (inSelecedFlag) {
 	$('.areaSelectedBtn_'+id).remove();
 	batchClearSelectedStatusById(id);
 	settingBtnIsCheck(id,item,false);
} else if(inSelecedDataByChildFlag) {
	cancel2(id,item); 
	batchSelectedStatusById(id);  
    writeDiva(item.areaname, item.areaid, '');
    settingBtnIsCheck(id,item,true);           	
} else {
	batchSelectedStatusById(id);  
    writeDiva(item.areaname, item.areaid, '');
    settingBtnIsCheck(id,item,true);
	   //如果选中省份，将下级设为不可选              
}
           
}



function inSelecedData(id){
return $('.areaSelectedBtn_'+id).length > 0 ? true : false;
}

//当前选项的子节点是否在选中框中
function inSelecedDataByChild(id){
var selecedArr = getSelecedArr($('.areaSelectedBtn'));

if(!selecedArr) return false;
var arrchildidItem = arrchildid[id];
var flag = false;             
$.each(selecedArr, function(i, n) {            	                  
	    if($.inArray(n, arrchildidItem) > -1){ 
	    	flag = true;
		}                              		                               
});
return flag;     
}

//

//获取选中框中数据
function getSelecedResultDiv(){
if ($('.areaSelectedBtn').length < 1 )  return "";
var str = "";
	$.each($('.areaSelectedBtn').toArray(), function(i, n) {            	                  	 
		str += writeDiva2(areaData[$(n).attr('data')].areaname, $(n).attr('data'));                             		                                  
});
return str;     
}

//获取选中框中数据
/*
function getSelecedArr(){
if ($('.areaSelectedBtn').length < 1 )  return false;
var arr = [];
	$.each($('.areaSelectedBtn').toArray(), function(i, n) {            	                  
	 arr.push($(n).attr('data'));                               		                                  
});
return arr;     
}*/

//获取选中框中数据
function getSelecedArr(obj){
if ($(obj).length < 1 )  return false;
var arr = [];
	$.each($(obj).toArray(), function(i, n) {            	                  
	 arr.push($(n).attr('data'));                               		                                  
});
return arr;     
}

//如果选择省份，选中框中有它的子节点 清除
function cancel2(id,item){
if(item == null) item = areaData[id];
if (item.parentid > 0 ) return ;
var arrchildidItem = arrchildid[id];
//点击事件
$.each(arrchildidItem, function(i, n){
	if ($('.areaSelectedBtn_'+n).length > 0) {
  	  $('.areaSelectedBtn_'+n).remove();
	   cancelCheckBtn(n);	
   }
	});
} 
//选中按钮
function checkBtn(id,item){
if(item == null) item = areaData[id];
batchSelectedStatusById(id);   
writeDiva(item.areaname, item.areaid, '');
settingBtnIsCheck(id,item,true);

}
//取消按钮
function cancelCheckBtn(id,item){
//if(item == null) item = areaData[id];
$('.areaSelectedBtn_'+id).remove();
batchClearSelectedStatusById(id);
settingBtnIsCheck(id, item, false);
}

//如果选择省份 ，子节点不可选（disabled 开关）             
function settingBtnIsCheck(id,item,disabled){
if(id < 1) return false; 
if (item == null)  item = areaData[id];
if (item.parentid > 0) return false;
var arrchildidItem = arrchildid[id];
$.each(arrchildidItem, function(i, n) {            	                  
	  if (disabled) {
		disabledSelectedBtn($('.secondAreaBtn_'+n));
    	disabledSelectedBtn($('.hotAreaBtn_'+n)); 
    } else { 
    	enabledSelectedBtn($('.secondAreaBtn_'+n));
        enabledSelectedBtn($('.hotAreaBtn_'+n));
    	                   
    }                                     		
                    
});     
}

function batchSelectedStatusById(id){
	$('.secondAreaBtn_'+id).addClass("slddl");
	$('.hotAreaBtn_'+id).addClass("slddl");
	$('.parentAreaBtn_'+id).addClass("slddl");
}
function batchClearSelectedStatusById(id){
	$('.secondAreaBtn_'+id).removeClass("slddl");
	$('.hotAreaBtn_'+id).removeClass("slddl");
	$('.parentAreaBtn_'+id).removeClass("slddl");
}

function isNotallowed(ojb){
if($(ojb).hasClass('notallowed')){
    return true;
}
return false;
}

function disabledSelectedBtn(obj){
$(obj).addClass('notallowed');
$(obj).css('cursor', 'not-allowed');
}

function enabledSelectedBtn(obj){
$(obj).removeClass('notallowed');
$(obj).css('cursor', 'pointer');
}

function setAreaResultDiv(){
 var targetFieldId = "field_"+currDialogId;
 $("#"+targetFieldId+" .tesgg").html(getSelecedResultDiv());
 var arr = getSelecedArr($('.areaSelectedBtn'));
 $('#'+currDialogId).val(arr ? arr.join() : '');
 $(".tesgg .tese_kj").removeClass("tese_kj").addClass("seertt");
 $(".tesgg .rewe").attr("src","/static/frontend/img/sousuo/guanbi.jpg");
 $(".tesgg .divSmall4").addClass("widthss");
 $(".tesgg .tese_ujt").removeClass("sjeht_how");
 dianjiguanbi();
}

function writeDiva(name, id, classONE) {//点击获取值
var divShowa = "<div id='selected_" + id + "' class='tese_kj divSmall4 areaSelectedBtn areaSelectedBtn_"+ id +"' data='" + id + "' ttype='"+ classONE+"' onClick=\"selectedBtn(this)\">"+"</span>" + name + "<img src='/static/frontend/img/sousuo/quxiabe.jpg' class='rewe' />"+"<div class='clear'>"+"</div>"+"</div>";
 $("#mainSelecta").html($("#mainSelecta").html() + divShowa);
 $('#work_place_error').html('').hide();
}

function writeDiva2(name, id) {//点击结果中单元
 var divShowa = "<div class='tese_kj divSmall4 areaResult areaResult_" + id + "' data='" + id + "' ttype='"+"'>" + name + 
 "<img src='/static/frontend/img/sousuo/quxiabe.jpg' class='rewe' />"+
 "<div class='clear'>"+"</div>"+
 "<input class='area' id='work_place' type='text' name='area[]' value='"+id+"' style='display: none;'/>"+
 "</div>";
 return divShowa;

}