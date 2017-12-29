/*Common function*/

//获取json子元素length
getJsonLength = function (json) {
	if ($.type(json) != 'object') {
		return false;
	}
	var i = 0;
	$.each(json, function (n) {
		i++
	});
	return i;
}
//获取字符串长度
String.prototype.strLen = function () {
	var len = 0;
	for (var i = 0; i < this.length; i++) {
		if (this.charCodeAt(i) > 255 || this.charCodeAt(i) < 0) len += 2;
		else len++;
	}
	return len;
}
//将字符串拆成字符，并存到数组中
String.prototype.strToChars = function () {
	var chars = new Array();
	for (var i = 0; i < this.length; i++) {
		chars[i] = [this.substr(i, 1), this.isCHS(i)];
	}
	String.prototype.charsArray = chars;
	return chars;
}
//判断某个字符是否是汉字
String.prototype.isCHS = function (i) {
	if (this.charCodeAt(i) > 255 || this.charCodeAt(i) < 0) {
		return true;
	} else {
		return false;
	}
}
//截取字符串（从start字节到end字节）
String.prototype.subCHString = function (start, end) {
	var len = 0,
		str = "";

	this.strToChars();
	for (var i = 0; i < this.length; i++) {
		if (this.charsArray[i][1]) {
			len += 2;
		} else {
			len++;
		}
		if (end < len) {
			return str;
		} else if (start < len) {
			str += this.charsArray[i][0];
		}
	}
	return str;
}
//截取字符串（从start字节截取length个字节）
String.prototype.subCHStr = function (start, length) {
	return this.subCHString(start, start + length);
}

parseDropMenuValue = function(obj) {
	var v = [];
	$.each(obj, function(i, o) {
		var $o = $(o);
		v.push({ value: $o.attr('data'), text: $o.text() });
	});
	return v;
}

genLocSelect = function (options) {
	var $this = options.div,
		$input = options.input,
		maxlength = options.maxlength,
		draggable = options.draggable,
		afterOK = options.afterOK,
		callback = options.callback,
		beforeSelect = options.beforeSelect,
		beforeUnselect = options.beforeUnselect,
		beforeClose = options.beforeClose,
		afterClosed = options.afterClosed;

	$.ajax({
		url: '/site/areaselect',
		success: function (data) {
			var $content = $(data),
				$all = $content.find('.js-jobLoc-all'),
				$hotCity = $content.find('.js-jobLoc-hotCity'),
				$city = $content.find('.js-jobLoc-city'),
				$pCity = $content.find('.js-jobLoc-pCity'),
				$provinces = $content.find('.js-jobLoc-province'),
				$cities = $all.add($hotCity).add($city).add($pCity);

			$hotCity.each(function () {
				var $hotCity = $(this);

				$pCity.each(function () {
					var $p = $(this);

					if ($hotCity.attr('data') == $p.attr('data')) {
						$hotCity.attr('data-parent', $p.attr('data-parent'));
					}
				});
			});

			var tabs = {};
			$provinces.each(function () {
				var $province = $(this),
					$con;

				$pCity.each(function () {
					var $p = $(this);

					if ($p.attr('data') == $province.attr('data')) {
						$con = $p.parent().parent();
						return false;
					}
				});

				tabs[$province.attr('data')] = {
					title: $province.text(),
					content: $con
				}
			}).on('click', function (e) {
				e.stopPropagation();
				var $o = $(this);

				if (!$o.hasClass('js-dataPicker-disabled')) {
					$this.selectr('switchTab', $(this).attr('data'));
				}
			});

			$this.selectr({
				type: 'dialog',
				input: $input,
				dialog: {
					title: '选择地点',
					draggable: draggable,
					maxLength: {
						max: maxlength,
						text: '最多选择%n项'
					},
					content: {
						'0': {
							title: '全部',
							content: $content.find('.js-jobLoc-allLoc'),
							beforeSwitch: function () {
								$this.selectr('hideOtherTabs', '0');
							}
						}
					},

					items: $cities,
					parentItems: $provinces,
					idAttr: 'data',
					parentAttr: 'data-parent',
					beforeSelect: beforeSelect,
					beforeUnselect: beforeUnselect,
					beforeClose: beforeClose,
					afterClosed: afterClosed
				}
			}).selectr('addTab', tabs)
			.selectr('switchTab', '0');
			//.selectr('dialogOpen');

			if ($.isFunction(callback)) {
				callback();
			}
		}
	});
}

genJobSelect = function (options) {
	/*options = {
		div: $this,
		input: $input,
		maxlength: 1,
		afterOK: function() {},
		callback: function() {}
	}*/

	var $this = options.div,
		$input = options.input,
		maxlength = options.maxlength,
		afterOK = options.afterOK,
		callback = options.callback,
		draggable = options.draggable,
		beforeClose = options.beforeClose,
		afterClosed = options.afterClosed;

	$.ajax({
		url: '/site/areaselect',
		success: function (data) {
			var $content = $(data).find('#js-function-dialog'),
				$parentsWrap = $content.find('.js-function-item-wrap'),
				$parents = $parentsWrap.find('.js-function-item'),
				$children = $content.find('.js-function-subitem');

			var tabs = {};
			$parents.each(function () {
				var $parent = $(this),
					$con;

				$children.each(function () {
					var $child = $(this);

					if ($child.attr('data-parent') == $parent.attr('data')) {
						$con = $child.parent().parent();
						return false;
					}
				});

				tabs[$parent.attr('data')] = {
					title: $parent.text(),
					content: $con
				}
			}).on('click', function (e) {
				e.stopPropagation();
				var $o = $(this);

				if (!$o.hasClass('js-dataPicker-disabled')) {
					$this.selectr('switchTab', $(this).attr('data'));
				}
			});

			$this.selectr({
					type: 'dialog',
					input: $input,
					dialog: {
						title: '选择职能信息',
						draggable: draggable,
						maxLength: {
							max: maxlength,
							text: '最多选择%n项'
						},
						content: {
							'0': {
								title: '全部',
								content: $parentsWrap,
								beforeSwitch: function () {
									$this.selectr('hideOtherTabs', '0');
								}
							}
						},
						items: $children,
						parentItems: $parents,
						idAttr: 'data',
						parentAttr: 'data-parent',
						beforeClose: beforeClose,
						afterClosed: afterClosed,
						afterOK: afterOK
					}
				}).selectr('addTab', tabs)
				.selectr('switchTab', '0');

			if ($.isFunction(callback)) {
				callback();
			}
		}
	});
}