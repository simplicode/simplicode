<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('datamodel');
	}

	public function index()
	{
	    if (isset($_POST['data'])) {
		    $csv = array_map('str_getcsv', explode("\n",$_POST['data']));
		    array_walk($csv, function(&$a) use ($csv) {
		      $a = array_combine($csv[0], $a);
		    });
		    array_shift($csv);
			$this->datamodel->upload_data($csv);
	    } else {
	    	echo '<pre>' . var_export($this->datamodel->download_data(), true) . '</pre>';
	    }

	}

	public function getdevices($id = "0") {

		if ($id == 0) {
			echo json_encode($this->datamodel->get_current_devices());
		} else {
			echo json_encode($this->datamodel->get_devices($id));
		}

		
	}
}
