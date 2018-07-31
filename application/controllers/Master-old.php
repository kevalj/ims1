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

    public function service_center($page = 'dashboard') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (isset($_SESSION['logged_in']['login_id']) && !empty($_SESSION['logged_in']['login_id'])) {

            $this->load->helper('url');
            $data['project'] = $this->master_model->get_project();
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
                $data['result'] = $this->master_model->get_sel_servicecenter_data($id);
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

}

?>
