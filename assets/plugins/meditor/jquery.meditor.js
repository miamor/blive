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
				class: 'meditor-container'
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
						containerDiv.find('.meditor-link-thumbbox').html('<a class="close-thumbbox right" onclick="$(\'.meditor-link-thumbbox\').slideUp(200, function () { $(\'.meditor-link-thumbbox\').html(\'\') })"><span class="fa fa-times"></span></a> <input type="hidden" value="' + link + '"/><div class="thumbbox"><a href="' + link + '"><img class="left thumb-photo hide" src="' + previewImg + '"/> ' + newLink + '</a></div>');
						$.get(newLink, function (data, status) {
							previewImg = data.split(/<img src=|\/>/)[1];
//							alert(previewImg);
							if (previewImg) containerDiv.find('.meditor-link-thumbbox .thumb-photo').show().attr('src', previewImg);
						});
					}, 300)
				}
			});
		})
	}
}(jQuery));
