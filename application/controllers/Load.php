<?php
class Load extends CI_Controller {


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

		
		public function loads($page = 'loads')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter

		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {


		$this->load->helper('url');
		$data['result'] = $this->trip_model->get_state();
		$data['result1'] = $this->master_model->get_customer_type();
		
		$data['driver_rate'] = $this->load_model->get_driver_rate(0)->result_array();
		
		//print_r($data['result1']);die;
		$this->load->view('template/header', $data);
        $this->load->view('loads/loads', $data);
		$this->load->view('template/footer', $data);
        /**$this->load->view('templates/banner', $data);
		$this->load->view('templates/home_profile', $data);
		$this->load->view('templates/success_stories', $data);
		$this->load->view('templates/news_events', $data);
        $this->load->view('templates/footer', $data);**/
		} else{
			$this->load->view('login/login', $data);
		}
		
		}

        

		public function get_vehicle_data()
		{
			//echo $this->input->get('term');
			$result = $this->load_model->get_vehicle_data($this->input->get('term'));
			$output = array();
			foreach($result->result() as $r) {
				 $output[] = array('id'=> $r->vehicle_id,'label'=> $r->vehicle_no,'value'=> $r->vehicle_no);

               
          }

		 
          echo json_encode($output);
          exit();
		}

		public function get_customer_data()
		{
			//echo $this->input->get('term');
			$result = $this->load_model->get_customer_data($this->input->get('term'));
			$output = array();
			foreach($result->result() as $r) {
				 $output[] = array('id'=> $r->customer_id,'label'=> $r->customer_name."(".$r->cust_id.")",'value'=> $r->customer_name);

               
          }

		 
          echo json_encode($output);
          exit();
		}

		public function get_driver_data()
		{
			//echo $this->input->get('term');
			$result = $this->load_model->get_driver_data($this->input->get('term'));
			$output = array();
			foreach($result->result() as $r) {
				 $output[] = array('id'=> $r->driver_id,'label'=> $r->driver_name."(".$r->driv_id.")",'value'=> $r->driver_name);

               
          }

		 
          echo json_encode($output);
          exit();
		}


		public function get_codriver_data()
		{
			//echo $this->input->get('term');
			$result = $this->load_model->get_codriver_data($this->input->get('term'));
			$output = array();
			foreach($result->result() as $r) {
				 $output[] = array('id'=> $r->driver_id,'label'=> $r->driver_name,'value'=> $r->driver_name);

               
          }

		 
          echo json_encode($output);
          exit();
		}


		public function addLoad($page = 'dashboard')
		{
			$data['title'] = ucfirst($page); // Capitalize the first letter

			if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
   
        
		$this->load->helper('url');
		//echo $this->input->post('shipper_id')[0];
		//print_r($_POST);
		
		$this->form_validation->set_rules('load_no', 'Customer Load No', 'trim|required');
		$this->form_validation->set_rules('customer_id', 'Customer Name', 'trim|required');
		
		//echo $_POST['driver_count'];
//$result = $this->load_model->save_load_data();
//print_r($this->form_validation);
		if ($this->form_validation->run() == FALSE) {
			//echo '1111';
			//die;
		$data['driver_rate'] = $this->load_model->get_driver_rate(0)->result_array();
		$this->load->view('template/header', $data);
        $this->load->view('loads/loads', $data);
		$this->load->view('template/footer', $data);
        } else{
			$result = $this->load_model->save_load_data();
			//die;
			$this->load->view('template/header', $data);
        $this->load->view('loads/view_load', $data);
		$this->load->view('template/footer', $data);
		}

		} else{
			$this->load->view('login/login', $data);
		}
		
		}

	public function editLoad($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {


		$this->load->helper('url');
		//echo $this->input->post('shipper_id')[0];
		//print_r($_POST);
		
		$this->form_validation->set_rules('load_no', 'Customer Load No', 'trim|required');
		$this->form_validation->set_rules('customer_id', 'Customer Name', 'trim|required');
		
		//echo $_POST['driver_count'];
//$result = $this->load_model->save_load_data();
//print_r($this->form_validation);
		if ($this->form_validation->run() == FALSE) {
			//echo '1111';
			//die;
			$id=$_POST['loading_id'];
		$data['fsc_amount_type'] = $this->master_model->get_fsc_amount_type();
			$data['fee_type'] = $this->master_model->get_fee_type();
			//$data['status'] = $this->master_model->get_status();
			$data['status'] = $this->load_model->get_load_status1();
			$data['quantity_type'] = $this->master_model->get_quantity_type();
			$data['result'] = $this->load_model->get_sel_load_data($id);
			$data['result1'] = $this->load_model->get_sel_load_pic_data($id);
			$data['result2'] = $this->load_model->get_sel_load_del_data($id);
			$data['result3'] = $this->load_model->get_sel_load_doc_data($id);
			$data['driver_rate'] = $this->load_model->get_driver_rate(0)->result_array();

			$data['state'] = $this->trip_model->get_state();
		    $data['cust_type'] = $this->master_model->get_customer_type();
			//print_R($data['result']);
			$this->load->view('template/header');
			$this->load->view('loads/edit_load', $data);
			$this->load->view('template/footer');
        } else{
			$result = $this->load_model->edit_load_data();
			//die;
			$this->load->view('template/header', $data);
        $this->load->view('loads/view_load', $data);
		$this->load->view('template/footer', $data);
		}
		} else{
			$this->load->view('login/login', $data);
		}
		
		}

		public function getLoadData()
		{
			$result = $this->load_model->get_load_data();
			$loadstatus = $this->load_model->get_load_status();
			$data = array();
			
			
			//die;

			 

			foreach($result->result() as $r) {
				$buttonstr="<input type='button' value='Change Status' onclick='changestatus(".$r->loading_id.")'>";
				$selectsrt="<select name='status' id='".$r->loading_id."'>";
				$selectsrt1="";
				foreach($loadstatus->result() as $s) {
					$selected="";
					if($s->status_code==$r->status){
						$selected="selected";
					}
				 $selectsrt1=$selectsrt1."<option value='".$s->status_code."'  ".$selected.">".$s->status_name."</option>";
			}
			 $selectsrt1=$selectsrt1."</select>";

               $data[] = array(
				   '<input type="radio" id="id" name="id" value="'.$r->loading_id.'">',
                   $r->loading_id,
                   $r->load_no,
                   $r->pickup_date,
                   $r->delivery_date,
				   $r->customer_name,
				   $r->froms,
				   $r->tos,
                   $r->bol,
				   $selectsrt.$selectsrt1,
				   $buttonstr,
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


		public function view_load($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

		$this->load->helper('url');
		//$data['featured_profile'] = $this->profile_model->get_featured_profile();
		
		$this->load->view('template/header', $data);
        $this->load->view('loads/view_load', $data);
		$this->load->view('template/footer', $data);
		} else{
			$this->load->view('login/login', $data);
		}
        
		
		}

		public function editLoadData($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
		$this->load->helper('url');
		$id=$_REQUEST['id'];
		

		if ($id >0) {
			$data['fsc_amount_type'] = $this->master_model->get_fsc_amount_type();
			$data['fee_type'] = $this->master_model->get_fee_type();
			//$data['status'] = $this->master_model->get_status();
			$data['status'] = $this->load_model->get_load_status1();
			$data['quantity_type'] = $this->master_model->get_quantity_type();
			$data['result'] = $this->load_model->get_sel_load_data($id);
			$data['result1'] = $this->load_model->get_sel_load_pic_data($id);
			$data['result2'] = $this->load_model->get_sel_load_del_data($id);
			$data['result3'] = $this->load_model->get_sel_load_doc_data($id);
			$data['driver_rate'] = $this->load_model->get_driver_rate(0)->result_array();

			$data['state'] = $this->trip_model->get_state();
		    $data['cust_type'] = $this->master_model->get_customer_type();
			//print_R($data['result']);
			$this->load->view('template/header');
			$this->load->view('loads/edit_load', $data);
			$this->load->view('template/footer');
        } else{
			$this->load->view('template/header', $data);
			$this->load->view('loads/view_load', $data);
			$this->load->view('template/footer', $data);
		}
		} else{
			$this->load->view('login/login', $data);
		}
		
		}


		public function viewLoadData($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter

		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

		$this->load->helper('url');
		$id=$_REQUEST['id'];
		

		if ($id >0) {
			$data['fsc_amount_type'] = $this->master_model->get_fsc_amount_type();
			$data['fee_type'] = $this->master_model->get_fee_type();
			//$data['status'] = $this->master_model->get_status();
			$data['status'] = $this->load_model->get_load_status1();
			$data['quantity_type'] = $this->master_model->get_quantity_type();
			$data['result'] = $this->load_model->get_sel_load_data($id);
			$data['result1'] = $this->load_model->get_sel_load_pic_data($id);
			$data['result2'] = $this->load_model->get_sel_load_del_data($id);
			$data['result3'] = $this->load_model->get_sel_load_doc_data($id);
			$data['driver_rate'] = $this->load_model->get_driver_rate(0)->result_array();

			$data['state'] = $this->trip_model->get_state();
		    $data['cust_type'] = $this->master_model->get_customer_type();
			//print_R($data['result']);
			$this->load->view('template/header');
			$this->load->view('loads/view_editload', $data);
			$this->load->view('template/footer');
        } else{
			$this->load->view('template/header', $data);
			$this->load->view('loads/view_load', $data);
			$this->load->view('template/footer', $data);
		}

		} else{
			$this->load->view('login/login', $data);
		}
		
		}




		public function loadedit($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter

		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

		$this->load->helper('url');
		//print_r($_POST);
		
		$this->form_validation->set_rules('vehicle_id', 'Vehicle No', 'trim|required');
		$this->form_validation->set_rules('customer_id', 'Customer Name', 'trim|required');
		$this->form_validation->set_rules('load_no', 'Load No.', 'trim|required');
		$this->form_validation->set_rules('driver_id', 'Driver Name', 'trim|required');
		$this->form_validation->set_rules('codriver_id', 'Co-Driver Name', 'trim|required');
		$this->form_validation->set_rules('pickup_date', 'Pickup Date', 'trim|required');
		$this->form_validation->set_rules('pickup_location', 'Pickup Location', 'trim|required');
		$this->form_validation->set_rules('delivery_date', 'Delivery Date', 'trim|required');
		$this->form_validation->set_rules('delivery_location', 'Delivery Location', 'trim|required');
		$this->form_validation->set_rules('load_rate', 'Load Rate', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
		//echo 'aaaaaaaa';
		//print_r($this->form_validation);
		//die();
		$this->load->view('template/header', $data);
        $this->load->view('loads/edit_load', $data);
		$this->load->view('template/footer', $data);
        } else{
			$result = $this->load_model->edit_load_data();
			$this->load->view('template/header', $data);
        $this->load->view('loads/view_load', $data);
		$this->load->view('template/footer', $data);
		}

		} else{
			$this->load->view('login/login', $data);
		}
		
		}



		public function get_driverrate_data()
		{
			$result = $this->load_model->get_driver_rate($this->input->post('driver_count'));
			$data = array();
			$val="";
			foreach($result->result() as $r) {
				$val= $r->rate;
              
          }

		 
          echo $val;
          exit();
		}


		public function changeStatus($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		$this->load->helper('url');
		$result = $this->load_model->changeStatus($_POST['id'],$_POST['status']);
		echo $result;
		//print_r($_POST);
		//$data['featured_profile'] = $this->profile_model->get_featured_profile();
		
		
        
		
		}



		
	public function uploaddoc(){
		//print_r($_FILES);
		//echo '---';
		//print_r($_POST);
		$output = array('error' => false);
        if(!empty($_FILES['file']['name'])){
            $config['upload_path'] = 'upload/';
			$new_name = time()."-".$this->clean($_FILES["file"]['name']);
            echo $config['file_name'] = $new_name;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|xls|xlsx|doc|docx|pdf|txt';
 
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
			//echo $var=$this->upload->do_upload('file');
 //print_r($var);
            if($this->upload->do_upload('file')){
				//echo "hiii";
                $uploadData = $this->load_model->insert_load_doc($_POST['loadid'],$_POST['type'],$config['file_name'] );
                //$filename = $uploadData['file_name'];
 
				//$file['filename'] = $filename;
 
				//$query = $this->files_model->insertfile($file);
				if($uploadData=='success'){
					$output['message'] = 'File uploaded successfully';
				}
				else{
					$output['error'] = true;
					$output['message'] = 'File uploaded but not inserted to database';
				}
 
            }else{
            	$output['error'] = true;
				$output['message'] = 'Cannot upload file';
            }
        }else{
        	$output['error'] = true;
			$output['message'] = 'Cannot upload empty file';
        }
 
        echo $output['message'];
 
	}



	public function getTripLoadData()
		{
			$result = $this->load_model->get_trip_load_data();
			//$loadstatus = $this->load_model->get_load_status();
			$data = array();
			
			
			//die;

			 

			foreach($result->result() as $r) {
				//$buttonstr="<input type='button' value='Change Status' onclick='changestatus(".$r->loading_id.")'>";
				//$selectsrt="<select name='status' id='".$r->loading_id."'>";
				//$selectsrt1="";
				/**foreach($loadstatus->result() as $s) {
					$selected="";
					if($s->status_code==$r->status){
						$selected="selected";
					}
				 $selectsrt1=$selectsrt1."<option value='".$s->status_code."'  ".$selected.">".$s->status_name."</option>";
			}
			 $selectsrt1=$selectsrt1."</select>";**/

               $data[] = array(
				   '<input type="checkbox" id="id" name="id[]" value="'.$r->loading_id.'">',
                   $r->loading_id,
                   $r->load_no,
                   $r->pickup_date,
                   $r->delivery_date,
				   $r->customer_name,
				   $r->froms,
				   $r->tos,
                   $r->bol,
				   $r->status_name,
				   
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

public function getSelTripLoadData()
		{
			$result = $this->load_model->get_trip_load_data();
			//$loadstatus = $this->load_model->get_load_status();
			$data = array();
			$id=$_POST['id'];
			$trip_load_data = $this->load_model->get_trip_load_data1($id);
			
			
			//die;
			//print_r($trip_load_data);

			 foreach($trip_load_data->result() as $r) {
				

			 

               $data[] = array(
				   '<input type="checkbox" id="id" name="id[]" value="'.$r->loading_id.'" checked>',
                   $r->loading_id,
                   $r->load_no,
                   $r->pickup_date,
                   $r->delivery_date,
				   $r->customer_name,
				   $r->froms,
				   $r->tos,
                   $r->bol,
				   $r->status_name,
				   
               );
          }

			foreach($result->result() as $r) {
				

			 

               $data[] = array(
				   '<input type="checkbox" id="id" name="id[]" value="'.$r->loading_id.'" >',
                   $r->loading_id,
                   $r->load_no,
                   $r->pickup_date,
                   $r->delivery_date,
				   $r->customer_name,
				   $r->froms,
				   $r->tos,
                   $r->bol,
				   $r->status_name,
				   
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

		public function clean($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-.]/', '', $string); // Removes special chars.
}
		
}
?>