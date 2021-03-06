<?php

class InventoryTransfer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('master_model');
		$this->load->model('inventory_model');
        $this->load->model('trip_model');
    }

    public function service_center_inventory($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
			$data['service_center'] = $this->inventory_model->get_service_center(0);	
			//print_r($data['service_center']);die;
			$data['machine_parts'] = $this->inventory_model->get_machine_parts();
            $this->load->view('template/header', $data);
            $this->load->view('inventory_transfer/service_center_inventory', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function view_service_center_inventory($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($_SESSION['logged_in']);
        //echo $_SESSION['logged_in']['login_id'];die;
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            

            $this->load->view('template/header', $data);
            $this->load->view('inventory_transfer/view_service_center_inventory', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function service_center_inventory_add($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
//print_r($_POST);die;
            //$this->form_validation->set_rules('project', 'Project Name', 'trim|required');
			//$this->form_validation->set_rules('inventory', 'Inventory', 'trim|required');


            
                $result = $this->inventory_model->save_service_center_inventory_data();
                $this->load->view('template/header', $data);
                $this->load->view('inventory_transfer/view_service_center_inventory', $data);
                $this->load->view('template/footer', $data);
            
        } else {
            $this->load->view('login/login', $data);
        }
    }

    
    public function getServiceCenterInventoryData() {
        $result = $this->inventory_model->getServiceCenterInventoryData();
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                '<input type="radio" id="id" name="id" value="' . $r->stock_id . '">',
                $r->service_center_name,
                $r->part_name,
				$r->ttlcnt,
				$r->usedcnt,
				$r->remcnt
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

    public function returnInventoryToCentral() {
        $id = $_POST['id'];
		$result = $this->inventory_model->get_inventory_present_pos_service_center($id);
		$cnt= sizeof($result->result());
		$status="";
		if($cnt>0){
			
			foreach ($result->result() as $r) {
                $status=$r->status;
            
        }
		echo "Selected inventory present in ".$status.". Cannot return to master Inventory";
		exit();
		}
        $result = $this->inventory_model->returnInventoryToCentral($id);
		if($result=="success"){
        echo 'Inventory returned successfully';
		} else{
			echo 'Error. Try again later';
		}

        exit();
    }






	public function view_depot_inventory($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($_SESSION['logged_in']);
        //echo $_SESSION['logged_in']['login_id'];die;
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            

            $this->load->view('template/header', $data);
            $this->load->view('inventory_transfer/view_depot_inventory', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }


	public function getDepotData() {
		$divisionid=$_POST['divisionid'];
        $result = $this->inventory_model->getDepotData($divisionid);
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                $r->depotId,
				
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


	public function depot_inventory($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
			$data['project'] = $this->inventory_model->get_project();	
			$data['inventory'] = $this->inventory_model->get_inventory();
            $this->load->view('template/header', $data);
            $this->load->view('inventory_transfer/depot_inventory', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }


	public function getPOSdata() {
		$projectid=$_POST['projectid'];
        $result = $this->inventory_model->getPOSdata($projectid);
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                $r->project_pos_details_id,
                $r->pos_name
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

	public function getProjectInventory() {
		$projectid=$_POST['projectid'];
        $result = $this->inventory_model->getProjectInventory($projectid);
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                $r->inventory_master_id,
                $r->inventory_no,
				$r->inventory_sr_no,
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


	public function pos_inventory_add($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
//print_r($_POST);die;
            $this->form_validation->set_rules('project', 'Region Name', 'trim|required');
			$this->form_validation->set_rules('pos', 'Division Name', 'trim|required');
			$this->form_validation->set_rules('depot', 'Depot Name', 'trim|required');
			//$this->form_validation->set_rules('inventory', 'Inventory', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
				$data['project'] = $this->inventory_model->get_project();	
				$data['inventory'] = $this->inventory_model->get_inventory();
                $this->load->view('template/header', $data);
                $this->load->view('inventory_transfer/depot_inventory', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->inventory_model->save_pos_inventory_data();
                $this->load->view('template/header', $data);
                $this->load->view('inventory_transfer/view_depot_inventory', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }


	public function projectToServiCecenter($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
			$id=$_GET['id'];
			$data['inventory_data'] = $this->inventory_model->get_sel_project_inventory_data($id);
			//print_r($data['inventory_data']);die;
			$projectid=0;
            foreach ($data['inventory_data'] as $data1):
				//print_r( $data1);
            $projectid=$data1['project_id'];
			endforeach;
			//echo $projectid;die;
			$data['service_center'] = $this->inventory_model->get_service_center($projectid);	
			$data['reason'] = $this->inventory_model->get_reason();	
			
            $this->load->view('template/header', $data);
            $this->load->view('inventory_transfer/project_to_service_center', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }


	
		public function project_to_service_center_add($page = 'dashboard') {
			               
        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
			

            $this->form_validation->set_rules('inventory_master_id', 'Inventory Id', 'trim|required');
			$this->form_validation->set_rules('inventory_project_relation_id', 'Inventory Id', 'trim|required|callback_checkInventoryPresentPosServiceCenter');
			$this->form_validation->set_rules('reason', 'Reason', 'trim|required');
			$this->form_validation->set_rules('service_center', 'Service Center Name', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
				$id=$_POST['inventory_project_relation_id'];
			$data['inventory_data'] = $this->inventory_model->get_sel_project_inventory_data($id);
			$projectid=0;
            foreach ($data['inventory_data'] as $data1):
			$projectid=$data1['project_id'];
			endforeach;
			$data['service_center'] = $this->inventory_model->get_service_center($projectid);	
			$data['reason'] = $this->inventory_model->get_reason();	
                $this->load->view('template/header', $data);
                $this->load->view('inventory_transfer/project_to_service_center', $data);
                $this->load->view('template/footer', $data);
            } else {

                $result = $this->inventory_model->save_project_to_service_center_data();
                $this->load->view('template/header', $data);
                $this->load->view('inventory_transfer/view_project_inventory', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

	

	 public function checkInventoryPresentPosServiceCenter($str)
        {
		 
		$result = $this->inventory_model->get_inventory_present_pos_service_center($str);
		$cnt= sizeof($result->result());//die;
		$status="";
		if($cnt>0){
			
			foreach ($result->result() as $r) {
                $status=$r->status;
            
        }
		$this->form_validation->set_message('checkInventoryPresentPosServiceCenter', 'The Inventory already present in '.$status);
                        return FALSE;
		} else {
			     
                        return TRUE;
		}
               
        }


	


	public function depotToServiCecenter($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

			
            $this->load->helper('url');

            $data['service_center'] = $this->inventory_model->get_service_center1();	
			$data['depot'] = $this->inventory_model->get_depot();	
                          $data['division'] = $this->inventory_model->get_division();
			$data['reason'] = $this->inventory_model->get_reason();
                        //$data['reason'] = $this->inventory_model->get_solution();
			
            $this->load->view('template/header', $data);
            $this->load->view('inventory_transfer/depot_to_service_center', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }
    
    
    public function depotToFaulty($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

			
            $this->load->helper('url');

            $data['service_center'] = $this->inventory_model->get_service_center1();	
			$data['depot'] = $this->inventory_model->get_depot();
                        $data['division'] = $this->inventory_model->get_division();
			$data['reason'] = $this->inventory_model->get_reason();	
			
            $this->load->view('template/header', $data);
            $this->load->view('inventory_transfer/depot_to_faulty', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

	public function checkInventoryPresentServiceCenter($str)
        {
		 
		$result = $this->inventory_model->get_inventory_present_service_center($str);
		$cnt= sizeof($result->result());//die;
		$status="";
		if($cnt>0){
			
			foreach ($result->result() as $r) {
                $status=$r->status;
            
        }
		$this->form_validation->set_message('checkInventoryPresentServiceCenter', 'The Inventory already present in '.$status);
                        return FALSE;
		} else {
			     
                        return TRUE;
		}
               
        }



		public function depot_to_service_center_add($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
//print_r($_POST);die;
            /**$this->form_validation->set_rules('inventory_project_relation_id', 'Inventory Id', 'trim|required');
			$this->form_validation->set_rules('inventory_master_id', 'Inventory Id', 'trim|required');
			$this->form_validation->set_rules('inventory_pos_relation_id', 'Inventory Id', 'trim|required|callback_checkInventoryPresentServiceCenter');
			$this->form_validation->set_rules('reason', 'Reason', 'trim|required');
			$this->form_validation->set_rules('service_center', 'Service Center Name', 'trim|required');**/



          /***  if ($this->form_validation->run() == FALSE) {
            
			
            $this->load->view('template/header', $data);
            $this->load->view('inventory_transfer/depot_to_service_center', $data);
            $this->load->view('template/footer', $data);
            } else {***/
                $result = $this->inventory_model->save_depot_to_service_center_data();
                $this->load->view('template/header', $data);
                $this->load->view('inventory_transfer/view_depot_inventory', $data);
                $this->load->view('template/footer', $data);
           // }
        } else {
            $this->load->view('login/login', $data);
        }
    }
    
    
    
    public function depot_to_faulty_add($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
                $result = $this->inventory_model->save_depot_to_faulty_data();
                $this->load->view('template/header', $data);
                $this->load->view('inventory_transfer/view_depot_inventory', $data);
                $this->load->view('template/footer', $data);
           // }
        } else {
            $this->load->view('login/login', $data);
        }
    }




	public function returnInventoryToProject() {
        $id = $_POST['id'];
		$result = $this->inventory_model->get_inventory_present_service_center($id);
		$cnt= sizeof($result->result());
		$status="";
		if($cnt>0){
			
			foreach ($result->result() as $r) {
                $status=$r->status;
            
        }
		echo "Selected inventory present in ".$status.". Cannot return to Project Inventory";
		exit();
		}
        $result = $this->inventory_model->returnInventoryToProject($id);
		if($result=="success"){
        echo 'Inventory returned successfully';
		} else{
			echo 'Error. Try again later';
		}

        exit();
    }


	public function inventoryToServiCecenter($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

			
            $this->load->helper('url');


			$id=$_GET['id'];
			$data['inventory_data'] = $this->inventory_model->get_sel_inventory_data($id);
			$projectid=0;
			$data['service_center'] = $this->inventory_model->get_service_center($projectid);	
			$data['reason'] = $this->inventory_model->get_reason();	
			
            $this->load->view('template/header', $data);
            $this->load->view('inventory_transfer/inventory_to_service_center', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }




	public function inventory_to_service_center_add($page = 'dashboard') {
			               
        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
			

            $this->form_validation->set_rules('inventory_master_id', 'Inventory Id', 'trim|required|callback_checkInventoryPresentProjectPosServiceCenter');
			$this->form_validation->set_rules('reason', 'Reason', 'trim|required');
			$this->form_validation->set_rules('service_center', 'Service Center Name', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
			$id=$_POST['inventory_master_id'];
			$data['inventory_data'] = $this->inventory_model->get_sel_inventory_data($id);
			$projectid=0;
			$data['service_center'] = $this->inventory_model->get_service_center($projectid);	
			$data['reason'] = $this->inventory_model->get_reason();	
			
            $this->load->view('template/header', $data);
            $this->load->view('inventory_transfer/inventory_to_service_center', $data);
            $this->load->view('template/footer', $data);
            } else {

                $result = $this->inventory_model->save_inventory_to_service_center_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_inventory', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

	
	public function checkInventoryPresentProjectPosServiceCenter($str)
        {
		 
		$result = $this->inventory_model->get_inventory_present_project_pos_service_center($str);
		$cnt= sizeof($result->result());//die;
		$status="";
		if($cnt>0){
			
			foreach ($result->result() as $r) {
                $status=$r->status;
            
        }
		$this->form_validation->set_message('checkInventoryPresentProjectPosServiceCenter', 'The Inventory already present in '.$status);
                        return FALSE;
		} else {
			     
                        return TRUE;
		}
               
        }



		    
    		public function getDepotInventoryData() {
        $result = $this->inventory_model->getDepotInventoryData();
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                '<input type="radio" id="id" name="id" value="' . $r->inventory_pos_relation_id . '">',
                $r->inventory_sr_no,
                $r->depot_name,
		$r->division_name,
		$r->region_name,
		$r->inventory_name
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



	public function getDepotFaultyInventory() {
		$depot=$_POST['depot'];
        $result = $this->inventory_model->getDepotFaultyInventorySelect($depot);
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                $r->inventory_master_id.'-'.$r->inventory_pos_relation_id.'-'.$r->faultyId,
                $r->inventory_sr_no,
				$r->inventory_sr_no,
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
    
    
    public function getDivisionFaultyInventory() {
		$depot=$_POST['depot'];
        $result = $this->inventory_model->getDivisionFaultyInventorySelect($depot);
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                $r->inventory_master_id.'-'.$r->inventory_pos_relation_id.'-'.$r->faultyId,
                $r->inventory_sr_no,
				$r->inventory_sr_no,
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
    
    
	public function getDivisionInventory() {
		$depot=$_POST['depot'];
        $result = $this->inventory_model->getDivisionInventorySelect($depot);
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                $r->inventory_master_id.'-'.$r->inventory_pos_relation_id,
                $r->inventory_sr_no,
				$r->inventory_sr_no,
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


	public function getDepotServiceCenter() {
		$depot=$_POST['depot'];
        $result = $this->inventory_model->getDepotServiceCenter($depot);
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                $r->project_service_center_id,
				$r->service_center_name,
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


	public function serviCecenterToInventory($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($_SESSION['logged_in']);
        //echo $_SESSION['logged_in']['login_id'];die;
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            

            $this->load->view('template/header', $data);
            $this->load->view('inventory_transfer/serviCecenterToInventory', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }



}

?>
