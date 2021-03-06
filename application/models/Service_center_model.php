<?php

class Service_center_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('date');
    }

    

    public function getServiceCenterInventoryData() {
        $query = "select fi.faultyId,it.inventory_name,im.inventory_no,im.inventory_sr_no,pm.project_name region,ppd.pos_name division,dm.depot_name,rm.stCategoryReasonName 
					from faulty_inventory fi
					inner join project_service_center psc on psc.project_service_center_id=fi.project_service_center_id
					inner join inventory_pos_relation ipor on ipor.inventory_pos_relation_id=fi.inventory_pos_relation_id
					inner join depot_master dm on dm.depotId=ipor.depot_Id
					inner join project_pos_details ppd on ppd.project_pos_details_id=dm.division_id
					inner join  project_master pm on pm.project_id=dm.region_id
					inner join inventory_master im on im.inventory_master_id=fi.inventory_master_id
					inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
					inner join reason_master rm on rm.reason_id= fi.issue_reason_id
					where fi.status='I'";  
					if($this->session->userdata['logged_in']['role_id']==4){
						$query = $query." and psc.project_service_center_id in (".$this->session->userdata['logged_in']['service_center'].")";
					}
        return $query = $this->db->query($query);
        //return $query->result_array();
    }

	public function getSelServiceCenterStockData($id) {
        $query = "select scps.stock_id,psc.project_service_center_id,psc.service_center_name,mp.part_id,mp.part_name,sum(scps.stock_count) ttlcnt,IFNULL(sum(fiup.count),0) usedcnt,(sum(scps.stock_count)-IFNULL(sum(fiup.count),0)) remcnt from service_center_part_stock scps
					inner join machine_parts mp on mp.part_id=scps.machine_part_id
					inner join project_service_center psc on psc.project_service_center_id=scps.service_center_id 
					left join faulty_inventory_used_parts fiup on scps.service_center_id=fiup.project_service_center_id and fiup.machine_part_id=mp.part_id
					where psc.project_service_center_id=(select project_service_center_id from faulty_inventory where faultyId=".$id.")
					group by psc.project_service_center_id,mp.part_id";  
         $query = $this->db->query($query);
        return $query->result_array();
    }


	public function get_servicecenter_machine_parts($id) {
        $query = " select distinct part_id,part_name from ( select scps.stock_id,psc.project_service_center_id,psc.service_center_name,mp.part_id,mp.part_name,sum(scps.stock_count) ttlcnt,IFNULL(sum(fiup.count),0) usedcnt,(sum(scps.stock_count)-IFNULL(sum(fiup.count),0)) remcnt from service_center_part_stock scps
					inner join machine_parts mp on mp.part_id=scps.machine_part_id
					inner join project_service_center psc on psc.project_service_center_id=scps.service_center_id 
					left join faulty_inventory_used_parts fiup on scps.service_center_id=fiup.project_service_center_id and fiup.machine_part_id=mp.part_id
					where psc.project_service_center_id=(select project_service_center_id from faulty_inventory where faultyId=".$id.")
					group by psc.project_service_center_id,mp.part_id ) a where remcnt>0";  
         $query = $this->db->query($query);
        return $query->result_array();
    }



	public function getSelServiceCenterInventoryData($id) {
        $query = "select fi.faultyId,fi.project_service_center_id,fi.inventory_master_id,fi.inventory_project_relation_id,fi.inventory_pos_relation_id,it.inventory_name,im.inventory_no,im.inventory_sr_no,pm.project_name region,ppd.pos_name division,dm.depot_name,rm.stCategoryReasonName,
            fi.faultymasterid
            from faulty_inventory fi
                                        inner join project_service_center psc on psc.project_service_center_id=fi.project_service_center_id
					inner join inventory_pos_relation ipor on ipor.inventory_pos_relation_id=fi.inventory_pos_relation_id
					inner join depot_master dm on dm.depotId=ipor.depot_Id
					inner join project_pos_details ppd on ppd.project_pos_details_id=dm.division_id
					inner join  project_master pm on pm.project_id=dm.region_id
					inner join inventory_master im on im.inventory_master_id=fi.inventory_master_id
					inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
					inner join reason_master rm on rm.reason_id= fi.issue_reason_id
                                        
					where fi.status='I' and fi.faultyId=".$this->db->escape($id)."";  
         $query = $this->db->query($query);
        return $query->result_array();
    }

	public function getSelServiceCenterInventoryData1($id) {
        $query = "select fi.faultyId,fi.project_service_center_id,fi.inventory_master_id,fi.inventory_project_relation_id,fi.inventory_pos_relation_id,it.inventory_name,im.inventory_no,im.inventory_sr_no,pm.project_name,ppd.pos_name,rm.stCategoryReasonName from faulty_inventory fi
inner join project_service_center psc on psc.project_service_center_id=fi.project_service_center_id
inner join inventory_master im on im.inventory_master_id=fi.inventory_master_id
inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
left join inventory_project_relation ipr on ipr.inventory_project_relation_id=fi.inventory_project_relation_id
left join project_master pm on pm.project_id=ipr.project_id
left join inventory_pos_relation ipor on ipor.inventory_pos_relation_id=fi.inventory_pos_relation_id
left join project_pos_details ppd on ppd.project_pos_details_id=ipor.project_pos_details_id
inner join reason_master rm on rm.reason_id= fi.issue_reason_id
where fi.status='I' and fi.faultyId=".$this->db->escape($id)."";  
         return $query = $this->db->query($query);
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


	
    public function update_repair_service_center_inventory() {
		$result=$this->getSelServiceCenterInventoryData1($this->input->post('faultyId'));
		$flg=0;
		$this->db->trans_start();
        $service_center_id=0;
		foreach ($result->result() as $r) {
			$service_center_id=$r->project_service_center_id;
                if($r->inventory_pos_relation_id!=0 && $flg==0){
					$data = array(
						'status' => 'Y',
						'modified_by' => $this->session->userdata['logged_in']['login_id']
					);
					$this->db->set('modified_date', 'NOW()', FALSE);
					$this->db->where('inventory_pos_relation_id', $r->inventory_pos_relation_id);
					$this->db->update('inventory_pos_relation', $data);

					$flg=1;

				}

				

            
        }

		if($flg==1){

        $data = array(
            'resolve_reason_id' => $this->input->post('reason'),
			'resolve_other_reason' => $this->input->post('other_reason'),
            'status' => 'R',
            'resolved_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('resolve_date', 'NOW()', FALSE);
        $this->db->where('faultyId', $this->input->post('faultyId'));
        $this->db->update('faulty_inventory', $data);
        
        
        $data = array(
            
            'status' => 'R',
            'resolved_by' => $this->session->userdata['logged_in']['login_id']
        );
        $this->db->set('resolve_date', 'NOW()', FALSE);
        $this->db->where('faultyId', $this->input->post('faultymasterid'));
        $this->db->update('faulty', $data);

        
        

		for($i=0;$i<sizeof($this->input->post('machine_parts'));$i++){

        $data = array(
            'faultyId' =>$this->input->post('faultyId'),
			'project_service_center_id' => $service_center_id,
			'machine_part_id' => $this->input->post('machine_parts')[$i],
			'count' => 1,
            'inserted_by' => $this->session->userdata['logged_in']['login_id'],
            'status' => 'Y'
        );
        $this->db->set('inserted_date', 'NOW()', FALSE);


        $this->db->insert('faulty_inventory_used_parts', $data);
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
		return "success";
		} else{
		return "error";
		}


    }

    
    
}
