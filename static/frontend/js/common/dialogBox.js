/*DialogBox plugin*/
$(function () {
	$.fn.dialogBox = function () {
		var method = arguments[0];

		if (methods[method]) {
			method = methods[method];
			arguments = Array.prototype.slice.call(arguments, 1);
		} else if (typeof (method) == 'object' || !method) {
			method = methods.init;
		} else {
			$.error('Method ' + method + ' does not exitst on jQuery.dialogBox!');
			return this;
		}

		return method.apply(this, arguments);
	}

	var methods = {
		init: function (options) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dialogBox');

				if (typeof (settings) == 'undefined') {
					var defaults = {
							title: undefined,
							draggable: false,
							resizable: false,
							content: undefined,
							ok: undefined, //{ text: '确定', cb: function(){} },
							cancel: undefined, //{ text: '取消', cb: function(){} },
							closeBtn: true,
							beforeOpen: function () {},
							afterOpened: function () {},
							beforeClose: function() {},
							afterClosed: function() {}
						},
						_options = {
							$modal: $('<div>'),
							$wrapper: $('<div>'),
							$container: $('<div>'),
							$title: $('<div>'),
							$content: $('<div class="PLG-dialogBox-content">'),
							$okBtn: $('<div>'),
							$cancelBtn: $('<div>')
						}

					settings = $.extend(true, {}, defaults, options);
					$this.data('dialogBox', settings);

					//Modal
					_options.$modal.addClass('PLG-dialogBox-modal').appendTo($this);

					//Wrapper
					_options.$wrapper.addClass('PLG-dialogBox-wrapper').appendTo($this);

					//Box
					_options.$container.addClass('PLG-dialogBox-container').appendTo(_options.$wrapper);

					//Title wrapper
					var $titleWrap = $('<div>', {
						'class': 'PLG-dialogBox-title-wrapper'
					}).appendTo(_options.$container);

					//Title
					_options.$title.addClass('PLG-dialogBox-title').text(settings.title).appendTo($titleWrap);

					//Close button
					if (settings.closeBtn === true) {
						$('<div>', {
							'class': 'PLG-dialogBox-btn-close',
							click: function (e) {
								e.stopPropagation();

								if (settings.cancel && $.isFunction(settings.cancel.cb)) {
									settings.cancel.cb();
								}
								methods.close.call($this);
							}
						}).appendTo($titleWrap);
					}

					//Content
					_options.$content.appendTo(_options.$container);

					//Footer
					var $footer = $('<div>', {
						'class': 'PLG-dialogBox-footer'
					}).appendTo(_options.$container);

					//Footer button wrappper
					var $btnWrap = $('<div>', {
						'class': 'PLG-dialogBox-footer-btn-wrapper'
					}).appendTo($footer);

					//OK button
					if ($.type(settings.ok) != 'undefined') {
						_options.$okBtn.addClass('PLG-dialogBox-btn-ok')
							.on('click', function (e) {
								e.stopPropagation();

								if ($(this).hasClass('PLG-dialogBox-btn-disabled')) {
									return false;
								}

								var close = true;
								if ($.isFunction(settings.ok.cb)) {
									close = settings.ok.cb();
								}

								if (close !== false) {
									methods.close.call($this);
								}
							})
							.append($('<span>', {
								text: settings.ok.text
							}))
							.appendTo($btnWrap);
					}
					//Cancel button
					if ($.type(settings.cancel) != 'undefined') {
						_options.$cancelBtn.addClass('PLG-dialogBox-btn-cancel')
							.on('click', function (e) {
								e.stopPropagation();

								if ($.isFunction(settings.cancel.cb)) {
									settings.cancel.cb();
								}
								methods.close.call($this);
							})
							.append($('<span>', {
								text: settings.cancel.text
							}))
							.appendTo($btnWrap)
					}

					//Draggable
					if (settings.draggable === true) {
						_options.$container.draggable({
							handle: $titleWrap
						});
					}
					if (settings.resizable === true) {
						_options.$container.resizable({
							handles: "se"
						});
					}

					settings = $.extend({}, settings, _options);
					$this.data('dialogBox', settings);

					//Insert content
					methods.content.call($this, settings.content);
				} else {
					settings = $.extend({}, settings, options);
					$this.data('dialogBox', settings);
				}
			});
		},
		destroy: function () {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dialogBox');

				settings.$modal.remove();
				settings.$wrapper.remove();
				$this.removeData('dialogBox');
			});
		},
		open: function () {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dialogBox');

				settings.beforeOpen.call($this);
				settings.$modal.show();
				settings.$wrapper.show();
				settings.afterOpened.call($this);
			});
		},
		close: function () {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dialogBox');
				
				settings.beforeClose.call($this);
				settings.$modal.hide();
				settings.$wrapper.hide();
				settings.afterClosed.call($this);
			});
		},
		content: function (content) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dialogBox');

				settings.$content.empty().append(content);
				settings.content = content;
				$this.data('dialogBox', settings);
			});
		},
		//参数：ms(毫秒), 经过n毫秒后启用
		disableOKBtn: function (ms) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dialogBox');

				settings.$okBtn.addClass('PLG-dialogBox-btn-disabled');
				if ($.type(ms) == 'number') {
					setTimeout(function(){
						settings.$okBtn.removeClass('PLG-dialogBox-btn-disabled');
					}, ms);
				}
			});
		},
		title: function(title) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dialogBox');

				settings.$title.text(title);
			});
		}
	}
});
/*DialogBox plugin End*/