<?php
class ControllerCommonSlidebar extends Controller {
	public function index() {
		$data = array();

		return $this->load->view('common/slidebar', $data);
	}
}
