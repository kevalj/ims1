<?php

class Master extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('master_model');
        $this->load->model('trip_model');
    }

    public function project($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');

            $this->load->view('template/header', $data);
            $this->load->view('master/project', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function view_project($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($_SESSION['logged_in']);
        //echo $_SESSION['logged_in']['login_id'];die;
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //$data['featured_profile'] = $this->profile_model->get_featured_profile();

            $this->load->view('template/header', $data);
            $this->load->view('master/view_project', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function projectadd($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');

            $this->form_validation->set_rules('project_name', 'Project Name', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data);
                $this->load->view('master/project', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->save_project_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_project', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function editProjectData($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $id = $_REQUEST['id'];


            if ($id > 0) {
                $data['status'] = $this->master_model->get_status();
                $data['result'] = $this->master_model->get_sel_project_data($id);
                //print_R($data['result']);
                $this->load->view('template/header');
                $this->load->view('master/edit_project', $data);
                $this->load->view('template/footer');
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('master/view_project', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function projectedit($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //print_r($_POST);

            $this->form_validation->set_rules('project_id', 'Project Id', 'trim|required');
            $this->form_validation->set_rules('project_name', 'Project Name', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                //echo 'aaaaaaaa';
                //print_r($this->form_validation);
                //die();
                $id = $_REQUEST['project_id'];

                $data['status'] = $this->master_model->get_status();
                $data['result'] = $this->master_model->get_sel_project_data($id);
                $this->load->view('template/header', $data);
                $this->load->view('master/edit_project', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->edit_project_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_project', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function getProjectData() {
        $result = $this->master_model->getProjectData();
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                '<input type="radio" id="id" name="id" value="' . $r->project_id . '">',
                $r->project_name,
                $r->status_name
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

    public function deleteProjectData() {
        $id = $_POST['id'];
        $result = $this->master_model->deleteProjectData($id);
        echo 'Project deleted successfully';

        exit();
    }

    public function view_inventory_type($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($_SESSION['logged_in']);
        //echo $_SESSION['logged_in']['login_id'];die;
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //$data['featured_profile'] = $this->profile_model->get_featured_profile();

            $this->load->view('template/header', $data);
            $this->load->view('master/view_inventory_type', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function getInventoryTypeData() {
        $result = $this->master_model->getInventoryTypeData();
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                '<input type="radio" id="id" name="id" value="' . $r->inventory_type_id . '">',
                $r->inventory_name,
                $r->status_name
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

    public function inventory_type($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');

            $this->load->view('template/header', $data);
            $this->load->view('master/inventory_type', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function inventorytypeadd($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');

            $this->form_validation->set_rules('inventory_type_name', 'Inventory Type Name', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data);
                $this->load->view('master/inventorytype', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->save_inventorytype_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_inventory_type', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function editInventoryTypeData($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $id = $_REQUEST['id'];


            if ($id > 0) {
                $data['status'] = $this->master_model->get_status();
                $data['result'] = $this->master_model->get_sel_inventorytype_data($id);
                //print_R($data['result']);
                $this->load->view('template/header');
                $this->load->view('master/edit_inventory_type', $data);
                $this->load->view('template/footer');
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('master/view_inventory_type', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function inventorytypeedit($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //print_r($_POST);

            $this->form_validation->set_rules('inventory_type_id', 'Inventory Type Id', 'trim|required');
            $this->form_validation->set_rules('inventory_type_name', 'Inventory Type Name', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                //echo 'aaaaaaaa';
                //print_r($this->form_validation);
                //die();
                $id = $_REQUEST['inventory_type_id'];

                $data['status'] = $this->master_model->get_status();
                $data['result'] = $this->master_model->get_sel_inventorytype_data($id);
                $this->load->view('template/header', $data);
                $this->load->view('master/edit_inventory_type', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->edit_inventorytype_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_inventory_type', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function deleteInventoryTypeData() {
        $id = $_POST['id'];
        $result = $this->master_model->deleteInventoryTypeData($id);
        echo 'Inventory Type deleted successfully';

        exit();
    }

    public function view_pos($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($_SESSION['logged_in']);
        //echo $_SESSION['logged_in']['login_id'];die;
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //$data['featured_profile'] = $this->profile_model->get_featured_profile();

            $this->load->view('template/header', $data);
            $this->load->view('master/view_pos', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function getPOSData() {
        $result = $this->master_model->getPOSData();
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                '<input type="radio" id="id" name="id" value="' . $r->project_pos_details_id . '">',
                $r->project_name,
                $r->pos_name,
                $r->status_name
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

    public function pos($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $data['project'] = $this->master_model->get_project();
            $this->load->view('template/header', $data);
            $this->load->view('master/pos', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function posadd($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');

            $this->form_validation->set_rules('pos_name', 'POS Name', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data);
                $this->load->view('master/pos', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->save_pos_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_pos', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function editPOSData($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $id = $_REQUEST['id'];


            if ($id > 0) {
                $data['status'] = $this->master_model->get_status();
                $data['result'] = $this->master_model->get_sel_pos_data($id);
                $data['project'] = $this->master_model->get_project();
                //print_r($data['project']);
                $this->load->view('template/header');
                $this->load->view('master/edit_pos', $data);
                $this->load->view('template/footer');
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('master/view_pos', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function posedit($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //print_r($_POST);

            $this->form_validation->set_rules('project_pos_details_id', 'POS Id', 'trim|required');
            $this->form_validation->set_rules('pos_name', 'POS Name', 'trim|required');
            $this->form_validation->set_rules('project', 'Project Name', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            
            $id = $_REQUEST['project_pos_details_id'];
            
            if ($this->form_validation->run() == FALSE) {
                //echo 'aaaaaaaa';
                //print_r($this->form_validation);
                //die();
                

                $data['status'] = $this->master_model->get_status();
                $data['result'] = $this->master_model->get_sel_pos_data($id);
                $data['project'] = $this->master_model->get_project();
                $this->load->view('template/header', $data);
                $this->load->view('master/edit_pos', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->edit_pos_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_pos', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function deletePOSData() {
        $id = $_POST['id'];
        $result = $this->master_model->deletePOSData($id);
        echo 'POS deleted successfully';

        exit();
    }

    public function view_service_center($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($_SESSION['logged_in']);
        //echo $_SESSION['logged_in']['login_id'];die;
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //$data['featured_profile'] = $this->profile_model->get_featured_profile();

            $this->load->view('template/header', $data);
            $this->load->view('master/view_service_center', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function getServiceCenterData() {
        $result = $this->master_model->getServiceCenterData();
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                '<input type="radio" id="id" name="id" value="' . $r->project_service_center_id . '">',
                $r->service_center_name,
                $r->pos_name,
                $r->status_name
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

    public function service_center($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $data['project'] = $this->master_model->get_project();
			$data['project'] = $this->master_model->get_division();
            $this->load->view('template/header', $data);
            $this->load->view('master/service_center', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function servicecenteradd($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');

            $this->form_validation->set_rules('service_center_name', 'Service Center Name', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data);
                $this->load->view('master/service_center', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->save_service_center_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_service_center', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function editServiceCenterData($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $id = $_REQUEST['id'];


            if ($id > 0) {
                $data['status'] = $this->master_model->get_status();
                $data['project'] = $this->master_model->get_project();
				$data['project'] = $this->master_model->get_division();
                $data['result'] = $this->master_model->get_sel_servicecenter_data($id);
				$data['result1'] = $this->master_model->get_sel_servicecenter_division_data($id);
                //print_R($data['result']);
                $this->load->view('template/header');
                $this->load->view('master/edit_service_center', $data);
                $this->load->view('template/footer');
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('master/view_service_center', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function servicecenteredit($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //print_r($_POST);

            $this->form_validation->set_rules('service_center_name', 'Service Center Name', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                //echo 'aaaaaaaa';
                //print_r($this->form_validation);
                //die();
                $id = $_REQUEST['project_service_center_id'];

                $data['status'] = $this->master_model->get_status();
                $data['project'] = $this->master_model->get_project();
                $data['result'] = $this->master_model->get_sel_servicecenter_data($id);
                $this->load->view('template/header', $data);
                $this->load->view('master/edit_service_center', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->edit_servicecenter_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_service_center', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function deleteServiceCenterData() {
        $id = $_POST['id'];
        $result = $this->master_model->deleteServiceCenterData($id);
        echo 'Service Center deleted successfully';

        exit();
    }
    
    
    public function view_inventory($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($_SESSION['logged_in']);
        //echo $_SESSION['logged_in']['login_id'];die;
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //$data['featured_profile'] = $this->profile_model->get_featured_profile();

            $this->load->view('template/header', $data);
            $this->load->view('master/view_inventory', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function getInventoryData() {
        $result = $this->master_model->getInventoryData();
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                '<input type="radio" id="id" name="id" value="' . $r->inventory_master_id . '">',
                $r->inventory_no,
                $r->inventory_sr_no,
                $r->inventory_name,
                $r->status_name
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

    public function inventory($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $data['inventory_type'] = $this->master_model->get_inventory_type();
            $this->load->view('template/header', $data);
            $this->load->view('master/inventory', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function inventoryadd($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');

            $this->form_validation->set_rules('inventory_no', 'Inventory Number', 'trim|required');
            $this->form_validation->set_rules('inventory_sr_no', 'Inventory Serial Number', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data);
                $this->load->view('master/inventory', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->save_inventory_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_inventory', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function editInventoryData($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $id = $_REQUEST['id'];


            if ($id > 0) {
                $data['status'] = $this->master_model->get_status();
                $data['inventory_type'] = $this->master_model->get_inventory_type();
                $data['result'] = $this->master_model->get_sel_inventory_data($id);
                //print_R($data['result']);
                $this->load->view('template/header');
                $this->load->view('master/edit_inventory', $data);
                $this->load->view('template/footer');
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('master/view_inventory', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function inventoryedit($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //print_r($_POST);

            $this->form_validation->set_rules('inventory_no', 'Inventory Number', 'trim|required');
            $this->form_validation->set_rules('inventory_sr_no', 'Inventory Serial Number', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                //echo 'aaaaaaaa';
                //print_r($this->form_validation);
                //die();
                $id = $_REQUEST['inventory_type_id'];

                $data['status'] = $this->master_model->get_status();
                $data['inventory_type'] = $this->master_model->get_sel_inventorytype_data();
                $data['result'] = $this->master_model->get_sel_inventory_data($id);
                
                $this->load->view('template/header', $data);
                $this->load->view('master/edit_inventory', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->edit_inventory_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_inventory', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function deleteInventoryData() {
        $id = $_POST['id'];
        $result = $this->master_model->deleteInventoryData($id);
        echo 'Inventory Number deleted successfully';

        exit();
    }
    
    public function view_user($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($_SESSION['logged_in']);
        //echo $_SESSION['logged_in']['login_id'];die;
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //$data['featured_profile'] = $this->profile_model->get_featured_profile();

            $this->load->view('template/header', $data);
            $this->load->view('master/view_user', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function getUserData() {
        $result = $this->master_model->getUserData();
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                '<input type="radio" id="id" name="id" value="' . $r->id . '">',
                
                $r->user_name,
					$r->user_id,
                $r->gender,
                $r->email,
                $r->role_name,
                $r->status_name
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

    public function user($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $data['user_role'] = $this->master_model->get_user_roles();
            $this->load->view('template/header', $data);
            $this->load->view('master/user', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

	 public function checkuser()
        {
		 //echo 'hiii';die;
			  $checkuseridexist = $this->master_model->checkuseridexist();
                if ($checkuseridexist=="error")
                {
                        $this->form_validation->set_message('checkuser', 'The User Id is already exist in application. Please try different User Id.');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }

    public function useradd($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');

            $this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
			$this->form_validation->set_rules('login_name', 'Login Name', 'callback_checkuser');
			//die;
            //$this->form_validation->set_rules('login_name', 'Login Name', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('email', 'eMail Id', 'trim|required');

            $data['user_role'] = $this->master_model->get_user_roles();
			//print_r($this->form_validation->run());die;
            
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data);
                $this->load->view('master/user', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->save_user_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_user', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function editUserData($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $id = $_REQUEST['id'];


            if ($id > 0) {
                $data['status'] = $this->master_model->get_status();
                $data['result'] = $this->master_model->get_sel_user_data($id);
                $data['user_role'] = $this->master_model->get_user_roles();
                
                //print_R($data['result']);
                $this->load->view('template/header');
                $this->load->view('master/edit_user', $data);
                $this->load->view('template/footer');
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('master/view_user', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function useredit($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //print_r($_POST);

            $this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
            
            $this->form_validation->set_rules('email', 'eMail Id', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                //echo 'aaaaaaaa';
                //print_r($this->form_validation);
                //die();
                $id = $_REQUEST['user_master_id'];

                $data['status'] = $this->master_model->get_status();
                $data['result'] = $this->master_model->get_sel_user_data($id);
                $this->load->view('template/header', $data);
                $this->load->view('master/edit_user', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->edit_user_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_user', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function deleteUserData() {
        $id = $_POST['id'];
        $result = $this->master_model->deleteUserData($id);
        echo 'User data  deleted successfully';

        exit();
    }



    public function view_depot($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($_SESSION['logged_in']);
        //echo $_SESSION['logged_in']['login_id'];die;
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //$data['featured_profile'] = $this->profile_model->get_featured_profile();

            $this->load->view('template/header', $data);
            $this->load->view('master/view_depot', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function getDepotData() {
        $result = $this->master_model->getDepotData();
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                '<input type="radio" id="id" name="id" value="' . $r->depotId . '">',
		$r->depot_name,                
                $r->pos_name,
		$r->project_name,
                $r->status_name
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

    public function depot($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {
                $data['status'] = $this->master_model->get_status();
                $data['division'] = $this->master_model->get_pos();
                $data['project'] = $this->master_model->get_project();
                $data['depot'] = $this->master_model->get_depot();

            $this->load->helper('url');
            $this->load->view('template/header', $data);
            $this->load->view('master/depot', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function depotadd($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');

            $this->form_validation->set_rules('depot_name', 'Depot Name', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data);
                $this->load->view('master/depot', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->save_depot_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_depot', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function editDepotData($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $id = $_REQUEST['id'];


            if ($id > 0) {
                $data['status'] = $this->master_model->get_status();
                $data['division'] = $this->master_model->get_pos();
                $data['project'] = $this->master_model->get_project();
                $data['depot'] = $this->master_model->get_sel_depot_data($id);
                //print_r($data['project']);
                $this->load->view('template/header');
                $this->load->view('master/edit_depot', $data);
                $this->load->view('template/footer');
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('master/view_depot', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function depotedit($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //print_r($_POST);

            $this->form_validation->set_rules('depot_name', 'Depot Name', 'trim|required');
            $this->form_validation->set_rules('pos_name', 'POS Name', 'trim|required');
            $this->form_validation->set_rules('project', 'Project Name', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            
            $id = $_REQUEST['deppotId'];
            
            if ($this->form_validation->run() == FALSE) {
                //echo 'aaaaaaaa';
                //print_r($this->form_validation);
                //die();
                

                $data['status'] = $this->master_model->get_status();
                $data['result'] = $this->master_model->get_sel_pos_data($id);
                $data['project'] = $this->master_model->get_project();
                $data['project'] = $this->master_model->get_depot();
                $this->load->view('template/header', $data);
                $this->load->view('master/edit_depot', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->edit_depot_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_depot', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function deleteDepotData() {
        $id = $_POST['id'];
        $result = $this->master_model->deletePOSData($id);
        echo 'POS deleted successfully';

        exit();
    }
    
    
    public function view_machine_part_type($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($_SESSION['logged_in']);
        //echo $_SESSION['logged_in']['login_id'];die;
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //$data['featured_profile'] = $this->profile_model->get_featured_profile();

            $this->load->view('template/header', $data);
            $this->load->view('master/view_machine_part_type', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function getMachinePartTypeData() {
        $result = $this->master_model->getMachinePartTypeData();
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                '<input type="radio" id="id" name="id" value="' . $r->part_id . '">',
                $r->part_name,
                $r->status_name
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

    public function machine_part_type($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');

            $this->load->view('template/header', $data);
            $this->load->view('master/machine_part_type', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function machineparttypeadd($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');

            $this->form_validation->set_rules('machine_part_type_name', 'Machine Part Type Name', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data);
                $this->load->view('master/machine_part_type', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->save_machineparttype_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_machine_part_type', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function editMachinePartTypeData($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $id = $_REQUEST['id'];


            if ($id > 0) {
                $data['status'] = $this->master_model->get_status();
                $data['result'] = $this->master_model->get_sel_machineparttype_data($id);
                //print_R($data['result']);
                $this->load->view('template/header');
                $this->load->view('master/edit_machine_part_type', $data);
                $this->load->view('template/footer');
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('master/view_machine_part_type', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function machineparttypeedit($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //print_r($_POST);

            $this->form_validation->set_rules('part_id', 'Machine Part Type Id', 'trim|required');
            $this->form_validation->set_rules('machine_part_type_name', 'Machine Part Type Name', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                //echo 'aaaaaaaa';
                //print_r($this->form_validation);
                //die();
                $id = $_REQUEST['part_id'];

                $data['status'] = $this->master_model->get_status();
                $data['result'] = $this->master_model->get_sel_machineparttype_data($id);
                $this->load->view('template/header', $data);
                $this->load->view('master/edit_machine_part_type', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->edit_machineparttype_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_machine_part_type', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function deleteMachinePartTypeData() {
        $id = $_POST['id'];
        $result = $this->master_model->deleteMachinePartTypeData($id);
        echo 'Machine Part Type deleted successfully';

        exit();
    }
    
    
    public function view_machine_part($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($_SESSION['logged_in']);
        //echo $_SESSION['logged_in']['login_id'];die;
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            //$data['featured_profile'] = $this->profile_model->get_featured_profile();

            $this->load->view('template/header', $data);
            $this->load->view('master/view_machine_part', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function getMachinePartData() {
        $result = $this->master_model->getMachinePartData();
        $data = array();
        foreach ($result->result() as $r) {

            $data[] = array(
                '<input type="radio" id="id" name="id" value="' . $r->stock_id . '">',
                $r->part_name,
                $r->stock_count,
                $r->inserted_date,
                $r->user_name,
                $r->status_name
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

    public function machine_part($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $data['machine_part_type'] = $this->master_model->get_machine_part_type();
            $this->load->view('template/header', $data);
            $this->load->view('master/machine_part', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->load->view('login/login', $data);
        }
    }

    public function machinepartadd($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');

            $this->form_validation->set_rules('machine_part_count', 'Machine Part Count', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data);
                $this->load->view('master/machine_part', $data);
                $this->load->view('template/footer', $data);
            } else {
                $result = $this->master_model->save_machine_part_data();
                $this->load->view('template/header', $data);
                $this->load->view('master/view_machine_part', $data);
                $this->load->view('template/footer', $data);
            }
        } else {
            $this->load->view('login/login', $data);
        }
    }

   

    public function deleteMachinePartData() {
        $id = $_POST['id'];
        $result = $this->master_model->deleteInventoryData($id);
        echo 'Inventory Number deleted successfully';

        exit();
    }    


}

?>
