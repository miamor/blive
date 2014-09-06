function oneGoodBig (id) {
	$('#' + id + ' .one-good-big').each(function () {
		ajaxSLikeCmt($(this).attr('id'));
		cmtPost($(this).attr('id'));
		votePost($(this).attr('id'));
//		showLikeList($(this).attr('id'))
	})
}

function voteRequest () {
	$('.helpful-btn a').click(function () {
		id = $(this).closest('.one-good-big').attr('id');
		url = MAIN_URL + '/pages/request.php?i=' + id;
		act = $(this).attr('id');
		alert(url + '&do=' + act);
		$.ajax({
			url: url + '&do=' + act,
			type: 'post',
			success: function (data) {
				$('.helpful-vote').fadeOut(200, function () {
					$(this).load(url + ' .helpful-vote > a', function () {
						$(this).fadeIn(200);
						voteRequest()
					})
				});
				$('.helpful-static').slideUp(200, function () {
					$(this).load(url + ' .helpful-static > span', function () {
						$(this).slideDown(200, function () {
							mtip('.helpful-static', 'success', '', 'Thanks for your feedbacks.')
						})
					})
				})
			}
		})
	})
}

$(function () {
	voteRequest();
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
				alertsContent = data.split(/[content][|]/)[1];
				alertsType = data.split(/[type][|]/)[1];
				mtip('.me-help', alertsType, '', alertsContent);
				if (alertsType == 'success') $('.me-help, .button-help').remove();
				$('.form-help').find('textarea').each(function () {
					$(this).val('').next('.sceditor-container').find('.meditor-iframe').html('')
				});
				$('.helper-list').slideUp(200, function () {
					$(this).load(url + ' .helper-list > div', function () {
						$(this).slideDown(100)
					})
				})
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
