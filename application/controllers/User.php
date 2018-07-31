<?php
class User extends CI_Controller {


	public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->load->library('session');
				$this->load->helper('url');
				$this->load->model('load_model');
				$this->load->model('master_model');
				$this->load->model('trip_model');
				$this->load->model('expense_model');
				$this->load->model('user_model');
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
				
        }

        

		
		public function user_role($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
		$this->load->helper('url');
		
		$data['user'] = $this->user_model->getuserData();
		
		
		$this->load->view('template/header', $data);
        $this->load->view('user/user_role', $data);
		$this->load->view('template/footer', $data);

		} else{
			$this->load->view('login/login', $data);
		}
        
		
		}

		
		public function getuserRoleData()
		{
			$id=$_POST['id'];
			$result = $this->user_model->getuserRoleData($id);
			$data = array();
			$role_id=0;
			foreach($result->result() as $r) {
				$role_id=$r->role_id;
               $data[] = array(
				   $r->role_id,
                   $r->role_name,
                   
               );
          }

		  if($role_id==1){
				$output = array(
                 "data" => $data
            );
		  }

		  
		  if($role_id==3){
             $result = $this->user_model->getDepotData();
			 foreach($result->result() as $r) {
				
               $data1[] = array(
				   $r->depotId,
                   $r->depot_name,
                   
               );
          }
		  $output = array(
                 "data" => $data,
				 "data1" => $data1
            );
		  }


		  if($role_id==4){
             $result = $this->user_model->getServiceCenterData();
			 foreach($result->result() as $r) {
				
               $data1[] = array(
				   $r->project_service_center_id,
                   $r->service_center_name,
                   
               );
          }
		  $output = array(
                 "data" => $data,
				 "data1" => $data1
            );
		  }
          echo json_encode($output);
          exit();
		}


		public function getProjectPOSServiceCenterData()
		{
			$id=$_POST['id'];
			//echo sizeof($_POST['id']);
			 $userrole=$_POST['userrole'];
			$data = array();
			$id=0;
			if($_POST['id']!=""){
				//echo 'aaaaa';
				for($i=0;$i<sizeof($_POST['id']);$i++){
					
					 $id=$id.",".$_POST['id'][$i];
				}
			}

			if($userrole==3){
				$result = $this->user_model->getProjectPOSData($id);
				foreach($result->result() as $r) {
				 $data[] = array(
				   $r->project_pos_details_id,
                   $r->pos_name,
                   
               );
          }
			}
			if($userrole==4){
				$result = $this->user_model->getProjectServiceCenterData($id);
				foreach($result->result() as $r) {
				 $data[] = array(
				   $r->project_service_center_id,
                   $r->service_center_name,
                   
               );
          }
			}
			

		  $output = array(
                 "data" => $data,
			 
            );
          echo json_encode($output);
          exit();
		}


		

		public function saveuserRightsData()
		{
			//$project=$_POST['project'];
			$userrole=$_POST['userrole'];
			//$pos=$_POST['pos'];
			//$service_center=$_POST['service_center'];
			

			$result = $this->user_model->saveuserRightsData();
			if($result=='success'){
				echo "Roles Added Successfully";
			}else{
				echo "Error.. Try again later";
			}
			
          //echo json_encode($output);
          exit();
		}


		public function getuserRoleViewData() {
        $result = $this->user_model->getuserRoleViewData();
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                '<input type="radio" id="id" name="id" value="' . $r->id . '">',
                $r->user_id,
                $r->user_name,
				$r->role_name,
				$r->depot_name,
				$r->service_center_name
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


	public function view_user_role($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
		$this->load->helper('url');
		
		$data['user'] = $this->user_model->getuserData();
		
		
		$this->load->view('template/header', $data);
        $this->load->view('user/view_user_role', $data);
		$this->load->view('template/footer', $data);

		} else{
			$this->load->view('login/login', $data);
		}
        
		
		}


		public function edit_user_role($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
		$this->load->helper('url');
        $id = $_REQUEST['id'];
		$role_id=0;

		if ($id > 0) {
			    $data['user'] = $this->user_model->getuserEditData($id);
                $data['user1'] = $this->user_model->getuserEditData1($id);

				foreach ($data['user1']->result() as $r) {

					$role_id=$r->role_id;

					}
				

				if($role_id==3){
					$data['depot'] = $this->user_model->getDepotEditData($id);

				}

				if($role_id==4){
					$data['service_center'] = $this->user_model->getProjectServiceCenterEditData($id);
				}

				$this->load->view('template/header', $data);
				$this->load->view('user/edit_user_role', $data);
				$this->load->view('template/footer', $data);
            } else {
                $this->load->view('template/header', $data);
				$this->load->view('user/view_user_role', $data);
				$this->load->view('template/footer', $data);
            }
		
		

		} else{
			$this->load->view('login/login', $data);
		}
        
		
		}
		

		

		
}
?>