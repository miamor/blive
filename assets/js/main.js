var ASSETS = MAIN_URL + '/assets',
	IMG = ASSETS + '/img',
	CSS = ASSETS + '/css',
	JS = ASSETS + '/js',
	PLUGINS = ASSETS + '/plugins',
	path = window.location.href.split('#')[0];
var pl_page;
// MAIN_URL is set in /jquery/jquery-1.7.2.js

jQuery.fx.interval = 50;

var duration = 5000;
var interval;

function redirect(location) {
	window.location.href = location;
}

$.fn.digits = function(){ 
    return this.each(function(){ 
        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ") ); 
    })
}

function alert_tip (content) {
	$('body').append('<div class="alert-tip">' + content + ' <div class="close-alert-tip"></div></div>')
}

function checkChat () {
	setInterval(function () {
		$.ajax({
			url: MAIN_URL + '/pages/checkChat.php',
			type: 'post',
			datatype: 'json',
			success: function (data) {
				if (data != 0 && data != -1) {
					numChat = split('~', data)[1];
					$('.navbar-nav .chat-mes-count .icon-count').remove();
					$('.navbar-nav .chat-mes-count').prepend('<span class="badge badge-success icon-count">' + numChat + '</span>');
				} else $('.navbar-nav .chat-mes-count .icon-count').remove();
				if (data.indexOf('new') != -1) {
					alert('new');
				}
			}
		})
	}, 1000)
}

checkChat();

/*function fancyboxLoad () {
	$('img').each(function () {
		$(this).wrap('<a href="'+$(this).attr('src')+'" class="cboxElement"></a>').colorbox({
			rel : 'group4',
			transition : 'none',
			width : '75%',
			height : '75%',
			slideshow : true
		});
	});
	$(".colorbox-ajax").colorbox();
	$(".colorbox-youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
	$(".colorbox-vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
	$(".colorbox-iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	$(".colorbox-inline").colorbox({inline:true, width:"50%"});
	$('.non-retina').colorbox({rel:'group5', transition:'none'})
	$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
}
*/
function tab() {
//	tipsy();
	$('.tooltip').remove();
	$('.tab,.tabs').click(function () {
		var a = $(this).attr('id');
		$(this).closest('#m_tab').find('.tab-index,.tab-indexs').hide();
		$(this).closest('#m_tab').find('.' + a).show();
		$(this).closest('#m_tab').find('.tab,.tabs').removeClass('active');
		$(this).addClass('active')
	});
}
function pagination() {
	tab();
	$('.pagination').each(function () {
		$(this).find('a').click(function () {
			var url = $(this).attr('href');
				a = $(this).parents('.tab-index').attr('class').split('tab-index ')[1];
			if (url) {
				page = url.split('pages/')[1].split('.')[0];
				$(this).closest('.tab-index.'+a).html('<img src="' + IMG + '/loading6.gif"/>').load(url + ' .tab-index.'+a+' > span, .tab-index.'+a+' > div', function () {
					pagination();
				});
			}
			return false
		})
	})
}

function mtip(a, c, title, content) {
	$(".alert").length && $(".alert").remove();
	if (a && a.length) $(a).prepend('<div class="alerts alert-' + c + ' just-add"><a class="close" onclick="htip(\'just-add\')" data-dismiss="alert">\u00d7</a><strong>' + title + " </strong>" + content + "</div>");
	else $('body').append('<div class="alert alert-' + c + ' just-add"><a class="close" onclick="htip(\'just-add\')" data-dismiss="alert">\u00d7</a><strong>' + title + " </strong>" + content + "</div>");
	stip('just-add')
}
function htip(a) {
	var l = $('.' + a).attr('class');
	if (l.indexOf('alerts') > -1) {
		$("." + a).slideUp(function () {
			$("." + a).remove()
		})
	} else {
		$(".alert").animate({
			right: "-=500"
		}, 1E3, function () {
			$(".alert").remove()
		})
	}
}
function stip(d) {
    $("." + d).fadeIn(1E3);
    setTimeout("htip('" + d + "')", 5E3)
}

