/*selectr Plugin*/
$(function () {
	$.fn.selectr = function () {
		var method = arguments[0];

		if (methods[method]) {
			method = methods[method];
			arguments = Array.prototype.slice.call(arguments, 1);
		} else if ($.type(method) == 'object' || !method) {
			method = methods.init;
		} else {
			$.error('Method ' + method + ' does not exitst on jQuery.selectr!');
			return this;
		}

		return method.apply(this, arguments);
	}

	var methods = {
		init: function (options) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('selectr');

				if ($.type(settings) == 'undefined') {
					$this.addClass('PLG-sel-wrapper');

					var defaults = {
							type: undefined, //'dialog' or 'pull-down',
							input: undefined,
							dialog: {
								title: undefined, //dialog title
								draggable: false,
								maxLength: {
									max: 1,
									text: '%n'
								},
								content: undefined, //$obj or { ID: { title:'', content: $obj } }
								items: undefined, //$items
								parentItems: undefined, //$parentItems
								idAttr: undefined, //Attribute name
								parentAttr: undefined, //Attribute name
								beforeSelect: function () {},
								beforeUnselect: function () {},
								beforeClose: function() {},
								afterClosed: function() {},
								afterOK: function() {}
							},
							'pull-down': {

							}
						},
						_options = {
							$list: $('<div class="PLG-sel-list">').prependTo($this),
							//dialog
							$maxlength: undefined,
							$selected: undefined,
							$warning: undefined,
							$dialog: undefined,
							$tab: undefined
						};

					settings = $.extend(true, {}, defaults, options, _options);

					if (settings.type == 'dialog') {
						var dialog = settings.dialog,
							$headerWrapper = $('<div>', {'class': 'PLG-sel-header-wrapper'}),
							maxlengthText = dialog.maxLength.text.replace(/%n/, dialog.maxLength.max);

						_options.$maxlength = $('<span>', {
							'class': 'PLG-sel-maxlength',
							text: maxlengthText
						}).appendTo($headerWrapper);
						_options.$selected = $('<div class="PLG-sel-selected">').appendTo($headerWrapper);
						_options.$warning = $('<div>', {
							'class': 'PLG-sel-warning',
							text: maxlengthText
						}).appendTo($headerWrapper);
						_options.$dialog = $('<div class="PLG-sel-dialog">').appendTo('body');

						if (dialog.content.length === undefined) {
							_options.$tab = $('<div class="PLG-sel-tab">');
							dialog.content = _options.$tab.tab({
								tabs: dialog.content
							});
						}

						settings = $.extend({}, settings, _options);
						$this.data('selectr', settings);

						//dataPicker
						settings.$list.dataPicker({
							$items: dialog.items,
							$parents: dialog.parentItems,
							$selected: _options.$selected,
							$warning: _options.$warning,
							idRef: dialog.idAttr,
							parentRef: dialog.parentAttr,
							maxLength: dialog.maxLength.max,
							beforeSelect: dialog.beforeSelect,
							beforeUnselect: dialog.beforeUnselect
						});

						_options.$list.insertValue({
							$wrapper: _options.$list,
							$input: settings.input,
							value: undefined
						});

						_options.$dialog.dialogBox({
							title: dialog.title,
							draggable: dialog.draggable,
							content: $headerWrapper.add(dialog.content),
							beforeClose: dialog.beforeClose,
							afterClosed: dialog.afterClosed,
							ok: {
								text: '确认',
								cb: function () {
									var value = _options.$list.dataPicker('getSelectedValue'),
										_value = [];

									_options.$list.insertValue('update', value);
									
									$.each(value, function(i, v) {
										_value.push(i);
									});
									dialog.afterOK(_value);
								}
							},
							cancel: {
								text: '取消'
							}
						});
					}
					settings = $.extend({}, settings, _options);
					$this.data('selectr', settings);
				}
			});
		},
		//增加tab, 参数：tab结构(参考defaults.dialog.content)
		addTab: function (tabs) {
			var $this = $(this),
				settings = $this.data('selectr');

			settings.$tab.tab('add', tabs);
			return $this;
		},
		//隐藏其他tab, 参数：item id(data)
		hideOtherTabs: function (Id) {
			var $this = $(this),
				settings = $this.data('selectr');

			settings.$tab.tab('hideOthers', Id);
			return $this;
		},
		//切换tab, 参数：item id(data)
		switchTab: function (Id) {
			var $this = $(this),
				settings = $this.data('selectr');

			settings.$tab.tab('switchTab', Id);
			return $this;
		},
		//启用所有item
		enableAllItems: function () {
			var $this = $(this),
				settings = $this.data('selectr');

			settings.$list.dataPicker('enableAllItems');
			return $this;
		},
		//禁用所有item
		disableAllItems: function () {
			var $this = $(this),
				settings = $this.data('selectr');

			settings.$list.dataPicker('disableAllItems');
			return $this;
		},
		//启用item, 参数：item id(data)
		enableItem: function (Id) {
			var $this = $(this),
				settings = $this.data('selectr');

			settings.$list.dataPicker('enableItem', Id);
			return $this;
		},
		//打开弹窗
		dialogOpen: function () {
			var $this = $(this),
				settings = $this.data('selectr');

			settings.$list.dataPicker('unselectAll');

			if (settings.input.val()) {
				$.each(settings.input.val().split(','), function (i, Id) {
					settings.$list.dataPicker('select', Id);
				});
			}

			settings.$dialog.dialogBox('open');
			return $this;
		},
		//取消所有选择
		unselectAll: function () {
			var $this = $(this),
				settings = $this.data('selectr');

			settings.$list.dataPicker('unselectAll');
			return $this;
		},
		//选择item, 参数：item ID(data)
		select: function (Id) {
			var $this = $(this),
				settings = $this.data('selectr');

			settings.$list.dataPicker('select', Id);
			return $this;
		},
		//参数：item ID(data)
		addValue: function(value) {
			var $this = $(this),
				settings = $this.data('selectr'),
				val = {};

			if ($.type(value) == 'array') {
				$.each(value, function(i, v) {
					$.extend(val, settings.$list.dataPicker('getValue', v.toString()));
				});
				settings.$list.insertValue('update', val);
			} else {
				settings.$list.insertValue('update', settings.$list.dataPicker('getValue', value.toString()));
			}
			return $this;
		},
		clearValue: function() {
			var $this = $(this),
				settings = $this.data('selectr');

			settings.$list.insertValue('clear');
			return $this;
		},
		getParentValue: function(value) {
			var $this = $(this),
				settings = $this.data('selectr'),
				pVal = [];

			if ($.type(value) == 'array') {
				$.each(value, function(i, val) {
					var v = settings.$list.dataPicker('getParentValue', val.toString()),
						exist = false;

					$.each(pVal, function(i, pV) {
						if (pV == v) {
							exist = true;
						}
					});
					
					if (!exist) {
						pVal.push(v);
					}
				});
			} else {
				pVal.push(settings.$list.dataPicker('getParentValue', value.toString()));
			}
			return pVal;
		}
	}
});