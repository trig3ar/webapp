<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	function __construct(){
		parent::__construct();
		isLoggedIn();
	}

	public function index(){
		//pr($this->session->userdata('user_id'));
		//pr($this->session->all_userdata());
		loadBackLayout('dashboard_view');
	}

}