function smallBoard (id) {
//	alert(a.attr('class').split('sb-')[1]);
//	$('body').append('<div class="small-board-fixed"></div> <div class="small-board sb-'+id+'">Dis</div>');
	a = $('.sb-'+id);
	if (!a.prev('.small-board-fixed').length) a.before('<div class="small-board-fixed"></div>');
	$('.small-board').hide();
	a.closest('.sidebar-nicescroller').css('z-index', 999);
//	$('.nicescroll-rails').hide();
	a.fadeIn(150).prev('.small-board-fixed').show();
	if (!a.find('.sb-close').length) {
		a.wrapInner('<div class="sb-content"></div>').children('.sb-content').hide();
		a.prepend('<div class="spinner"> <div></div><div></div><div></div> </div>');
		a.prepend('<div class="sb-close" title="Close">x</div>');
	} else {
		$('.sb-content').hide();
		$('.spinner').show()
	}
	a.find('.sb-close').click(function () {
		a.fadeOut(250, function () {
			a.prev('.small-board-fixed').hide()
/*			a.closest('.sidebar-nicescroller').removeAttr('style');
			$('.nicescroll-rails').show();
*/		});
	});
	setTimeout(function () {
		a.children('.spinner').hide();
		a.children('.sb-content').fadeIn(200);
	}, 250)
}

var unavailableDates = ["08-07-2014", "28-05-2014"];
function unavailable (date) {
	dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
	if ($.inArray(dmy, unavailableDates) == -1) {
		return [true, ""];
	} else {
		return [false, "", "Unavailable"];
	}
}


function refreshScripts () {
//	tipsy();
//	fancyboxLoad();
	pl_page = $('.page-content').attr('data-p');
	pagination();
	flatApp();
//	$('.left-menu-column').show();
//	sce('content');
	$('.sb-open').click(function () {
		id = $(this).attr('id');
		smallBoard(id)
	});
	/** BEGIN NiCE SCROLLER **/
	if ($('.sidebar-nicescroller').not('.no-width').length > 0) {
		$(".sidebar-nicescroller").not('.no-width').niceScroll({
			cursorcolor: "#37bc9b",
			cursorborder: "0px solid rgba(255,255,255,.6)",
			cursorborderradius: "10px",
			cursorwidth: "5px"
		})
	}
	if ($('.sidebar-nicescroller.no-width').length > 0) {
		$(".sidebar-nicescroller.no-width").niceScroll({
			cursorcolor: "transparent",
			cursorborder: "0",
			cursorwidth: "0"
		});
	}
//	$(".sidebar-nicescroller").getNiceScroll().resize();
	/** END NiCE SCROLLER **/
	/** BEGIN OWL CAROUSEL **/
	if ($('#owl-carousel-single-1').length > 0) {
		$("#owl-carousel-single-1").owlCarousel({
		  navigation : true,
		  slideSpeed : 300,
		  paginationSpeed : 400,
		  singleItem:true,
		  navigationText : ["&lsaquo;","&rsaquo;"],
		  autoPlay : true,
		  stopOnHover : true,
		});
	}	
	var Owltime = 7;
	var $progressBar,
	  $bar, 
	  $elem, 
	  isPause, 
	  tick,
	  percentTime;
	 
	if ($('#owl-single-progress-bar').length > 0) {
		$("#owl-single-progress-bar").owlCarousel({
			slideSpeed : 500,
			paginationSpeed : 500,
			singleItem : true,
			afterInit : progressBar,
			afterMove : moved,
			startDragging : pauseOnDragging
		});
	}
 
	function progressBar (elem) {
		$elem = elem;
		buildProgressBar();
		start();
	}
	function buildProgressBar () {
		$progressBar = $("<div>",{
			id:"OwlprogressBar"
		});
		$bar = $("<div>",{
			id:"Owlbar"
		});
		$progressBar.append($bar).prependTo($elem);
	}
	function start () {
		percentTime = 0;
		isPause = false;
		tick = setInterval(interval, 10);
	}
	function interval () {
		if (isPause === false) {
			percentTime += 1 / Owltime;
			$bar.css({
				width: percentTime+"%"
			});
			if (percentTime >= 100) $elem.trigger('owl.next')
		}
	}
	function pauseOnDragging () {
		isPause = true
	}
	function moved () {
		clearTimeout(tick);
		start()
	}
	/** END OWL CAROUSEL **/
	$('a[href^="#!login"]').click(function () {
		$('#login_board').show().find('.board-content').load(MAIN_URL + '/pages/login.php');
		return false
	})
}

