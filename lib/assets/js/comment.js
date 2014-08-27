$(function () {
	$('.cmt-post-form').submit(function () {
		$form = $(this);
		page = $form.closest('.box-feed, .one-good, .one-good-big').attr('data-p');
		id = $form.closest('.box-feed, .one-good, .one-good-big').attr('id');
		cmi = $form.attr('alt');
		$form.find('textarea').each(function () {
			val = $(this).next('.sceditor-container').find('iframe').contents().find('body').html();
			$(this).val(val);
		});
		formData = $form.serialize();
		if (cmi && cmi != null && cmi != '') url = MAIN_URL + '/pages/' + page + '.php?i=' + id + '&do=comment&cmt=' + cmi;
		else url = MAIN_URL + '/pages/' + page + '.php?i=' + id + '&do=comment';
		alert(formData + url);
		$.ajax({
			url: url,
			type: 'post',
			data: formData,
			datatype: 'json',
			success: function (data) {
				$form.next('.sceditor-container').find('iframe').contents().find('body').html('');
				$form.prev('.cmts-post').load(MAIN_URL + '/pages/' + page + '.php?i=' + id + ' .cmts-post > div')
			}
		});
		return false
	})
})
