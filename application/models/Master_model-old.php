<?php

class Master_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('date');
    }

    public function get_active_session() {
        $condition = "user_login_id =  " . $this->db->escape($this->session->userdata['logged_in']['login_id']) . " and status='Y'  ";
        $this->db->select('*');
        $this->db->from('user_login_history');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save_project_data() {

        $data = array(
            'project_name' => $this->input->post('project_name'),
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);


        $this->db->insert('project_master', $data);
        return $this->db->insert_id();
    }

    public function edit_project_data() {

        $data = array(
            'project_name' => $this->input->post('project_name'),
            'status' => $this->input->post('status'),
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('project_id', $this->input->post('project_id'));
        return $this->db->update('project_master', $data);
    }

    public function getProjectData() {
        $query = "select pm.project_id,pm.project_name,sm.status_name from project_master pm
					inner join status_master sm on pm.status=sm.status_code ORDER BY pm.project_id desc";
        return $query = $this->db->query($query);
        //return $query->result_array();
    }

    public function get_vehicle_type() {

        $query = $this->db->get('vehicle_type');
        return $query->result_array();
    }

    public function get_status() {

        $query = $this->db->get('status_master');
        return $query->result_array();
    }

    public function get_sel_project_data($id) {
        $condition = "project_id =  " . $this->db->escape($id) . " ";
        $this->db->select('project_id,project_name,status');
        $this->db->from('project_master');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_driver_data() {
        $query = "select d.driver_id,d.driv_id,d.driver_name,d.driver_street,d.driver_city,s.state_name,d.driver_contact,d.driver_alt_contact,pt.payment_mode,d.driver_fax,d.driver_email,sm.status_name,DATE_FORMAT(d.hire_date,'%m-%d-%Y') hire_date,DATE_FORMAT(d.license_expiry,'%m-%d-%Y') license_expiry,DATE_FORMAT(d.card_renewal_date,'%m-%d-%Y') card_renewal_date	
from driver_details d 
inner join status_master sm on sm.status_code=d.driver_status
inner join states s on s.state_id=d.driver_state_id
inner join payment_type pt on pt.payment_type_id=d.payment_type_id where  company_detail_id=" . $this->db->escape($this->session->userdata['logged_in']['company_detail_id']) . " and d.driver_status!='D' order by d.driver_id desc";
        return $query = $this->db->query($query);
        //return $query->result_array();
    }

    public function dateconvert($date) {
        $oldDate = $date;
        if ($date != '') {
            $arr1 = explode('-', $oldDate);
            return $newDate = $arr1[2] . '-' . $arr1[0] . '-' . $arr1[1];
        } else {
            return $date;
        }
    }

    public function deleteProjectData($id) {

        $data = array(
            'status' => 'D',
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('project_id', $id);
        return $this->db->update('project_master', $data);
    }

    public function getInventoryTypeData() {
        $query = "select inventory_type_id,inventory_name,sm.status_name from inventory_type it
					inner join status_master sm on it.status=sm.status_code ORDER BY it.inventory_type_id desc";
        return $query = $this->db->query($query);
        //return $query->result_array();
    }

    public function save_inventorytype_data() {

        $data = array(
            'inventory_name' => $this->input->post('inventory_type_name'),
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);


        $this->db->insert('inventory_type', $data);
        return $this->db->insert_id();
    }

    public function get_sel_inventorytype_data($id) {
        $condition = "inventory_type_id =  " . $this->db->escape($id) . " ";
        $this->db->select('inventory_type_id,inventory_name,status');
        $this->db->from('inventory_type');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function edit_inventorytype_data() {
        $data = array(
            'inventory_name' => $this->input->post('inventory_type_name'),
            'status' => $this->input->post('status'),
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('inventory_type_id', $this->input->post('inventory_type_id'));
        return $this->db->update('inventory_type', $data);
    }

    public function deleteInventoryTypeData($id) {

        $data = array(
            'status' => 'D',
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('inventory_type_id', $id);
        return $this->db->update('inventory_type', $data);
    }

    public function get_project() {

        $condition = "status = 'Y'";
        $this->db->select('*');
        $this->db->from('project_master');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPOSData() {
        $query = "select project_pos_details_id,pos_name,project_name,sm.status_name from project_pos_details pps
                                        inner join project_master pm on pps.project_master_id = pm.project_id
					inner join status_master sm on pps.status=sm.status_code ORDER BY pps.project_pos_details_id desc";
        return $query = $this->db->query($query);
        //return $query->result_array();
    }

    public function save_pos_data() {

        $data = array(
            'pos_name' => $this->input->post('pos_name'),
            'project_master_id' => $this->input->post('project'),
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);


        $this->db->insert('project_pos_details', $data);
        return $this->db->insert_id();
    }

    public function get_sel_pos_data($id) {
        $condition = "project_pos_details_id =  " . $this->db->escape($id) . " ";
        $this->db->select('project_pos_details_id,pos_name,project_master_id,status');
        $this->db->from('project_pos_details');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function edit_pos_data() {
        $data = array(
            'pos_name' => $this->input->post('pos_name'),
            'project_master_id' => $this->input->post('project'),
            'status' => $this->input->post('status'),
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('project_pos_details_id', $this->input->post('project_pos_details_id'));
        return $this->db->update('project_pos_details', $data);
    }

    public function deletePOSData($id) {

        $data = array(
            'status' => 'D',
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('project_pos_details_id', $id);
        return $this->db->update('project_pos_details', $data);
    }

    public function get_pos() {

        $condition = "status = 'Y'";
        $this->db->select('*');
        $this->db->from('project_pos_details');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getServiceCenterData() {
        $query = "select project_service_center_id,service_center_name,project_name,sm.status_name 
                                        from project_service_center psc
                                        inner join project_master pm on psc.project_master_id = pm.project_id
                                        inner join status_master sm on psc.status=sm.status_code ORDER BY psc.project_service_center_id desc";
        return $query = $this->db->query($query);
        //return $query->result_array();
    }

    public function save_service_center_data() {

        $data = array(
            'service_center_name' => $this->input->post('service_center_name'),
            'project_master_id' => $this->input->post('project'),
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);


        $this->db->insert('project_service_center', $data);
        return $this->db->insert_id();
    }

    public function get_sel_servicecenter_data($id) {
        $condition = "project_service_center_id =  " . $this->db->escape($id) . " ";
        $this->db->select('project_service_center_id,service_center_name,project_master_id,status');
        $this->db->from('project_service_center');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function edit_servicecenter_data() {
        $data = array(
            'service_center_name' => $this->input->post('service_center_name'),
            'project_master_id' => $this->input->post('project'),
            'status' => $this->input->post('status'),
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('project_service_center_id', $this->input->post('project_service_center_id'));
        return $this->db->update('project_service_center', $data);
    }

    public function deleteServiceCenterData($id) {

        $data = array(
            'status' => 'D',
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('project_service_center_id', $id);
        return $this->db->update('project_service_center', $data);
    }

    public function get_service_center() {

        $condition = "status = 'Y'";
        $this->db->select('*');
        $this->db->from('project_service_center');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getInventoryData() {
        $query = "select inventory_master_id,inventory_no,inventory_sr_no,inventory_name,sm.status_name 
                  from inventory_master im
                  inner join inventory_type it on im.inventory_type_id = it.inventory_type_id
                  inner join status_master sm on im.status=sm.status_code ORDER BY im.inventory_type_id desc";
        return $query = $this->db->query($query);
        //return $query->result_array();
    }

    public function save_inventory_data() {

        $data = array(
            'inventory_type_id' => $this->input->post('inventory_type'),
            'inventory_no' => $this->input->post('inventory_no'),
            'inventory_sr_no' => $this->input->post('inventory_sr_no'),
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);


        $this->db->insert('inventory_master', $data);
        return $this->db->insert_id();
    }

    public function get_sel_inventory_data($id) {
        $condition = "inventory_master_id =  " . $this->db->escape($id) . " ";
        $this->db->select('inventory_master_id,inventory_no,inventory_sr_no,inventory_type_id,status');
        $this->db->from('inventory_master');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function edit_inventory_data() {
        $data = array(
            'inventory_type_id' => $this->input->post('inventory_type_id'),
            'inventory_no' => $this->input->post('inventory_no'),
            'inventory_sr_no' => $this->input->post('inventory_sr_no'),
            'status' => $this->input->post('status'),
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('inventory_master_id', $this->input->post('inventory_master_id'));
        return $this->db->update('inventory_master', $data);
    }

    public function deleteInventoryData($id) {

        $data = array(
            'status' => 'D',
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('inventory_master_id', $id);
        return $this->db->update('inventory_master', $data);
    }
    
    public function get_inventory_type() {

        $condition = "status = 'Y'";
        $this->db->select('*');
        $this->db->from('inventory_type');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

}
