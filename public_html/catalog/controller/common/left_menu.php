<?php
class ControllerCommonLeftMenu extends Controller {
	public function index() {
		// Left menu
        $data = array();
		return $this->load->view('common/left_menu', $data);
	}
}
