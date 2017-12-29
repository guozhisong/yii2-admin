$(function(){
	
	$(".switchs li").click(function(){
		$(".switchs li").addClass("c");
		$(this).removeClass("c");
		$(".info").children("div").addClass("hidden");
		$("#info"+$(this).attr("id")).removeClass("hidden");
	});
});

function JumpFrame(url1,url2){
	if(url1){window.parent.left.location.href=url1;}
	if(url2){window.parent.main.location.href=url2;}
}

function closec(tid){
	if($("."+tid).css("display")=="table-row"){
		$("."+tid).css("display","none");
		$("#"+tid).attr("class", "classico1");
	}else{
		$("."+tid).css("display","table-row");
		$("#"+tid).attr("class", "classico2");
	}
	/*
	if ($.browser.msie) {
		if($("."+tid).css("display")=="inline"){
			$("."+tid).css("display","none");
			$("#"+tid).attr("class", "classico1");
		}else{
			$("."+tid).css("display","inline");
			$("#"+tid).attr("class", "classico2");
		}
	}else{
		if($("."+tid).css("display")=="table-row"){
			$("."+tid).css("display","none");
			$("#"+tid).attr("class", "classico1");
		}else{
			$("."+tid).css("display","table-row");
			$("#"+tid).attr("class", "classico2");
		}
	}*/
}

function checkboxs(id,ids,input){
	var ids = ids.split(",");
	if($(id).attr('checked') == true){
		for(i=0;i<ids.length;i++){
			$("#"+input+ids[i]).attr('checked',true);
		}
	}
}
function checkboxp(id,pid){
	if($(id).attr('checked') == false){
		$(pid).attr('checked',false);
	}
}
function alls(divc,inputs){
	if($("#"+inputs).attr('value') == '全选'){
		$("input[name='"+divc+"']").attr('checked',true);
		$("#"+inputs).attr('value','取消全选');
	}else{
		$("input[name='"+divc+"']").attr('checked',false);
		$("#"+inputs).attr('value','全选');
	}
}
function forma(gos){
	if(confirm("确定要执行批量操作吗？")){
		$("#go").attr("value",gos);
		$("#formall").trigger("submit");
	}
}

function winboxgo(con,c){
	$("#winbox").remove();
	$("body").append('<div class="winbox_'+c+'" id="winbox">'+con+'</div>');
	winboxgo_tl();
	$(window).bind("resize scroll", function(){
		winboxgo_tl()
	});
}
function winboxgo_tl(){
	$t=Math.round(($(window).height()-$("#winbox").height())/2);
	$l=Math.round(($(window).width()-$("#winbox").width())/2);
	$("#winbox").css("top",$t+$(document).scrollTop());
	$("#winbox").css("left",$l+$(document).scrollLeft());
}