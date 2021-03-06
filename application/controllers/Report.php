<?php
class Report extends CI_Controller {


	public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->load->library('session');
				$this->load->helper('url');
				$this->load->model('report_model');
				$this->load->model('master_model');
				
				$data="";
				if( !isset($this->session->userdata['logged_in']['login_id'])  ) {
					//echo 'hiiii';
					$this->load->view('login/login', $data);
				} else {
					//echo 'hiiii';die;
					//$data['result'] = $this->master_model->get_active_session();
//sizeof($data['result']);//die;
					//if(sizeof($data['result'])>0){
					//}else{
					//	$this->load->view('login/login', $data);
					//}
					//print_r($data['result']);
				}
				/**$this->load->model('home_model');
				$this->load->model('profile_model');
				if( !isset($this->session->userdata['logged_in']['uniqueid'])  ) {
					$uniqueid = $this->home_model->get_unique_id();
					$uniqueval=$uniqueid['view_count'];
					$session_data = array(
					 'uniqueid' => $uniqueval
					);
					// Add user data in session
				$this->session->set_userdata('logged_in', $session_data);
				}
				$result = $this->home_model->public_user_log(1);

				$this->load->model('login_model');

				if(isset($_SESSION['logged_in']['userid']) && !empty($_SESSION['logged_in']['userid'])) {
					 $this->login_model->login_history_update($_SESSION['logged_in']['userid']);
				}
				**/
        }

        

		public function inventory_details($page = 'report'){

			$data['title'] = ucfirst($page); // Capitalize the first letter
		//echo 'hiiii';

		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

			$data['region'] = $this->report_model->getRegion();
		
		$this->load->view('template/header', $data);
        $this->load->view('report/inventory_details', $data);
		$this->load->view('template/footer', $data);

		} else{
			$this->load->view('login/login', $data);
		}

		}


		



		public function getProjectwiseData()
		{
			$result=$this->report_model->getProjectwiseData();
			$data = array();
			foreach($result->result() as $r) {

				


				
               $data[] = array(
				   '<a href="#" onclick="getPOSwiseData('.$r->project_id.')">'.$r->project_name.'</a>',
                   $r->cnt,
				   
               );
          }

		  $output = array(
				"recordsTotal" => $result->num_rows(),
                 "recordsFiltered" => $result->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
		}

		public function getPOSwiseData()
		{
			$result=$this->report_model->getPOSwiseData();
			$data = array();
			foreach($result->result() as $r) {

				


				
               $data[] = array(
				   '<a href="#" onclick="getPOSwiseData('.$r->project_pos_details_id.')">'.$r->pos_name.'</a>',
                   $r->cnt,
				   
               );
          }

		  $output = array(
				"recordsTotal" => $result->num_rows(),
                 "recordsFiltered" => $result->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
		}

		public function faulty_inventory_detail($page = 'report'){

			$data['title'] = ucfirst($page); // Capitalize the first letter
		//echo 'hiiii';

		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
		
		$data['region'] = $this->report_model->getRegion();
		$this->load->view('template/header', $data);
        $this->load->view('report/faulty_inventory_detail', $data);
		$this->load->view('template/footer', $data);

		} else{
			$this->load->view('login/login', $data);
		}

		}

		


		public function getInventoryData()
		{
			$region=$_GET['region'];
			$division=$_GET['division'];
			$depot=$_GET['depot'];

			$result=$this->report_model->getInventoryData($region,$division,$depot);
			$data = array();
			foreach($result->result() as $r) {

				


				
               $data[] = array(
				   $r->inventory_sr_no,
                   $r->inventory_name,
				   $r->project_name,
				   $r->pos_name,
				   $r->depot_name
				   
               );
          }

		  $output = array(
				"recordsTotal" => $result->num_rows(),
                 "recordsFiltered" => $result->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
		}


		public function getfaultyInventoryData()
		{
			$region=$_GET['region'];
			$division=$_GET['division'];
			$depot=$_GET['depot'];

			$result=$this->report_model->getFaultyInventoryData($region,$division,$depot);
			$data = array();
			foreach($result->result() as $r) {

				


				
               $data[] = array(
				   $r->inventory_sr_no,
                   $r->inventory_name,
				   $r->project_name,
				   $r->pos_name,
				   $r->depot_name,
				   $r->stCategoryReasonName
				   
               );
          }

		  $output = array(
				"recordsTotal" => $result->num_rows(),
                 "recordsFiltered" => $result->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
		}


		
}
?>