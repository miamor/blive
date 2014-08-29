main = $(window);


function ajaxLoadsS() {
    $('#stt_photo').live('change', function () {
        var img = $(this).val();
        $("#test").html('Loading...');
        $("#test").html(img)
    })
}

function showS() {
	$(".statuss .nums").click(function () {
		$(this).parents("#tool").next('.like_list').children('#likelist').toggle()
	})
}

function showM(a) {
	$(a+" .nums").click(function () {
//		$(this).parents("#tool").next('.like_list').children('#likelist').toggle()
	})
}

function ajaxS () {
	$('.statu').each(function () {
		ajaxSLikeCmt($(this).attr('id'));
		if ($(this).find('.one-good-feed').length) bButtonFeed($(this).find('.one-good-feed').attr('id'));
		cmtPost($(this).attr('id'));
		votePost($(this).attr('id'));
		shortenStt($(this).attr('id'))
//		showLikeList($(this).attr('id'))
	});
}

/*function ajaxSs (big) {
	$(big).find('.statu').each(function () {
		ajaxSLikeCmt($(this).attr('id'));
		if ($(this).find('.one-good-feed').length) bButtonFeed($(this).find('.one-good-feed').attr('id'));
		cmtPost($(this).attr('id'));
		votePost($(this).attr('id'));
		shortenStt($(this).attr('id'))
	})
}*/

function shortenStt (i) {
	$('.statu.the' + i).not('.one').each(function () {
		$(this).find('.static-post, .cmts-post, .cmt-post-form').hide();
		$(this).find('#tool').click(function () {
			$(this).closest('.statu').find('.static-post, .cmts-post, .cmt-post-form').toggle();
		});
		if ($(this).find('.one-good-feed').length) {
			id = $(this).find('.one-good-feed').attr('id');
			pFullContent = $(this).find('.one-good-content').html();
			pcontent = pFullContent.substring(0, 300);
			pMoreContent = pFullContent.substring(0, 800);
			if ($(this).find('.one-good-content').text().length > 300) {
				$(this).find('.one-good-content').html(pcontent + '... <a class="see-more">See more</a> <div class="hidden hidden-content">' + fullContent + '</div>');
				$(this).find('.see-more').click(function () {
					$stt = $(this).closest('.statu').find('.one-good-content');
					fullTextLength = $stt.find('.hidden-content').text().length;
					fullContent = $stt.find('.hidden-content').html();
					moreContent = fullContent.substring(0, 800);
					$stt.html(pMoreContent);
					if (fullTextLength > 800) $stt.append('... <a class="see-full" href="#!promise?i=' + id + '">Continue reading</a>');
				})
			}
		} else if ($(this).find('.content.stt').length) {
			fullContent = $(this).find('.content.stt').html();
			mcontent = fullContent.substring(0, 300);
			if ($(this).find('.content.stt').text().length > 300) {
				$(this).find('.content.stt').html(mcontent + '... <a class="see-more">See more</a> <div class="hidden hidden-content">' + fullContent + '</div>');
				$(this).find('.see-more').click(function () {
					$stt = $(this).closest('.statu').find('.content.stt');
					fullTextLength = $stt.find('.hidden-content').text().length;
					fullContent = $stt.find('.hidden-content').html();
					moreContent = fullContent.substring(0, 800);
					$stt.html(moreContent);
					if (fullTextLength > 800) $stt.append('... <a class="see-full" href="#!feed?i=' + i + '">Continue reading</a>');
				})
			}
		}
	})
}

function bButtonFeed (id) {
	$('.one-good-feed.the'+id+' .one-good-info .hide-on-list').remove();
	$('.box-feed .one-good-feed.the'+id+' .b-buttons:not(".disabled") .b-button, .box-feed .one-good-feed.the'+id+' .b-button.active, .one-good-feed.the'+id+':not(".dis") .b-button, .box-feed .one-good-feed.the'+id+' .encourage-button').click(function () {
//		id = $(this).closest('.one-good-big').attr('id');
		act = $(this).attr('id');
		url = MAIN_URL + '/pages/promise.php?i=' + id;
		$.ajax({
			url: url + '&do=' + act,
			type: 'post',
			datatype: 'json',
			success: function (data) {
				$('.one-good-feed.the'+id+' .one-good-info').load(url + ' .one-good-big.the'+id+' .one-good-info > div:not(".one-good-time")', function () {
					bButtonFeed(id);
				})
			}
		})
	})
}
/*function bButtonFeed (id) {
	$('.box-feed .one-good-feed.the'+id+' .b-buttons:not(".disabled") .b-button, .box-feed .one-good-feed.the'+id+' .b-button.active, .box-feed .one-good-feed.the'+id+' .encourage-button').click(function () {
		act = $(this).attr('id');
		url = MAIN_URL + '/pages/promise.php?i=' + id;
		$.ajax({
			url: url + '&do=' + act,
			type: 'post',
			datatype: 'json',
			success: function (data) {
				$('.one-good-feed.the'+id+' .one-good-info').load(url + ' .one-good-big.the'+id+' .one-good-info > div:not(".one-good-time")', function () {
					bButtonFeed(id);
				});
				$('#left-content .one-good-big.the'+id+' .one-good-buttons').load(url + ' .one-good-big.the'+id+' .one-good-buttons > div', function () {
					bButton(id, 'left-content');
				})
			}
		})
	})
}*/

function all () {
	ajaxS();
//	sce();
//	flatApp();
	if (window.location.href.indexOf('undividepage') == -1) loadmore(0);
}

function loadmore (i) {
	main.scroll(function () {
		var scrollBottom = $('.following').height() - main.scrollTop() - 650;
		if (scrollBottom <= 10) {
			var page = $('.statuss > .pagination .page').length;
			if (!$('#more #load-more'+i).length) $('#more').append('<div class="load-more load-more'+i+'" style="display:none" id="load-more'+i+'"></div>');
			url = $('.statuss > .pagination .page:eq('+i+')').attr('href');
			$('#load-more'+i+':hidden').show().html('<div class="spinner loading-status"><div></div><div></div><div></div></div>').hide();
//			<center>Loading... <img class="loading-status" src="'+IMG+'/alw_loading.png"/></center>
			$('#load-more'+i+':hidden').load(url + ' .statuss .statu', function () {
				$('#load-more'+i).find('.no-toolbar').sceditor({
					toolbar: '',
					emoticons: emoticonsList
				});
				$('#load-more'+i).find('input[type="submit"]').addClass('right btn btn-info btn-perspective-hover');
//				ajaxSs('#load-more'+i);
				$('#load-more'+i).find('.statu').each(function () {
					ajaxSLikeCmt($(this).attr('id'));
					if ($(this).find('.one-good-feed').length) bButtonFeed($(this).find('.one-good-feed').attr('id'));
					cmtPost($(this).attr('id'));
					votePost($(this).attr('id'));
					shortenStt($(this).attr('id'))
				});
				if (i < page) {
					i++;
					loadmore(i)
				}
			});
			if ($('#load-more'+i).find('.loading-status').length) {
//				$('#load-more'+i).html('<div class="statu follow">No more data to show.</div>')
				$('#load-more'+i).html('')
			}
			$('#load-more'+i+':hidden').fadeIn(800)
		}
	});
}

$(function () {
	all();
//	pagination();
});
