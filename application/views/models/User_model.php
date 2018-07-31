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

		public function getProjectServiceCenterData($id)
		{
			$query="select psc.project_service_center_id,psc.service_center_name	 from project_service_center psc
					where psc.status='Y' and psc.project_master_id in (".$id.")";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getProjectServiceCenterEditData($id,$projectid)
		{
			$query="select psc.project_service_center_id,psc.service_center_name,ifnull(uscr.user_service_center_relation_id,0) user_service_center_relation_id	 from project_service_center psc
					left join user_service_center_relation uscr on uscr.project_service_center_id=psc.project_service_center_id and uscr.status='Y' and uscr.id=".$this->db->escape($id)."
					where psc.status='Y'  and psc.project_master_id in (".$projectid.")";
			 $query = $this->db->query($query);
			return $query->result_array();
		}


		public function saveuserRightsData()
		{
			

			$this->db->trans_start();

//print_r($this->session->userdata['logged_in']);
			$query="update user_project_relation set status='N',modified_by=".$this->session->userdata['logged_in']['login_id'].",modified_date=now()  where status='Y' and id=".$this->input->post('user')."";
		    $query = $this->db->query($query);

			for($i=0;$i<sizeof($this->input->post('project'));$i++){
			$data = array(
				 'id' => $this->input->post('user'),
				 'project_id' => $this->input->post('project')[$i],
				'status' =>'Y',
				'created_by'=>$this->session->userdata['logged_in']['login_id']

			 );
			$this->db->set('created_date', 'NOW()', FALSE);
			$this->db->insert('user_project_relation', $data);
			}


			if($this->input->post('userrole')==3){
			$query="update user_pos_relation set status='N',modified_by=".$this->session->userdata['logged_in']['login_id'].",modified_date=now()  where status='Y' and id=".$this->input->post('user')."";
		    $query = $this->db->query($query);


			for($i=0;$i<sizeof($this->input->post('pos'));$i++){
			$data = array(
				 'id' => $this->input->post('user'),
				 'project_pos_details_id' => $this->input->post('pos')[$i],
				'status' =>'Y',
				'created_by'=>$this->session->userdata['logged_in']['login_id']

			 );
			$this->db->set('created_date', 'NOW()', FALSE);
			$this->db->insert('user_pos_relation', $data);
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
			$query="select id,user_id,user_name,group_concat(project_name) project_name,group_concat(pos_name) pos_name,group_concat(service_center_name) service_center_name from (
			select distinct uld.id,uld.user_id,uld.user_name,pm.project_name,'' pos_name,'' service_center_name
			from user_login_details uld
			inner join user_project_relation  upr on uld.id=upr.id and upr.status='Y'
			inner join project_master pm on pm.project_id=upr.project_id

			union all

			select distinct uld.id,uld.user_id,uld.user_name,'' project_name,'' pos_name,psc.service_center_name
			#,psc.service_center_name,ppd.pos_name
			#uld.user_id,uld.user_name,group_concat(user_project_relation_id)	 
			from user_login_details uld
			inner join user_service_center_relation uscr on uscr.id=uld.id and uscr.status='Y'
			inner join project_service_center psc on psc.project_service_center_id =uscr.project_service_center_id

			union all

			select distinct uld.id,uld.user_id,uld.user_name,'' project_name,ppd.pos_name,'' service_center_name	 
			from user_login_details uld
			inner join user_pos_relation upor on upor.id=uld.id and upor.status='Y'
			inner join project_pos_details ppd on ppd.project_pos_details_id=upor.project_pos_details_id
			) a
			group by id";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		
}