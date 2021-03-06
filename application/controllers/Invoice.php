<?php
class Invoice extends CI_Controller {


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
				$this->load->model('invoice_model');
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

        

		
		public function view_invoice($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

		$this->load->helper('url');
		//$data['featured_profile'] = $this->profile_model->get_featured_profile();

		
		
		$this->load->view('template/header', $data);
        $this->load->view('invoice/invoice', $data);
		$this->load->view('template/footer', $data);
        
		} else{
			$this->load->view('login/login', $data);
		}
		}

		public function getInvoiceData()
		{
			$result = $this->invoice_model->getInvoiceData();
			$data = array();
			$str="";
			foreach($result->result() as $r) {
				$str="";
				if($r->invoice_status=='N'){
					$str="<a href='".base_url()."index.php/invoice/getSelectedInvoiceData?id=".$r->loading_id."' class='btn btn-primary'>Create Invoice</a>";
				} else{
						$str="<a href='".base_url()."index.php/invoice/getSelectedInvoiceDataView?id=".$r->loading_id."' class='btn btn-primary'>View Invoice</a>";
				}
				$str1="";
				if($r->paid_status=='Y'){
					$str1="<a onclick='changepaidstatus(\"".$r->loading_id."\",\"U\")' class='btn btn-primary'>Paid</a>";
				} else{
					$str1="<a onclick='changepaidstatus(\"".$r->loading_id."\",\"P\")' class='btn btn-primary'>Unpaid</a>";
				}

               $data[] = array(
                   $r->load_no,
                   $r->load_no,
                   $r->customer_name,
                   $r->pickup_date,
                   $r->delivery_date,
				   $r->froms,
				   $r->tos,
				   $r->amount,
				   $r->invoice_addvance,
				   $str,
				   $str1
				  
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


		public function getSelectedInvoiceData($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter

		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

		$this->load->helper('url');
		$id=$_REQUEST['id'];
		//$data['featured_profile'] = $this->profile_model->get_featured_profile();
		if($id>0){
		$data['invoice'] = $this->invoice_model->getSelectedInvoiceData($id);
		$this->load->view('template/header', $data);
        $this->load->view('invoice/invoice_data', $data);
		$this->load->view('template/footer', $data);

		}else{
		
		$this->load->view('template/header', $data);
        $this->load->view('invoice/invoice', $data);
		$this->load->view('template/footer', $data);
        }

		} else{
			$this->load->view('login/login', $data);
		}
		
		}


		public function getSelectedInvoiceDataView($page = 'dashboard')
		{

			if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
   
        $data['title'] = ucfirst($page); // Capitalize the first letter
		$this->load->helper('url');
		$id=$_REQUEST['id'];
		//$data['featured_profile'] = $this->profile_model->get_featured_profile();
		if($id>0){
		$data['invoice'] = $this->invoice_model->getSelectedInvoiceData($id);
		$this->load->view('template/header', $data);
        $this->load->view('invoice/invoice_view', $data);
		$this->load->view('template/footer', $data);

		}else{
		
		$this->load->view('template/header', $data);
        $this->load->view('invoice/invoice', $data);
		$this->load->view('template/footer', $data);
        }

		} else{
			$this->load->view('login/login', $data);
		}
		
		}


		public function invoiceadd($page = 'dashboard')
		{
   
        $data['title'] = ucfirst($page); // Capitalize the first letter

		if(isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {


		$this->load->helper('url');
		
		$this->form_validation->set_rules('bill_from', 'Bill From', 'trim|required');
		$this->form_validation->set_rules('bill_to', 'Bill To', 'trim|required');
		$this->form_validation->set_rules('loading_id', 'Invalid Request', 'trim|required');
		

		if ($this->form_validation->run() == FALSE) {
		$data['invoice'] = $this->invoice_model->getSelectedInvoiceData($_POST['loading_id']);
		$this->load->view('template/header', $data);
        $this->load->view('invoice/invoice_data', $data);
		$this->load->view('template/footer', $data);

        } else{
			$result = $this->invoice_model->save_invoice_data();
			$this->load->view('template/header', $data);
        $this->load->view('invoice/invoice', $data);
		$this->load->view('template/footer', $data);
		}

		} else{
			$this->load->view('login/login', $data);
		}
		
		}


		public function changePaidStatus(){
			$id=$_POST['id'];
			$status=$_POST['status'];
			$cstatus="";
			if($status=='P'){
			$cstatus='Y';
			}

			if($status=='U'){
			$cstatus='N';
			}

			echo $result = $this->invoice_model->changePaidStatus($id,$cstatus);
		}

		public function getInvoiceFromData()
		{
			//echo $this->input->get('term');
			$result = $this->invoice_model->getInvoiceFromData($this->input->get('term'));
			$output = array();
			foreach($result->result() as $r) {
				 $output[] = array('id'=> $r->invoice_from,'label'=> $r->invoice_from,'value'=> $r->invoice_from);

               
          }

		 
          echo json_encode($output);
          exit();
		}

		public function getInvoiceToData()
		{
			//echo $this->input->get('term');
			$result = $this->invoice_model->getInvoiceToData($this->input->get('term'));
			$output = array();
			foreach($result->result() as $r) {
				 $output[] = array('id'=> $r->invoice_to,'label'=> $r->invoice_to,'value'=> $r->invoice_to);

               
          }

		 
          echo json_encode($output);
          exit();
		}


		
}
?>