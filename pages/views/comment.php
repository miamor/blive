<? $tbcmt = $tb.'_cmt';
include 'system/comment.php' ?>
			
			<? 	$totalCmts = countRecord($tbcmt, "`iid` = $iid AND `pid` = 0 ");
				if ($tb == 'activity') $page = 'feed';
				else $page = $tb;
				if ($num && $totalCmts > $num) echo '<div class="view-all-cmt"><a href="#!'.$page.'?i='.$iid.'">View all <b>'.$totalCmts.'</b> comments</a></div>';
				if (!$num) $order = 'time ASC';
				else {
					$order = 'LENGTH(likes) DESC';
					$num = '%'.$num;
				}
				$cmtList = $getRecord -> GET($tbcmt, "`iid` = $iid AND `pid` = 0 ", $num, $order);
				foreach ($cmtList as $cl) {
					$au = getRecord('members^username,avatar', "id = {$cl['uid']}");
					if ($cl['likes']) $cmtLikesAr = explode(', ', $cl['likes']);
					else $cmtLikesAr = array();
					$cmtLikes = count($cmtLikesAr) ?>
					<div class="one-cmt cmt-<? echo $cl['id'] ?>" id="<? echo $cl['id'] ?>">
						<img class="avatar-circle left" src="<? echo $au['avatar'] ?>"/>
						<a href="#!user?u=<? echo $cl['uid'] ?>" class="cmt-user-name bold left"><? echo $au['username'] ?></a>
						<div class="cmt-content"><? echo tag($cl['content']) ?></div>
						<div class="cmt-bottom tool" id="tool-cmt" alt="<? echo $cl['id'] ?>">
							<a class="like-button small" id="like-cmt">
								<span class="num-like-cmt"><b><? if ($cmtLikes > 0) echo '<span class="fa fa-thumbs-up"></span> '.$cmtLikes ?></b></span>
								<span class="text"><? if (!in_array($u, $cmtLikesAr)) echo 'Like'; else echo 'Unlike' ?></span>
							</a>
							<a class="like-button small" id="comment-cmt">Comment</a>
							<span class="gensmall right cmt-time"><span class="fa fa-clock-o"></span> <? echo timeFormat($cl['time']) ?></span>
						</div>
						<div class="child-comments-list">
<?				if ($num) $numChild = 3;
				if (!$num) $order = 'time ASC';
				$cmtChildList = $getRecord -> GET($tbcmt, "`iid` = $iid AND `pid` = '{$cl['id']}' ", '', $order);
				foreach ($cmtChildList as $ccl) {
					$auc = getRecord('members^username,avatar', "id = {$cl['uid']}");
					if ($ccl['likes']) $cmtChildLikesAr = explode(', ', $ccl['likes']);
					else $cmtChildLikesAr = array();
					$cmtChildLikes = count($cmtChildLikesAr) ?>
							<div class="one-cmt child cmt-<? echo $ccl['id'] ?>" id="<? echo $ccl['id'] ?>">
								<img class="avatar-circle left" src="<? echo $auc['avatar'] ?>"/>
								<a href="#!user?u=<? echo $ccl['uid'] ?>" class="cmt-user-name bold left"><? echo $auc['username'] ?></a>
								<div class="cmt-content"><? echo tag($ccl['content']) ?></div>
								<div class="cmt-bottom tool" id="tool-cmt" alt="<? echo $ccl['id'] ?>">
									<a class="like-button small" id="like-cmt">
										<span class="num-like-cmt"><b><? if ($cmtChildLikes > 0) echo '<span class="fa fa-thumbs-up"></span> '.$cmtChildLikes ?></b></span>
										<span class="text"><? if (!in_array($u, $cmtChildLikesAr)) echo 'Like'; else echo 'Unlike' ?></span>
									</a>
									<span class="gensmall right cmt-time"><span class="fa fa-clock-o"></span> <? echo timeFormat($ccl['time']) ?></span>
								</div>
							</div>
<?				} ?>
						</div>
					</div>
				<? } ?>
