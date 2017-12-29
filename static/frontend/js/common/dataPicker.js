/*Data Picker Plugin*/
$(function () {
	$.fn.dataPicker = function () {
		var method = arguments[0];

		if (methods[method]) {
			method = methods[method];
			arguments = Array.prototype.slice.call(arguments, 1);
		} else if (typeof (method) == 'object' || !method) {
			method = methods.init;
		} else {
			$.error('Method ' + method + ' does not exitst on jQuery.dataPicker!');
			return this;
		}

		return method.apply(this, arguments);
	}

	var methods = {
		init: function (options) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dataPicker');

				if (typeof (settings) == 'undefined') {
					var defaults = {
							$items: undefined,
							$parents: undefined,
							$selected: undefined,
							$warning: undefined,

							idRef: undefined, //The attr name for id
							parentRef: undefined, //The attr name for parent id
							maxLength: 1,

							beforeSelect: function () {},
							afterSelect: function () {},
							beforeUnselect: function () {},
							afterUnselect: function () {}
						},
						_options = {
							selected: {},
							childInfo: {},
							disabled: {},
							$icon: $('<div>', {
								'class': 'js-dataPicker_selectedIcon PLG-dataPicker-selectedIcon'
							}).append($('<div>', {
								'class': 'PLG-dataPicker-selectedIcon-cancel'
							}))
						}

					settings = $.extend({}, defaults, options, _options);
					$this.data('dataPicker', settings);

					settings.$items.on('click', function (e) {
						e.stopPropagation();

						var $item = $(this),
							Id = $item.attr(settings.idRef),
							isSelected = (typeof (settings.selected[Id]) != 'undefined');

						if (isSelected) {
							methods.unselect.call($this, Id);
						} else {
							methods.select.call($this, Id);
						}
					});
					
					if ($.type(settings.$parents) != 'undefined') {
						settings.$parents.each(function() {
							var $parent = $(this);

							$('<label>', {
								'class': 'js-dataPicker-amount PLG-dataPicker-amount'
							}).insertAfter($parent);
						});
					}
				}
			});
		},
		select: function (Id) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dataPicker'),
					idRef = settings.idRef,
					parentRef = settings.parentRef,
					hasParent = ($.type(parentRef) != 'undefined');

				settings.beforeSelect(Id);

				if (typeof (settings.disabled[Id]) != 'undefined') {
					return false;
				} else if (settings.maxLength == 1) {
					methods.unselectAll.call($this);
				} else if (getJsonLength(settings.selected) == settings.maxLength) {
					methods.warning.call($this);
					return false;
				}

				var text,
					parentId;

				settings.$items.each(function () {
					var $item = $(this);

					if ($item.attr(idRef) == Id) {
						text = $item.text();
						
						if (hasParent) {
							parentId = $item.attr(parentRef);
						}
						$item.addClass('PLG-dataPicker-active');
					}
				});

				if (hasParent) {
					if ($.type(parentId) == 'undefined') {
						settings.$items.each(function () {
							var $item = $(this);

							if ($item.attr(parentRef) == Id) {
								methods.unselect.call($this, $item.attr(idRef));
								methods.disableItem.call($this, $item.attr(idRef));
							}
						});
					} else {
						settings.$parents.each(function(i, parent) {
							var $parent = $(parent);
							if ($parent.attr(idRef) == parentId) {
								var info = settings.childInfo[parentId];
								if (typeof(info) == 'undefined') {
									settings.childInfo[parentId] = {
										$parent: $parent,
										children: {}
									}
								}
								settings.childInfo[parentId].children[Id] = true;
							}
						});
					}
				}

				var $icon = settings.$icon.clone()
					.prepend('<span>'+text+'</span>')
					.appendTo(settings.$selected)
					.on('click', function (e) {
						e.stopPropagation();
						methods.unselect.call($this, Id);
					});
					
				settings.selected[Id] = $icon;
				settings.afterSelect(Id);

				$this.data('dataPicker', settings);
				
				methods.updateChildNum.call($this);
			});
		},
		unselect: function (Id, disableAll) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dataPicker'),
					idRef = settings.idRef,
					parentRef = settings.parentRef,
					hasParent = ($.type(parentRef) != 'undefined');

				if (typeof (settings.selected[Id]) == 'undefined') {
					return false;
				}

				settings.beforeUnselect(Id);

				var parentId;

				settings.$items.each(function () {
					var $item = $(this);

					if ($item.attr(idRef) == Id) {
						$item.removeClass('PLG-dataPicker-active');
						if (hasParent) {
							parentId = $item.attr(parentRef);
						}
					}
				});

				if (hasParent) {
					if (typeof (parentId) == 'undefined') {
						settings.$items.each(function () {
							var $item = $(this);

							if ($item.attr(parentRef) == Id) {
								methods.enableItem.call($this, $item.attr(idRef));
							}
						});
					} else {
						settings.$parents.each(function(i, parent) {
							var $parent = $(parent);
							if ($parent.attr(idRef) == parentId) {
								var info = settings.childInfo[parentId];
								delete settings.childInfo[parentId].children[Id];
							}
						});
					}
				}

				settings.selected[Id].remove();
				delete settings.selected[Id];

				settings.afterUnselect(Id);

				$this.data('dataPicker', settings);
				
				methods.updateChildNum.call($this);
			});
		},
		unselectAll: function() {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dataPicker');
				
				$.each(settings.selected, function(Id) {
					methods.unselect.call($this, Id);
				});
			});
		},
		updateChildNum: function() {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dataPicker');
				
				$.each(settings.childInfo, function(parentId, info) {
					var amounts = getJsonLength(info.children),
						$amount = info.$parent.siblings('.js-dataPicker-amount');
					
					$amount.text(amounts);
					(amounts > 0)? $amount.show() : $amount.hide();
				});
			});
		},
		disableItem: function (Id) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dataPicker');

				settings.$items.each(function () {
					var $item = $(this);

					if ($item.attr(settings.idRef) == Id) {
						$item.addClass('PLG-dataPicker-item-disabled');
						methods.unselect.call($this, Id);
						settings.disabled[Id] = true;
					}
				});
				$this.data('dataPicker', settings);
			});
		},
		disableAllItems: function () {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dataPicker');

				$.each(settings.selected, function (Id) {
					methods.unselect.call($this, Id, true);
				});
				
				settings.$items.addClass('PLG-dataPicker-item-disabled');
				settings.$parents.addClass('js-dataPicker-disabled PLG-dataPicker-item-disabled');

				settings.$items.each(function() {
					var $item = $(this);

					settings.disabled[$item.attr(settings.idRef)] = true;
				});
				$this.data('dataPicker', settings);
			});
		},
		enableItem: function (Id) {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dataPicker');

				settings.$items.each(function() {
					var $item = $(this);

					if ($item.attr(settings.idRef) == Id) {
						$item.removeClass('PLG-dataPicker-item-disabled');
						if (settings.disabled[Id] === true) {
							delete settings.disabled[Id];
						}
					}
				});
				$this.data('dataPicker', settings);
			});
		},
		enableAllItems: function () {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dataPicker');

				settings.$items.removeClass('PLG-dataPicker-item-disabled');
				settings.$parents.removeClass('js-dataPicker-disabled PLG-dataPicker-item-disabled');
				
				settings.$items.each(function() {
					var $item = $(this),
						Id = $item.attr(settings.idRef);
					
					if (settings.disabled[Id] === true) {
						delete settings.disabled[Id];
					}
				});
				$this.data('dataPicker', settings);
			});
		},
		warning: function () {
			return this.each(function () {
				var $this = $(this),
					settings = $this.data('dataPicker');

				if (!settings.$warning.hasClass('js-dataPicker-inWarning')) {
					settings.$warning.addClass('js-dataPicker-inWarning').fadeToggle(1000).delay(2000).fadeToggle(1000, function () {
						settings.$warning.removeClass('js-dataPicker-inWarning');
					});
				}
			});
		},
		getSelectedValue: function() {
			var v = {};

			$.each(this.data('dataPicker').selected, function(Id) {
				v[Id] = $(this).text();
			});
			return v;
		},
		getValue: function(Id) {
			var settings = this.data('dataPicker'),
				v = {};

			$.each(settings.$items, function(i, item) {
				var $item = $(item);

				if ($(item).attr(settings.idRef) == Id) {
					v[Id] = $item.text();
					return false;
				}
			});
			return v;
		},
		getParentValue: function(Id) {
			var settings = this.data('dataPicker'),
				parentId;

			$.each(settings.$items, function(i, item) {
				var $item = $(item);

				if ($item.attr(settings.idRef) == Id) {

					$.each(settings.$parents, function(i, parent) {
						var $parent = $(parent),
							pId = $parent.attr(settings.idRef);

						if ($item.attr(settings.parentRef) == pId) {
							parentId = pId;
							return false;
						}
					});
					return false;
				}
			});
			return parentId;
		}
	}
});