<?php

class Inventory_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('date');
    }

    

    public function save_project_inventory_data() {
		
		$this->db->trans_start();
		for($i=0;$i<sizeof($this->input->post('inventory'));$i++){

        $data = array(
            'inventory_master_id' => $this->input->post('inventory')[$i],
			'project_id' => $this->input->post('project'),
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);


        $this->db->insert('inventory_project_relation', $data);
		}

		if ($this->db->trans_status() === FALSE)
				{
						$this->db->trans_rollback();
						return "error";
				}
				else
				{
						$this->db->trans_commit();
						return "success";
				}
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

    public function getProjectInventoryData() {
        $query = "select ipr.inventory_project_relation_id,pm.project_name,im.inventory_no,im.inventory_sr_no,it.inventory_name,ppd.pos_name from					   inventory_project_relation ipr
				inner join inventory_master im on im.inventory_master_id=ipr.inventory_master_id
				inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
				inner join project_master pm on pm.project_id=ipr.project_id
				left join inventory_pos_relation ipor on ipor.inventory_project_relation_id=ipr.inventory_project_relation_id and ipor.status='Y'
				left join project_pos_details ppd on ppd.project_pos_details_id=ipor.project_pos_details_id
				where ipr.status='Y' and im.status='Y' and pm.status='Y'";  
        return $query = $this->db->query($query);
        //return $query->result_array();
    }

    
    public function get_sel_project_inventory_data($id) {
         $query = "select ipr.inventory_project_relation_id,pm.project_id,pm.project_name,im.inventory_master_id,im.inventory_no,im.inventory_sr_no,it.inventory_name from					   inventory_project_relation ipr
				inner join inventory_master im on im.inventory_master_id=ipr.inventory_master_id
				inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
				inner join project_master pm on pm.project_id=ipr.project_id
				where ipr.status='Y' and im.status='Y' and pm.status='Y' and ipr.inventory_project_relation_id=".$this->db->escape($id)."";  
        $query = $this->db->query($query);
		return $query->result_array();
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


	public function get_project() {
		if($this->session->userdata['logged_in']['role_id']==2 || $this->session->userdata['logged_in']['role_id']==3){
			$condition="status = 'Y' and project_id in(".$this->session->userdata['logged_in']['project'].")";
		}

		if($this->session->userdata['logged_in']['role_id']==1){
			$condition="status = 'Y' ";
		}

        
        $this->db->select('*');
        $this->db->from('project_master');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function get_inventory() {

		$query = "select im.* from inventory_master im
					where im.status='Y' and im.inventory_master_id not in(select inventory_master_id  from inventory_project_relation ipr where ipr.status='Y')";  
        $query = $this->db->query($query);
        return $query->result_array();
    }


	public function getPOSInventoryData() {
        $query = "select ipor.inventory_pos_relation_id,ppd.pos_name,pm.project_name,im.inventory_no,im.inventory_sr_no,it.inventory_name from	inventory_pos_relation ipor
                                inner join inventory_project_relation ipr on ipr.inventory_project_relation_id=ipor.inventory_project_relation_id
                                inner join project_pos_details ppd on ppd.project_pos_details_id=ipor.project_pos_details_id
                                inner join project_master pm on pm.project_id=ppd.project_master_id
								inner join inventory_master im on im.inventory_master_id=ipor.inventory_master_id
								inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
								
								where ipor.status='Y' and ipr.status='Y' and ppd.status='Y' and im.status='Y' and pm.status='Y' and it.status='Y'";  
        return $query = $this->db->query($query);
        //return $query->result_array();
    }


	public function getPOSdata($projectid) {
		if( $this->session->userdata['logged_in']['role_id']==3){
			$condition="status = 'Y' and project_pos_details_id in(".$this->session->userdata['logged_in']['pos'].")";
		} else{
        $condition = "status = 'Y' and project_master_id=" . $this->db->escape($projectid) . "";
		}
        $this->db->select('*');
        $this->db->from('project_pos_details');
        $this->db->where($condition);
        return $query = $this->db->get();
        return $query->result_array();
    }

	public function getProjectInventory($projectid) {
        $query = "select ipr.inventory_project_relation_id,im.inventory_master_id,im.inventory_no,im.inventory_sr_no	 from inventory_project_relation ipr
inner join inventory_master im on im.inventory_master_id=ipr.inventory_master_id
where ipr.status='Y' and im.status='Y' and  ipr.project_id=" . $this->db->escape($projectid) . " and ipr.inventory_project_relation_id not in (select inventory_pos_relation_id from inventory_pos_relation where status='Y')";  
        return $query = $this->db->query($query);
    }


	public function save_pos_inventory_data() {
		
		$this->db->trans_start();
		for($i=0;$i<sizeof($this->input->post('inventory'));$i++){
			$inv = explode("-", $this->input->post('inventory')[$i]);


        $data = array(
            'project_pos_details_id' => $this->input->post('pos'),
			'inventory_project_relation_id' => $inv[0],
			'inventory_master_id' => $inv[1],
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);


        $this->db->insert('inventory_pos_relation', $data);
		}

		if ($this->db->trans_status() === FALSE)
				{
						$this->db->trans_rollback();
						return "error";
				}
				else
				{
						$this->db->trans_commit();
						return "success";
				}
        return $this->db->insert_id();
    }

	public function get_service_center($projectid) {
		if($projectid==0){
			$condition = "status = 'Y' ";
		}else{
        $condition = "status = 'Y' and project_master_id=".$this->db->escape($projectid)." ";
		}
        $this->db->select('*');
        $this->db->from('project_service_center');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function get_reason() {

        $condition = "isActive = 'Y'";
        $this->db->select('*');
        $this->db->from('reason_master');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function save_project_to_service_center_data() {
		
		$this->db->trans_start();

		$data = array(
            'modified_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'I'
        );

		$this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('inventory_project_relation_id', $this->input->post('inventory_project_relation_id'));
        $this->db->update('inventory_project_relation', $data);


		$data = array(
            'project_service_center_id' => $this->input->post('service_center'),
			'inventory_master_id' => $this->input->post('inventory_master_id'),
			'inventory_project_relation_id' => $this->input->post('inventory_project_relation_id'),
			'inventory_pos_relation_id' => 0,
			'issue_reason_id' => $this->input->post('reason'),
			'issue_other_reason' => $this->input->post('other_reason'),
            'issued_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'I'
        );
        $this->db->set('issue_date', 'NOW()', FALSE);


        $this->db->insert('faulty_inventory', $data);
		

		if ($this->db->trans_status() === FALSE)
				{
						$this->db->trans_rollback();
						return "error";
				}
				else
				{
						$this->db->trans_commit();
						return "success";
				}
        return $this->db->insert_id();
    }


	public function get_sel_pos_inventory_data($id) {
         $query = "select ipor.inventory_pos_relation_id,ipr.inventory_project_relation_id,ppd.pos_name,pm.project_name,pm.project_id,im.inventory_master_id,im.inventory_no,im.inventory_sr_no,it.inventory_name 
from	inventory_pos_relation ipor
                                inner join inventory_project_relation ipr on ipr.inventory_project_relation_id=ipor.inventory_project_relation_id
                                inner join project_pos_details ppd on ppd.project_pos_details_id=ipor.project_pos_details_id
                                inner join project_master pm on pm.project_id=ppd.project_master_id
								inner join inventory_master im on im.inventory_master_id=ipor.inventory_master_id
								inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
								
								where ipor.status='Y' and ipr.status='Y' and ppd.status='Y' and im.status='Y' and pm.status='Y' and it.status='Y' and ipor.inventory_pos_relation_id=".$this->db->escape($id)."";  
        $query = $this->db->query($query);
		return $query->result_array();
    }


	public function save_pos_to_service_center_data() {
		
		$this->db->trans_start();

		$data = array(
            'modified_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'I'
        );

		$this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('inventory_pos_relation_id', $this->input->post('inventory_pos_relation_id'));
        $this->db->update('inventory_pos_relation', $data);

		$data = array(
            'project_service_center_id' => $this->input->post('service_center'),
			'inventory_master_id' => $this->input->post('inventory_master_id'),
			'inventory_project_relation_id' => $this->input->post('inventory_project_relation_id'),
			'inventory_pos_relation_id' => $this->input->post('inventory_pos_relation_id'),
			'issue_reason_id' => $this->input->post('reason'),
			'issue_other_reason' => $this->input->post('other_reason'),
            'issued_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'I'
        );
        $this->db->set('issue_date', 'NOW()', FALSE);


        $this->db->insert('faulty_inventory', $data);
		

		if ($this->db->trans_status() === FALSE)
				{
						$this->db->trans_rollback();
						return "error";
				}
				else
				{
						$this->db->trans_commit();
						return "success";
				}
        return $this->db->insert_id();
    }


	public function returnInventoryToCentral($id) {
		
		$this->db->trans_start();

		$data = array(
            'inventory_return_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'R'
        );

		$this->db->set('inventory_return_date', 'NOW()', FALSE);
        $this->db->where('inventory_project_relation_id', $id);
        $this->db->update('inventory_project_relation', $data);
		

		if ($this->db->trans_status() === FALSE)
				{
						$this->db->trans_rollback();
						return "error";
				}
				else
				{
						$this->db->trans_commit();
						return "success";
				}
        return $this->db->insert_id();
    }

	public function get_inventory_present_project_pos_service_center($id) {
         $query = "select * from (
					select count(*) cnt,'POS' status,inventory_master_id  from inventory_project_relation where status ='Y'
					union all
					select count(*) cnt,'POS' status,inventory_master_id  from inventory_pos_relation where status ='Y'
					union all
					select count(*) cnt,'Service Center' status,inventory_master_id from faulty_inventory where status ='I'
					) a where inventory_master_id =".$this->db->escape($id)."";  
        return $query = $this->db->query($query);
		return $query->result_array();
    }


	public function get_inventory_present_pos_service_center($id) {
         $query = "select * from (
					select count(*) cnt,'POS' status,inventory_master_id  from inventory_pos_relation where status ='Y'
					union all
					select count(*) cnt,'Service Center' status,inventory_master_id from faulty_inventory where status ='I'
					) a where inventory_master_id =(select inventory_master_id from inventory_project_relation where inventory_project_relation_id=".$this->db->escape($id).")";  
        return $query = $this->db->query($query);
		return $query->result_array();
    }


	public function get_inventory_present_service_center($id) {
         $query = "select * from (
					
					select count(*) cnt,'Service Center' status,inventory_master_id from faulty_inventory where status ='I'
					) a where inventory_master_id =(select inventory_master_id from inventory_pos_relation where inventory_pos_relation_id=".$this->db->escape($id).")";  
        return $query = $this->db->query($query);
		return $query->result_array();
    }

	public function returnInventoryToProject($id) {
		
		$this->db->trans_start();

		$data = array(
            'inventory_return_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'R'
        );

		$this->db->set('inventory_return_date', 'NOW()', FALSE);
        $this->db->where('inventory_pos_relation_id', $id);
        $this->db->update('inventory_pos_relation', $data);
		

		if ($this->db->trans_status() === FALSE)
				{
						$this->db->trans_rollback();
						return "error";
				}
				else
				{
						$this->db->trans_commit();
						return "success";
				}
        return $this->db->insert_id();
    }


	public function get_sel_inventory_data($id) {
        $condition = "inventory_master_id =  " . $this->db->escape($id) . " and status='Y' ";
        $this->db->select('inventory_master_id,inventory_no,inventory_sr_no,inventory_type_id,status');
        $this->db->from('inventory_master');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }


	public function save_inventory_to_service_center_data() {
		
		$this->db->trans_start();

		$data = array(
            'modified_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'I'
        );

		$this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('inventory_master_id', $this->input->post('inventory_master_id'));
        $this->db->update('inventory_master', $data);


		$data = array(
            'project_service_center_id' => $this->input->post('service_center'),
			'inventory_master_id' => $this->input->post('inventory_master_id'),
			'inventory_project_relation_id' => 0,
			'inventory_pos_relation_id' => 0,
			'issue_reason_id' => $this->input->post('reason'),
			'issue_other_reason' => $this->input->post('other_reason'),
            'issued_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'I'
        );
        $this->db->set('issue_date', 'NOW()', FALSE);


        $this->db->insert('faulty_inventory', $data);
		

		if ($this->db->trans_status() === FALSE)
				{
						$this->db->trans_rollback();
						return "error";
				}
				else
				{
						$this->db->trans_commit();
						return "success";
				}
        return $this->db->insert_id();
    }

    
}
