<?
class communityView {
	private static $instance;
	public $data = array();

	function __construct () {
	}

	function __destruct () {
	}

	public static function getInstance () {
		if (!self::$instance) {
			self::$instance = new communityView();
		}
		return self::$instance;
	}

	public function __set ($index,$value) {
		$this->data[$index] = $value;
	}
	
	public function showActivity () {
		foreach ($this->data as $value) { ?>
			<div class="one-activity">
				<div class="one-activity-avatar-user left">
					<img class="avatar-circle" src="https://scontent-b-pao.xx.fbcdn.net/hphotos-prn2/t1.0-9/1620498_433280320144732_5734580470169334630_n.jpg"/>
				</div>
				<div class="one-activity-content">
					<? echo $value['content'] ?>
				</div>
			</div>
<? 		}
	}
} ?>
