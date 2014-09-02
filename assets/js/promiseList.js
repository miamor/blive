/*function bButtonList (id) {
	$('#left-content .one-good.the'+id+' .b-buttons:not(".disabled") .b-button, #left-content .one-good.the'+id+' .b-button.active, #left-content .one-good.the'+id+' .encourage-button').click(function () {
		act = $(this).attr('id');
		url = MAIN_URL + '/pages/promise.php?i=' + id;
		$.ajax({
			url: url + '&do=' + act,
			type: 'post',
			datatype: 'json',
			success: function (data) {
				$('#left-content .one-good.the'+id+' .one-good-info').load(MAIN_URL + '/pages/promise.php .one-good.the'+id+' .one-good-info > div', function () {
					bButtonList(id);
				});
				$('#content .one-good-big.the'+id+' .one-good-buttons').load(url + ' .one-good-big.the'+id+' .one-good-buttons > div', function () {
					bButton(id, 'content');
				})
			}
		})
	})
}*/
function bButtonList (id) {
	$('.one-good.the'+id+' .one-good-info .hide-on-list').remove();
	$('.one-good.the'+id+' .b-buttons:not(".disabled, .dis") .b-button, .one-good.the'+id+':not(".disabled, .dis") .b-button.active, .one-good.the'+id+' .encourage-button').click(function () {
//		id = $(this).closest('.one-good-big').attr('id');
		act = $(this).attr('id');
		url = MAIN_URL + '/pages/' + pl_page + '.php?i=' + id;
		$.ajax({
			url: url + '&do=' + act,
			type: 'post',
			datatype: 'json',
			success: function (data) {
				$('.one-good#'+id+' .one-good-info').load(MAIN_URL + '/pages/' + pl_page + '.php .one-good#'+id+' .one-good-info > div', function () {
					bButtonList(id)
				})
			}
		})
	})
}

	$('.one-good').each(function () {
//		alert($(this).attr('id'));
		bButtonList($(this).attr('id'));
	});
