/* Tabs Plugin */
$(function () {
	$.fn.tab = function () {
		var method = arguments[0];

		if (methods[method]) {
			method = methods[method];
			arguments = Array.prototype.slice.call(arguments, 1);
		} else if (typeof (method) == 'object' || !method) {
			method = methods.init;
		} else {
			$.error('Method ' + method + ' does not exitst on jQuery.Tabs!');
			return this;
		}

		return method.apply(this, arguments);
	}

	var methods = {
		init: function (options) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('tab');

				if (typeof (settings) == 'undefined') {
					var defaults = {
							tabs: {}, //id: {title:, titleClass:,content:, beforeSwitch:function(){}, afterSwitch:function(){}}
							active: undefined //id
						},
						_options = {
							tabList: {}, //{$title:,$content:,active:}
							$titleWrap: $('<ul>'),
							$container: $('<div class="PLG-tab-container">')
						}

					settings = $.extend({}, defaults, options);

					//Tab Title
					_options.$titleWrap.addClass('PLG-tab-title-wrap').appendTo($this);

					//Content
					_options.$container.appendTo($this);

					settings = $.extend({}, settings, _options);
					$this.data('tab', settings);

					//Create tabs
					methods.add.call($this, settings.tabs);
					if (typeof (settings.active) != 'undefined') {
						methods.switchTab.call($this, settings.active);
					}
				} else {
					settings = $.extend({}, settings, options);
					$this.data('tab', settings);
				}
			});
		},
		add: function (tabs) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('tab'),
					tabOpts = settings.tabs,
					tabList = settings.tabList,
					$titleWrap = settings.$titleWrap;

				$.each(tabs, function (Id, tab) {
					//if created, cancel
					if (typeof (tabList[Id]) != 'undefined') {
						methods.switchTab.call($this, Id);
						return true;
					}

					var $title = $('<li>', {
							'class': 'PLG-tabs-title',
							click: function (e) {
								$('input[name=group_type]').val(Id);
								e.stopPropagation();
								methods.switchTab.call($this, Id);
							}
						}).attr('tabId', Id)
						.appendTo($titleWrap);
					
						$title.append($('<span>', {
							text: tab.title
						})).append($('<div>'));

					if (typeof (tab.titleClass) != 'undefined') {
						$title.addClass(tab.titleClass);
					}

					var $content = $('<div>')
						.append(tab.content)
						.attr('tabId', Id)
						.appendTo(settings.$container)
						.hide();

					tabList[Id] = {
						$title: $title,
						$content: $content
					};
					tabOpts[Id] = tab;
				});

				settings = $.extend(true, {}, settings, {
					tabs: tabOpts,
					tabList: tabList
				});

				$this.data('tab', settings);
			});
		},
		switchTab: function (Id) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('tab'),
					tabOpt = settings.tabs[Id],
					tabList = settings.tabList;

				if ($.type(tabOpt) == 'undefined') {
					$.error('Error: [jQuery.Tab][switchTab] Id does not exitst !');
					return false;
				}

				if ($.isFunction(tabOpt.beforeSwitch)) {
					tabOpt.beforeSwitch(Id);
				}

				if ($.type(settings.active) != 'undefined') {
					tabList[settings.active].$title.removeClass('PLG-tabs-title-active');
					tabList[settings.active].$content.hide();
				}

				tabList[Id].$title.addClass('PLG-tabs-title-active');
				tabList[Id].$title.show();
				tabList[Id].$content.show();

				settings.active = Id;
				$this.data('tab', settings);

				if ($.isFunction(tabOpt.afterSwitch)) {
					tabOpt.afterSwitch(Id);
				}
			});
		},
		hide: function (Id) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('tab'),
					tabList = settings.tabList;

				tabList[Id].$title.removeClass('PLG-tabs-title-active').hide();

				if (settings.active == Id) {
					tabList[Id].$content.hide();
					settings.active = undefined;
				}
				$this.data('tab', settings);
			});
		},
		hideOthers: function (Id) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('tab'),
					tabList = settings.tabList;

				$.each(tabList, function (tabId, tab) {
					if (Id != tabId) {
						tab.$title.removeClass('PLG-tabs-title-active').hide();
						if (settings.active == tabId) {
							tab.$content.hide();
							settings.active = undefined;
						}
					}
				});
				$this.data('tab', settings);
			});
		}
	};
});