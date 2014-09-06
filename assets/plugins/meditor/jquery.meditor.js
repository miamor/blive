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
			var editor = $('<div />', {
				class: 'meditor-iframe',
				contenteditable : true
			}).appendTo(containerDiv);
			var link_thumbbox = $("<div/>", {
				class: 'meditor-link-thumbbox hide'
			}).appendTo(containerDiv);
			$editorBody = containerDiv.find('.meditor-iframe');
			containerDiv.resizable({
				handles: 's, w',
				stop: function (event, ui) {
					var width = ui.size.width;
					var height = ui.size.height;
					containerDiv.find('.meditor-iframe').width(ui.size.width).height(ui.size.height)
				}
			});
			$editorBody.css('margin', '3px 8px').on("keyup", function () {
				var start = /\@/ig; // @ Match
				var word = /\@(\w+)/ig; //@abc Match
				var wordSpace = /\@.*(\s)/ig; //@abc def Match
				var content = $(this).text(); //Content Box Data
				var go = content.match(start); //Content Matching @
				var name = content.match(word); //Content Matching @abc
				var nameSpace = content.match(wordSpace); //Content Matching @abc def
				var dataString = 'key=' + name;
				if (go.length > 0) {
//					alert($(this).caret().start);
					topp = parseInt($this.offset().top) + 35;
					if (!containerDiv.find('.select-tag-users').length) containerDiv.append('<div class="select-tag-users" style="position: absolute; top: ' + topp + 'px"><div class="spinner"> <div></div> <div></div> <div></div> </div></div>');
					containerDiv.find('.select-tag-users').slideDown('show');
					containerDiv.find('.select-tag-users').html("Tag someone...");
					if (nameSpace != null) containerDiv.find('.select-tag-users').remove()
					else if (name.length > 0) {
						$.ajax({
							type: "POST",
							url: "./pages/friendList.php",
							data: dataString,
							cache: false,
							success: function(data) {
								containerDiv.find('.select-tag-users').html(data).show();
								containerDiv.find(".select-tag-users .one-fr-search").on("click", function() {
									ebody = containerDiv.find(".meditor-iframe");
									var username = $(this).attr('alt');
									var old = ebody.html();
									var content = old.replace(word, " "); //replacing @abc to (" ") space
									content = content.replace('<div></div>', " ");
									ebody.html(content + '<span class="tag-name" contenteditable="false">+' + username + ' </span><span>&nbsp;</span>');
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
						containerDiv.addClass('with-thumbbox').css('height', 200).find('.meditor-link-thumbbox').html('<div class="thumbbox"><a class="close-thumbbox right"><span class="fa fa-times"></span></a> <input type="hidden" name="thumb-link" value="' + link + '"/> <input type="hidden" name="thumb-link-title"/> <input type="hidden" name="thumb-link-img"/> <textarea class="hide non-sce" name="thumb-link-content"></textarea> <div class="left thumb-photo hide"></div> <div class="thumb-title"><a href="' + link + '"></a></div> <div class="thumb-link"><a href="' + link + '">' + newLink + '</a></div> <div class="thumb-content"><a href="' + link + '"></a></div></div>');
						$('.close-thumbbox').click(function () {
							$(this).closest('.meditor-container').removeClass('with-thumbbox').css('height', 120).find('.meditor-link-thumbbox').slideUp(200, function () {
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
