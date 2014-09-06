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


$(function () {
	$('.statu.one').each(function () {
		ajaxSLikeCmt($(this).attr('id'));
		if ($(this).find('.one-good-feed').length) bButtonFeed($(this).find('.one-good-feed').attr('id'));
		cmtPost($(this).attr('id'));
		votePost($(this).attr('id'));
		shortenStt($(this).attr('id'))
	});
	$('.pagination').hide()
});
