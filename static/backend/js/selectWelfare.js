	$(document).ready(function(){
		$('.welfare').each(function(){
				if(this.nextSibling.checked){
					$(this).removeClass('label-info');
					$(this).addClass('label-danger');
				}
			});
	});

	//添加企业福利
	$('#addWelfare').toggle(function(){
		$('#addWelfareText').val('').show().focus();
		$(this).html('确定');
	},function(){
		var welfare = $('#addWelfareText').val();
		var welfareValue;
		if(welfare){
			$('<span class="welfare label label-info" style="margin-right:20px;cursor: pointer;">'+welfare+'</span>').insertBefore('#addWelfareText');
			
			$('.welfare').each(function(){
				if(welfareValue){
					welfareValue += ','+$(this).html();
				}else{
					welfareValue = $(this).html();
				}
			});
			$('#welfareValue').val(welfareValue);
			
		}
		$('#addWelfareText').val('').hide();
		$(this).html('增加');
	});
	
	$('.welfare').dblclick(function(){
		$(this).remove();
		var welfareValue;
		$('.welfare').each(function(){
				if(welfareValue){
					welfareValue += ','+$(this).html();
				}else{
					welfareValue = $(this).html();
				}
			});
		$('#welfareValue').val(welfareValue);
	});
	