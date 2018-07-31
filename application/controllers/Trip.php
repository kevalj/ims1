<?php
class Trip extends CI_Controller {


	public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->load->library('session');
				$this->load->helper('url');
				$this->load->model('load_model');
				$this->load->model('trip_model');
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

        

		public function trip($page = 'loads')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter

		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {


		$this->load->helper('url');
		//$data['driver_rate'] = $this->load_model->get_driver_rate(0)->result_array();
		$data['result'] = $this->trip_model->get_state();
		$data['result1'] = $this->master_model->get_status();
		
		$data['state'] = $this->trip_model->get_state();
		    $data['cust_type'] = $this->master_model->get_customer_type();
			$data['vehicle_type'] = $this->master_model->get_vehicle_type();
			$data['payment_type'] = $this->master_model->get_payment_type();
			$data['result2'] = $this->master_model->get_expense();
		$this->load->view('template/header', $data);
        $this->load->view('trip/trip', $data);
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

		


		public function tripadd($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter

		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
		$this->load->helper('url');
		//echo $this->input->post('shipper_id')[0];
		//print_r($_POST);die;
		//$result = $this->trip_model->save_trip_data();
		//die;
		$this->form_validation->set_rules('cust_trip_no', 'Customer Load No', 'trim|required');
		//$this->form_validation->set_rules('customer_id', 'Customer Name', 'trim|required');
		
		//echo $_POST['driver_count'];
//$result = $this->load_model->save_load_data();
//print_r($this->form_validation);
		if ($this->form_validation->run() == FALSE) {
			//echo '1111';
			//die;
		//$data['driver_rate'] = $this->trip_model->get_driver_rate(0)->result_array();
		$this->load->view('template/header', $data);
        $this->load->view('trip/trip', $data);
		$this->load->view('template/footer', $data);
        } else{
			$result = $this->trip_model->save_trip_data();
			//die;
		$this->load->view('template/header', $data);
        $this->load->view('trip/view_trip', $data);
		$this->load->view('template/footer', $data);
		}

		} else{
			$this->load->view('login/login', $data);
		}
		
		}


