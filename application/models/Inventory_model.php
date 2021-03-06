<?php

class Inventory_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('date');
    }

    

    public function save_service_center_inventory_data() {
		
		$this->db->trans_start();
		for($i=0;$i<sizeof($this->input->post('service_center'));$i++){

        $data = array(
            'service_center_id' => $this->input->post('service_center')[$i],
			'machine_part_id' => $this->input->post('machine_parts')[$i],
			'stock_count' => $this->input->post('count')[$i],
            'inserted_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('inserted_date', 'NOW()', FALSE);


        $this->db->insert('service_center_part_stock', $data);
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

    public function getServiceCenterInventoryData() {
        $query = "select scps.stock_id,psc.service_center_name,mp.part_name,sum(scps.stock_count) ttlcnt,IFNULL(sum(fiup.count),0) usedcnt,(sum(scps.stock_count)-IFNULL(sum(fiup.count),0)) remcnt from service_center_part_stock scps
inner join machine_parts mp on mp.part_id=scps.machine_part_id
inner join project_service_center psc on psc.project_service_center_id=scps.service_center_id 
left join faulty_inventory_used_parts fiup on scps.service_center_id=fiup.project_service_center_id and fiup.machine_part_id=mp.part_id
group by psc.project_service_center_id,mp.part_id";  
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
		$condition="status = 'Y'";
		

		if($this->session->userdata['logged_in']['role_id']==3){

		 $query = "select * from project_master pm where pm.status='Y' and project_id in (select region_id from depot_master where depotId in (".$this->session->userdata['logged_in']['depot'].") and status='Y')";  
		}else{
		$query = "select * from project_master pm on pm.status='Y' ";  
		}
        $query = $this->db->query($query);
        return $query->result_array();
    }

	public function get_inventory() {

		$query = "select im.* from inventory_master im
					where im.status='Y' and im.inventory_master_id not in(select inventory_master_id  from inventory_project_relation ipr where ipr.status='Y')";  
        $query = $this->db->query($query);
        return $query->result_array();
    }


	public function getDepotData($divisionid) {

		if($this->session->userdata['logged_in']['role_id']==3){

		 $query = "select * from depot_master dm where dm.status='Y' and depotId in (".$this->session->userdata['logged_in']['depot'].") and dm.division_id=".$divisionid."";  
		}else{
		$query = "select dm.depot_name,dm.depotId 
				from depot_master dm                                
				where dm.status='Y' and dm.division_id=".$divisionid."";   
		}

        
        return $query = $this->db->query($query);
        //return $query->result_array();
    }


	public function getPOSdata($projectid) {
		

		if($this->session->userdata['logged_in']['role_id']==3){

		 $query = "select * from project_pos_details ppd where ppd.status='Y' and project_pos_details_id in (select division_id from depot_master where depotId in (".$this->session->userdata['logged_in']['depot'].") and status='Y') and ppd.project_master_id=".$projectid."";  
		}else{
		$query = "select * from project_pos_details ppd where  ppd.status='Y' and ppd.project_master_id=".$projectid."";  
		}
		return $query = $this->db->query($query);
        return $query->result_array();
    }

	public function getProjectInventory($projectid) {
        $query = "select im.inventory_master_id,im.inventory_no,im.inventory_sr_no	 
		from inventory_master im
		where  im.status='Y'  and im.inventory_master_id not in (select inventory_master_id from inventory_pos_relation where status='Y')";  
        return $query = $this->db->query($query);
    }


	public function getDepotInventory($projectid) {
        $query = "select ipr.inventory_project_relation_id,im.inventory_master_id,im.inventory_no,im.inventory_sr_no	 
		from inventory_project_relation ipr
		inner join inventory_master im on im.inventory_master_id=ipr.inventory_master_id
		where ipr.status='Y' and im.status='Y' and  ipr.project_id=" . $this->db->escape($projectid) . " and ipr.inventory_project_relation_id not in (select inventory_pos_relation_id from inventory_pos_relation where status='Y')";  
        return $query = $this->db->query($query);
    }

	public function save_pos_inventory_data() {
		
		$this->db->trans_start();
		for($i=0;$i<sizeof($this->input->post('inventory'));$i++){
			

        $data = array(
			'depot_id' => $this->input->post('depot'),
            'inventory_master_id' => $this->input->post('inventory')[$i],
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

	public function get_machine_parts() {
			$condition = "status = 'Y' ";
		
        $this->db->select('*');
        $this->db->from('machine_parts');
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
    
    
    public function get_solution() {

        $condition = "isActive = 'Y'";
        $this->db->select('*');
        $this->db->from('solution_reason_master');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function get_service_center1() {

        $condition = "status = 'Y'";
        $this->db->select('*');
        $this->db->from('project_service_center');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }


	public function get_depot() {

        $condition = "status = 'Y'";
		if($this->session->userdata['logged_in']['role_id']==3){
					$condition=" depotId in (".$this->session->userdata['logged_in']['depot'].")";
					}
        $this->db->select('*');
        $this->db->from('depot_master');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_division() {

        $condition = "status = 'Y'";
		if($this->session->userdata['logged_in']['role_id']==3){
					$condition=" project_pos_details_id in (".$this->session->userdata['logged_in']['depot'].")";
					}
        $this->db->select('*');
        $this->db->from('project_pos_details');
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


	public function save_depot_to_service_center_data() {
		
		$this->db->trans_start();

		for($i=0;$i<sizeof($this->input->post('depot'));$i++){

		$invid=explode("-",$this->input->post('inventory')[$i]);

		$data = array(
            'modified_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'I'
        );

		$this->db->set('modified_date', 'NOW()', FALSE);
        $this->db->where('inventory_pos_relation_id',$invid[1]);
        $this->db->update('inventory_pos_relation', $data);

		
        $data = array(
			'depot_id' => $this->input->post('depot')[$i],
            'inventory_master_id' =>$invid[0],
			'inventory_pos_relation_id' => $invid[1],
            'faultymasterid'=> $invid[2],
			'project_service_center_id' => $this->input->post('service_center')[$i],
			'issue_reason_id' => $this->input->post('reason')[$i],
			'issue_other_reason' => $this->input->post('other_reason')[$i],
            'issued_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'I'
        );
        
        $this->db->set('issue_date', 'NOW()', FALSE);
        $this->db->insert('faulty_inventory', $data);

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
    
    
    
	public function save_depot_to_faulty_data() {
            
            //print_r($_POST);die;
		
		$this->db->trans_start();

		for($i=0;$i<sizeof($this->input->post('inventory'));$i++){

		$invid=explode("-",$this->input->post('inventory')[$i]);
                
                $query = "select depot_id from inventory_pos_relation where inventory_master_id =".$this->db->escape($invid[0])."";  
                $query = $this->db->query($query);
		$data= $query->result_array();
                //echo $data[0]['depot_id'];
                //print_r($data);die;

//$depot_id
		
        $data = array(
			'depot_id' => $data[0]['depot_id'],
                        'inventory_master_id' =>$invid[0],
			'inventory_pos_relation_id' => $invid[1],
			'issue_reason_id' => $this->input->post('reason')[$i],
                        'issued_by' => $this->session->userdata['logged_in']['login_id'],
                        'status' => 'F'
        );
        
        $this->db->set('issue_date', 'NOW()', FALSE);
        $this->db->insert('faulty', $data);

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



	public function getDepotInventoryData() {
         $query = "select ipr.inventory_pos_relation_id,dm.depot_name,ppd.pos_name division_name,pm.project_name region_name,im.inventory_sr_no,it.inventory_name 
			from inventory_pos_relation ipr
			inner join depot_master dm on dm.depotId=ipr.depot_id
			inner join project_pos_details ppd on dm.division_id=ppd.project_pos_details_id
			inner join project_master pm on dm.region_id=pm.project_id
			inner join inventory_master im on im.inventory_master_id=ipr.inventory_master_id
			inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
			where ipr.status='Y' and dm.status='Y' and im.status='Y' and it.status='Y'";  
			if($this->session->userdata['logged_in']['role_id']==3){
			$query=$query." and dm.depotId in (".$this->session->userdata['logged_in']['depot'].")";
			}
			$query=$query." order by pm.project_id,ppd.project_pos_details_id,dm.depotId,im.inventory_master_id";
                        
                        $query=$query." limit 100";
        return $query = $this->db->query($query);
		return $query->result_array();
    }


	public function getDepotInventorySelect($depotid) {
         $query = "select ipr.inventory_pos_relation_id,dm.depot_name,im.inventory_sr_no,it.inventory_name,im.inventory_master_id from inventory_pos_relation ipr
					inner join depot_master dm on dm.depotId=ipr.depot_id
					inner join inventory_master im on im.inventory_master_id=ipr.inventory_master_id
					inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
					where ipr.status='Y' and dm.status='Y' and im.status='Y' and it.status='Y' and ipr.depot_id=".$depotid."";  
        return $query = $this->db->query($query);
		$query->result_array();
    }
    
    public function getDivisionInventorySelect($depotid) {
         $query = "select im.inventory_master_id,ipr.inventory_pos_relation_id,im.inventory_sr_no from inventory_pos_relation ipr
inner join inventory_master im on im.inventory_master_id=ipr.inventory_master_id
inner join depot_master dm on dm.depotid=ipr.depot_id
inner join project_pos_details ppd on ppd.project_pos_details_id=dm.division_id
where ppd.project_pos_details_id=".$depotid." and im.inventory_master_id not in (select inventory_master_id from faulty where status='F')";  
        return $query = $this->db->query($query);
		$query->result_array();
    }
    
    public function getDepotFaultyInventorySelect($depotid) {
         $query = "select f.inventory_master_id,f.inventory_pos_relation_id,im.inventory_sr_no,f.faultyId from faulty f
inner join inventory_master im on im.inventory_master_id=f.inventory_master_id
where f.status='F' and depot_id=".$depotid."";  
        return $query = $this->db->query($query);
		$query->result_array();
    }
    
    
    public function getDivisionFaultyInventorySelect($depotid) {
         $query = "select im.inventory_master_id,ipr.inventory_pos_relation_id,im.inventory_sr_no,f.faultyId from faulty f
inner join inventory_pos_relation ipr on f.inventory_pos_relation_id=ipr.inventory_pos_relation_id
inner join inventory_master im on im.inventory_master_id=ipr.inventory_master_id
inner join depot_master dm on dm.depotid=ipr.depot_id
inner join project_pos_details ppd on ppd.project_pos_details_id=dm.division_id
where f.status='F' and im.inventory_master_id not in (select inventory_master_id from faulty_inventory where status ='I') and ppd.project_pos_details_id=".$depotid."";  
        return $query = $this->db->query($query);
		$query->result_array();
    }


	public function getDepotServiceCenter($depotid) {
         $query = "select psc.project_service_center_id,service_center_name	 from project_service_center psc
		 inner join service_center_division_relation scdr on scdr.project_service_center_id=psc.project_service_center_id
					where scdr.division_id=".$depotid."  and psc.status='Y' and scdr.status='Y'";  
        return $query = $this->db->query($query);
		$query->result_array();
    }

    
}
