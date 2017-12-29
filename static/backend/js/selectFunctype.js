//添加职位分类
	$('#addJobClass').click(function(){
		$('.alert').hide();
		$('.showClass').show();
	});
	$('#closeShowClass').click(function(){
		$('.showClass').hide();
	});
	$('.func_type').each(function(i){
		$('.func_type').eq(i).click(function(){
			$('.func_type').removeClass('label-danger').removeClass('label-default').addClass('label-default');
			$(this).removeClass('label-default').addClass('label-danger');
			$('.showJobClass').hide().eq(i).show();
		});
	});
	//选择和添加
	function selectJobClass(obj){
		var click = $(obj).attr('click');
			if(click==0){
				if($('#selectedJobClass').find('span').length<$maxSelectJobClass){
				var typehtml = $('#showFuncType').find('.label-danger').html();
				var is_select_type = 0;
				var data = $('#showFuncType').find('.label-danger').attr('data');
				$('#selectedFuncType').find('span').each(function(){
					if($(this).html()==typehtml){
						is_select_type = 1;
					};
				});
				if(is_select_type == 0){
					$('#selectedFuncType').append('<span class="selectFuncType label label-info" data="'+data+'" style="margin-right:20px;cursor: pointer;">'+typehtml+'</span>');
				}
				$('#selectedJobClass').append('<span class="selectJobClass label label-info" data="'+$(obj).attr('data')+'" style="margin-right:20px;cursor: pointer;">'+$(obj).html()+'</span>');
				$(obj).removeClass('label-default').addClass('label-danger');
				$(obj).attr('click','1');
			}else{
				alert('最多选择'+$maxSelectJobClass+'项');
			}
		}else{
			if($('#selectedJobClass').find('span').length<=$maxSelectJobClass){
				var falsehtml = $(obj).html();
				$(obj).removeClass('label-danger').addClass('label-default');	
				if($(obj).parent().find('.label-danger').length==0){
					var typehtml = $('#showFuncType').find('.label-danger').html();
					
					$('#selectedFuncType').find('span').each(function(){
						if($(this).html()==typehtml){
							$(this).remove();
						};
					});
				}
				$('#selectedJobClass').find('span').each(function(){
						if($(this).html()==falsehtml){
							$(this).remove();
						};
				});
				$(obj).attr('click','0');
			}else{
				alert('最多选择'+$maxSelectJobClass+'项');
			}
		}
		
	}
		
		

	//选择完成添加
	$('#JobClassTrue').click(function(){
		$('.functype').remove();
		$('.jobClass').remove();
		var funcVal;
		var classVal;
		$('#selectedFuncType').find('span').each(function(){
			if(!funcVal){
				funcVal = $(this).attr('data');
			}else{
				funcVal += ','+$(this).attr('data');
			}
			$('<span class="functype label label-info" data="'+$(this).attr('data')+'"  style="margin-right:20px;cursor: pointer;">'+$(this).html()+'</span>').insertBefore('#functypeValue');
		});
		$('#selectedJobClass').find('span').each(function(){
			if(!classVal){
				classVal = $(this).attr('data');
			}else{
				classVal += ','+$(this).attr('data');
			}
			$('<span class="jobClass label label-info" data="'+$(this).attr('data')+'"  style="margin-right:20px;cursor: pointer;">'+$(this).html()+'</span>').insertBefore('#jobClassValue');
		});
		$('#functypeValue').val(funcVal);
		$('#jobClassValue').val(classVal);
		$('.showClass').hide();
	});
	//取消添加
	$('#JobClassFalse').click(function(){
		$('.showClass').hide();
	});
	//初始化默认值
	var  functypeLength = $('.functype').length;
	var  jobclassLength = $('.jobClass').length;
	if(functypeLength>0){
		$('.functype').each(function(){
			$('#selectedFuncType').append('<span class="selectFuncType label label-info" data="'+$(this).attr('data')+'" style="margin-right:20px;cursor: pointer;">'+$(this).html()+'</span>');
		});
	}
	if(jobclassLength>0){
		$('.jobClass').each(function(){
			$('#selectedJobClass').append('<span class="selectJobClass label label-info" data="'+$(this).attr('data')+'" style="margin-right:20px;cursor: pointer;">'+$(this).html()+'</span>');
		});
	}