function scrollToContent (file, v) {
	if (v.length > 0) f_url = 'pages/' + file + '.php?' + v;
	else f_url = 'pages/' + file + '.php';
	$('#content').next('.loading-screen').remove();
	$('#content').hide().after('<div class="loading-screen"><div class="spinner"> <div></div><div></div><div></div> </div></div>');
	$.ajax({
		url: MAIN_URL + '/' + f_url,
		type: 'GET',
		success: function (data) {
			title = data.split(/<!-- | -->/)[1];
			display = data.split(/<!--{|}-->/)[1];
			if (title) document.title = title;
			if (display == 'board') displayBoard(data);
			else displayMain(data)
		},
		error: function (xhr) {
			setTimeout(function () {
				$('#content').html('This page does not exist or being under constructions or something\'s broken.');
			}, 100)
		}
	})
}

function loadFromUrl (url) {
	if (url.indexOf('#!') > 0) {
		if (url.split('#!')[1].length) {
			lo = location.hash.replace('#!', '');
			if (url.indexOf('?') > 0) {
				scrollToContent(lo.split('?')[0], lo.split('?')[1])
			} else scrollToContent(lo, '')
		} else scrollToContent('feed', '')
	} else if (url == MAIN_URL + '/') scrollToContent('feed', '');
}

function firstScroll () {
	loadFromUrl(window.location.href)
}

function displayBoard (data) {
	titlez = data.split(/<!--|-->/)[1];
	displayz = data.split(/<!--{|}-->/)[1];
	$('body').addClass('fixed');
	$('#content').show().next('.loading-screen').remove();
	$('.the-board-fixed').remove();
	if (!$('#content-board').length) $('body').append('<div class="the-board" id="content-board"></div>');
	$('#content-board').after('<div class="the-board-fixed"></div>').fadeIn(250).html('<div class="loading-screen"><div class="spinner"> <div></div><div></div><div></div> </div></div>');
	setTimeout(function () {
		$('#content-board').html(data).slideDown(100, function () {
			$(this).prepend('<a class="board-close" href="javascript:history.go(-1)"></a>');
			refreshScripts();
//			sce('content-board');
			if ($(this).find('.one-good-big').length) oneGoodBig('content-board')
		})
	}, 200)
}

function displayMain (data) {
	titlez = data.split(/<!--|-->/)[1];
	displayz = data.split(/<!--{|}-->/)[1];
	$('body').removeClass('fixed');
	$('#content-board').fadeOut(250, function () {
		$(this).next('.the-board-fixed').remove()
	});
	setTimeout(function () {
		$('#content').next('.loading-screen').remove();
//		$('#content').prev('.top-section').find('.toggle-form').html(titlez);
		$('#content').show().html(data).slideDown(100, function () {
			clearTimeout(interval);
			refreshScripts();
//			sce('content');
			if ($(this).find('.one-good-big').length) oneGoodBig('content')
		})
	}, 100)
}

