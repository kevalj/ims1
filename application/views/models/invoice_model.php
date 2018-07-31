<?php
class Invoice_model extends CI_Model {

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


		

		public function getInvoiceData()
		{
			$query="select loading_id,invoice_no,load_no,DATE_FORMAT(pickup_date,'%m-%d-%Y')pickup_date,DATE_FORMAT(delivery_date,'%m-%d-%Y')delivery_date,customer_name,froms,tos,(primary_fee+fsc_amount+additional+detention+lumper+stop_off+tarp_fee)amount,invoice_addvance,invoice_status,paid_status
			from (
			select ld.loading_id,ld.invoice_no,ld.load_no,min(pld.pickup_date) pickup_date,max(dld.delivery_date) delivery_date,
			cd.customer_name,concat(cd1.customer_street,' ',cd1.customer_apt,' ',s1.state_name) froms,concat(cd2.customer_street,' ',cd2.customer_apt,' ',s2.state_name) tos,
			ld.primary_fee,ld.fsc_amount,ld.additional,ld.detention,ld.lumper,ld.stop_off,ld.tarp_fee,ld.invoice_addvance,ld.invoice_status,ld.paid_status
			from loading_details ld
			inner join pickup_loading_details pld on ld.loading_id=pld.loading_id
			inner join delivery_loading_details dld on dld.loading_id=ld.loading_id
			inner join customer_details cd on cd.customer_id=ld.customer_id
			inner join customer_details cd1 on pld.shipper_id=cd1.customer_id
			inner join customer_details cd2 on dld.cosignee_id=cd2.customer_id
			inner join states s1 on s1.state_id=cd1.customer_state
			inner join states s2 on s2.state_id=cd2.customer_state
			inner join load_status sm on sm.status_code=ld.status
			where  pld.status='Y' and dld.status='Y' and sm.status_code='C' and ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and pld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and dld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd1.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd2.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."
			group by ld.loading_id desc
			) a group by loading_id";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}


		public function getSelectedInvoiceData($id)
		{
			$query="select loading_id,invoice_no,load_no,DATE_FORMAT(pickup_date,'%m-%d-%Y') pickup_date,DATE_FORMAT(delivery_date,'%m-%d-%Y') delivery_date,customer_name,froms,tos,(primary_fee+fsc_amount+additional+detention+lumper+stop_off+tarp_fee)amount,primary_fee,fsc_amount,additional,detention,lumper,stop_off,tarp_fee,invoice_addvance,invoice_status,invoice_from,invoice_to,DATE_FORMAT(invoice_created_date,'%m-%d-%Y') invoice_created_date
			from (
			select ld.loading_id,ld.invoice_no,ld.load_no,min(pld.pickup_date) pickup_date,max(dld.delivery_date) delivery_date,
			concat(cd.customer_name,', ',cd.customer_street,' ',cd.customer_apt,' ',s3.state_name,' ',cd.customer_city,' ',cd.customer_zipcode) customer_name,concat(cd1.customer_street,' ',cd1.customer_apt,' ',s1.state_name) froms,concat(cd2.customer_street,' ',cd2.customer_apt,' ',s2.state_name) tos,
			ld.primary_fee,ld.fsc_amount,ld.additional,ld.detention,ld.lumper,ld.stop_off,ld.tarp_fee,ld.invoice_addvance,ld.invoice_status,ld.invoice_from,ld.invoice_to,ld.invoice_created_date
			from loading_details ld
			inner join pickup_loading_details pld on ld.loading_id=pld.loading_id
			inner join delivery_loading_details dld on dld.loading_id=ld.loading_id
			inner join customer_details cd on cd.customer_id=ld.customer_id
			inner join states s3 on s3.state_id=cd.customer_state
			inner join customer_details cd1 on pld.shipper_id=cd1.customer_id
			inner join customer_details cd2 on dld.cosignee_id=cd2.customer_id
			inner join states s1 on s1.state_id=cd1.customer_state
			inner join states s2 on s2.state_id=cd2.customer_state
			inner join load_status sm on sm.status_code=ld.status
			where  pld.status='Y' and dld.status='Y' and sm.status_code='C' and ld.loading_id=".$this->db->escape($id)." and ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and pld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and dld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd1.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd2.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."
			group by ld.loading_id desc
			) a group by loading_id";
			$query = $this->db->query($query);
			return $query->result_array();
		}


		public function save_invoice_data()
		{
			
			$data = array(
			 'invoice_status' => 'Y',
             'invoice_created_by' => $this->session->userdata['logged_in']['login_id'],
			 'invoice_from' => $this->input->post('bill_from'),
			 'invoice_to' => $this->input->post('bill_to'),
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']
			 );
			 $this->db->set('invoice_created_date', 'NOW()', FALSE);
			 $this->db->where('loading_id', $this->input->post('loading_id'));
			return $this->db->update('loading_details', $data);
			

		}


		public function changePaidStatus($id,$cstatus)
		{
			
			$data = array(
				'paid_by' => $this->session->userdata['logged_in']['login_id'],
			 'paid_status' => $cstatus,
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']
			 );
			 $this->db->set('paid_date', 'NOW()', FALSE);
			 $this->db->where('loading_id', $id);
			return $this->db->update('loading_details', $data);
			

		}

		public function getInvoiceFromData($val)
		{
			$query="select distinct invoice_from invoice_from from loading_details ld
			where invoice_from is not null and invoice_from!=''
			and  ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and invoice_from like '%".trim($this->db->escape_like_str($val))."%'";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getInvoiceToData($val)
		{
			$query="select distinct invoice_to invoice_to from loading_details ld
			where invoice_to is not null and invoice_to!=''
			and  ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and invoice_to like '%".trim($this->db->escape_like_str($val))."%'";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}


}