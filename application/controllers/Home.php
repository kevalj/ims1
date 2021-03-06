<?php
class Home extends CI_Controller {


	public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->load->library('session');
				$this->load->helper('url');
				$this->load->model('home_model');
				$this->load->model('dashboard_model');
				//$my_session_id = session_id(); //gets the session ID successfully
				//$this->session->userdata('session_id', $my_session_id); 
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

        public function view($page = 'home')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
		$this->load->helper('url');
		

        $this->load->view('views/index', $data);
        } else{
			$this->load->view('login/login', $data);
		}
		
		}

		public function signup($page = 'signup')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		$this->load->helper('url');
		
        $this->load->view('login/signup', $data);
        
		
		}

		public function dashboard($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		

		$this->form_validation->set_rules('userid', 'User ID', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {

		$this->load->view('login/login', $data);
		
		} else{
			$data = array(
				'userid' => $this->input->post('userid'),
				'password' => md5($this->input->post('password'))
		);
			//echo $this->session->userdata['__ci_last_regenerate'];
			//print_r($this->session);die;
			$result = $this->home_model->login_user();
			if($result==false){
				$data['loginmsg']="Invalid User Name Or Password";
				$this->load->view('login/login', $data);
			} else{
				$parent = $this->home_model->get_parent_menu_data($result[0]['role_id']);
				$child = $this->home_model->get_child_menu_data($result[0]['role_id']);

				//$pos = $this->home_model->get_user_pos_data($result[0]['id']);
				//$project = $this->home_model->get_user_project_data($result[0]['id']);
				$service_center = $this->home_model->get_user_service_center_data($result[0]['id']);
				$depot = $this->home_model->get_user_depot_data($result[0]['id']);
				
				


				$session_data = array(
					'username' => $result[0]['user_name'],
					'email' => $result[0]['email'],
					'userid' => $result[0]['id'],
					'login_id' => $result[0]['login_id'],
					'role_id' => $result[0]['role_id'],
					'role_name' => $result[0]['role_name'],
					'parent' =>$parent,
                    'child' =>$child,
					//'pos' =>$pos[0]['project_pos_details_id'],
					//'project' => $project[0]['project_id'],
					'depot' => $depot[0]['depotId'],
					'service_center' =>$service_center[0]['project_service_center_id']
					);
				$this->session->set_userdata('logged_in', $session_data);

				//print_r($_SESSION['logged_in']);die;
				$data['pie_chart_data'] = $this->dashboard_model->getPieChartData();

				$this->load->view('template/header', $data);
				$this->load->view('dashboard/index', $data);
				$this->load->view('template/footer', $data);
			}

		}
		
		
        
		
		}


		public function home_dashboard($page = 'dashboard')
		{
			$data['title'] = ucfirst($page);
			if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

				$data['pie_chart_data'] = $this->dashboard_model->getPieChartData();
				$this->load->view('template/header', $data);
				$this->load->view('dashboard/index', $data);
				$this->load->view('template/footer', $data);
				} else{
			$this->load->view('login/login', $data);
		}
		
		}

		public function getBarChartRegionData()
		{
			$result = $this->dashboard_model->getBarChartRegionData();
			$data = array();
			$ttlcnt=0;
			foreach($result->result() as $r) {
				$ttlcnt=$ttlcnt+$r->cnt;
               $data[] = array(
				  
                   $r->project_name,
                   $r->cnt,
				   $r->faultycnt
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

		public function getBarChartDivisionData()
		{
			$divisionid=$_POST['divisionid'];
			$result = $this->dashboard_model->getBarChartDivisionData($divisionid);
			$data = array();
			$ttlcnt=0;
			foreach($result->result() as $r) {
				$ttlcnt=$ttlcnt+$r->cnt;
               $data[] = array(
				  
                   $r->pos_name,
                   $r->cnt,
				   $r->faultycnt
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

		public function getBarChartDepotData()
		{
			$depotid=$_POST['depotid'];
			$result = $this->dashboard_model->getBarChartDepotData($depotid);
			$data = array();
			$ttlcnt=0;
			foreach($result->result() as $r) {
				$ttlcnt=$ttlcnt+$r->cnt;
               $data[] = array(
				  
                   $r->depot_name,
                   $r->cnt,
				   $r->faultycnt
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

		public function myaccount($page = 'myaccount')
		{
			    $data['title'] = ucfirst($page);

				if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

				if($_SESSION['logged_in']['company_admin']=='Y') {

				$data['get_companyuser_data'] = $this->home_model->get_companyuser_data();
   
				$this->load->view('template/header', $data);
				$this->load->view('dashboard/myaccount', $data);
				$this->load->view('template/footer', $data);
				} else{
				$this->load->view('template/header', $data);
				$this->load->view('dashboard/index', $data);
				$this->load->view('template/footer', $data);
				}
				} else{
			$this->load->view('login/login', $data);
		}
		
		}

		public function chngsetting($page = 'myaccount'){
			 $data['title'] = ucfirst($page);
			 if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

			$this->form_validation->set_rules('email', 'EmailId', 'trim|required');
			//$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('userid', 'UserId', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['get_user_data'] = $this->home_model->get_user_data();
   
				$this->load->view('template/header', $data);
				$this->load->view('dashboard/setting', $data);
				$this->load->view('template/footer', $data);

		$this->load->view('login/signup', $data);
		
		} else{
			$this->home_model->update_user_data();
			$data['get_user_data'] = $this->home_model->get_user_data();
   
				$this->load->view('template/header', $data);
				$this->load->view('dashboard/setting', $data);
				$this->load->view('template/footer', $data);

		}
		} else{
			$this->load->view('login/login', $data);
		}

		}

		public function setting($page = 'myaccount')
		{
			    $data['title'] = ucfirst($page);

				if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
				

				$data['get_user_data'] = $this->home_model->get_user_data();
   
				$this->load->view('template/header', $data);
				$this->load->view('dashboard/setting', $data);
				$this->load->view('template/footer', $data);
				} else{
			$this->load->view('login/login', $data);
		}
		
		}

		public function profile($page = 'profile')
		{
			    $data['title'] = ucfirst($page);

				if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
				

				$data['get_detail_user_data'] = $this->home_model->get_detail_user_data();
   
				$this->load->view('template/header', $data);
				$this->load->view('dashboard/profile', $data);
				$this->load->view('template/footer', $data);
				} else{
			$this->load->view('login/login', $data);
		}
				
		
		}

		public function delete_user(){
			$userid=$_POST['userid'];
			$deleteuser=$this->home_model->deleteuser($userid);
			echo 'success';die;
			
		}

		public function add_user(){
			$userid=$_POST['userid'];
			$username=$_POST['username'];
			$password=$_POST['password'];
			$email=$_POST['email'];
			$gender=$_POST['gender'];

			$checkuseridexist=$this->home_model->checkuseridexist();
			if($checkuseridexist=='error'){
			echo 'UserId Already Exist. Please try Different UserId';
			die;
			}
			$checkemailexist=$this->home_model->checkemailexist();
			if($checkemailexist=='error'){
			echo 'EmailId Already Exist. Please try Different EmailId';
			die;
			}
			$maxconn=0;
			$get_maxconn_data=$this->home_model->get_maxconn_data();

			foreach($get_maxconn_data->result() as $r) {

				$maxconn=$r->max_user;

          }

		  $checkenoofuser=$this->home_model->checkenoofuser();
		  if($checkenoofuser>=$maxconn){
			  echo "More Users are not allowed.";die;
		  }

		  $add_user=$this->home_model->add_user();
		  if($add_user==1){
			  echo "success";die;
		  }else{
			  echo "Error. Please try again later";die;
		  }

		}

		 public function checkcompanyexist($str)
        {
			 $checkcompanyexist = $this->home_model->checkcompanyexist();
                if ($checkcompanyexist=="error")
                {
                        $this->form_validation->set_message('checkcompanyexist', 'The Company Name is already exist in application');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }

		 public function checkuseridexist($str)
        {
			 $checkuseridexist = $this->home_model->checkuseridexist();
                if ($checkuseridexist=="error")
                {
                        $this->form_validation->set_message('checkuseridexist', 'The User Id is already exist in application. Please try different User Id.');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }

		 public function checkemailexist($str)
        {
			 $checkemailexist = $this->home_model->checkemailexist();
                if ($checkemailexist=="error")
                {
                        $this->form_validation->set_message('checkemailexist', 'The Email Id is already exist in application');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }

		 public function checkpasswordexist($str)
        {
			
             if($this->input->post('password')!=$this->input->post('confpassword'))
                {
                        $this->form_validation->set_message('checkpasswordexist', 'Password and Confirm Password Not Matching');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }

		public function mcbot($str)
        {
			
             if(trim($this->input->post('mc'))=="" && trim($this->input->post('bot'))=="")
                {
                        $this->form_validation->set_message('mcbot', 'MC Number OR BOT Number Required');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }


		public function signup_user($page = 'signup_user')
		{
		$data['title'] = ucfirst($page); // Capitalize the first letter
 
 

		$this->form_validation->set_rules('companyname', 'Company Name', 'trim|required');
		$this->form_validation->set_rules('companyname', 'Company Name', 'callback_checkcompanyexist');
		$this->form_validation->set_rules('companyaddress', 'Company Address', 'trim|required');
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('email', 'EmailID', 'trim|required');
		$this->form_validation->set_rules('email', 'EmailID', 'callback_checkemailexist');
		$this->form_validation->set_rules('userid', 'User ID', 'trim|required');
		$this->form_validation->set_rules('userid', 'User ID', 'callback_checkuseridexist');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confpassword', 'Confirm Password', 'trim|required');
		$this->form_validation->set_rules('confpassword', 'Confirm Password', 'callback_checkpasswordexist');
		$this->form_validation->set_rules('mc', 'MC Nuber', 'callback_mcbot');

		

		if ($this->form_validation->run() == FALSE) {

		$this->load->view('login/signup', $data);
		
		} else{
			
			


			$data = array(
				'fullname' => $this->input->post('fullname'),
				'email' => $this->input->post('email'),
				'gender' => $this->input->post('gender'),
				'userid' => $this->input->post('userid'),
				'password' => md5($this->input->post('password')),
				'confpassword' => $this->input->post('confpassword')
		);
			$get_sysconfig_data = $this->home_model->get_sysconfig_data();
			$activation_periode=0;
			$max_conn=0;
			foreach($get_sysconfig_data->result() as $r) {

				if($r->sys_config_name=='activation_periode'){
					$activation_periode=$r->sys_config_value;
				}
				if($r->sys_config_name=='max_user'){
					$max_conn=$r->sys_config_value;
				}

          }

			$result = $this->home_model->signup_user($activation_periode,$max_conn);
			if($result>0){
				$data['loginmsg']="User Created successfully. Please login to access application";
				$this->load->view('login/login', $data);
			} else{
				$this->load->view('login/signup', $data);
			}
			}
			//echo $result;

		
		
		}


		public function logout($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
	
			$result = $this->home_model->logout_user();
			$session_data = array(
					'username' => '',
					'email' => '',
					'userid' => '',
					'login_id' => ''
					);
					$this->session->unset_userdata($session_data);
			$this->session->sess_destroy();
			
				$this->load->view('login/login', $data);

				} else{
			$this->load->view('login/login', $data);
		}
			
		}



}
?>