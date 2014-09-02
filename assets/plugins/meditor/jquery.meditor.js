(function($) {
	$.fn.meditor = function (options) {
		var settings = $.extend({
			width: "400px",
			height: "200px",
			fonts: ["Arial", "Comic Sans MS", "Courier New", "Lato", "Monotype Corsiva", "Tahoma", "Times"]
		}, options);
		return this.each(function (e) {
			var $this = $(this).hide();
			var containerDiv = $("<div/>", {
				id: 'meditor' + e,
				class: 'meditor-container sceditor-container'
			});
			$this.after(containerDiv);
			var editor = $('<iframe class="meditor-iframe"/>', {
				frameborder: 0
			}).appendTo(containerDiv).get(0);
			var link_thumbbox = $("<div/>", {
				class: 'meditor-link-thumbbox'
			}).appendTo(containerDiv);
			editor.contentWindow.document.open();
			editor.contentWindow.document.close();
			editor.contentWindow.document.designMode = "on";
			$editorBody = containerDiv.find(".meditor-iframe").contents().find('body');
			containerDiv.find(".meditor-iframe").contents().find("head").append('<link rel="stylesheet" href="' + PLUGINS + '/meditor/meditor.default.css"/>');
			$editorBody.html('<div></div>').bind("paste", function (evt) {
				var text = evt.originalEvent.clipboardData.getData('text');
				newLink = findLink(text);
				function findLink (text) {
					var exp = /.*((https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/i;
					text = text.replace(exp, "<a href=\"$1\">$1</a>");
					link = text.split(/<a href="|">/)[1];
					if (link) return link
					return null
				}
				if (newLink) {
					containerDiv.find('.meditor-link-thumbbox').show().html('<div class="spinner"><div></div> <div></div> <div></div></div>');
					setTimeout(function () {
						previewImg = 'preview.jpg';
						containerDiv.find('.meditor-link-thumbbox').html('<div class="thumbbox"><a class="close-thumbbox right"><span class="fa fa-times"></span></a> <input type="hidden" name="thumb-link" value="' + link + '"/> <input type="hidden" name="thumb-link-title"/> <input type="hidden" name="thumb-link-img"/> <textarea class="hide non-sce" name="thumb-link-content"></textarea> <div class="left thumb-photo hide"></div> <div class="thumb-title"><a href="' + link + '"></a></div> <div class="thumb-link"><a href="' + link + '">' + newLink + '</a></div> <div class="thumb-content"><a href="' + link + '"></a></div></div>');
						$('.close-thumbbox').click(function () {
							$(this).closest('.meditor-link-thumbbox').slideUp(200, function () {
								$(this).html('').find('.thumb-link').val('')
							})
						});
						$.ajax({
							url: newLink,
							success: function (data) {
								containerDiv.find('.meditor-link-thumbbox .thumb-photo').show().load(newLink + ' img:first', function () {
									$('[name="thumb-link-img"]').val($(this).find('img').attr('src'))
								});
								title = $(data).filter('title').text();
								containerDiv.find('.meditor-link-thumbbox .thumb-title a').html(title);
								$('[name="thumb-link-title"]').val(title);
								containerDiv.find('.meditor-link-thumbbox .thumb-content a').load(newLink + ' body > div:first', function () {
									$('[name="thumb-link-content"]').val($(this).text())
								});
							},
							error: function () {
								containerDiv.find('.meditor-link-thumbbox .thumb-photo').hide();
							}
						});
					}, 300)
				}
			});
		})
	}
}(jQuery));
