//是否有全国选项
if($is_national!=true){
	$('#is_national').remove();
}else{
	if($('#is_national').attr('click')==1){
		
		$('.showCity').hide();
	}
}
//显示选择弹出层
$('#'+$showAreaID).click(function(){
		$('.alert').hide();
		$('.showArea').show();
});
$('#closeArea').click(function(){
		$('.showArea').hide();
});
$('.workPlaceProvince').each(function(i){
		$('.workPlaceProvince').eq(i).click(function(){
			$('.workPlaceProvince').removeClass($selectAreaSpanClass).removeClass($defaultAreaSpanClass).addClass($defaultAreaSpanClass);
			$(this).removeClass($defaultAreaSpanClass).addClass($selectAreaSpanClass);
			$('.showCity').hide().eq(i).show();
		});
});
$('.workPlaceProvince').click(function(){
	$('#is_national').removeClass($selectAreaSpanClass).addClass($defaultAreaSpanClass);
});
//选择和添加
	function selectWorkPlace(obj){
		var click = $(obj).attr('click');
		$('#selectedArea').find('span').each(function(){
					if($(this).html()=='全国'){
						$(this).remove();
					}
		});
			if(click==0){
				if($('#selectedArea').find('span').length<$maxSelectArea){
				var typehtml = $('#showProvince').find($selectAreaSpanClass).html();
				var is_select_type = 0;
				var data = $('#showProvince').find($selectAreaSpanClass).attr('data');
				$('#selectedArea').append('<span class="selectArea label label-info" data="'+$(obj).attr('data')+'" style="margin-right:20px;cursor: pointer;">'+$(obj).html()+'</span>');
				$(obj).removeClass($defaultAreaSpanClass).addClass($selectAreaSpanClass);
				$(obj).attr('click','1');
			}else{
				alert('最多选择'+$maxSelectArea+'项');
			}
		}else{
			if($('#selectedArea').find('span').length<=$maxSelectArea){
				var falsehtml = $(obj).html();
				$(obj).removeClass($selectAreaSpanClass).addClass($defaultAreaSpanClass);	
				$('#selectedArea').find('span').each(function(){
						if($(this).html()==falsehtml){
							$(this).remove();
						};
				});
				$(obj).attr('click','0');
			}else{
				alert('最多选择'+$maxSelectArea+'项');
			}
		}
		
	}
	
//选择完成添加
	$('#workPlaceTrue').click(function(){
		$('.workPlace').remove();
		var $area;
		$('#selectedArea').find('span').each(function(){
			if(!$area){
				$area = $(this).attr('data');
			}else{
				$area += ','+$(this).attr('data');
			}
			$('<span class="workPlace label label-info" data="'+$(this).attr('data')+'"  style="margin-right:20px;cursor: pointer;">'+$(this).html()+'</span>').insertBefore('#workPlaceValue');
		});
		$('#'+$areaInputID).val($area);
		$('.showArea').hide();
	});
	
//取消添加
	$('#workPlaceFalse').click(function(){
		$('.showArea').hide();
	});
	//初始化默认值
	var  workPlaceLength = $('.workPlace').length;
	if(workPlaceLength>0){
		$('.workPlace').each(function(){
			$('#selectedArea').append('<span class="selectArea label label-info" data="'+$(this).attr('data')+'" style="margin-right:20px;cursor: pointer;">'+$(this).html()+'</span>');
		});
	}
	$('#is_national').click(function(){
		$('.showCity').hide();
		$('.workPlaceCity').removeClass($selectAreaSpanClass).removeClass($defaultAreaSpanClass).addClass($defaultAreaSpanClass);
		$('.workPlaceProvince').removeClass($selectAreaSpanClass).removeClass($defaultAreaSpanClass).addClass($defaultAreaSpanClass);
		$(this).removeClass($defaultAreaSpanClass).addClass($selectAreaSpanClass);
		
		$('#selectedArea').find('span').remove();
		$('#selectedArea').append('<span class="selectArea label label-info" data="'+$(this).attr('data')+'" style="margin-right:20px;cursor: pointer;">'+$(this).html()+'</span>');
	});
//定位已选择的地区
$('#selectedArea').delegate('.selectArea','click',function(){
	var $clickThis = $(this).attr('data');
	$('.workPlaceProvince').removeClass($selectAreaSpanClass).removeClass($defaultAreaSpanClass).addClass($defaultAreaSpanClass);
	$('.showCity').hide();
	$('.showCity').each(function(i){
		$('.showCity').eq(i).find('.workPlaceCity').each(function(j){
			if($(this).attr('data')==$clickThis){
				$('.workPlaceProvince').eq(i).removeClass($defaultAreaSpanClass).addClass($selectAreaSpanClass);
				$('.showCity').eq(i).show();
			}
		});
	});
});
//取消已选择区域
$('#selectedArea').delegate('.selectArea','dblclick',function(){
	var $clickThis = $(this).attr('data');
	$('.showCity').each(function(i){
		$('.showCity').eq(i).find('.workPlaceCity').each(function(j){
			if($(this).attr('data')==$clickThis){
				$('.workPlaceCity').eq(i).removeClass($selectAreaSpanClass).addClass($defaultAreaSpanClass);
			}
		});
	});
});