function flatApp() {
//	$('.alerts, .alert').addClass('alert-square alert-bold-border');
	$('.tooltip').remove();
//	$('input[type="submit"], button, .button').not('[class*="btn "]').addClass('btn btn-info btn-perspective-hover');
	$('input[type="submit"], button, .button').not('[class*="btn "]').addClass('btn');
	$('input[type="reset"]').addClass('btn btn-default');
	$('[data-toggle="confirmation"]').confirmation();
	$('[data-toggle="confirmation-singleton"]').confirmation({singleton:true});
	$('[data-toggle="confirmation-popout"]').confirmation({popout: true});
	$(':checkbox').not('[data-toggle="switch"], .onoffswitch-checkbox').checkbox();
	$(':radio').radio();
	choosen();
	$('.tooltips').tooltip({
		selector: '*:not(".sceditor-dropdown img, #ui-datepicker-div a, #fancybox-buttons li a, #fancybox-buttons li, .fancybox-overlay li, .fancybox-overlay span, .fancybox-overlay div, .fancybox-overlay a")',
		container: "body"
	});
	$(".datepicker").datepicker({
		minDate: 0,
		dateFormat: 'dd-mm-yy',
		beforeShowDay: unavailable,
		onSelect: function(dateText, inst) {
			$(this).val(dateText);
			$(this).closest('.rb-content').find('.deadline-hidden').val(dateText);
		}
	});
	if ($('.btn-file').length > 0){
		$(document).on('change', '.btn-file :file', function() {
				"use strict";
				var input = $(this),
				numFiles = input.get(0).files ? input.get(0).files.length : 1,
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				input.trigger('fileselect', [numFiles, label]);
		});
		$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
			var input = $(this).parents('.input-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;
			if( input.length ) {
				input.val(log);
			} else {
				if (log) alert(log);
			}
		});
	}
}

function choosen() {
	"use strict";
	var configChosen = {
		'.chosen-select'           : {},
		'.chosen-select-deselect'  : {allow_single_deselect:true},
		'.chosen-select-no-single' : {disable_search_threshold:10},
		'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		'.chosen-select-width'     : {width:"100px"}
	}
	for (var selector in configChosen) {
		$(selector).chosen(configChosen[selector]);
	}
}

