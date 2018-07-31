<?php
class Dashboard extends CI_Controller {


	public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->load->library('session');
				$this->load->helper('url');
				$this->load->model('dashboard_model');
				$this->load->model('master_model');
				$data="";
				if( !isset($this->session->userdata['logged_in']['login_id'])  ) {
					//echo 'hiiii';
					$this->load->view('login/login', $data);
				} else {
					//echo 'hiiii';die;
					$data['result'] = $this->master_model->get_active_session();
sizeof($data['result']);//die;
					if(sizeof($data['result'])>0){
					}else{
						$this->load->view('login/login', $data);
					}
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

        

		
		


		public function getInventoryData()
		{
			$result = $this->dashboard_model->getInventoryData();
			$data = array();
			$ttlcnt=0;
			foreach($result->result() as $r) {
				$ttlcnt=$ttlcnt+$r->cnt;
               $data[] = array(
				  
                   $r->inventory_name,
                   $r->cnt
               );
          }
		   $data[] = array(
				  
                   '<b>Total Count</b>',
                   '<b>'.$ttlcnt.'</b>'
               );

		  $output = array(
				"recordsTotal" => $result->num_rows(),
                 "recordsFiltered" => $result->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
		}

		public function getProjectwiseInventoryData()
		{
			$result = $this->dashboard_model->getProjectwiseInventoryData();
			//$invtype = $this->dashboard_model->getInventoryTypeData();
			$data = array();
			$ttlcnt=0;
			foreach($result->result() as $r) {
				
				$ttlcnt=$ttlcnt+$r->cnt;
				   $data[] = array(
					  $r->project_name,
					   $r->inventory_name,
					   $r->cnt
				   );
			
          }
		   $data[] = array(
				  
                   '<b>Total Count</b>',
					   '<b></b>',
                   '<b>'.$ttlcnt.'</b>'
               );

		  $output = array(
				"recordsTotal" => $result->num_rows(),
                 "recordsFiltered" => $result->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
		}


		public function getPOSwiseInventoryData()
		{
			$result = $this->dashboard_model->getPOSwiseInventoryData();
			//$invtype = $this->dashboard_model->getInventoryTypeData();
			$data = array();
			$ttlcnt=0;
			foreach($result->result() as $r) {
				
				$ttlcnt=$ttlcnt+$r->cnt;
				   $data[] = array(
					   $r->project_name,
					  $r->pos_name,
					   $r->inventory_name,
					   $r->cnt
				   );
			
          }
		   $data[] = array(
				  
                   '<b>Total Count</b>',
					   '<b></b>',
					    '<b></b>',
                   '<b>'.$ttlcnt.'</b>'
               );

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