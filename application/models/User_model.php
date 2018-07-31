<?php
class User_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
				$this->load->library('session');
				$this->load->helper('date');

        }

		
		

		public function getuserData()
		{
			$query="select * from user_login_details uld where status='Y'";
			 $query = $this->db->query($query);
			return $query->result_array();
		}

		public function getuserEditData($id)
		{
			$query="select uld.id,uld.user_id,uld.user_name,urr.role_id from user_login_details uld 
			inner join user_role_relation urr on uld.id=urr.user_id
			where uld.status='Y' and urr.status='Y' and id=".$this->db->escape($id)."";
			$query = $this->db->query($query);
			return $query->result_array();
		}

		public function getuserEditData1($id)
		{
			$query="select uld.id,uld.user_id,uld.user_name,urr.role_id from user_login_details uld 
			inner join user_role_relation urr on uld.id=urr.user_id
			where uld.status='Y' and urr.status='Y' and id=".$this->db->escape($id)."";
			return $query = $this->db->query($query);
			return $query->result_array();
		}

		public function getuserRoleData($id)
		{
			$query="select rm.role_id,rm.role_name from user_role_relation urr
					inner join role_master rm on urr.role_id=rm.role_id
					where urr.status='Y' and urr.user_id=".$this->db->escape($id)."";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		
        public function getProjectData()
		{
			$query="select project_id,project_name	 from project_master
					where status='Y'";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getDepotData()
		{
			$query="select depotId,depot_name	 from depot_master
					where status='Y'";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getServiceCenterData()
		{
			$query="select project_service_center_id,service_center_name from project_service_center
					where status='Y'";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getprojectEditData($id)
		{
			$query="select pm.project_id,pm.project_name,ifnull(upr.user_project_relation_id,0) user_project_relation_id from project_master pm
					left join user_project_relation upr on pm.project_id=upr.project_id
					where pm.status='Y' and upr.status='Y' and upr.id=".$this->db->escape($id)."";
			 $query = $this->db->query($query);
			return $query->result_array();
		}

		public function getprojectEditData1($id)
		{
			$query="select pm.project_id,pm.project_name,ifnull(upr.user_project_relation_id,0) user_project_relation_id from project_master pm
					left join user_project_relation upr on pm.project_id=upr.project_id
					where pm.status='Y' and upr.status='Y' and upr.id=".$this->db->escape($id)."";
			return $query = $this->db->query($query);
			return $query->result_array();
		}

		 public function getProjectPOSData($id)
		{
			 $query="select ppd.project_pos_details_id,ppd.pos_name	 from project_pos_details ppd
					where status='Y' and ppd.project_master_id in (".$id.")";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		 public function getProjectPOSEditData($id,$projectid)
		{
			 $query="select ppd.project_pos_details_id,ppd.pos_name,ifnull(upor.user_pos_relation_id,0) user_pos_relation_id	 
					from project_pos_details ppd
					left join user_pos_relation upor on upor.project_pos_details_id=ppd.project_pos_details_id and upor.status='Y' and upor.id=".$this->db->escape($id)."
					where ppd.status='Y'  and ppd.project_master_id in (".$projectid.")";
			 $query = $this->db->query($query);
			// die;
			return $query->result_array();
		}

		public function getDepotEditData($id)
		{
			 $query="select dm.depotId,dm.depot_name,ifnull(udr.user_depot_relation_id,0) user_depot_relation_id	 from depot_master dm
						left join user_depot_relation udr on udr.depotId=dm.depotId and udr.status='Y' and udr.user_id=".$id."
						where dm.status='Y' ";
			 $query = $this->db->query($query);
			// die;
			return $query->result_array();
		}

		public function getProjectServiceCenterData($id)
		{
			$query="select psc.project_service_center_id,psc.service_center_name	 from project_service_center psc
					where psc.status='Y' and psc.project_master_id in (".$id.")";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getProjectServiceCenterEditData($id)
		{
			$query="select psc.project_service_center_id,psc.service_center_name,ifnull(uscr.user_service_center_relation_id,0) user_service_center_relation_id	 from project_service_center psc
					left join user_service_center_relation uscr on uscr.project_service_center_id=psc.project_service_center_id and uscr.status='Y' and uscr.id=".$this->db->escape($id)."
					where psc.status='Y'  ";
			 $query = $this->db->query($query);
			return $query->result_array();
		}


		public function saveuserRightsData()
		{
			

			$this->db->trans_start();


			if($this->input->post('userrole')==3){
			$query="update user_depot_relation set status='N',modified_by=".$this->session->userdata['logged_in']['login_id'].",modified_date=now()  where status='Y' and user_id=".$this->input->post('user')."";
		    $query = $this->db->query($query);


			for($i=0;$i<sizeof($this->input->post('depot'));$i++){
			$data = array(
				 'user_id' => $this->input->post('user'),
				 'depotId' => $this->input->post('depot')[$i],
				'status' =>'Y',
				'created_by'=>$this->session->userdata['logged_in']['login_id']

			 );
			$this->db->set('created_date', 'NOW()', FALSE);
			$this->db->insert('user_depot_relation', $data);
			}
			}

			if($this->input->post('userrole')==4){

			$query="update user_service_center_relation set status='N',modified_by=".$this->session->userdata['logged_in']['login_id'].",modified_date=now()  where status='Y' and id=".$this->input->post('user')."";
		    $query = $this->db->query($query);

			for($i=0;$i<sizeof($this->input->post('service_center'));$i++){
			$data = array(
				 'id' => $this->input->post('user'),
				 'project_service_center_id' => $this->input->post('service_center')[$i],
				 'status' =>'Y',
				 'created_by'=>$this->session->userdata['logged_in']['login_id']

			 );
			$this->db->set('created_date', 'NOW()', FALSE);
			$this->db->insert('user_service_center_relation', $data);
			}
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

			
		}

		

		public function getuserRoleViewData()
		{
			$query="select * from (
					select uld.id,uld.user_id,uld.user_name,rm.role_name,'' depot_name,group_concat(service_center_name) service_center_name from user_login_details uld
					inner join user_role_relation urr on urr.user_id=uld.id
					inner join role_master rm on rm.role_id=urr.role_id
					inner join user_service_center_relation uscr on uscr.id=uld.id
					inner join project_service_center psc on psc.project_service_center_id=uscr.project_service_center_id
					where uld.status='Y' and urr.status='Y' and uscr.status='Y' and rm.status='Y' and rm.role_id=4
					group by uld.id

					union all

					select uld.id,uld.user_id,uld.user_name,rm.role_name,'' depot_name,'' service_center_name from user_login_details uld
					inner join user_role_relation urr on urr.user_id=uld.id
					inner join role_master rm on rm.role_id=urr.role_id
					where uld.status='Y' and urr.status='Y' and rm.status='Y' and rm.role_id=1
					group by uld.id

					union all

					select uld.id,uld.user_id,uld.user_name,rm.role_name,group_concat(dm.depot_name) depot_name,'' service_center_name from user_login_details uld
					inner join user_role_relation urr on urr.user_id=uld.id
					inner join role_master rm on rm.role_id=urr.role_id
					inner join user_depot_relation udr on udr.user_id=uld.id
					inner join depot_master dm on dm.depotId=udr.depotId
					where uld.status='Y' and urr.status='Y' and rm.status='Y' and rm.role_id=3 and udr.status='Y'
					group by uld.id
					) a order by id desc";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		
}