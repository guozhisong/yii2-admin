/*
*插件作者:周祥
*发布时间:2014年12月12日
*插件介绍:图片上传本地预览插件 兼容浏览器(IE 谷歌 火狐) 不支持safari 当然如果是使用这些内核的浏览器基本都兼容
*插件网站:http://jquery.decadework.com
*作  者QQ:200592114
*使用方法:
*界面构造(IMG标签外必须拥有DIV 而且必须给予DIV控件ID)
* <div id="imgdiv"><img id="imgShow" width="120" height="120" /></div>
* <input type="file" id="up_img" />
*调用代码:
* new uploadPreview({ UpBtn: "up_img", DivShow: "imgdiv", ImgShow: "imgShow" });
*参数说明:
*UpBtn:选择文件控件ID;
*DivShow:DIV控件ID;
*ImgShow:图片控件ID;
*Width:预览宽度;
*Height:预览高度;
*ImgType:支持文件类型 格式:["jpg","png"];
*callback:选择文件后回调方法;

*版本:v1.4
更新内容如下:
1.修复回调.

*版本:v1.3
更新内容如下:
1.修复多层级框架获取路径BUG.
2.去除对jquery插件的依赖.
*/

/*
*author:周祥
*date:2014年12月12日
*work:图片预览插件
*/
var licenseUploadPreview = function(setting) {
    /*
    *author:周祥
    *date:2014年12月11日
    *work:this(当前对象)
    */
    var _self = this;
    /*
    *author:周祥
    *date:2014年12月11日
    *work:判断为null或者空值
    */
    _self.IsNull = function(value) {
        if (typeof (value) == "function") { return false; }
        if (value == undefined || value == null || value == "" || value.length == 0) {
            return true;
        }
        return false;
    }
    /*
    *author:周祥
    *date:2014年12月11日
    *work:默认配置
    */
    _self.DefautlSetting = {
        UpBtn: "",
        DivShow: "",
        ImgShow: "",
        Width: 100,
        Height: 100,
        ImgType: ["gif", "jpg", "png"],
        ImgSize:2097152,
        ErrMsg: "选择文件错误,图片类型必须是(gif,jpg,png)中的一种",
        callback: function() { }
    };
    /*
    *author:周祥
    *date:2014年12月11日
    *work:读取配置
    */
    _self.Setting = {
        UpBtn: _self.IsNull(setting.UpBtn) ? _self.DefautlSetting.UpBtn : setting.UpBtn,
        DivShow: _self.IsNull(setting.DivShow) ? _self.DefautlSetting.DivShow : setting.DivShow,
        ImgShow: _self.IsNull(setting.ImgShow) ? _self.DefautlSetting.ImgShow : setting.ImgShow,
        Width: _self.IsNull(setting.Width) ? _self.DefautlSetting.Width : setting.Width,
        Height: _self.IsNull(setting.Height) ? _self.DefautlSetting.Height : setting.Height,
        ImgType: _self.IsNull(setting.ImgType) ? _self.DefautlSetting.ImgType : setting.ImgType,
        ImgSize: _self.IsNull(setting.ImgSize) ? _self.DefautlSetting.ImgSize : setting.ImgSize,
        ErrMsg: _self.IsNull(setting.ErrMsg) ? _self.DefautlSetting.ErrMsg : setting.ErrMsg,
        callback: _self.IsNull(setting.callback) ? _self.DefautlSetting.callback : setting.callback
    };
    /*
    *author:周祥
    *date:2014年12月11日
    *work:获取文本控件URL
    */
    _self.getObjectURL = function(file) {
        var url = null;
        if (window.createObjectURL != undefined) {
            url = window.createObjectURL(file);
        } else if (window.URL != undefined) {
            url = window.URL.createObjectURL(file);
        } else if (window.webkitURL != undefined) {
            url = window.webkitURL.createObjectURL(file);
        }
        return url;
    }
    /*
    *author:周祥
    *date:2014年12月11日
    *work:绑定事件
    */
    _self.Bind = function() {
        document.getElementById(_self.Setting.UpBtn).onchange = function() {
            if (this.value) {
                if (!RegExp("\.(" + _self.Setting.ImgType.join("|") + ")$", "i").test(this.value.toLowerCase())) {
                    //document.getElementById('logo_info').innerHTML(_self.Setting.ErrMsg);
                    $msg=_self.Setting.ErrMsg;
                     if (navigator.userAgent.indexOf("MSIE") > -1) {
                     	alert($msg);
                     }else{
                     	$('#license_info').html($msg).css('color','red');
                     }
                    licenseError=$msg;
                    this.value = "";
                    return false;
                }
                if (navigator.userAgent.indexOf("MSIE") > -1) {
                    try {
                        document.getElementById(_self.Setting.ImgShow).src = _self.getObjectURL(this.files[0]);
                    } catch (e) {
                        var div = document.getElementById(_self.Setting.DivShow);
                        this.select();
                        top.parent.document.body.focus();
                        var src = document.selection.createRange().text;
                        document.selection.empty();
                        /*
                        document.getElementById(_self.Setting.ImgShow).style.display = "none";
                        div.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                        div.style.width = _self.Setting.Width + "px";
                        div.style.height = _self.Setting.Height + "px";
                        */
                        var $size=_self.Setting.ImgSize;
                        $.post('/ajax/check-upload-size',{'src':src},function(data){
                        	if(data>$size){
                        		$('#license_info').html('文件过大，上传文件请小于'+Math.ceil(_self.Setting.ImgSize/1024)+'KB');
                        		licenseError='文件过大，上传文件请小于'+Math.ceil(_self.Setting.ImgSize/1024)+'KB';
                        		return false;
                        	}else{
                        		$('#license_info').html(src);
                        		$('.uploadimg-license').attr('data',src);
                        		licenseError=false;
                        	}
                        })
                    }
                } else {
                	
                	if(this.files[0].size>_self.Setting.ImgSize){
                		$('#license_info').html('文件过大，上传文件请小于'+Math.ceil(_self.Setting.ImgSize/1024)+'KB').css('color','red');
                		licenseError='文件过大，上传文件请小于'+Math.ceil(_self.Setting.ImgSize/1024)+'KB';
                	}else{
                		$('#license_info').html(_self.getObjectURL(this.files[0]));
                		$('.uploadimg-license').attr('data',_self.getObjectURL(this.files[0]));
                		licenseError=false;
                	}
                }
                _self.Setting.callback();
            }
        }
    }
    /*
    *author:周祥
    *date:2014年12月11日
    *work:执行绑定事件
    */
    _self.Bind();
}