function findLink (text) {
	var exp = /.*((https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/i;
	text = text.replace(exp, "<a href=\"$1\">$1</a>");
	link = text.split(/<a href="|">/)[1];
	if (link) return link
	return null
}

function convertLink (text) {
	var exp = /(?:^|[^"'])((https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/i;
//	alert(text.match(exp));
	text = text.replace(exp, "<a href=\"$1\">$1</a>");
	link = text.split(/<a href="|">/)[1];
	return text
}

function chatForm () {
	$('form.chat-submit textarea').keydown(function (e) {
		if (e.keyCode == 13 && !e.shiftKey) {
			e.preventDefault();
			$('form.chat-submit').submit();
		}
	});
	$('form.chat-submit').submit(function () {
		id = $(this).attr('id');
		uid = id.split('form')[1];
		formData = $(this).serialize();
		$.ajax({
			url: MAIN_URL + '/pages/chat.php?u='+uid+'&act=send',
			type: 'POST',
			data: formData,
			datatype: 'json',
			success: function (data) {
				if (data && data != 'error') {
					$('form.chat-submit textarea').val('');
					$('.chat-content').html(data);
					$('.chat-submit#'+id+' input').val('');
				} else $('.chat-content').append('<div class="console error">Your message can\'t be sent.</div>');
			},
			error: function (xhr) {
				$('.chat-content').append('<div class="console error">Your message can\'t be sent.</div>');
			}
		});
		return false
	})
}
function chat (a) {
	chatForm();
//	a.find('.chat-content').scrollTop = 15000;
	a.find('.dropdown-toggle').click(function () {
		var menu = $(this).next('.dropdown-menu');
		menu.toggle();
		if (menu.is(':visible')) $(this).closest('li.dropdown').addClass('open');
		else $(this).closest('li.dropdown').removeClass('open');
	});
}


function cmtPost (id) {
	showLikeList(id);
	$('.the' + id).each(function () {
		if ($(this).find('.one-good-content').length) {
			newContent = convertLink($(this).find('.one-good-content').html());
			$(this).find('.one-good-content').html(newContent);
		} else if ($(this).find('.content.stt').length) {
			newContent = convertLink($(this).find('.content.stt').html());
			$(this).find('.content.stt').html(newContent);
		}
	});
/*	$('.the' + id).children('.cmt-post-form').children('textarea').sceditor({
			toolbar: '',
			emoticons: emoticonsList
	}).next('.sceditor-container').find('iframe').contents().bind("keydown", function (e) {
		if (e.keyCode == 13 && !e.shiftKey) {
			e.preventDefault();
			$('.the' + id).children('.cmt-post-form').submit();
		}
	});
*/	$('.the' + id).children('.normal-stt-tool').children('.cmt-post-form').children('textarea').meditor().next('.sceditor-container').find('.meditor-iframe').bind("keydown", function (e) {
		if (e.keyCode == 13 && !e.shiftKey) {
			e.preventDefault();
			$('.the' + id).children('.normal-stt-tool').children('.cmt-post-form').submit();
		}
	});
	$('.the' + id).children('.normal-stt-tool').children('.cmt-post-form').submit(function () {
		$form = $(this);
		page = $form.closest('.box-feed, .one-good, .one-good-big').attr('data-p');
//		id = $form.closest('.box-feed, .one-good, .one-good-big').attr('id');
		cmi = $form.attr('alt');
		$form.find('textarea').each(function () {
			val = $(this).next('.sceditor-container').find('.meditor-iframe').html();
			$(this).val(val);
		});
		formData = $form.serialize();
		if (cmi && cmi != null && cmi != '') url = MAIN_URL + '/pages/' + page + '.php?i=' + id + '&do=comment&cmt=' + cmi;
		else url = MAIN_URL + '/pages/' + page + '.php?i=' + id + '&do=comment';
//		alert(formData + url);
		$.ajax({
			url: url,
			type: 'post',
			data: formData,
			datatype: 'json',
			success: function (data) {
//				alert(data + url + formData);
				$form.find('.sceditor-container').find('.meditor-iframe').html('');
				$form.prev('.cmts-post').load(MAIN_URL + '/pages/' + page + '.php?i=' + id + ' .cmts-post > div', function () {
					ajaxSLikeCmt(id)
/*					$('.the' + id).find('.one-cmt').each(function () {
						ajaxSLikeCmtOne($(this).attr('id'), id)
					})
*/				})
			}
		});
		return false
	})
}

function votePost (id) {
	$('.the' + id + ' #share-post').click(function () {
		smallBoard('share-board')
	});
	$('.the' + id + ' .like-button#like-post').click(function () {
		$big = $(this).closest('.box-feed, .one-good, .one-good-big');
		bclas = $big.attr('class').split(' ')[0];
		page = $big.attr('data-p');
		act = $(this).attr('id').split('-')[0];
		url = MAIN_URL + '/pages/' + page + '.php?i=' + id;
		liketext = $big.find('#like-post').text();
		$.ajax({
			url: url + '&do=' + act,
			type: 'post',
			datatype: 'json',
			success: function (data) {
				if (liketext == 'Like') $('.the' + id).find('#like-post').text('Unlike');
				else if (liketext == 'Unlike') $('.the' + id).find('#like-post').text('Like');
				$big.find('.static-post').load(url + ' .' + bclas + '.the' + id + ' .static-post > div');
				$big.find('.nums').load(url + ' .' + bclas + '.the' + id + ' .nums > span');
			}
		});
		return false
	})
}

function ajaxSLikeCmtOne (i, id) {
//	showLikeList(i);
	$('.the' + id + ' .one-cmt.cmt-' + i).each(function () {
		newContent = convertLink($(this).find('.cmt-content').html());
		$(this).find('.cmt-content').html(newContent)
	});
	$('.the' + id + ' .one-cmt.cmt-' + i).find('.like-button#like-cmt').click(function () {
		$big = $(this).closest('.box-feed, .one-good, .one-good-big');
		bclas = $big.attr('class').split(' ')[0];
		$cmt = $(this).closest('.one-cmt');
		page = $big.attr('data-p');
		act = $(this).attr('id').split('-')[0];
		url = MAIN_URL + '/pages/' + page + '.php?i=' + id;
		liketext = $cmt.find('#like-cmt .text').text();
		$.ajax({
			url: url + '&cmt=' + i + '&do=' + act,
			type: 'post',
			datatype: 'json',
			success: function (data) {
				if (liketext == 'Like') $cmt.children('#tool-cmt').find('#like-cmt .text').text('Unlike');
				else if (liketext == 'Unlike') $cmt.children('#tool-cmt').find('#like-cmt .text').text('Like');
				$cmt.children('#tool-cmt').find('.num-like-cmt').load(url + ' .' + bclas + '.the' + id + ' .one-cmt.cmt-' + i + ' > #tool-cmt .num-like-cmt > b');
			}
		});
		return false
	})
}
function ajaxSCommentCmtOne (i, id) {
	$('.the' + id + ' .one-cmt.cmt-' + i).find('#comment-cmt').click(function () {
		$big = $(this).closest('.box-feed, .one-good, .one-good-big');
		bclas = $big.attr('class').split(' ')[0];
		$cmt = $(this).closest('.one-cmt');
		page = $big.attr('data-p');
		act = $(this).attr('id').split('-')[0];
		url = MAIN_URL + '/pages/' + page + '.php?i=' + id;
		liketext = $cmt.find('#like-cmt .text').text();
		if (!$cmt.find('#cmt' + i + '-' + id).length) $cmt.find('.child-comments-list').after('<form class="cmt-cmt-form" id="cmt' + i + '-' + id + '"><img class="avatar-circle left" src="' + $big.find('.cmt-post-form > .avatar-circle').attr('src') + '"><textarea name="cmt-content" class="no-toolbar left" style="height:45px"></textarea></form>');
		$cmtCmt = $cmt.find('#cmt' + i + '-' + id);
/*		$cmtCmt.find('textarea').sceditor({
			toolbar: '',
			emoticons: emoticonsList
		});
*/		$cmtCmt.find('textarea').meditor();
		submitChildCommment(id, i);
	});
	$('.the' + id + ' .one-cmt.cmt-' + i).find('.child-comments-list').each(function () {
		cmt = $(this).find('.one-cmt').length;
		showcmt = cmt - 2;
		if (cmt > 2) $(this).prepend('<a class="small show-all-child-cmts"><span class="fa fa-chevron-down"></span> View all <b>' + cmt + '</b> replies</a>')
		$(this).find('.one-cmt').not($(this).find('.one-cmt').slice(0, 2)).wrapAll('<div class="more-cmts hide"></div>');
		$(this).find('.show-all-child-cmts').click(function () {
			$cList = $(this).closest('.child-comments-list');
			cmt = $cList.find('.one-cmt').length;
			showcmt = cmt - 2;
			if ($cList.find('.more-cmts').is(':hidden')) {
				$cList.find('.more-cmts').slideDown();
				$cList.find('.show-all-child-cmts').html('<span class="fa fa-chevron-up"></span> Hide <b>' + showcmt + '</b> replies')
			} else {
				$cList.find('.more-cmts').slideUp();
				$cList.find('.show-all-child-cmts').html('<span class="fa fa-chevron-down"></span> View all <b>' + cmt + '</b> replies')
			}
		})
	})
}
function submitChildCommment (id, i) {
	$('.the' + id + ' .one-cmt.cmt-' + i).find('#cmt' + i + '-' + id).find('.sceditor-container .meditor-iframe').bind("keydown", function (e) {
		if (e.keyCode == 13 && !e.shiftKey) {
			e.preventDefault();
			$('.the' + id + ' .one-cmt.cmt-' + i).find('#cmt' + i + '-' + id).submit();
		}
	});
	$('.the' + id + ' .one-cmt.cmt-' + i).find('#cmt' + i + '-' + id).submit(function () {
		$cmt = $(this).closest('.one-cmt');
		page = $big.attr('data-p');
		$cmtCmt = $cmt.find('#cmt' + i + '-' + id);
		$cmtCmt.find('textarea').each(function () {
			val = $(this).next('.sceditor-container').find('.meditor-iframe').html();
			$(this).val(val);
		});
		formData = $cmtCmt.serialize();
		urlc = MAIN_URL + '/pages/' + page + '.php?i=' + id + '&cmt=' + i + '&do=comment';
		$.ajax({
			url: urlc,
			type: 'post',
			data: formData,
			datatype: 'json',
			success: function (data) {
//				submitChildCommment(id, i);
				$cmtCmt.find('textarea').val('').next('.sceditor-container').find('.meditor-iframe').html('');
				$cmt.find('.child-comments-list').load(MAIN_URL + '/pages/' + page + '.php?i=' + id + ' .one-cmt.cmt-' + i + ' .child-comments-list > div', function () {
					$(this).find('.one-cmt.child').each(function () {
						ajaxSLikeCmtOne($(this).attr('id'), id)
					})
				})
			}
		});
		return false
	})
}

function showLikeList (i) {
	$(".the"+i+" #like-list").click(function () {
		mi = $(this).closest(".the" + i);
		if (mi.find('.one-good-feed').length) {
			page = mi.find('.one-good-feed').attr('data-p');
			id = mi.find('.one-good-feed').attr('id');
		} else {
			page = $('.page-content').attr('data-p');
			id = mi.attr('id');
		}
		$.ajax({
			url: MAIN_URL + '/pages/' + page + '.php?i=' + id + '&display=like',
			type: "get",
			success: function (data) {
				$('.sb-like-list').html(data);
				smallBoard('like-list')
			}
		})
	})
}

function ajaxSLikeCmt (id) {
	$('.the' + id).find('.one-cmt').each(function () {
		ajaxSLikeCmtOne($(this).attr('id'), id);
		ajaxSCommentCmtOne($(this).attr('id'), id);
	})
}

function showChat () {
	if ($('.chat-area').is(':hidden')) {
		$('.chat-area').show('slide', {direction: 'right'}, 200);
		$('.right-sidebar, .right-sidebar .top-section').removeAttr('style');
		left = $('.chat-area').position().left - $('.right-sidebar').width();
		$('.right-sidebar').animate({
			'left' : left
		}, 300);
		$('.right-sidebar .top-section').animate({
			'left' : left
		}, 300);
		$('.toggle-chat-area').removeClass('fa-chevron-left').addClass('fa-chevron-right')
	} else {
		$('.chat-area').hide('slide', {direction: 'right'}, 200);
		$('.right-sidebar, .right-sidebar .top-section').removeAttr('style');
		$('.right-sidebar, .right-sidebar .top-section').animate({
			'right' : 0
		}, 300);
		$('.toggle-chat-area').removeClass('fa-chevron-right').addClass('fa-chevron-left')
	}
}

$(function () {
	firstScroll();
	$('.money-type-select').click(function () {
		$('.money-type-select').removeClass('selected');
		$(this).addClass('selected');
		$('.p-money-type :hidden').value($(this).attr('id'))
	});

	sce('left-sidebar');
	$(".tagsinput").tagsInput();

	$('a[href^="#!logout"]').click(function () {
		$.ajax({
			url: MAIN_URL + '/pages/logout.php',
			type: "POST",
			datatype: 'json',
			success: function (data) {
				$('.sb-logout').html(data);
				smallBoard('logout');
			}
		});
		return false
	});
	$('#right-content .one-friend').click(function () {
		uid = $(this).attr('id');
		$.ajax({
			url: MAIN_URL + '/pages/chat.php?u='+uid,
			type: 'GET',
			datatype: 'json',
			success: function (data) {
				if (!$('.chat-stick-one[data-u="'+uid+'"]').length) {
					$('.chat-area').html(data);
					chat($('.chat-stick-one[data-u="'+uid+'"]'));
				} else $('.chat-stick-one[data-u="'+uid+'"]').animate({'bottom' : 0}, 300)
				if ($('.chat-area').is(':hidden')) showChat();
			},
			error: function (xhr) {
				mtip('', 'error', '', xhr+'. Please contact the administrators for help.')
			}
		})
	});
	$('.toggle-chat-area').click(function () {
		showChat()
	});

	n = 0;
	$('#add_more').on('click', function () {
		$(this).before(
			$("<div/>", {
				id: 'filediv'
			}).fadeIn('slow').append(
				$("<input/>", {
					name: 'img[]',
					type: 'file',
					class: 'btn-upload-img',
					id: 'stt_photo'
				})
			)
		);
	});
	$('body').on('change', '#stt_photo', function() {
		if (this.files && this.files[0]) {
			n += 1;
			var z = n - 1;
			var x = $(this).parent().find('#previewimg' + z).remove();
			$(this).closest('#filediv').find('.btn-upload-img').hide().after("<div id='img" + n + "' class='img-preview'><img class='hide' id='previewimg" + n + "'/></div>");
			$('#add_more').click();
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
			$(this).hide();
			$("#img" + n).append(
				$("<span/>", {
					id: 'img-remove',
					class: 'fa fa-times',
					alt: 'delete'
				}).click(function() {
					$(this).parent().parent().fadeOut(170, function () {
						$(this).remove()
					})
				})
			)
		}
	});
	function imageIsLoaded(e) {
		$('#previewimg' + n).attr('src', e.target.result).fadeIn(190)
	}
	$('.status-form').submit(function () {
		var checkSend = false;
		$bigDiv = $(this).closest('.left-menu-column');
		page = $(this).attr('data-p');
		act = $(this).attr('data-a');
		url = MAIN_URL + '/pages/' + page + '.php';
		$(this).children('textarea').each(function () {
			val = $(this).next('.sceditor-container').find('.meditor-iframe').html();
			$(this).val(val);
			if (page != 'feed' && (!val || val == '<p><br></p>')) {
				checkSend = false;
				mtip('.form-alerts', 'warning', '', 'Please fill in the required fields.')
			} else checkSend = true;
		});
		$('#content').hide().after('<div class="loading-screen"><div class="spinner"> <div></div><div></div><div></div> </div></div>');
		$(this).find('input[type="submit"]').attr('disabled', true);
		if (checkSend == true) {
			formData = new FormData($(this)[0]);
			$.ajax({
				url: url + '?' + act,
				type: 'post',
				data: formData,
				mimeType: "multipart/form-data",
				contentType: false,
				cache: false,
				processData: false,
				success: function (data, textStatus, jqXHR) {
					$bigDiv.find('.the-form textarea').each(function () {
						$(this).next('.sceditor-container').find('.meditor-iframe').html('')
					});
					$bigDiv.find('input[type="submit"]').attr('disabled', false);
					firstScroll()
				},
				error: function (xhr) {
					mtip('', 'error', '', 'Your message can\'t be sent.');
				}
			})
		}
		return false
	});

	$('.switch-status-update span').click(function () {
		a = $(this).attr('id');
		$('.switch-status-update span').removeClass('active');
		$(this).addClass('active');
		$('.the-form').slideUp(200);
		$('.the-form.' + a).slideDown(200)
	});

	$('.one-square').click(function () {
		$('.leftPopup').hide();
		$(this).next('.leftPopup').fadeIn(100)
	});
	$('.popClose').click(function () {
		$(this).closest('.leftPopup').fadeOut(100)
	});
	$('.quote-stt').each(function () {
		qstt = $(this).text().substring(0, 60);
		$(this).text(qstt + '...')
	});

	$('.switch-menu li').click(function () {
		$('.switch-menu li').removeClass('active');
		$(this).addClass('active');
		c = $(this).attr('id');
		$('.user-quick-sta').hide();
		$('.user-quick-sta#' + c).show()
	});
	$('.user-quick-sta li').click(function () {
		$('.user-quick-sta li').removeClass('active');
		$(this).addClass('active');
		pag = $(this).closest('.user-quick-sta').attr('id');
		loadLeft(pag, 'show=' + $(this).attr('id'));
		$('#left-content').prev('.top-section').find('.s-title').find('.back-to-list, .back-to-item').remove();
	});
	$('a[href^="#!logout"]').click(function () {
		$.ajax({
			url: MAIN_URL + '/pages/logout.php',
			type: "POST",
			datatype: 'json',
			success: function (data) {
				$('.sb-logout').html(data);
				smallBoard('logout');
			}
		});
		return false
	});
	
/*	$(".sidebar-nicescroller").not('.no-width').niceScroll({
		cursorcolor: "#00aecd",
		cursorborder: "0px solid rgba(255,255,255,.6)",
		cursorborderradius: "10px",
		cursorwidth: "5px"
	});
	$(".sidebar-nicescroller.no-width").niceScroll({
		cursorcolor: "transparent",
		cursorborder: "0",
		cursorwidth: "0"
	});
	$(".sidebar-nicescroller").getNiceScroll().resize();
*/
})

$(window).on('hashchange', function (e) {
	var origEvent = e.originalEvent
	newUrl = origEvent.newURL;
	loadFromUrl(newUrl)
});
