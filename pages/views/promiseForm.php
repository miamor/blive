<div class="switch-status-update">
	<span id="form-update-promise" class="fa fa-coffee active" title="Promises"></span>
	<span id="form-update-request" class="fa fa-coffee" title="Requests"></span>
	<span id="form-update-feed" class="fa fa-tags" title="Update a status"></span>
	<div class="clearfix"></div>
</div>

<div class="the-form form-update-promise hide" style="display:block">
	<form class="status-form top-form" data-p="promise" data-a="mode=new">
		<textarea name="p-status" class="no-toolbar"></textarea>
		<div class="form-custom">
			<div class="custom">
				<input type="number" name="p-money" class="p-money" placeholder="Bet some coins?"/>
				<div class="p-money-type">
					<img class="money-type-select selected" id="coin" src="<? echo IMG ?>/coins.png"/>
					<img class="money-type-select" id="gold" src="<? echo IMG ?>/dollar_coin.png"/>
					<input type="hidden" name="p-money-type" value="coin">
				</div>
				<select name="p-privacy" class="p-privacy">
					<option value="public">Public</option>
					<option value="draff">Draff</option>
				</select>
				<input class="right" type="submit" value="Submit">
				<div class="clearfix"></div>
			</div>
			<label class="checkbox" title="<? if (!$member['token']) echo 'You need to login/sync your blive account with your facebook account to use this feature'; else echo 'This might take a while' ?>">
				<input type="checkbox" <? if (!$member['token']) echo 'disabled' ?> name="post-to-fb"/> Post to facebook
			</label>
		</div>
	</form>
</div>

<div class="the-form form-update-request hide">
	<form class="status-form top-form" data-p="request" data-a="mode=new">
		<textarea name="p-status" class="no-toolbar"></textarea>
		<div class="form-custom">
			<div class="custom">
				<div class="p-type-div">
					<div class="left">You're: </div>
					<select name="p-type" class="p-type right">
						<option value="need" selected>Needing help</option>
						<option value="add">Adding a favor</option>
					</select>
					<div class="clearfix"></div>
				</div>
				<div class="p-tags">
					<input type="text" name="tags" id="tagsinput" class="tagsinput"/>
					<div class="clearfix"></div>
				</div>
				<select name="p-privacy" class="p-privacy">
					<option value="public">Public</option>
					<option value="draff">Draff</option>
				</select>
				<input class="right" type="submit" value="Submit">
				<div class="clearfix"></div>
			</div>
			<label class="checkbox" title="<? if (!$member['token']) echo 'You need to login/sync your blive account with your facebook account to use this feature'; else echo 'This might take a while' ?>">
				<input type="checkbox" <? if (!$member['token']) echo 'disabled' ?> name="post-to-fb"/> Post to facebook
			</label>
		</div>
	</form>
</div>

<div class="the-form form-update-feed hide">
	<form method="post" enctype="multipart/form-data" data-p="feed" data-a="do=submitstt" class="status-form top-form" alt="<?php echo $member['id'] ?>" id="submitstt">
		<textarea name="status" id="update_stt" class="no-toolbar" placeholder="What on your mind"></textarea>
		<div class="form-custom">
			<div class="custom">
				<div id="submitphoto">
					<div id="filediv">
						<input name="img[]" type="file" accept="image/*" class="btn-upload-img" id="stt_photo"/>
					</div>
					<input type="button" id="add_more" class="upload btn hide" value="+"/>
					<div class="clearfix"></div>
				</div>
				<select name="p-privacy" class="p-privacy left">
					<option value="public">Public</option>
					<option value="draff">Draff</option>
				</select>
				<input class="right" type="submit" name="ok_upload" id="oku" value="Submit">
				<div class="clearfix"></div>
				<div class="loading" style="float:right;margin:13px 10px 0 0;display:none"><img src="<?php echo $imgdir ?>/ajaxload.gif"/></div>
			</div>
			<label class="checkbox" title="<? if (!$member['token']) echo 'You need to login/sync your blive account with your facebook account to use this feature'; else echo 'This might take a while' ?>">
				<input type="checkbox" <? if (!$member['token']) echo 'disabled' ?> name="post-to-fb"/> Post to facebook
			</label>
		</div>
	</form>
</div>


<div class="form-alerts"></div>
