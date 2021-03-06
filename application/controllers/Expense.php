<?php
class Expense extends CI_Controller {


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

        

		
		public function expense($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
		$this->load->helper('url');
		//$data['featured_profile'] = $this->profile_model->get_featured_profile();
        $data['vehicle_type'] = $this->master_model->get_vehicle_type();
		
		    $data['cust_type'] = $this->master_model->get_customer_type();
		$data['state'] = $this->trip_model->get_state();
		$data['truck'] = $this->expense_model->get_vehicle_data(1);
		$data['trailer'] = $this->expense_model->get_vehicle_data(2);
		
		$this->load->view('template/header', $data);
        $this->load->view('expense/expense', $data);
		$this->load->view('template/footer', $data);

		} else{
			$this->load->view('login/login', $data);
		}
        
		
		}

		public function getExpenseCategory()
		{
			$result = $this->expense_model->get_expense_category();
			$data = array();
			
			foreach($result->result() as $r) {
				
               $data[] = array(
				   $r->expense_details_id,
                   $r->expense_name,
                   
               );
          }

		  $output = array(
                 "data" => $data
            );
          echo json_encode($output);
          exit();
		}


		public function expenseadd($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

		$this->load->helper('url');
		
		$this->form_validation->set_rules('expense_details_id', 'Expense category', 'trim|required');
		

		if ($this->form_validation->run() == FALSE) {
		
		$this->load->view('template/header', $data);
        $this->load->view('expense/expense', $data);
		$this->load->view('template/footer', $data);
        } else{
		//	print_r($_POST);
			//die;
			$result = $this->expense_model->save_expense_data();
			$this->load->view('template/header', $data);
        $this->load->view('expense/view_expense', $data);
		$this->load->view('template/footer', $data);
		}
		} else{
			$this->load->view('login/login', $data);
		}
		
		}


		public function getexpenseData()
		{
			$result = $this->expense_model->getexpenseData();
			$data = array();
			foreach($result->result() as $r) {

               $data[] = array(
				   '<input type="radio" id="id" name="id" value="'.$r->category_expense_details_id.'">',
                   $r->expense_name,
                   $r->expense_date,
                   $r->expense_amount,
                   $r->truck.'/'.$r->trailer,
                   $r->expense_description	,
				   $r->gallons,
				   $r->expense_name,
				   $r->state_name
				  
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

		public function view_expense($page = 'dashboard')
		{
			if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		$this->load->helper('url');
		$this->load->view('template/header', $data);
        $this->load->view('expense/view_expense', $data);
		$this->load->view('template/footer', $data);
        } else{
			$this->load->view('login/login', $data);
		}
		
		}


		public function save_expense_category_data(){
			$result = $this->expense_model->save_expense_category_data();
			echo $result;
		}

		public function editExpenseData($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

		$this->load->helper('url');
		$id=$_REQUEST['id'];
		$data['state'] = $this->trip_model->get_state();
		

		if ($id >0) {
			
			$data['vehicle_type'] = $this->master_model->get_vehicle_type();
		
		    $data['cust_type'] = $this->master_model->get_customer_type();
		$data['state'] = $this->trip_model->get_state();
		$data['truck'] = $this->expense_model->get_vehicle_data(1);
		$data['trailer'] = $this->expense_model->get_vehicle_data(2);
			$data['expense'] = $this->expense_model->getselexpenseData($id);
			$data['status'] = $this->master_model->get_status();
			
			$this->load->view('template/header');
			$this->load->view('expense/edit_expense', $data);
			$this->load->view('template/footer');
        } else{
			$this->load->view('template/header', $data);
			$this->load->view('expense/view_expense', $data);
			$this->load->view('template/footer', $data);
		}
		} else{
			$this->load->view('login/login', $data);
		}
		
		}


		public function expenseedit($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

		$this->load->helper('url');
		
		$this->form_validation->set_rules('expense_details_id', 'Expense category', 'trim|required');
		$this->form_validation->set_rules('category_expense_details_id', 'Expense Detail Id', 'trim|required');
		

		if ($this->form_validation->run() == FALSE) {
		
		$this->load->view('template/header', $data);
        $this->load->view('expense/edit_expense', $data);
		$this->load->view('template/footer', $data);
        } else{
			//print_r($_POST);
			//die;
			$result = $this->expense_model->edit_expense_data();
			$this->load->view('template/header', $data);
        $this->load->view('expense/view_expense', $data);
		$this->load->view('template/footer', $data);
		}

		} else{
			$this->load->view('login/login', $data);
		}
		
		}


		
}
?>