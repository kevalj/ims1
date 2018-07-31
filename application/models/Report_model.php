<?php
class Report_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
				$this->load->library('session');
				$this->load->helper('date');

        }

		




		public function getTotalInventoryData()
		{
			$query="select count(*) cnt from inventory_master where status!='D'";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getInventoryTypewiseData()
		{
			$query="select it.inventory_type_id,it.inventory_name,count(*) cnt	 from inventory_master im
					inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
					where it.status!='D' and im.status!='D'
					group by it.inventory_type_ids";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getProjectwiseData()
		{
			$query="select pm.project_id,pm.project_name,it.inventory_type_id,it.inventory_name,count(*) cnt	 from inventory_project_relation ipr
					inner join inventory_master im on ipr.inventory_master_id=im.inventory_master_id
					inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
					inner join project_master pm on pm.project_id=ipr.project_id
					#where ipr.status='Y' 
					group by pm.project_id";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getPOSwiseData()
		{
			$query="select ppd.project_pos_details_id,ppd.pos_name,pm.project_id,pm.project_name,it.inventory_type_id,it.inventory_name,count(*) cnt from inventory_pos_relation ipor
			inner join inventory_project_relation  ipr on ipor.inventory_project_relation_id=ipr.inventory_project_relation_id
			inner join inventory_master im on ipr.inventory_master_id=im.inventory_master_id
			inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
			inner join project_pos_details ppd on ppd.project_pos_details_id=ipor.project_pos_details_id
			inner join project_master pm on pm.project_id=ppd.project_master_id
			#where ipor.status='Y' 
			group by pm.project_id,ppd.project_pos_details_id";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}


		public function getInventoryDetailData()
		{
			$query="select im.inventory_master_id,im.inventory_no,im.inventory_sr_no,it.inventory_type_id,it.inventory_name	 from inventory_master im
					inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
					where im.status!='D'";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}


		

		public function getInventoryData($region,$division,$depot)
		{
			$query="select im.inventory_sr_no,it.inventory_type_id,it.inventory_name,dm.depotId,dm.depot_name,pm.project_id,pm.project_name,ppd.project_pos_details_id,ppd.pos_name		 from inventory_master im
					inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
					left join inventory_pos_relation ipor on ipor.inventory_master_id=im.inventory_master_id and ipor.status='Y'
					inner join depot_master dm on dm.depotid=ipor.depot_id
					inner join project_master pm on pm.project_id=dm.region_id
					inner join project_pos_details ppd on ppd.project_master_id=pm.project_id
					where im.status='Y'";

					if($region!=0){
						$query=$query." and pm.project_id=".$region."";
					}

					if($division!=0){
						$query=$query." and ppd.project_pos_details_id=".$division."";
					}

					if($depot!=0){
						$query=$query." and dm.depotId=".$depot."";
					}
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getFaultyInventoryData($region,$division,$depot)
		{
			$query="select it.inventory_name,im.inventory_sr_no,pm.project_name,pm.project_id ,ppd.pos_name,ppd.project_pos_details_id,dm.depot_name,dm.depotId,rm.stCategoryReasonName 
					from faulty_inventory fi
					inner join project_service_center psc on psc.project_service_center_id=fi.project_service_center_id
					inner join inventory_pos_relation ipor on ipor.inventory_pos_relation_id=fi.inventory_pos_relation_id
					inner join depot_master dm on dm.depotId=ipor.depot_Id
					inner join project_pos_details ppd on ppd.project_pos_details_id=dm.division_id
					inner join  project_master pm on pm.project_id=dm.region_id
					inner join inventory_master im on im.inventory_master_id=fi.inventory_master_id
					inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
					inner join reason_master rm on rm.reason_id= fi.issue_reason_id
					
					where im.status='Y'";

					if($region!=0){
						$query=$query." and pm.project_id=".$region."";
					}

					if($division!=0){
						$query=$query." and ppd.project_pos_details_id=".$division."";
					}

					if($depot!=0){
						$query=$query." and dm.depotId=".$depot."";
					}
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getRegion()
		{
			$query="select * from project_master where status!='D'";
			 $query = $this->db->query($query);
			return $query->result_array();
		}



		
}