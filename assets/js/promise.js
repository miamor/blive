function promise () {
//	flatApp();
//	sce();
/*	$('.sb-open').click(function () {
		id = $(this).attr('id');
		smallBoard(id)
	});
*/	$('#left-content .one-good .one-good-content').click(function () {
//		$('#left-content').html('<div class="spinner"> <div></div> <div></div><div></div> </div>');
		id = $(this).closest('.one-good').attr('id');
		loadLeft(pl_page, 'i=' + id);
		$('#left-content').prev('.top-section').find('.toggle-form').before('<a class="fa fa-reply back-to-list" href="javascript:history.go(-1)"></a>');
/*		$.ajax({
			url: MAIN_URL + '/pages/promise.php?i='+id,
			type: 'get',
			datatype: 'json',
			success: function (data) {
				title = data.split(/<!--|-->/)[1];
				setTimeout(function () {
//					$('.left-menu-column .top-section .toggle-form').html(title).wrap('<div class="s-title"></div>').prepend('<a class="fa fa-reply back-to-list" href="javascript:history.go(-1)"></a>');
					$('#left-content').html(data).prev('.top-section').find('.toggle-form').html(title).before('<a class="fa fa-reply back-to-list" href="javascript:history.go(-1)"></a>');
					sce('left-content');
					oneGoodBig('left-content');
//					$('#left-content').prev('.top-section').find('.toggle-form').find('.back-to-list').not(':last').remove();
					promise()
				}, 300);
			}
		})
*/	});
	$('.left-menu-column .back-to-list').click(function () {
//		$('#left-content').html('<div class="spinner"> <div></div><div></div><div></div> </div>');
		loadLeft(pl_page, 'show=open');
		$('#left-content').prev('.top-section').find('.s-title').find('.back-to-list').remove();
/*		$.ajax({
			url: MAIN_URL + '/pages/promise.php',
			type: 'get',
			datatype: 'json',
			success: function (data) {
				title = data.split(/<!--|-->/)[1];
				setTimeout(function () {
//					$('.left-menu-column .top-section .toggle-form').html(title).wrap('<div class="s-title"></div>').prepend('<a class="fa fa-reply back-to-list" href="javascript:history.go(-1)"></a>');
					$('#left-content').html(data).prev('.top-section').find('.toggle-form').html(title).parent('.s-title').find('.back-to-list').remove();
//					$('#left-content').prev('.top-section').find('.toggle-form').find('.back-to-list').not(':last').remove();
					promise();
				}, 300);
			}
		});
*/		return false
	})
}
