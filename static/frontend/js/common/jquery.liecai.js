$.liecai = $.liecai || {};

$.widget("liecai.dropmenu", {
	version: "1.0.1",
	options: {
		mode: 'click', 	//click/hover
		data: undefined,	//[{text:'', value:'', icon:''}]
		icon: undefined,
		placeholder: undefined,
		onClick: function() {}
	},
	_create: function() {
		this._draw();
	},
	_init: function() {
		this._bindEvents();
	},
	_draw: function() {
		this._drawButton();
		this._drawMenu();
		this._drawMenuItems();
	},
	_drawButton: function() {
		var opts = this.options;

		this.button = $('<span>', {
			"class": 'PLG-dropmenu-button',
			tabIndex: 0
		})
		.insertAfter(this.element);

		this.buttonText = $('<span>', {
			"class": 'PLG-dropmenu-button-text',
			text: opts.placeholder
		})
		.prependTo(this.button);

		if (opts.icon) {
			this.buttonIcon = $('<span>', {
				"class": 'PLG-dropmenu-button-icon'
			})
			.addClass(opts.icon)
			.appendTo(this.button);
		}
	},
	_drawMenu: function() {
		this.menu = $('<ul>', {
			"class": 'PLG-dropmenu-menu'
		});

		this._hideMenu();
	},
	_drawMenuItems: function() {
		var that = this;

		$.each(this.options.data, function(i, d) {
			var item = $('<li>', {
				"class": 'PLG-dropmenu-menu-item',
				"dropmenu-value": d.value,
				"dropmenu-id": i,
				text: d.text
			}).appendTo(that.menu);
			
			if (d.icon) {
				$('<span>', {
					"class": 'PLG-dropmenu-menu-item-icon'
				})
				.addClass(d.icon)
				.appendTo(item);
			}
		});
	},
	_refresh: function() {
		this._refreshButton();
		this._refreshMenu();
		this._drawMenuItems();
		this._bindEvents();
	},
	_refreshButton: function() {
		this.button.empty().removeAttr('dropmenu-value');
	},
	_refreshMenu: function() {
		this.menu.empty();
	},
	_switchMenu: function() {
		(this.expanded)? this._hideMenu() : this._showMenu();
	},
	_showMenu: function() {
		this.menu.insertAfter(this.button);
		this._setMenuPosition();
		this.menu.show();
		this.expanded = true;
	},
	_hideMenu: function() {
		if (this.activeItem === true) {
			return;
		}
		this.menu.appendTo('body').hide();
		this.expanded = false;
	},
	_setMenuPosition: function() {
		var x = this.button.offset();
		this.menu.css({
			top: x.top + this.button.outerHeight(),
			left: x.left
		});
	},
	_bindEvents: function() {
		var that = this,
			items = this.menu.children();

		this.button.on('click' + this.eventNamespace, function() { that._switchMenu(); })
			.on('blur' + this.eventNamespace, function() { that._hideMenu(); })
			.on('mouseover' + this.eventNamespace + ' mouseout' + this.eventNamespace, function(e) {
			if (e.type == 'mouseover') {
				$(this).addClass('PLG-dropmenu-active');
			} else if (e.type == 'mouseout') {
				$(this).removeClass('PLG-dropmenu-active');
			}
		});

		items.on('mouseover' + this.eventNamespace + ' mouseout' + this.eventNamespace, function(e) {
			if (e.type == 'mouseover') {
				that.activeItem = true;
				$(this).addClass('PLG-dropmenu-active');
			} else if (e.type == 'mouseout') {
				that.activeItem = false;
				$(this).removeClass('PLG-dropmenu-active');
			}
		}).on('click' + this.eventNamespace, function() {
			var $this = $(this);

			that.value = $this.attr('dropmenu-value');
			that.buttonText.text($this.text()).addClass('PLG-dropmenu-selected');
			that.activeItem = false;
			that._hideMenu();
			that.options.onClick(that.value);
		});
	},
	select: function(v) {
		var that = this;

		$.each(that.menu.children(), function() {
			var $item = $(this);
			if ($item.attr('dropmenu-value') == v) {
				$item.click();
			}
		});
	}
});