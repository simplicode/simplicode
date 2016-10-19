<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Senddata extends CI_Controller {

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

			if (isset($_POST['grupo'])) {
				
				$grupo = $_POST['grupo'];
				$dispositivo = $_POST['dispositivo'];
				$mensaje = $_POST['mensaje'];

				$this->datamodel->upload_command($grupo, $dispositivo, $mensaje);

			} elseif (isset($_GET['grupo'])) {

				$grupo = $_GET['grupo'];
				$dispositivo = $_GET['dispositivo'];

				for ($i=0; $i < 10; $i++) { 
					$command = $this->datamodel->download_command($grupo, $dispositivo);
					if (count($command)>0) {
						echo json_encode($command);
						break;
					} else {
						sleep(5);
					}
				}

			}

		}

		public function verify()
		{
			if (isset($_GET['grupo'])) {

				$grupo = $_POST['grupo'];
				$dispositivo = $_POST['dispositivo'];
				$id = $_POST['id'];

				header('Not found', true, 404);
				header('Pending', true, 202);

			}

		}
	}
