<?php
class Load_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
				$this->load->library('session');
				$this->load->helper('date');

        }

		

		
		
		public function get_vehicle_data($name)
		{
			$condition = "vehicle_no like  '%" . $this->db->escape_like_str($name) . "%' and vehicle_status!='D' and company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			$this->db->select('*');
			$this->db->from('vehicle_details');
			$this->db->where($condition);
			return $query = $this->db->get();
			//return $query->result_array();
		}

		public function get_customer_data($name)
		{
			$condition = "(customer_name like  '%" . $this->db->escape_like_str($name) . "%' or cust_id like  '%" . $this->db->escape_like_str($name) . "%') and customer_status!='D' and company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			$this->db->select('*');
			$this->db->from('customer_details');
			$this->db->where($condition);
			return $query = $this->db->get();
			//return $query->result_array();
		}

		public function get_driver_data($name)
		{
			$condition = "(driver_name like  '%" . $this->db->escape_like_str($name) . "%' or driv_id like  '%" . $this->db->escape_like_str($name) . "%') and driver_status!='D' and company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			$this->db->select('*');
			$this->db->from('driver_details');
			$this->db->where($condition);
			return $query = $this->db->get();
			//return $query->result_array();
		}

		public function get_codriver_data($name)
		{
			$condition = "driver_name like  '%" . $this->db->escape_like_str($name) . "%' aand driver_status!='D' and company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			$this->db->select('*');
			$this->db->from('driver_details');
			$this->db->where($condition);
			return $query = $this->db->get();
			//return $query->result_array();
		}

		public function save_load_data()
		{
			echo 'hiiii';

			$this->db->trans_start();
			$data = array(
				 'load_no' => $this->input->post('load_no'),
				 'customer_id' => $this->input->post('customer_id'),
				 'primary_fee' => str_replace( ',', '',$this->input->post('primary_fee')),
				 'primary_fee_type' => $this->input->post('primary_fee_type'),
				 'fsc_amount' => str_replace( ',', '',$this->input->post('fsc_amt')),
				 'fsc_amount_type' => $this->input->post('fsc_amt_type'),
				 'additional' => str_replace( ',', '',$this->input->post('additional')),
				'detention' => str_replace( ',', '',$this->input->post('detention')),
				'lumper' => str_replace( ',', '',$this->input->post('lumper')),
				'stop_off' => str_replace( ',', '',$this->input->post('stop_off')),
				'tarp_fee' => str_replace( ',', '',$this->input->post('tarp_fee')),
				'invoice_addvance' => str_replace( ',', '',$this->input->post('invoice_adv')),
				'legal_desc' => $this->input->post('legal_dic'),
				'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('loading_details', $data);
			$loading_id=$this->db->insert_id();
			for($i=0;$i<sizeof($this->input->post('shipper_id'));$i++){
			$data = array(
				 'loading_id' => $loading_id,
				 'shipper_id' => $this->input->post('shipper_id')[$i],
				 'pickup_date' => $this->dateconvert($this->input->post('pickup_date')[$i]),
				 'instructions' => $this->input->post('instructions')[$i],
				 'bol' => $this->input->post('bol')[$i],
				 'customer_req_info' => $this->input->post('cust_req_info')[$i],
				 'weight' => str_replace( ',', '',$this->input->post('weight')[$i]),
				'quantity' => str_replace( ',', '',$this->input->post('quantity')[$i]),
				'quantity_type' => $this->input->post('quantity_type')[$i],
				'notes' => $this->input->post('notes')[$i],
				'commodity' => $this->input->post('commodity')[$i],
				'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('pickup_loading_details', $data);
			}


			for($i=0;$i<sizeof($this->input->post('consignee_id'));$i++){
			$data = array(
				 'loading_id' => $loading_id,
				 'cosignee_id' => $this->input->post('consignee_id')[$i],
				 'delivery_date' => $this->dateconvert($this->input->post('delivery_date')[$i]),
				 'instruction' => $this->input->post('instructions')[$i],
				'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('delivery_loading_details', $data);
			}

			 $query="update loading_details set invoice_no=CONCAT('INV',LPAD(".$this->db->escape($loading_id).", 7, '0'))  where loading_id=".$this->db->escape($loading_id);
		     $query = $this->db->query($query);

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


		


		public function edit_load_data()
		{
			echo 'hiiii';

			$this->db->trans_start();
			$data = array(
				 'load_no' => $this->input->post('load_no'),
				 'customer_id' => $this->input->post('customer_id'),
				 'primary_fee' => str_replace( ',', '',$this->input->post('primary_fee')),
				 'primary_fee_type' => $this->input->post('primary_fee_type'),
				 'fsc_amount' => str_replace( ',', '',$this->input->post('fsc_amt')),
				 'fsc_amount_type' => $this->input->post('fsc_amt_type'),
				 'additional' => str_replace( ',', '',$this->input->post('additional')),
				'detention' => str_replace( ',', '',$this->input->post('detention')),
				'lumper' => str_replace( ',', '',$this->input->post('lumper')),
				'stop_off' => str_replace( ',', '',$this->input->post('stop_off')),
				'tarp_fee' => str_replace( ',', '',$this->input->post('tarp_fee')),
				'invoice_addvance' => str_replace( ',', '',$this->input->post('invoice_adv')),
				'legal_desc' => $this->input->post('legal_dic'),
				'status' =>$this->input->post('status'),
				'modified_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('modified_date', 'NOW()', FALSE);
			 $this->db->where('loading_id', $this->input->post('loading_id'));
			$this->db->update('loading_details', $data);
			$loading_id=$this->input->post('loading_id');


			$query="update pickup_loading_details set status='N',modified_date=now(),modified_by=".$this->db->escape($this->session->userdata['logged_in']['login_id'])."    where loading_id=".$loading_id." and status='Y'";
			 $query = $this->db->query($query);


			for($i=0;$i<sizeof($this->input->post('shipper_id'));$i++){
			$data = array(
				 'loading_id' => $loading_id,
				 'shipper_id' => $this->input->post('shipper_id')[$i],
				 'pickup_date' => $this->dateconvert($this->input->post('pickup_date')[$i]),
				 'instructions' => $this->input->post('instructions')[$i],
				 'bol' => $this->input->post('bol')[$i],
				 'customer_req_info' => $this->input->post('cust_req_info')[$i],
				 'weight' => str_replace( ',', '',$this->input->post('weight')[$i]),
				'quantity' => str_replace( ',', '',$this->input->post('quantity')[$i]),
				'quantity_type' => $this->input->post('quantity_type')[$i],
				'notes' => $this->input->post('notes')[$i],
				'commodity' => $this->input->post('commodity')[$i],
				'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('pickup_loading_details', $data);
			}


			$query="update delivery_loading_details set status='N',modified_date=now(),modified_by=".$this->db->escape($this->session->userdata['logged_in']['login_id'])."    where loading_id=".$this->db->escape($loading_id)." and status='Y'";
			 $query = $this->db->query($query);


			for($i=0;$i<sizeof($this->input->post('consignee_id'));$i++){
			$data = array(
				 'loading_id' => $loading_id,
				 'cosignee_id' => $this->input->post('consignee_id')[$i],
				 'delivery_date' => $this->dateconvert($this->input->post('delivery_date')[$i]),
				 'instruction' => $this->input->post('instructions')[$i],
				'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('delivery_loading_details', $data);
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




		public function get_load_data()
		{
			$query="select loading_id,load_no,DATE_FORMAT(pickup_date,'%m-%d-%Y') pickup_date,DATE_FORMAT(delivery_date,'%m-%d-%Y') delivery_date,
customer_name,froms,tos,bol ,status_name,status from 
			(select ld.loading_id,ld.load_no,min(pld.pickup_date) pickup_date,max(dld.delivery_date) delivery_date,
cd.customer_name,concat(cd1.customer_street,' ',cd1.customer_apt,' ',s1.state_name) froms,concat(cd2.customer_street,' ',cd2.customer_apt,' ',s2.state_name) tos,pld.bol ,sm.status_name,ld.status
from loading_details ld
inner join pickup_loading_details pld on ld.loading_id=pld.loading_id
inner join delivery_loading_details dld on dld.loading_id=ld.loading_id
inner join customer_details cd on cd.customer_id=ld.customer_id
inner join customer_details cd1 on pld.shipper_id=cd1.customer_id
inner join customer_details cd2 on dld.cosignee_id=cd2.customer_id
inner join states s1 on s1.state_id=cd1.customer_state
inner join states s2 on s2.state_id=cd2.customer_state
inner join load_status sm on sm.status_code=ld.status
where  pld.status='Y' and dld.status='Y' and ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and pld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and dld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd1.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd2.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."
group by ld.loading_id desc) a";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}


		public function get_trip_load_data()
		{
			$query="select loading_id,load_no,DATE_FORMAT(pickup_date,'%m-%d-%Y') pickup_date,DATE_FORMAT(delivery_date,'%m-%d-%Y') delivery_date,
customer_name,froms,tos,bol ,status_name,status from (select ld.loading_id,ld.load_no,min(pld.pickup_date) pickup_date,max(dld.delivery_date) delivery_date,
cd.customer_name,concat(cd1.customer_street,' ',cd1.customer_apt,' ',s1.state_name) froms,concat(cd2.customer_street,' ',cd2.customer_apt,' ',s2.state_name) tos,pld.bol ,sm.status_name,ld.status
from loading_details ld
inner join pickup_loading_details pld on ld.loading_id=pld.loading_id
inner join delivery_loading_details dld on dld.loading_id=ld.loading_id
inner join customer_details cd on cd.customer_id=ld.customer_id
inner join customer_details cd1 on pld.shipper_id=cd1.customer_id
inner join customer_details cd2 on dld.cosignee_id=cd2.customer_id
inner join states s1 on s1.state_id=cd1.customer_state
inner join states s2 on s2.state_id=cd2.customer_state
inner join load_status sm on sm.status_code=ld.status
where  pld.status='Y' and dld.status='Y' and ld.status='Y' and ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and pld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and dld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd1.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd2.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."
and ld.loading_id not in (select load_id from trip_load_details where status='Y' and company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id']).")
group by ld.loading_id desc ) a";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}


		public function get_sel_load_data($id)
		{
			$query="select ld.loading_id,ld.load_no,ld.customer_id,cd.customer_name,ld.primary_fee,ld.primary_fee_type,ld.fsc_amount,ld.fsc_amount_type,ld.additional,ld.detention,ld.lumper,ld.stop_off,ld.tarp_fee,ld.invoice_addvance,ld.legal_desc,ld.status
			from loading_details ld
			inner join customer_details cd on cd.customer_id=ld.customer_id
			where loading_id=".$this->db->escape($id)." and ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			 $query = $this->db->query($query);
			return $query->result_array();
		}

		public function get_sel_load_del_data($id)
		{
			$query="select 	dld.loading_id,dld.cosignee_id,DATE_FORMAT(dld.delivery_date,'%m-%d-%Y') delivery_date,dld.instruction,cd.customer_name from delivery_loading_details dld
					inner join customer_details cd on cd.customer_id=dld.cosignee_id
					where dld.status='Y' and loading_id=".$this->db->escape($id)." and dld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			 $query = $this->db->query($query);
			return $query->result_array();
		}

		public function get_sel_load_pic_data($id)
		{
			$query="select pld.loading_id,pld.shipper_id,DATE_FORMAT(pld.pickup_date,'%m-%d-%Y') pickup_date,pld.instructions,pld.bol,pld.customer_req_info,pld.weight,pld.quantity,pld.quantity_type,pld.notes,pld.commodity,cd.customer_name 
			from pickup_loading_details pld
			inner join customer_details cd on cd.customer_id=pld.shipper_id
			where pld.status='Y' and loading_id=".$this->db->escape($id)." and pld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			 $query = $this->db->query($query);
			return $query->result_array();
		}

		public function get_sel_load_doc_data($id)
		{
			$query="select ldd.load_doc_type_id,ldd.document_file_name from loading_details ld
			inner join load_document_details ldd on ldd.loading_id=ld.loading_id
			where ldd.status='Y' and ldd.loading_id=".$this->db->escape($id)." and ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and ldd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			 $query = $this->db->query($query);
			return $query->result_array();
		}


		public function get_driver_rate($name)
		{
			//echo $name;die;
			if($name==0){
			$condition = "status =  'Y' ";
			} else{
				$condition = "status =  'Y' and driver_rate_details_id=".$this->db->escape($name)."";
			}
			$this->db->select('*');
			$this->db->from('driver_rate_details');
			$this->db->where($condition);
			return $query = $this->db->get();
			//return $query->result_array();
		}


		public function get_trip_load_data1($id)
		{
			//echo $name;die;

			$query="select loading_id,load_no,DATE_FORMAT(pickup_date,'%m-%d-%Y') pickup_date,DATE_FORMAT(delivery_date,'%m-%d-%Y') delivery_date,
customer_name,froms,tos,bol ,status_name,status from (select ld.loading_id,ld.load_no,min(pld.pickup_date) pickup_date,max(dld.delivery_date) delivery_date,
cd.customer_name,concat(cd1.customer_street,' ',cd1.customer_apt,' ',s1.state_name) froms,concat(cd2.customer_street,' ',cd2.customer_apt,' ',s2.state_name) tos,pld.bol ,sm.status_name,ld.status
from loading_details ld
left join trip_load_details tld on tld.load_id=ld.loading_id
inner join pickup_loading_details pld on ld.loading_id=pld.loading_id
inner join delivery_loading_details dld on dld.loading_id=ld.loading_id
inner join customer_details cd on cd.customer_id=ld.customer_id
inner join customer_details cd1 on pld.shipper_id=cd1.customer_id
inner join customer_details cd2 on dld.cosignee_id=cd2.customer_id
inner join states s1 on s1.state_id=cd1.customer_state
inner join states s2 on s2.state_id=cd2.customer_state
inner join load_status sm on sm.status_code=ld.status
where  pld.status='Y' and dld.status='Y'  and tld.trip_details_id=".$this->db->escape($id)." and tld.status='Y' and ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and tld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and pld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and dld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd1.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd2.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."
group by ld.loading_id desc ) a";
			
				return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function get_load_status()
		{
			//echo $name;die;
			
			$this->db->select('*');
			$this->db->from('load_status');
			
			return $query = $this->db->get();
			//return $query->result_array();
		}

		public function get_load_status1()
		{
			//echo $name;die;
			
			$this->db->select('*');
			$this->db->from('load_status');
			
			 $query = $this->db->get();
			return $query->result_array();
		}


		public function changeStatus($id,$status)
		{
			//echo $name;die;
			
			$query="update loading_details set status=".$this->db->escape($status).",modified_date=now(),modified_by=".$this->db->escape($this->session->userdata['logged_in']['login_id'])."    where loading_id=".$this->db->escape($id)." and company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			return $query = $this->db->query($query);
			
		}




		public function insert_load_doc($loadid,$type,$docname)
		{
			//echo 'hiiii';

			$this->db->trans_start();
			

			$query="update load_document_details set status='N',modified_date=now(),modified_by=".$this->db->escape($this->session->userdata['logged_in']['login_id'])."    where loading_id=".$this->db->escape($loadid)." and load_doc_type_id=".$this->db->escape($type)." and company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			 $query = $this->db->query($query);


			$data = array(
				 'loading_id' => $loadid,
				 'load_doc_type_id' => $type,
				 'document_file_name' => $docname,
				 'status' => 'Y',
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']
				 

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('load_document_details', $data);
			


			

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