		public function tripedit($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter

		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {


		$this->load->helper('url');
		$this->form_validation->set_rules('cust_trip_no', 'Customer Trip No', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
		$id=$_POST['trip_details_id'];
		$_GET['id']=$_POST['trip_details_id'];
		$data['trip_data'] = $this->trip_model->get_sel_trip_data($id);
			$data['trip_stop_data'] = $this->trip_model->get_sel_trip_stop_data($id);
			$data['trip_fuel_data'] = $this->trip_model->get_sel_trip_fuel_exp_data($id);
			$data['trip_truck_data'] = $this->trip_model->get_sel_trip_truck_exp_data($id);
			$data['trip_refree_data'] = $this->trip_model->get_sel_trip_refree_fuel_exp_data($id);


			$data['result'] = $this->trip_model->get_state();
			$data['result1'] = $this->master_model->get_status();
			



			$data['fsc_amount_type'] = $this->master_model->get_fsc_amount_type();
			$data['fee_type'] = $this->master_model->get_fee_type();
			$data['status'] = $this->master_model->get_status();
			$data['quantity_type'] = $this->master_model->get_quantity_type();
			$data['result2'] = $this->master_model->get_expense();
			
			
			$data['driver_rate'] = $this->load_model->get_driver_rate(0)->result_array();
			//print_R($data['result']);
			$this->load->view('template/header');
			$this->load->view('trip/edit_trip', $data);
			$this->load->view('template/footer');

        } else{
			$result = $this->trip_model->edit_trip_data();
			//die;
		$this->load->view('template/header', $data);
        $this->load->view('trip/view_trip', $data);
		$this->load->view('template/footer', $data);
		}

		} else{
			$this->load->view('login/login', $data);
		}
		
		}



		
		public function gettripData()
		{
			$result = $this->trip_model->get_trip_data();
			$data = array();
			foreach($result->result() as $r) {

               $data[] = array(
				   '<input type="radio" id="id" name="id" value="'.$r->trip_details_id.'">',
                   $r->trip_number,
                   '<a target="_blank" href="'.$r->trip_tracking_link.'">'.$r->trip_tracking_link.'</a>',
                   $r->pickup_date,
                   $r->delivery_date,
				   //$r->from_loc,
				   //$r->to_loc,
				   $r->truck.'/ '.$r->trailer,
                   $r->driver_name,
				   $r->team_driver_name,
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

		public function view_trip($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter

		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

		$this->load->helper('url');
		//$data['featured_profile'] = $this->profile_model->get_featured_profile();
		
		$this->load->view('template/header', $data);
        $this->load->view('trip/view_trip', $data);
		$this->load->view('template/footer', $data);

		} else{
			$this->load->view('login/login', $data);
		}
        
		
		}


		public function editTripData($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter

		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

		$this->load->helper('url');
		$id=$_REQUEST['id'];
		

		if ($id >0) {
			$data['payment_type'] = $this->master_model->get_payment_type();
			$data['cust_type'] = $this->master_model->get_customer_type();
			$data['vehicle_type'] = $this->master_model->get_vehicle_type();
			$data['quantity_type'] = $this->master_model->get_quantity_type();
			$data['fsc_amount_type'] = $this->master_model->get_fsc_amount_type();
			$data['fee_type'] = $this->master_model->get_fee_type();
			$data['status'] = $this->load_model->get_load_status1();
			$data['driver_rate'] = $this->load_model->get_driver_rate(0)->result_array();

			$data['trip_data'] = $this->trip_model->get_sel_trip_data($id);
			$data['trip_stop_data'] = $this->trip_model->get_sel_trip_stop_data($id);
			$data['trip_fuel_data'] = $this->trip_model->get_sel_trip_fuel_exp_data($id);
			$data['trip_truck_data'] = $this->trip_model->get_sel_trip_truck_exp_data($id);
			$data['trip_refree_data'] = $this->trip_model->get_sel_trip_refree_fuel_exp_data($id);


			$data['result'] = $this->trip_model->get_state();
			$data['result1'] = $this->master_model->get_status();
			$data['result2'] = $this->master_model->get_expense();



			
			
			//$data['status'] = $this->master_model->get_status();
			
			
			
			
			
			//print_R($data['result']);
			$this->load->view('template/header');
			$this->load->view('trip/edit_trip', $data);
			$this->load->view('template/footer');
        } else{
			$this->load->view('template/header', $data);
			$this->load->view('trip/view_trip', $data);
			$this->load->view('template/footer', $data);
		}

		} else{
			$this->load->view('login/login', $data);
		}
		
		}


public function viewTripData($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter

		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {


		$this->load->helper('url');
		$id=$_REQUEST['id'];
		

		if ($id >0) {
			$data['result'] = $this->trip_model->get_state();
			$data['fsc_amount_type'] = $this->master_model->get_fsc_amount_type();
			$data['fee_type'] = $this->master_model->get_fee_type();
			$data['result1'] = $this->master_model->get_status();
			$data['status'] = $this->load_model->get_load_status1();
			$data['quantity_type'] = $this->master_model->get_quantity_type();
			$data['driver_rate'] = $this->load_model->get_driver_rate(0)->result_array();
			$data['result2'] = $this->master_model->get_expense();



			
			
			//$data['status'] = $this->master_model->get_status();
			
			
			
			
			
			$data['trip_data'] = $this->trip_model->get_sel_trip_data($id);
			$data['trip_stop_data'] = $this->trip_model->get_sel_trip_stop_data($id);
			$data['trip_fuel_data'] = $this->trip_model->get_sel_trip_fuel_exp_data($id);
			$data['trip_truck_data'] = $this->trip_model->get_sel_trip_truck_exp_data($id);
			$data['trip_refree_data'] = $this->trip_model->get_sel_trip_refree_fuel_exp_data($id);


			//print_R($data['result']);
			$this->load->view('template/header');
			$this->load->view('trip/view_edit_trip', $data);
			$this->load->view('template/footer');
        } else{
			$this->load->view('template/header', $data);
			$this->load->view('trip/view_trip', $data);
			$this->load->view('template/footer', $data);
		}

		} else{
			$this->load->view('login/login', $data);
		}
		
		}





		
}
?>