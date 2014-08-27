<?
Class communityController {
	protected $model;
	protected $view;

	private $hoten;
	private $tuoi;
	function __construct () {
		$this->model = communityModel::getInstance();
		$this->view = communityView::getInstance();
	}

	function __destruct() {
	}

	public function addActivity ($params) {
		$this->view->data['content'] = $params['content'];
		$this->model->addActivity($this->view->data);
	}

	public function showActivity () {
		$records = $this->model->getActivity();
		foreach ($records as $one)
			$this->view->data[] = $one;
		$this->view->showActivity();
	}

}
?>
