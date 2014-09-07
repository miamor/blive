function oneGoodBig (id) {
	$('#' + id + ' .one-good-big').each(function () {
		ajaxSLikeCmt($(this).attr('id'));
		cmtPost($(this).attr('id'));
		votePost($(this).attr('id'));
//		showLikeList($(this).attr('id'))
	})
}

function voteRequest () {
	$('.helpful-vote a').click(function () {
		id = $(this).closest('.one-good-big').attr('id');
		url = MAIN_URL + '/pages/request.php?i=' + id;
		act = $(this).attr('id');
		$.ajax({
			url: url + '&do=' + act,
			type: 'post',
			success: function (data) {
				$('.helpful-vote').load(url + ' .helpful-vote > span', function () {
					$(this).fadeIn(100);
					voteRequest()
				});
				$('.helpful-static').slideUp(200, function () {
					$(this).load(url + ' .helpful-static > span', function () {
						$(this).slideDown(200, function () {
							if (act == 'helpful' || act == 'helpfulnot') mtip('.one-good-info.helpful', 'success', '', 'Thanks for your feedbacks.')
						})
					})
				})
			}
		})
	})
}

function voteRequestChild (id, sid) {
	$('.helper-one#hep' + sid).find('.button-choose-best').click(function () {
		url = MAIN_URL + '/pages/request.php?i=' + id;
		$.ajax({
			url: url + '&do=requestsolved&s=' + sid,
			type: 'post',
			success: function (data) {
				$('.helper-one#hep' + sid).fadeOut(150, function () {
					$(this).load(url + ' .helper-list > .helper-one#hep' + sid, function () {
						$(this).slideDown(120)
					})
				})
			}
		});
	})
}

$(function () {
	voteRequest();
	$('.helper-list .helper-one').each(function () {
		voteRequestChild($(this).closest('.one-good-big').attr('id'), $(this).attr('alt'))
	});
	$('.button-help').click(function () {
		if ($('.me-help').is(':hidden')) $('.me-help').slideDown(200);
		else $('.me-help').slideUp(200)
	});
	$('.help-content-textarea').meditor();
	$('.form-help').submit(function () {
		id = $(this).closest('.one-good-big').attr('id');
		url = MAIN_URL + '/pages/request.php?i=' + id;
		$(this).find('textarea').each(function () {
			Content = $(this).next('.sceditor-container').find('.meditor-iframe').html();
			$(this).val(Content);
		});
		formData = $(this).serialize();
		$.ajax({
			url: url + '&do=help',
			type: 'post',
			data: formData,
			datatype: 'json',
			success: function (data) {
				alertsContent = data.split(/\[content\]|\[\/content]/)[1];
				alertsType = data.split(/\[type\]|\[\/type\]/)[1];
				if (alertsType && alertsContent) mtip('.me-help', alertsType, '', alertsContent);
				if (alertsType == 'success') {
					$('.me-help').slideUp(200, function () {
						$(this).remove()
					});
					$('.button-help').fadeOut(150, function () {
						$(this).remove()
					})
					$('.helper-list').slideUp(200, function () {
						$(this).load(url + ' .helper-list > div', function () {
							$(this).slideDown(100)
						})
					})
				}
			}
		});
		return false
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
					firstScroll()
				}
			});
			return false
		}
	});
})
