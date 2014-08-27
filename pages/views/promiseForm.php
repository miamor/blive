<div class="switch-status-update">
	<span id="form-update-promise" class="fa fa-coffee active" title="Promises"></span>
	<span id="form-update-request" class="fa fa-coffee" title="Requests"></span>
	<span id="form-update-feed" class="fa fa-tags" title="Update a status"></span>
	<div class="clearfix"></div>
</div>

<div class="the-form form-update-request hide">
	<form class="status-form top-form" data-p="request" data-a="mode=new">
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
		</div>
	</form>
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
		</div>
	</form>
</div>

<div class="the-form form-update-feed hide">
	<form method="post" enctype="multipart/form-data" data-p="feed" data-a="do=submitstt" class="status-form top-form" alt="<?php echo $member['id'] ?>" id="submitstt">
		<textarea name="status" id="update_stt" class="no-toolbar" placeholder="What on your mind"></textarea>
		<div class="form-custom">
			<div class="custom">
				<select name="p-privacy" class="p-privacy left">
					<option value="public">Public</option>
					<option value="draff">Draff</option>
				</select>
				<div id="submitphoto" class="left">
					<div class="btn btn-none btn-file submit_img fa fa-camera">
						<input type="file" accept="image/*" id="stt_photo" name="img"/>
					</div>
				</div>
				<input class="right" type="submit" name="ok_upload" id="oku" value="Submit">
				<div class="clearfix"></div>
				<div class="loading" style="float:right;margin:13px 10px 0 0;display:none"><img src="<?php echo $imgdir ?>/ajaxload.gif"/></div>
			</div>
		</div>
	</form>
</div>
