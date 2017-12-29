/* Insert Value Plugin */
$(function () {
	$.fn.insertValue = function () {
		var method = arguments[0];

		if (methods[method]) {
			method = methods[method];
			arguments = Array.prototype.slice.call(arguments, 1);
		} else if (typeof (method) == 'object' || !method) {
			method = methods.init;
		} else {
			$.error('Method ' + method + ' does not exitst on jQuery.insertValue!');
			return this;
		}

		return method.apply(this, arguments);
	}

	var methods = {
		init: function (options) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('insertValue');

				if (typeof (settings) == 'undefined') {
					var defaults = {
							$wrapper: undefined,
							$input: undefined,
							value: {} //{value: 'text'}
						},
						_options = {
							selected: {}
						};

					settings = $.extend(true, {}, defaults, options, _options);
					$this.data('insertValue', settings);

					methods.update.call($this, settings.value);
				} else {
					settings = $.extend({}, settings, options);
					$this.data('insertValue', settings);

					methods.update.call($this, settings.value);
				}
			});
		},
		remove: function (value) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('insertValue'),
					v = [];
				
				$.each(settings.selected, function(val, $icon) {
					if (value == val) {
						$icon.remove();
						delete settings.selected[val];
					} else {
						v.push(val);
					}
				});
				
				settings.$input.val(v.join(','));
				$this.data('insertValue', settings);
			});
		},
		update: function (value) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('insertValue'),
					v = [];

				settings.$wrapper.empty();
				settings.$input.val('');
				settings.selected = {};

				$.each(value, function (val, text) {
					var $icon = $('<span>', {
						'class': "PLG-insertValue-value",
						text: text
					}).on('click', function(e) {
						e.stopPropagation();
						methods.remove.call($this, val);
					});

					$('<img>', {
						src: '/static/frontend/img/sousuo/guanbi.jpg'
					}).on('click', function (e) {
						e.stopPropagation();
						methods.remove.call($this, val);
					}).appendTo($icon);

					$icon.appendTo(settings.$wrapper);
					
					settings.selected[val] = $icon;
					v.push(val);
				});

				settings.$input.val(v.join(','));

				$this.data('insertValue', settings);
			});
		},
		clear: function() {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('insertValue');
				
				settings.$wrapper.empty();
				settings.$input.val('');
				settings.selected = {};
				$this.data('insertValue', settings);
			});
		}
	}
});