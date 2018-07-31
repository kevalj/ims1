<?php
class Home_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
				$this->load->library('session');
				$this->load->helper('date');

        }

		
		public function get_sysconfig_data()
		{
			$this->db->select('*');
			$this->db->from('sys_config');
			return $query = $this->db->get();
			//return $query->result_array();
		}

		public function get_maxconn_data()
		{
			$condition = "company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			$this->db->select('*');
			$this->db->where($condition);
			$this->db->from('company_detail');
			return $query = $this->db->get();
			//return $query->result_array();
		}

		public function get_companyuser_data()
		{
			$condition = "company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and status='Y'";
			$this->db->select('*');
			$this->db->from('user_login_details');
			$this->db->where($condition);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_user_data()
		{
			$condition = "company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and id=".$this->db->escape($this->session->userdata['logged_in']['userid'])." and status='Y'";
			$this->db->select('*');
			$this->db->from('user_login_details');
			$this->db->where($condition);
			$query = $this->db->get();
			return $query->result_array();
		}


		public function get_detail_user_data()
		{
			$query="select cd.company_name,cd.company_address,cd.mc,cd.bot,uld.user_id,uld.user_name,uld.email,uld.gender,uld.is_admin
					from company_detail cd
					inner join user_login_details uld on cd.company_detail_id=uld.company_detail_id
					where cd.status='Y' and uld.status='Y' and uld.id=".$this->db->escape($this->session->userdata['logged_in']['userid'])."";
			 $query = $this->db->query($query);
			return $query->result_array();
		}

		public function update_user_data(){
			if(trim($this->input->post('password'))!=""){
				$data = array(
			 'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'modified_by'=>$this->session->userdata['logged_in']['login_id']

			 );
			} else{

				$data = array(
			 'email' => $this->input->post('email'),
				'modified_by'=>$this->session->userdata['logged_in']['login_id']

			 );
			}
			//print_r($data);
			 $this->db->set('modified_date', 'NOW()', FALSE);
			 $this->db->where('id', $this->input->post('userid'));
			return $this->db->update('user_login_details', $data);
		}

		public function signup_user($activation_periode,$max_conn)
		{
			$this->db->trans_start();

			$data1 = array(
			 'company_name' => $this->input->post('companyname'),
             'company_address' => $this->input->post('companyaddress'),
				'mc' => $this->input->post('mc'),
				'bot' => $this->input->post('bot'),
			 'status' => 'Y',
			 'is_admin' => 'N',
				'max_user' =>$max_conn
			 );

			$this->db->set('active_from', 'NOW()', FALSE);
			$this->db->set('active_to', 'DATE_ADD(NOW(), INTERVAL '.$activation_periode.' DAY)', FALSE);
			$this->db->insert('company_detail', $data1);
			$company_detail_id=$this->db->insert_id();
			
			
			$data = array(
			 'user_id' => $this->input->post('userid'),
             'user_name' => $this->input->post('fullname'),
			 'password' => md5($this->input->post('password')),
				'email' => $this->input->post('email'),
				'gender' => $this->input->post('gender'),
				'status' => 'Y',
				'ip_address' => $this->input->ip_address(),
				'company_detail_id' => $company_detail_id,
				'is_admin' =>'Y'

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);


			$this->db->insert('user_login_details', $data);

			if ($this->db->trans_status() === FALSE)
				{
						$this->db->trans_rollback();
						return 0;
				}
				else
				{
						$this->db->trans_commit();
						return 1;
				}
		}

		public function login_user()
		{
			
			$userid = $this->input->post('userid');
			$password = md5($this->input->post('password'));

			$query="select uld.id,uld.user_id,uld.user_name,uld.email,uld.gender,rm.role_id,rm.role_name			 
					from user_login_details uld
					inner join user_role_relation urr on urr.user_id=uld.id
					inner join role_master rm on rm.role_id=urr.role_id
					where uld.status='Y' and urr.status='Y' and rm.status='Y' and uld.user_id=".$this->db->escape($userid)." and uld.password=".$this->db->escape($password)."";
			$query = $this->db->query($query);

			
			if ($query->num_rows() == 1) {

			$resultdata= $query->result_array();
			
			$data = array(
			 'user_id' => $resultdata[0]['id'],
             'status' => 'Y',
			 'ip_address' => $this->input->ip_address(),
			 'session_id' => $this->session->userdata['__ci_last_regenerate']

			 );
			$this->db->set('login_date', 'NOW()', FALSE);


			$insertdata=$this->db->insert('user_login_history', $data);
			//print_r($this->db->insert_id());die();
			$resultdata[0]['login_id']=$this->db->insert_id();
			return $resultdata;
			} else {
			return false;
			}
		}


		public function logout_user()
		{
			
			$data = array(
			 'status' => 'N'
             
			 );
			 $this->db->set('logout_date', 'NOW()', FALSE);
			 $this->db->where('user_login_id', $this->session->userdata['logged_in']['login_id']);
			$data= $this->db->update('user_login_history', $data);
			
			$array_items = array('logged_in');
			$this->session->unset_userdata($array_items);
			return $data;

			

		}

		public function checkcompanyexist()
		{
			
			$companyname = $this->input->post('companyname');
			
			$condition = "company_name =  " . trim($this->db->escape($companyname)) . " and  status='Y'";
			$this->db->select('*');
			$this->db->from('company_detail');
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

		public function checkuseridexist()
		{
			
			$userid = $this->input->post('userid');
			
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

		public function checkemailexist()
		{
			
			$email = $this->input->post('email');
			
			$condition = "email =  " . trim($this->db->escape($email)) . " and  status='Y'";
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

		public function deleteuser($userid){
				$data = array(
			 'status' => 'N',
				'modified_by'=>$this->session->userdata['logged_in']['login_id']

			 );
			 $this->db->set('modified_date', 'NOW()', FALSE);
			 $this->db->where('id', $userid);
			return $this->db->update('user_login_details', $data);
		}



		public function checkenoofuser()
		{
			
			$email = $this->input->post('email');
			
			$condition = "company_detail_id =  ".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and  status='Y'";
			$this->db->select('*');
			$this->db->from('user_login_details');
			$this->db->where($condition);
			$query = $this->db->get();
			$query->result_array();
			

			//echo $query->num_rows();
			return $query->num_rows() ;
		}


		public function add_user()
		{
			$this->db->trans_start();

			
			
			$data = array(
			 'user_id' => $this->input->post('userid'),
             'user_name' => $this->input->post('username'),
			 'password' => md5($this->input->post('password')),
				'email' => $this->input->post('email'),
				'gender' => $this->input->post('gender'),
				'status' => 'Y',
				'ip_address' => $this->input->ip_address(),
				'company_detail_id' => $this->session->userdata['logged_in']['company_detail_id'],
				'is_admin' =>'N',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);


			$this->db->insert('user_login_details', $data);

			if ($this->db->trans_status() === FALSE)
				{
						$this->db->trans_rollback();
						return 0;
				}
				else
				{
						$this->db->trans_commit();
						return 1;
				}
		}

		public function get_parent_menu_data($role_id)
		{
			 $query="select mm.menu_id,mm.menu_name,mm.link	 from menu_role_relation mrr 
					inner join menu_master mm on mm.menu_id=mrr.menu_id
					where mm.parent='Y' and mm.status='Y' and mrr.status='Y' #and mrr.role_id=".$this->db->escape($role_id)."
					order by mm.menu_id ";
			 $query = $this->db->query($query);
			return $query->result_array();
		}

		public function get_child_menu_data($role_id)
		{
			$query="select mm.menu_id,mm.menu_name,mm.link,mm.parent_id	 from menu_role_relation mrr 
					inner join menu_master mm on mm.menu_id=mrr.menu_id
					where mm.child='Y' and mm.status='Y' and mrr.status='Y' #and mrr.role_id=".$this->db->escape($role_id)."
					order by mm.menu_id ";
			 $query = $this->db->query($query);
			return $query->result_array();
		}

		public function get_user_pos_data($userid)
		{
			$query="select group_concat(project_pos_details_id) project_pos_details_id from user_pos_relation where status='Y' and id=".$this->db->escape($userid)."";
			 $query = $this->db->query($query);
			return $query->result_array();
		}

		public function get_user_project_data($userid)
		{
			$query="select group_concat(project_id) project_id from user_project_relation where status='Y' and id=".$this->db->escape($userid)."";
			 $query = $this->db->query($query);
			return $query->result_array();
		}

		public function get_user_service_center_data($userid)
		{
			$query="select group_concat(project_service_center_id) project_service_center_id from user_service_center_relation where status='Y' and id=".$this->db->escape($userid)."";
			 $query = $this->db->query($query);
			return $query->result_array();
		}



}