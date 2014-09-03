(function($) {
	$.fn.meditor = function (options) {
		var settings = $.extend({
			fonts: ["Arial", "Comic Sans MS", "Courier New", "Lato", "Monotype Corsiva", "Tahoma", "Times"]
		}, options);
		return this.each(function (e) {
			var $this = $(this).hide();
			var containerDiv = $("<div/>", {
				id: 'meditor' + e,
				class: 'meditor-container sceditor-container'
			});
			$this.after(containerDiv);
			if ($this.attr('name') != 'cmt-content') containerDiv.css('height', 120);
			var editor = $('<iframe class="meditor-iframe"/>', {
				frameborder: 0
			}).appendTo(containerDiv).get(0);
			var link_thumbbox = $("<div/>", {
				class: 'meditor-link-thumbbox hide'
			}).appendTo(containerDiv);
			editor.contentWindow.document.open();
			editor.contentWindow.document.close();
			editor.contentWindow.document.designMode = "on";
			$editorBody = containerDiv.find(".meditor-iframe").contents().find('body');
			containerDiv.resizable({
				handles: 's, w',
				stop: function (event, ui) {
					var width = ui.size.width;
					var height = ui.size.height;
					containerDiv.find('.meditor-iframe').width(ui.size.width).height(ui.size.height)
				}
			}).find(".meditor-iframe").contents().find("head").append('<link rel="stylesheet" href="' + PLUGINS + '/meditor/meditor.default.css"/>');
			$editorBody.css('margin', '-3px 6px').on("keyup", function () {
				var start = /\@/ig; // @ Match
				var word = /\@(\w+)/ig; //@abc Match
				var content = $(this).text(); //Content Box Data
				var go = content.match(start); //Content Matching @
				var name = content.match(word); //Content Matching @abc
				var dataString = 'key=' + name;
				if (go.length > 0) {
//					alert($(this).caret().start);
					topp = parseInt($this.offset().top) + 35;
					if (!containerDiv.find('.select-tag-users').length) containerDiv.append('<div class="select-tag-users" style="position: absolute; top: ' + topp + 'px"><div class="spinner"> <div></div> <div></div> <div></div> </div></div>');
					containerDiv.find('.select-tag-users').slideDown('show');
					containerDiv.find('.select-tag-users').html("Tag someone...");
					if (name.length > 0 && name.indexOf(' ') == -1) {
						$.ajax({
							type: "POST",
							url: "./pages/friendList.php",
							data: dataString,
							cache: false,
							success: function(data) {
								containerDiv.find('.select-tag-users').html(data).show();
								containerDiv.find(".select-tag-users .one-fr-search").on("click", function() {
									ebody = containerDiv.find(".meditor-iframe").contents().find('body');
									var username = $(this).attr('alt');
									var old = ebody.html();
									var content = old.replace(word, " "); //replacing @abc to (" ") space
									content = content.replace('<div></div>', " ");
									ebody.html(content + '<span class="tag-name" style="color:#fff;background:#ff6699;border-radius:3px;padding:0 3px 2px;display:inline;cursor:pointer" contenteditable="false">+' + username + ' </span><span>&nbsp;</span>');
									containerDiv.find('.select-tag-users').remove();
								});
							}
						});
					}
				}
			}).bind("paste", function (evt) {
				var text = evt.originalEvent.clipboardData.getData('text');
				newLink = findLink(text);
				if (newLink) {
					containerDiv.find('.meditor-link-thumbbox').show().html('<div class="spinner"><div></div> <div></div> <div></div></div>');
					setTimeout(function () {
						previewImg = 'preview.jpg';
						containerDiv.addClass('with-thumbbox').find('.meditor-link-thumbbox').html('<div class="thumbbox"><a class="close-thumbbox right"><span class="fa fa-times"></span></a> <input type="hidden" name="thumb-link" value="' + link + '"/> <input type="hidden" name="thumb-link-title"/> <input type="hidden" name="thumb-link-img"/> <textarea class="hide non-sce" name="thumb-link-content"></textarea> <div class="left thumb-photo hide"></div> <div class="thumb-title"><a href="' + link + '"></a></div> <div class="thumb-link"><a href="' + link + '">' + newLink + '</a></div> <div class="thumb-content"><a href="' + link + '"></a></div></div>');
						$('.close-thumbbox').click(function () {
							$(this).closest('.meditor-container').removeClass('with-thumbbox').find('.meditor-link-thumbbox').slideUp(200, function () {
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
