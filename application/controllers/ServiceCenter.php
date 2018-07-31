<?php

class ServiceCenter extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('master_model');
		$this->load->model('inventory_model');
		$this->load->model('service_center_model');
        $this->load->model('trip_model');
    }

    public function view_service_center_inventory($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($_SESSION['logged_in']);
        //echo $_SESSION['logged_in']['login_id'];die;
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            

            $this->load->view('template/header', $data);
            $this->load->view('service_center/view_service_center_inventory', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

	public function getServiceCenterInventoryData() {
        $result = $this->service_center_model->getServiceCenterInventoryData();
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                '<input type="radio" id="id" name="id" value="' . $r->faultyId . '">',
                $r->inventory_name,
                $r->inventory_no,
				$r->inventory_sr_no,
				$r->region,
				$r->division,
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

	public function repair_service_center_inventory($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $id = $_REQUEST['id'];


            if ($id > 0) {
                $data['result'] = $this->service_center_model->getSelServiceCenterInventoryData($id);
				$data['stockcount'] = $this->service_center_model->getSelServiceCenterStockData($id);
				//$data['reason'] = $this->service_center_model->get_reason();
                                $data['reason'] = $this->service_center_model->get_solution();
				$data['machine_parts'] = $this->service_center_model->get_servicecenter_machine_parts($id);
                //print_R($data['result']);
                $this->load->view('template/header');
                $this->load->view('service_center/repair_service_center_inventory', $data);
                $this->load->view('template/footer');
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('service_center/view_service_center_inventory', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }


	public function update_repair_service_center_inventory($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //print_r($_POST);

            $this->form_validation->set_rules('faultyId', 'Faulty Id', 'trim|required');
            //$this->form_validation->set_rules('project_name', 'Project Name', 'trim|required');
            //$this->form_validation->set_rules('status', 'Status', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                //echo 'aaaaaaaa';
                //print_r($this->form_validation);
                //die();
                $id = $_POST['faultyId'];

                $data['result'] = $this->service_center_model->getSelServiceCenterInventoryData($id);
				$data['reason'] = $this->service_center_model->get_reason();	
                //print_R($data['result']);
                $this->load->view('template/header');
                $this->load->view('service_center/repair_service_center_inventory', $data);
                $this->load->view('template/footer');
            } else {
                $result = $this->service_center_model->update_repair_service_center_inventory();
				if($result=='success'){
                $this->load->view('template/header', $data);
                $this->load->view('service_center/view_service_center_inventory', $data);
                $this->load->view('template/footer', $data);
				}else{
				$id = $_POST['faultyId'];

                $data['result'] = $this->service_center_model->getSelServiceCenterInventoryData($id);
				$data['reason'] = $this->service_center_model->get_reason();	
                //print_R($data['result']);
                $this->load->view('template/header');
                $this->load->view('service_center/repair_service_center_inventory', $data);
                $this->load->view('template/footer');

				}
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    
}

?>
