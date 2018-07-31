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
		$cond="";
		if($this->session->userdata['logged_in']['role_id']!=1){
			$cond=" and project_id in(".$this->session->userdata['logged_in']['project'].")";
		}
        $query = "select pm.project_id,pm.project_name,sm.status_name from project_master pm
					inner join status_master sm on pm.status=sm.status_code and pm.status!='D' ".$cond." ORDER BY pm.project_id desc";
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

	public function get_division() {

        $condition = "status = 'Y'";
        $this->db->select('*');
        $this->db->from('project_pos_details');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPOSData() {
		$cond="";
		if($this->session->userdata['logged_in']['role_id']==2){
			$cond=" and pm.project_id in(".$this->session->userdata['logged_in']['project'].")";
		}

		if($this->session->userdata['logged_in']['role_id']==3){
			$cond=" and pps.project_pos_details_id in(".$this->session->userdata['logged_in']['pos'].")";
		}

        $query = "select project_pos_details_id,pos_name,project_name,sm.status_name from project_pos_details pps
                                        inner join project_master pm on pps.project_master_id = pm.project_id
					inner join status_master sm on pps.status=sm.status_code where pps.status!='D' ".$cond." ORDER BY pps.project_pos_details_id desc";
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
		$cond="";
		if($this->session->userdata['logged_in']['role_id']==2 || $this->session->userdata['logged_in']['role_id']==3){
			$cond=" and pm.project_id in(".$this->session->userdata['logged_in']['project'].")";
		}

        $query = "select psc.project_service_center_id,service_center_name,group_concat(pos_name) pos_name,sm.status_name  
                                        from project_service_center psc
										inner join service_center_division_relation scdr on scdr.project_service_center_id=psc.project_service_center_id
                                        inner join project_pos_details pm on scdr.division_id = pm.project_pos_details_id
                                        inner join status_master sm on psc.status=sm.status_code where psc.status!='D' ".$cond."
										group by psc.project_service_center_id
										ORDER BY psc.project_service_center_id desc";
        return $query = $this->db->query($query);
        //return $query->result_array();
    }

    public function save_service_center_data() {
		$this->db->trans_start();

		$data = array(
            'service_center_name' => $this->input->post('service_center_name'),
            
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);


        $this->db->insert('project_service_center', $data);
        $servicecenterid= $this->db->insert_id();


		for($i=0;$i<sizeof($this->input->post('project'));$i++){

        $data = array(
            'project_service_center_id' => $servicecenterid,
            'division_id' => $this->input->post('project')[$i],
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);


        $this->db->insert('service_center_division_relation', $data);
        
		}

		if ($this->db->trans_status() === FALSE)
				{
			//echo "aa";die;
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

    public function get_sel_servicecenter_data($id) {
        $condition = "project_service_center_id =  " . $this->db->escape($id) . " ";
        $this->db->select('project_service_center_id,service_center_name,project_master_id,status');
        $this->db->from('project_service_center');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function get_sel_servicecenter_division_data($id) {
        $condition = "project_service_center_id =  " . $this->db->escape($id) . " ";
        $this->db->select('project_service_center_id,division_id,status');
        $this->db->from('service_center_division_relation');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function edit_servicecenter_data() {
		$this->db->trans_start();

        $data = array(
            'service_center_name' => $this->input->post('service_center_name'),
            
            'status' => $this->input->post('status'),
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('project_service_center_id', $this->input->post('project_service_center_id'));
        $this->db->update('project_service_center', $data);

		$query = "update service_center_division_relation set status='N',updated_date=now(),updated_by=".$this->session->userdata['logged_in']['login_id']." where status='Y' and project_service_center_id=".$this->input->post('project_service_center_id')."";
        $this->db->query($query);

		for($i=0;$i<sizeof($this->input->post('project'));$i++){

        $data = array(
            'project_service_center_id' => $this->input->post('project_service_center_id'),
            'division_id' => $this->input->post('project')[$i],
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);


        $this->db->insert('service_center_division_relation', $data);
        
		}

		if ($this->db->trans_status() === FALSE)
				{
			//echo "aa";die;
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
    
    public function getUserData() {
        $query ="select id,uld.user_id,user_name,password,email,gender,urr.role_id,rm.role_name,sm.status_name 
                from user_login_details uld
                inner join user_role_relation urr on uld.id=urr.user_id
                inner join role_master rm on urr.role_id=rm.role_id                        
		        inner join status_master sm on uld.status=sm.status_code
                where uld.status='Y' and urr.status='Y' ORDER BY uld.id desc";
        return $query = $this->db->query($query);
        //return $query->result_array();
    }


	public function checkuseridexist()
		{
			
			$userid = $this->input->post('login_name');
			
			$condition = "user_id =  " . trim($this->db->escape($userid)) . " and  status='Y'";
			$this->db->select('*');
			$this->db->from('user_login_details');
			$this->db->where($condition);
			$query = $this->db->get();
			$query->result_array();
			

			//echo $query->num_rows();
			if ($query->num_rows() == 0) {
			return "success";
			} else {
			return "error";
			}
		}

    public function save_user_data() {
        
        $this->db->trans_start();
        
        $data = array(
            'user_id' => $this->input->post('user_name'),
            'user_name' => $this->input->post('login_name'),
            'password' => md5($this->input->post('password')),
            'email' => $this->input->post('email'),
            'gender' => $this->input->post('gender'),
            'inserted_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('inserted_date', 'NOW()', FALSE);

        $this->db->insert('user_login_details', $data);
        $userId = $this->db->insert_id();
        

        $data = array(
            'user_id' => $userId,
            'role_id' => $this->input->post('user_role'),
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);

        $this->db->insert('user_role_relation', $data);
        
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
    }

    public function get_sel_user_data($id) {
        $query ="select id,uld.user_id,user_name,password,email,gender,urr.role_id,rm.role_name,sm.status_name 
                from user_login_details uld
                inner join user_role_relation urr on uld.id=urr.user_id
                inner join role_master rm on urr.role_id=rm.role_id                        
		        inner join status_master sm on uld.status=sm.status_code 
                where uld.id=" . $this->db->escape($id) ." and uld.status='Y' and urr.status='Y'";
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function edit_user_data() {

		$this->db->trans_start();

        $data = array(
            
            'user_name' => $this->input->post('user_name'),
            'email' => $this->input->post('email'),
            'gender' => $this->input->post('gender'),
            'status' => $this->input->post('status'),
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
			//print_r($data);die;
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('id', $this->input->post('user_master_id'));
        $this->db->update('user_login_details', $data);

		$query = "update user_role_relation set status='N', modified_by=".$this->session->userdata['logged_in']['login_id'].", modified_date=NOW()
		          where user_id = ".$this->input->post('user_master_id')." and status='Y'";
         $query = $this->db->query($query);

		 $data = array(
            'user_id' => $this->input->post('user_master_id'),
            'role_id' => $this->input->post('user_role'),
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);

        $this->db->insert('user_role_relation', $data);
        
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
    }

    public function deleteUserData($id) {

        $data = array(
            'status' => 'D',
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('id', $id);
        return $this->db->update('user_login_details', $data);
    }
    
    public function get_user_roles() {

        $condition = "status = 'Y'";
        $this->db->select('*');
        $this->db->from('role_master');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDepotData() {
		$cond="";
		if($this->session->userdata['logged_in']['role_id']==2){
			$cond=" and pm.project_id in(".$this->session->userdata['logged_in']['project'].")";
		}

		if($this->session->userdata['logged_in']['role_id']==3){
			$cond=" and pps.project_pos_details_id in(".$this->session->userdata['logged_in']['pos'].")";
		}
		$cond="";
        $query = "select depotId,depot_name,project_pos_details_id,pos_name,project_name,sm.status_name 
			from depot_master dm
					inner join project_pos_details pps on dm.division_id  = pps.project_pos_details_id
                                        inner join project_master pm on pps.project_master_id = pm.project_id
					inner join status_master sm on pps.status=sm.status_code where dm.status!='D' ".$cond." ORDER BY dm.depotId desc";
        return $query = $this->db->query($query);
        //return $query->result_array();
    }

    public function save_depot_data() {

        $data = array(
            'depot_name' => $this->input->post('depot_name'),
            'division_id' => $this->input->post('division'),
            'region_id' => $this->input->post('project'),
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);


        $this->db->insert('depot_master', $data);
        return $this->db->insert_id();
    }

    public function get_sel_depot_data($id) {
        $condition = "depotId =  " . $this->db->escape($id) . " ";
        $this->db->select('depotId,depot_name,division_id,region_id,status');
        $this->db->from('depot_master');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function edit_depot_data() {
        $data = array(
            'depot_name' => $this->input->post('depot_name'),
            'division_id' => $this->input->post('division'),
            'region_id' => $this->input->post('project'),
            'status' => $this->input->post('status'),
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('depotId', $this->input->post('depotId'));
        return $this->db->update('depot_master', $data);
    }

    public function deleteDepotData($id) {

        $data = array(
            'status' => 'D',
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('depotId', $id);
        return $this->db->update('depot_master', $data);
    }

    public function get_depot() {

        $condition = "status = 'Y'";
        $this->db->select('*');
        $this->db->from('depot_master');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getMachinePartTypeData() {
        $query = "select part_id,part_name,sm.status_name from machine_parts mp
					inner join status_master sm on mp.status=sm.status_code ORDER BY mp.part_id desc";
        return $query = $this->db->query($query);
        //return $query->result_array();
    }

    public function save_machineparttype_data() {

        $data = array(
            'part_name' => $this->input->post('machine_part_type_name'),
            'created_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('created_date', 'NOW()', FALSE);


        $this->db->insert('machine_parts', $data);
        return $this->db->insert_id();
    }

    public function get_sel_machineparttype_data($id) {
        $condition = "part_id =  " . $this->db->escape($id) . " ";
        $this->db->select('part_id,part_name,status');
        $this->db->from('machine_parts');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function edit_machineparttype_data() {
        $data = array(
            'part_name' => $this->input->post('machine_part_type_name'),
            'status' => $this->input->post('status'),
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('part_id', $this->input->post('part_id'));
        return $this->db->update('machine_parts', $data);
    }

    public function deleteMachinePartTypeData($id) {

        $data = array(
            'status' => 'D',
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('part_id', $id);
        return $this->db->update('machine_parts', $data);
    }

    
    public function getMachinePartData() {
        $query = "select stock_id,machine_part_id,part_name,stock_count,sm.status_name,mps.inserted_date,mps.inserted_by,user_name
                  from machine_part_stock mps
                  inner join machine_parts mp on mps.machine_part_id = mp.part_id
                  inner join status_master sm on mps.status=sm.status_code 
                  inner join user_login_details uld on mps.inserted_by=uld.id
                  ORDER BY mps.stock_id desc";
        return $query = $this->db->query($query);
        //return $query->result_array();
    }

    public function save_machine_part_data() {

        $data = array(
            'machine_part_id' => $this->input->post('machine_part_type_id'),
            'stock_count' => $this->input->post('machine_part_count'),
            'inserted_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('inserted_date', 'NOW()', FALSE);


        $this->db->insert('machine_part_stock', $data);
        return $this->db->insert_id();
    }

    public function get_sel_machine_part_data($id) {
        $query = "select stock_id,machine_part_id,part_name,stock_count,sm.status_name 
                  from machine_part_stock mps
                  inner join machine_parts mp on mps.machine_part_id = mp.part_id
                  inner join status_master sm on mps.status=sm.status_code
                  where stock_id =  " . $this->db->escape($id) . "
                  ORDER BY mps.stock_id desc";
        $queryR = $this->db->query($query);
        return $queryR->result_array();
    }


    public function deleteMachinePartData($id) {

        $data = array(
            'status' => 'D',
            'modified_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('inventory_master_id', $id);
        return $this->db->update('inventory_master', $data);
    }
    
    public function get_machine_part_type() {

        $condition = "status = 'Y'";
        $this->db->select('*');
        $this->db->from('machine_parts');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

}
