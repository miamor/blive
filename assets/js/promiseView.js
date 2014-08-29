function confirmDid (e) {
	if (e == 'yes') {
		confirmSwitchHTML = '<a id="no" class="no did-it btn btn-none" onclick="confirmDid(\'no\')"><span class="failure-sign"> I failed</span></a>';
		confirmHTML = '<span class="success-sign bold"> Congratulation! You\'ve made it!</span>';
		$('.confirm-lock-option').show();
		$('.confirm-select-people').append('<div class="gensmall success-select-announce">* People from list above will have to make a word to complete with a bet at least as yours. </div>').find('select').attr('disabled', false).next('.chosen-container').show().prev().prev('.fail-select-announce').remove();
		$('.confirm-select-suborner').show().find('select').attr('disabled', false).next('.chosen-container').show().prev().prev('.fail-select-announce_').remove();
	} else if (e == 'no') {
		confirmSwitchHTML = '<a id="yes" class="yes did-it btn btn-primary" onclick="confirmDid(\'yes\')"><span class="success-sign"></span> I did it</a>';
		confirmHTML = '<span class="failure-sign"> <b>Aww! We\'re so sorry about that :(</b><br/>Don\'t be worry, you only lose one-thirds of your bets. </span>';
		$('.confirm-lock-option').hide();
		$('.confirm-select-people').prepend('<div class="gensmall fail-select-announce">* So sorry. You need to make your words to make this list</div>').find('select').attr('disabled', true).next('.chosen-container').hide().next('.success-select-announce').remove();
//		$('.confirm-select-suborner').prepend('<div class="gensmall fail-select-announce_">* <!--When you fail with something, admitting it will only cause you lost one-thirds of your bets. (Despite votes)<br/>Well, say you made it when nobody trusted will cause you lost 100% your full money.--> Since you admit you failed, you won\'t need suborners (or votes). It means despite votes, you will lose one-thirds of your bets.</div>').find('select').attr('disabled', true).next('.chosen-container').hide().next('.success-select-announce_').remove();
		$('.confirm-select-suborner').hide().find('select').attr('disabled', true).next('.chosen-container').hide().next('.success-select-announce_').remove();
	}
	$('.confirm-did > div').hide();
	$('.confirm-ask').fadeOut(300, function () {
		$(this).next('.confirm-switch').html(confirmSwitchHTML).next('.confirm-text').html(confirmHTML).next('.confirm-textarea').find('.did-option').val(e)
		$(this).parent('.confirm-did').children('div, form').not('.confirm-ask').fadeIn(300)
	})
}

/*function bButton (id, pid) {
	$('#' + pid + ' .one-good-big.the'+id+' .b-buttons:not(".disabled") .b-button, #' + pid + ' .one-good-big.the'+id+' .b-button.active, #' + pid + ' .one-good-big.the'+id+' .encourage-button').click(function () {
		act = $(this).attr('id');
		url = MAIN_URL + '/pages/promise.php?i=' + id;
		$.ajax({
			url: url + '&do=' + act,
			type: 'post',
			datatype: 'json',
			success: function (data) {
				$('#content .one-good-big.the'+id+' .one-good-buttons').load(url + ' .one-good-big.the'+id+' .one-good-buttons > div', function () {
					bButton(id, 'content');
				});
				$('#left-content .one-good-big.the'+id+' .one-good-buttons').load(url + ' .one-good-big.the'+id+' .one-good-buttons > div', function () {
					bButton(id, 'left-content');
				});
				$('#left-content .one-good.the'+id+' .one-good-info').load(MAIN_URL + '/pages/promise.php .one-good.the'+id+' .one-good-info > div', function () {
					bButtonList(id);
				})
			}
		})
	})
}*/

function bButton (id) {
	$('.one-good-big.the'+id+' .b-buttons:not(".disabled, .dis") .b-button, .one-good-big.the'+id+' .b-buttons:not(".dis") .b-button.active, .one-good-big.the'+id+' .encourage-button').click(function () {
		act = $(this).attr('id');
		url = MAIN_URL + '/pages/' + pl_page + '.php?i=' + id;
		$.ajax({
			url: url + '&do=' + act,
			type: 'post',
			datatype: 'json',
			success: function (data) {
				$('.one-good-big.the'+id+' .one-good-buttons').load(url + ' .one-good-big.the'+id+' .one-good-buttons > div', function () {
					bButton(id)
				})
			}
		})
	})
}

function oneGoodBig (id) {
	$('#' + id + ' .one-good-big').each(function () {
		ajaxSLikeCmt($(this).attr('id'));
		bButton($(this).attr('id'));
		cmtPost($(this).attr('id'));
		votePost($(this).attr('id'));
		showLikeList($(this).attr('id'))
	})
}

$(function () {
	$('.user-quick-sta li').removeClass('active');
	$('.confirm-options a').click(function () {
		e = $(this).attr('id');
		if (pl_page == 'promise') confirmDid(e);
		else if (pl_page == 'ask') {
			if (e == 'yes') {
				confirmSwitchHTML = '<a id="no" class="no did-it btn" data-placement="left" data-toggle="confirmation"><span class="failure-sign"></span> Refuse</a>';
				confirmHTML = '<span class="success-sign bold"> Answer!</span>';
				$('.confirm-ask').fadeOut(300, function () {
					$(this).next('.confirm-switch').next('.confirm-text').html(confirmHTML).next('.confirm-textarea').find('.did-option').val(e)
					$(this).parent('.confirm-did').children('div, form').not('.confirm-ask').fadeIn(300)
				})
			}
		}
	});
	$('.lock-it').confirmation({
		placement: 'right',
		onConfirm: function () {
			id = $(this).closest('.one-good-big, .one-good-feed').attr('id');
			url = MAIN_URL + '/pages/' + pl_page + '.php?i=' + id;
			$.ajax({
				url: url + '&do=lock',
				type: 'post',
				datatype: 'json',
				success: function (data) {
//					loadLeft(pl_page, 'i=' + id)
					firstScroll()
				}
			});
			return false
		}
	});
	$('.view-all-vote').click(function () {
		bigId = $(this).closest('.sidebar-nicescroller').children('.overflow-scroll').attr('id')
		i = $(this).closest('.one-good-big, .one-good-feed').attr('id');
			$.ajax({
				url: MAIN_URL + '/pages/promise.php?i=' + i + '&show=votes',
				type: "get",
				success: function (data) {
					$('.sb-like-list').html(data);
					smallBoard('like-list');
					tab()
				}
			})
	});
//	$('#left-content').prev('.top-section').find('.toggle-form').before('<a class="fa fa-reply back-to-list" href="javascript:history.go(-1)"></a>');
	$('.confirm-textarea').submit(function () {
		id = $(this).closest('.one-good-big').attr('id');
		url = MAIN_URL + '/pages/' + pl_page + '.php?i=' + id;
		$('.did-content').each(function () {
			didContent = $(this).next('.sceditor-container').find('iframe').contents().find('body').html();
			$(this).val(didContent);
		});
		formData = $(this).serialize();
		$.ajax({
			url: url + '&didit=submit',
			type: 'post',
			data: formData,
			datatype: 'json',
			success: function (data) {
				firstScroll()
			}
		});
		return false
	})
});
