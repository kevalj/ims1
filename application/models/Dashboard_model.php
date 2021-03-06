<?php
class Dashboard_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
				$this->load->library('session');
				$this->load->helper('date');

        }

		




		public function getInventoryData()
		{
			$query="select It.inventory_name,it.inventory_type_id, count(*) cnt from inventory_master im 
					inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
					where im.status='Y' and it.status='Y'
					group by it.inventory_type_id";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getInventoryTypeData()
		{
			$query="sselect * from inventory_type where status='Y'";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}


		public function getProjectwiseInventoryData()
		{
			$query="select pm.project_name,It.inventory_name,it.inventory_type_id,count(*) cnt  from inventory_project_relation ipr 
					inner join project_master pm on pm.project_id=ipr.project_id
					inner join inventory_master im on im.inventory_master_id=ipr.inventory_master_id
					inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
					where ipr.status='Y' and pm.status='Y' and im.status='Y' and it.status='Y'
					group by pm.project_id,it.inventory_type_id
					order by  pm.project_id,it.inventory_type_id";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getPOSwiseInventoryData()
		{
			$query="select pm.project_name,ppd.pos_name,It.inventory_name,it.inventory_type_id,count(*) cnt from inventory_pos_relation ipor
					inner join project_pos_details ppd on ppd.project_pos_details_id=ipor.project_pos_details_id
					inner join project_master  pm on pm.project_id=ppd.project_master_id
					inner join inventory_master im on im.inventory_master_id=ipor.inventory_master_id
					inner join inventory_type it on it.inventory_type_id=im.inventory_type_id
					where ipor.status='Y' and ppd.status='Y' and pm.status='Y' and im.status='Y' and it.status='Y'
					group by pm.project_id,ppd.project_pos_details_id,it.inventory_type_id
					order by pm.project_id,ppd.project_pos_details_id,it.inventory_type_id";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getPieChartData()
		{
			$query="select 'Faulty' type,count(*) cnt from faulty_inventory
					union
					select 'Active' type,count(*) cnt from  inventory_pos_relation where status='Y'
					";
			 $query = $this->db->query($query);
			return $query->result_array();
		}

		public function getBarChartRegionData()
		{
			$query="select project_name,sum(cnt) cnt,sum(faultycnt) faultycnt from(
					select project_name,count(*) cnt,0 faultycnt from 
					inventory_pos_relation ipor 
					inner join depot_master dm on dm.depotid=ipor.depot_id
					inner join project_master pm on pm.project_id=dm.region_id
					group by project_name

					union all

					select project_name,0 cnt,count(*) faultycnt from 
					faulty_inventory fi 
					inner join depot_master dm on dm.depotid=fi.depot_id
					inner join project_master pm on pm.project_id=dm.region_id
					group by project_name

					) a group by project_name";
			return $query = $this->db->query($query);
			return $query->result_array();
		}

		public function getBarChartDivisionData($divisionid)
		{
			$query="select pos_name,sum(cnt) cnt,sum(faultycnt) faultycnt from(
					select pos_name,count(*) cnt,0 faultycnt from 
					inventory_pos_relation ipor 
					inner join depot_master dm on dm.depotid=ipor.depot_id
					inner join project_pos_details ppd on ppd.project_pos_details_id=dm.division_id
					group by pos_name

					union all

					select pos_name,0 cnt,count(*) faultycnt from 
					faulty_inventory fi 
					inner join depot_master dm on dm.depotid=fi.depot_id
					inner join project_pos_details ppd on ppd.project_pos_details_id=dm.division_id
					group by pos_name

					) a where pos_name in( select pos_name from project_pos_details ppd
inner join project_master pm on pm.project_id=ppd.project_master_id where pm.project_name='".$divisionid."') group by pos_name";
			return $query = $this->db->query($query);
			return $query->result_array();
		}

		public function getBarChartDepotData($depotid)
		{
			$query="select depot_name,sum(cnt) cnt,sum(faultycnt) faultycnt from(
					select depot_name,count(*) cnt,0 faultycnt from 
					inventory_pos_relation ipor 
					inner join depot_master dm on dm.depotid=ipor.depot_id
					group by depot_name

					union all

					select depot_name,0 cnt,count(*) faultycnt from 
					faulty_inventory fi 
					inner join depot_master dm on dm.depotid=fi.depot_id
					group by depot_name

					) a where depot_name in(select depot_name from depot_master dm
inner join project_pos_details ppd on dm.division_id=ppd.project_pos_details_id
where ppd.pos_name='".$depotid."') group by depot_name";
			return $query = $this->db->query($query);
			return $query->result_array();
		}

		

		


		



		
}