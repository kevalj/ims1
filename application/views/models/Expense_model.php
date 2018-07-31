<?php
class Expense_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
				$this->load->library('session');
				$this->load->helper('date');

        }

		

		public function get_vehicle_data($id)
		{
			$condition = "vehicle_type_id =  " . $this->db->escape($id) . " and company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			$this->db->select('*');
			$this->db->from('vehicle_details');
			$this->db->where($condition);
			$query = $this->db->get();
			return $query->result_array();
		}


		public function get_expense_category()
		{
			$condition = "company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			$this->db->select('*');
			$this->db->from('expense_details');
			$this->db->where($condition);
			return $query = $this->db->get();
			
		}

		public function save_expense_data()
		{
			 
			$data = array(
			 'expense_details_id' => $this->input->post('expense_details_id'),
             'expense_date' => $this->dateconvert($this->input->post('expense_date')),
			 'expense_amount' => str_replace( ',', '',$this->input->post('amount')),
			 'trailer_id' => $this->input->post('trailer_id'),
			 'truck_id' => $this->input->post('truck_id'),
			 'expense_description' => $this->input->post('description'),
			 'gallons' => $this->input->post('gallons'),
				'customer_id' => $this->input->post('fuel_vendor_id'),
				'state_id' => $this->input->post('state'),
			'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);


			 $this->db->insert('category_expense_details', $data);
			return $this->db->insert_id();
		}

		public function getexpenseData()
		{
			$query="select category_expense_details_id,DATE_FORMAT(expense_date,'%m-%d-%Y') expense_date,expense_amount,expense_description,gallons,expense_name,vd.vehicle_no truck,vd1.vehicle_no trailer,customer_name,state_name
from category_expense_details ced
inner join expense_details ed on ed.expense_details_id=ced.expense_details_id
left join vehicle_details vd on vd.vehicle_id=ced.truck_id
left join vehicle_details vd1 on vd1.vehicle_id=ced.trailer_id
left join customer_details cd on cd.customer_id=ced.customer_id
left join states s on s.state_id=ced.state_id 
where ced.status='Y' and ced.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and ed.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and vd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and vd1.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."
order by category_expense_details_id desc";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}


		public function save_expense_category_data()
		{
			 
			$data = array(
			 'expense_name' => $this->input->post('exp_expense_category'),
             'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);


			 $this->db->insert('expense_details', $data);
			return $this->db->insert_id();
		}


		public function getselexpenseData($id)
		{
			$query="select category_expense_details_id,DATE_FORMAT(expense_date,'%m-%d-%Y') expense_date,expense_amount,expense_description,gallons,expense_name,ed.expense_details_id,vd.vehicle_no truck,vd.vehicle_id truck_id,vd1.vehicle_no trailer,vd1.vehicle_id trailer_id,customer_name,cd.customer_id,state_name,s.state_id,ced.status
from category_expense_details ced
inner join expense_details ed on ed.expense_details_id=ced.expense_details_id
left join vehicle_details vd on vd.vehicle_id=ced.truck_id
left join vehicle_details vd1 on vd1.vehicle_id=ced.trailer_id
left join customer_details cd on cd.customer_id=ced.customer_id
left join states s on s.state_id=ced.state_id where category_expense_details_id=".$this->db->escape($id)." and ced.status='Y' and ced.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and ed.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and vd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and vd1.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			$query = $this->db->query($query);
			return $query->result_array();
		}


		public function edit_expense_data()
		{
			 
			$data = array(
			 'expense_details_id' => $this->input->post('expense_details_id'),
             'expense_date' => $this->dateconvert($this->input->post('expense_date')),
			 'expense_amount' => str_replace( ',', '',$this->input->post('amount')),
			 'trailer_id' => $this->input->post('trailer_id'),
			 'truck_id' => $this->input->post('truck_id'),
			 'expense_description' => $this->input->post('description'),
			 'gallons' => $this->input->post('gallons'),
				'customer_id' => $this->input->post('fuel_vendor_id'),
				'state_id' => $this->input->post('state'),
			'status' =>$this->input->post('status'),
				'modified_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('modified_date', 'NOW()', FALSE);
			$this->db->where('category_expense_details_id', $this->input->post('category_expense_details_id'));

			$this->db->update('category_expense_details', $data);
			return $this->db->insert_id();
		}

		public function dateconvert($date){
				$oldDate = $date;
				if($date!=''){
				$arr1 = explode('-', $oldDate);
				return $newDate = $arr1[2].'-'.$arr1[0].'-'.$arr1[1];
				} else{
					return $date;
				}
			}
}