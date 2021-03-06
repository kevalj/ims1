<?php
class Trip_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
				$this->load->library('session');
				$this->load->helper('date');

        }

		

		
		
		
		public function save_trip_data()
		{
			echo 'hiiii';

			$this->db->trans_start();
			$data = array(
				 'trip_number' => $this->input->post('cust_trip_no'),
				 'trip_tracking_link' => $this->input->post('trip_tracking_link'),
				 'driver_id' => $this->input->post('driver_id'),
				 'acc_driver_pay' => str_replace( ',', '',$this->input->post('acc_driver_pay')),
				 'driver_advance' => str_replace( ',', '',$this->input->post('driver_advance')),
				 'team_driver_id' => $this->input->post('team_driver_id'),
				 'team_acc_driver_pay' => str_replace( ',', '',$this->input->post('acc_team_driver_pay')),
				'team_driver_advance' => str_replace( ',', '',$this->input->post('team_driver_advance')),
				'truck_id' => $this->input->post('truck_id'),
				'trailer_id' => $this->input->post('trailer_id'),
				'odometer' => $this->input->post('odometer1'),
				'load_id' => '1',
				'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('trip_details', $data);
			$trip_details_id=$this->db->insert_id();


			for($i=0;$i<sizeof($this->input->post('routing_stop_id'));$i++){
			$data = array(
				 'trip_details_id' => $trip_details_id,
				 'routing_stop_id' => $this->input->post('routing_stop_id')[$i],
				 'routing_stop_date' => $this->dateconvert($this->input->post('delivery_date')[$i]),
				 'instruction' => $this->input->post('instructions')[$i],
				 'notes' => $this->input->post('notes')[$i],
				'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('trip_routing_stop', $data);
			}


			for($i=0;$i<sizeof($this->input->post('expense_date'));$i++){
			$data = array(
				 'trip_details_id' => $trip_details_id,
				 'expense_date' => $this->dateconvert($this->input->post('expense_date')[$i]),
				 'amount' => str_replace( ',', '',$this->input->post('amount')[$i]),
				 'gallons' => $this->input->post('gallons')[$i],
				 'odometer' => $this->input->post('odometer')[$i],
				'fuel_vender' => $this->input->post('fuel_vendor_id')[$i],
				'state_id' => $this->input->post('state')[$i],
				'include_driver_settelment' => $this->input->post('driver_settlement')[$i],
				 'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('trip_fuel_expense', $data);
			}


			for($i=0;$i<sizeof($this->input->post('exp_category_id'));$i++){
			$data = array(
				 'trip_details_id' => $trip_details_id,
				 'expense_category_id' => $this->input->post('exp_category_id')[$i],
				 'expense_date' => $this->dateconvert($this->input->post('truck_expense_date')[$i]),
				 'expense_amount' => str_replace( ',', '',$this->input->post('truck_amount')[$i]),
				'expense_driver_settlement' => $this->input->post('truck_driver_settlement')[$i],
				'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('trip_truck_expense', $data);
			}


			for($i=0;$i<sizeof($this->input->post('ref_expense_date'));$i++){
			$data = array(
				 'trip_details_id' => $trip_details_id,
				 'expense_date' => $this->dateconvert($this->input->post('ref_expense_date')[$i]),
				 'expense_amount' => str_replace( ',', '',$this->input->post('ref_amount')[$i]),
				 'gallons' => $this->input->post('ref_gallons')[$i],
				 'state_id' => $this->input->post('ref_state')[$i],
				'driver_settlement' => $this->input->post('ref_driver_settlement')[$i],
				'fuel_vendor_id' => $this->input->post('ref_fuel_vendor_id')[$i],
				 'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('trip_refree_fuel_expense', $data);
			}


			for($i=0;$i<sizeof($this->input->post('id'));$i++){
			$data = array(
				 'trip_details_id' => $trip_details_id,
				 'load_id' => $this->input->post('id')[$i],
				 'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('trip_load_details', $data);
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



		public function edit_trip_data()
		{
			echo 'hiiii';

			$this->db->trans_start();
			$data = array(
				 'trip_number' => $this->input->post('cust_trip_no'),
				 'trip_tracking_link' => $this->input->post('trip_tracking_link'),
				 'driver_id' => $this->input->post('driver_id'),
				 'acc_driver_pay' => str_replace( ',', '',$this->input->post('acc_driver_pay')),
				 'driver_advance' => str_replace( ',', '',$this->input->post('driver_advance')),
				 'team_driver_id' => $this->input->post('team_driver_id'),
				 'team_acc_driver_pay' => str_replace( ',', '',$this->input->post('acc_team_driver_pay')),
				'team_driver_advance' => str_replace( ',', '',$this->input->post('team_driver_advance')),
				'truck_id' => $this->input->post('truck_id'),
				'trailer_id' => $this->input->post('trailer_id'),
				'odometer' => $this->input->post('odometer1'),
				'load_id' => '1',
				'status' =>$this->input->post('status'),
				'modified_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('modified_date', 'NOW()', FALSE);
			$this->db->where('trip_details_id', $this->input->post('trip_details_id'));
			$this->db->update('trip_details', $data);
			$trip_details_id=$this->input->post('trip_details_id');

			$query="update trip_routing_stop set status='N',modified_date=now(),modified_by=".$this->db->escape($this->session->userdata['logged_in']['login_id'])."    where trip_details_id=".$this->db->escape($trip_details_id)." and status='Y'";
			 $query = $this->db->query($query);


			for($i=0;$i<sizeof($this->input->post('routing_stop_id'));$i++){
			$data = array(
				 'trip_details_id' => $trip_details_id,
				 'routing_stop_id' => $this->input->post('routing_stop_id')[$i],
				 'routing_stop_date' => $this->dateconvert($this->input->post('delivery_date')[$i]),
				 'instruction' => $this->input->post('instructions')[$i],
				 'notes' => $this->input->post('notes')[$i],
				'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('trip_routing_stop', $data);
			}

			$query="update trip_fuel_expense set status='N',modified_date=now(),modified_by=".$this->db->escape($this->session->userdata['logged_in']['login_id'])."    where trip_details_id=".$this->db->escape($trip_details_id)." and status='Y'";
			 $query = $this->db->query($query);


			for($i=0;$i<sizeof($this->input->post('expense_date'));$i++){
			$data = array(
				 'trip_details_id' => $trip_details_id,
				 'expense_date' => $this->dateconvert($this->input->post('expense_date')[$i]),
				 'amount' => str_replace( ',', '',$this->input->post('amount')[$i]),
				 'gallons' => $this->input->post('gallons')[$i],
				 'odometer' => $this->input->post('odometer')[$i],
				'fuel_vender' => $this->input->post('fuel_vendor_id')[$i],
				'state_id' => $this->input->post('state')[$i],
				'include_driver_settelment' => $this->input->post('driver_settlement')[$i],
				 'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('trip_fuel_expense', $data);
			}

			$query="update trip_truck_expense set status='N',modified_date=now(),modified_by=".$this->db->escape($this->session->userdata['logged_in']['login_id'])."    where trip_details_id=".$this->db->escape($trip_details_id)." and status='Y'";
			 $query = $this->db->query($query);



			for($i=0;$i<sizeof($this->input->post('exp_category_id'));$i++){
			$data = array(
				 'trip_details_id' => $trip_details_id,
				 'expense_category_id' => $this->input->post('exp_category_id')[$i],
				 'expense_date' => $this->dateconvert($this->input->post('truck_expense_date')[$i]),
				 'expense_amount' => str_replace( ',', '',$this->input->post('truck_amount')[$i]),
				'expense_driver_settlement' => $this->input->post('truck_driver_settlement')[$i],
				'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('trip_truck_expense', $data);
			}

			$query="update trip_refree_fuel_expense set status='N',modified_date=now(),modified_by=".$this->db->escape($this->session->userdata['logged_in']['login_id'])."    where trip_details_id=".$this->db->escape($trip_details_id)." and status='Y'";
			 $query = $this->db->query($query);


			for($i=0;$i<sizeof($this->input->post('ref_expense_date'));$i++){
			$data = array(
				 'trip_details_id' => $trip_details_id,
				 'expense_date' => $this->dateconvert($this->input->post('ref_expense_date')[$i]),
				 'expense_amount' => str_replace( ',', '',$this->input->post('ref_amount')[$i]),
				 'gallons' => $this->input->post('ref_gallons')[$i],
				 'state_id' => $this->input->post('ref_state')[$i],
				'driver_settlement' => $this->input->post('ref_driver_settlement')[$i],
				'fuel_vendor_id' => $this->input->post('ref_fuel_vendor_id')[$i],
				 'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('trip_refree_fuel_expense', $data);
			}

			$query="update trip_load_details set status='N',modified_date=now(),modified_by=".$this->db->escape($this->session->userdata['logged_in']['login_id'])."    where trip_details_id=".$this->db->escape($trip_details_id)." and status='Y'";
			 $query = $this->db->query($query);


			for($i=0;$i<sizeof($this->input->post('id'));$i++){
			$data = array(
				 'trip_details_id' => $trip_details_id,
				 'load_id' => $this->input->post('id')[$i],
				 'status' =>'Y',
				'inserted_by'=>$this->session->userdata['logged_in']['login_id'],
				'company_detail_id'=>$this->session->userdata['logged_in']['company_detail_id']

			 );
			$this->db->set('inserted_date', 'NOW()', FALSE);
			$this->db->insert('trip_load_details', $data);
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



		

		public function get_trip_data()
		{
			$query="select trip_details_id, trip_number,trip_tracking_link,DATE_FORMAT(pickup_date,'%m-%d-%Y') pickup_date,DATE_FORMAT(delivery_date,'%m-%d-%Y') delivery_date,
				truck,trailer,driver_name,team_driver_name,status_name from( select td.trip_details_id, td.trip_number,td.trip_tracking_link,min(pld.pickup_date) pickup_date,max(dld.delivery_date) delivery_date,
				vd.vehicle_no truck,vd1.vehicle_no trailer,dd.driver_name,dd1.driver_name team_driver_name,ls.status_name	 
				from trip_details td
				inner join trip_load_details tld on td.trip_details_id=tld.trip_details_id
                inner join loading_details ld on tld.load_id=ld.loading_id
				inner join pickup_loading_details pld on tld.load_id=pld.loading_id
				inner join delivery_loading_details dld on dld.loading_id=tld.load_id
				inner join customer_details cd1 on pld.shipper_id=cd1.customer_id
				inner join customer_details cd2 on dld.cosignee_id=cd2.customer_id
				left join driver_details dd on td.driver_id=dd.driver_id
                left join driver_details dd1 on dd1.driver_id=td.team_driver_id
				left join vehicle_details vd on vd.vehicle_id=td.truck_id
				left join vehicle_details vd1 on vd1.vehicle_id=td.trailer_id
				inner join load_status ls on td.status=ls.status_code
				where tld.status='Y'and pld.status='Y' and dld.status='Y' and td.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and pld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and dld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd1.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd2.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and dd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and dd1.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and vd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and vd1.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."
				group by td.trip_details_id
				order by pld.pickup_loading_details_id,dld.delivery_loading_details_id desc) a order by trip_details_id desc";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}


		public function get_state() {

			$query = $this->db->get('states');
			return $query->result_array();

		}

		public function get_sel_trip_data($id)
		{
			$query="select td.trip_details_id,td.trip_number,td.trip_tracking_link,td.driver_id,td.acc_driver_pay,td.driver_advance,td.team_driver_id,td.team_acc_driver_pay,td.team_driver_advance,td.truck_id,td.trailer_id,td.odometer,td.load_id,
			dd.driver_name,dd1.driver_name  team_driver_name,vd.vehicle_no truck,vd1.vehicle_no trailer,td.status
			from trip_details td
			inner join driver_details dd on dd.driver_id=td.driver_id
			left join driver_details dd1 on td.team_driver_id=dd1.driver_id
			left join vehicle_details vd on vd.vehicle_id=td.truck_id
			left join vehicle_details vd1 on vd1.vehicle_id=td.trailer_id
			inner join load_status sm on sm.status_code=td.status
			where td.trip_details_id=".$this->db->escape($id)." and td.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and dd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and dd1.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and vd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and vd1.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			 $query = $this->db->query($query);
			return $query->result_array();
		}


		public function get_sel_trip_stop_data($id)
		{
			$query="select trs.trip_details_id,trs.routing_stop_id,DATE_FORMAT(trs.routing_stop_date,'%m-%d-%Y') routing_stop_date,trs.instruction,trs.notes,cd.customer_name
					from trip_routing_stop trs
					inner join customer_details cd on trs.routing_stop_id=cd.customer_id
					where trs.trip_details_id=".$this->db->escape($id)." and trs.status='Y' and trs.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			 $query = $this->db->query($query);
			return $query->result_array();
		}


		public function get_sel_trip_fuel_exp_data($id)
		{
			$query="select tfe.trip_details_id,DATE_FORMAT(tfe.expense_date,'%m-%d-%Y') expense_date,tfe.amount,tfe.gallons,tfe.odometer,tfe.fuel_vender,tfe.state_id,tfe.include_driver_settelment,s.state_name	,cd.customer_name
			from trip_fuel_expense tfe
			inner join states s on tfe.state_id=s.state_id
			inner join customer_details cd on tfe.fuel_vender=cd.customer_id
			where tfe.trip_details_id=".$this->db->escape($id)." and tfe.status='Y' and tfe.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			 $query = $this->db->query($query);
			return $query->result_array();
		}

		public function get_sel_trip_truck_exp_data($id)
		{
			$query="select tte.trip_details_id,tte.expense_category_id,DATE_FORMAT(tte.expense_date,'%m-%d-%Y') expense_date,tte.expense_amount,tte.expense_driver_settlement
					from trip_truck_expense tte
					inner join expense_details ed on ed.expense_details_id=tte.expense_category_id
					where tte.trip_details_id=".$this->db->escape($id)." and tte.status='Y' and tte.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			 $query = $this->db->query($query);
			return $query->result_array();
		}


		public function get_sel_trip_refree_fuel_exp_data($id)
		{
			$query="select trfe.trip_details_id,DATE_FORMAT(trfe.expense_date,'%m-%d-%Y') expense_date,trfe.expense_amount,trfe.gallons,trfe.fuel_vendor_id,trfe.state_id,trfe.driver_settlement,cd.customer_name,s.state_name
			from trip_refree_fuel_expense trfe
			inner join customer_details cd on trfe.fuel_vendor_id=cd.customer_id
			inner join states s on trfe.state_id=s.state_id
					where trfe.trip_details_id=".$this->db->escape($id)." and trfe.status='Y' and trfe.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			 $query = $this->db->query($query);
			return $query->result_array();
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