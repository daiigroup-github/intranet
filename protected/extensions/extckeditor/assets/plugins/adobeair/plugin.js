﻿/*
 Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */

		(function() {
			var a = ['click', 'keydown', 'mousedown', 'keypress', 'mouseover', 'mouseout'];
			function b(c) {
				var d = c.getElementsByTag('*'), e = d.count(), f;
				for (var g = 0; g < e; g++) {
					f = d.getItem(g);
					(function(h) {
						for (var i = 0; i < a.length; i++)
							(function(j) {
								var k = h.getAttribute('on' + j);
								if (h.hasAttribute('on' + j)) {
									h.removeAttribute('on' + j);
									h.on(j, function(l) {
										var m = /(return\s*)?CKEDITOR\.tools\.callFunction\(([^)]+)\)/.exec(k), n = m && m[1], o = m && m[2].split(','), p = /return false;/.test(k);
										if (o) {
											var q = o.length, r;
											for (var s = 0; s < q; s++) {
												o[s] = r = CKEDITOR.tools.trim(o[s]);
												var t = r.match(/^(["'])([^"']*?)\1$/);
												if (t) {
													o[s] = t[2];
													continue;
												}
												if (r.match(/\d+/)) {
													o[s] = parseInt(r, 10);
													continue;
												}
												switch (r) {
													case 'this':
														o[s] = h.$;
														break;
													case 'event':
														o[s] = l.data.$;
														break;
													case 'null':
														o[s] = null;
														break;
												}
											}
											var u = CKEDITOR.tools.callFunction.apply(window, o);
											if (n && u === false)
												p = 1;
										}
										if (p)
											l.data.preventDefault();
									});
								}
							})(a[i]);
					})(f);
				}
			}
			;
			CKEDITOR.plugins.add('adobeair', {init: function(c) {
					if (!CKEDITOR.env.air)
						return;
					c.addCss('body { padding: 8px }');
					c.on('uiReady', function() {
						b(c.container);
						if (c.sharedSpaces)
							for (var d in c.sharedSpaces)
								b(c.sharedSpaces[d]);
						c.on('elementsPathUpdate', function(e) {
							b(e.data.space);
						});
					});
					c.on('contentDom', function() {
						c.document.on('click', function(d) {
							d.data.preventDefault(true);
						});
					});
				}});
			CKEDITOR.ui.on('ready', function(c) {
				var d = c.data;
				if (d._.panel) {
					var e = d._.panel._.panel, f;
					(function() {
						if (!e.isLoaded) {
							setTimeout(arguments.callee, 30);
							return;
						}
						f = e._.holder;
						b(f);
					})();
				} else if (d instanceof CKEDITOR.dialog)
					b(d._.element);
			});
		})();
CKEDITOR.dom.document.prototype.write = CKEDITOR.tools.override(CKEDITOR.dom.document.prototype.write, function(a) {
	function b(c, d, e, f) {
		var g = c.append(d), h = CKEDITOR.htmlParser.fragment.fromHtml(e).children[0].attributes;
		h && g.setAttributes(h);
		f && g.append(c.getDocument().createText(f));
	}
	;
	return function(c, d) {
		if (this.getBody()) {
			var e = this, f = this.getHead();
			c = c.replace(/(<style[^>]*>)([\s\S]*?)<\/style>/gi, function(g, h, i) {
				b(f, 'style', h, i);
				return '';
			});
			c = c.replace(/<base\b[^>]*\/>/i, function(g) {
				b(f, 'base', g);
				return '';
			});
			c = c.replace(/<title>([\s\S]*)<\/title>/i, function(g, h) {
				e.$.title = h;
				return '';
			});
			c = c.replace(/<head>([\s\S]*)<\/head>/i, function(g) {
				var h = new CKEDITOR.dom.element('div', e);
				h.setHtml(g);
				h.moveChildren(f);
				return '';
			});
			c.replace(/(<body[^>]*>)([\s\S]*)(?=$|<\/body>)/i, function(g, h, i) {
				e.getBody().setHtml(i);
				var j = CKEDITOR.htmlParser.fragment.fromHtml(h).children[0].attributes;
				j && e.getBody().setAttributes(j);
			});
		} else
			a.apply(this, arguments);
	};
});
