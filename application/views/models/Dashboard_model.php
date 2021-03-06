<?php
class Dashboard_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
				$this->load->library('session');
				$this->load->helper('date');

        }

		




		public function getDriverLicenseExpiryData()
		{
			$query="select driver_id,driv_id,driver_name,DATE_FORMAT(license_expiry,'%m-%d-%Y') license_expiry	 from driver_details
					where license_expiry between CURDATE() and DATE_ADD(CURDATE(), INTERVAL 15 DAY) and driver_status='Y' and company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getVehicleRegExpiryData()
		{
			$query="select vd.vehicle_id,vd.vehicle_no,vd.vin_no,vd.plate,vd.make,vd.model,DATE_FORMAT(vd.registration_expiry_date,'%m-%d-%Y') registration_expiry_date,vt.vehicle_name from					vehicle_details vd
				inner join vehicle_type vt on vt.vehicle_type_id=vd.vehicle_type_id
				where vd.registration_expiry_date between CURDATE() and DATE_ADD(CURDATE(), INTERVAL 15 DAY) and vd.vehicle_status='Y' and vd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getUpcomingLoadingData()
		{
			$query="select * from(
					select ld.loading_id,ld.load_no,min(pld.pickup_date) pickup_date,max(dld.delivery_date) delivery_date from loading_details ld 
                    inner join pickup_loading_details pld on ld.loading_id=pld.loading_id
					inner join delivery_loading_details dld on ld.loading_id=dld.loading_id
					where ld.status='Y' and dld.status='Y' and pld.status='Y' and ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and pld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and dld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."
					group by ld.loading_id
					) a where (delivery_date between CURDATE() and DATE_ADD(CURDATE(), INTERVAL 15 DAY) or pickup_date between CURDATE() and DATE_ADD(CURDATE(), INTERVAL 15 DAY) )";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}

		public function getUpcomingTripDataStatus($id)
		{
			$query="select case when pickup_date= CURDATE() then concat('pickup today from ',pickup_customer) else concat('pickup tomorrow from ',pickup_customer) end as status from (
					select  pld.pickup_date pickup_date,cd.customer_name pickup_customer
                                        from trip_details td
					inner join trip_load_details tld on tld.trip_details_id=td.trip_details_id
					inner join loading_details ld on tld.load_id=ld.loading_id
					inner join pickup_loading_details pld on ld.loading_id=pld.loading_id
                                        inner join customer_details cd on pld.shipper_id=cd.customer_id
					where td.trip_details_id=".$this->db->escape($id)." and tld.status='Y' and pld.status='Y' 
                                        and td.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and tld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and pld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." 
					
					) a 
                                      where ( CURDATE() = pickup_date    ) 
									  union all

									  select case when delivery_date= CURDATE() then concat('delivery today to ',delivery_customer) else concat('delivery tomorrow to ',delivery_customer) end as status from (
					select  dld.delivery_date delivery_date,cd.customer_name delivery_customer
                                        from trip_details td
					inner join trip_load_details tld on tld.trip_details_id=td.trip_details_id
					inner join loading_details ld on tld.load_id=ld.loading_id
					inner join delivery_loading_details dld on ld.loading_id=dld.loading_id
                                        inner join customer_details cd on dld.cosignee_id=cd.customer_id
					where td.trip_details_id=".$this->db->escape($id)." and tld.status='Y' and dld.status='Y'  
                                        and td.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and tld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and dld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."
					#group by ld.loading_id
					) a 
                                      where ( CURDATE() = delivery_date ) 

									  union all

									  select case when routing_stop_date= CURDATE() then concat('delivery today to ',delivery_customer) else concat('delivery tomorrow to ',delivery_customer) end as status from (
					select  trs.routing_stop_date routing_stop_date,cd.customer_name delivery_customer
                                        from trip_details td
					inner join trip_routing_stop trs on trs.trip_details_id=td.trip_details_id
                                        inner join customer_details cd on trs.routing_stop_id=cd.customer_id
					where  td.trip_details_id=".$this->db->escape($id)." and trs.status='Y'  
                                        and td.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and trs.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."
					#group by ld.loading_id
					) a 
                                      where ( CURDATE() = routing_stop_date ) 


									  ";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}


		public function getUpcomingTripData()
		{
			$query="select trip_details_id,trip_number,trip_tracking_link,DATE_FORMAT(pickup_date,'%m-%d-%Y') pickup_date,DATE_FORMAT(delivery_date,'%m-%d-%Y') delivery_date,loading_id,load_no,customer  from (select * from (
					select td.trip_details_id,td.trip_number,td.trip_tracking_link,min(pld.pickup_date) pickup_date,max(dld.delivery_date) delivery_date,ld.loading_id,ld.load_no ,concat(cd.customer_name,' ',s.state_name,' ',cd.customer_city) customer
                                        from trip_details td
					inner join trip_load_details tld on tld.trip_details_id=td.trip_details_id
					inner join loading_details ld on tld.load_id=ld.loading_id
					inner join pickup_loading_details pld on ld.loading_id=pld.loading_id
                                        inner join delivery_loading_details dld on ld.loading_id=dld.loading_id
										inner join customer_details cd on cd.customer_id=ld.customer_id
										inner join states s on s.state_id=cd.customer_state
                                        where tld.status='Y' and pld.status='Y' and dld.status='Y' and pld.status='Y' 
                                        and td.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and tld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and ld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and pld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and dld.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])." and
										cd.company_detail_id=".$this->db->escape($this->session->userdata['logged_in']['company_detail_id'])."
					group by td.trip_details_id
					) a where ( CURDATE() between DATE_ADD(pickup_date, INTERVAL -1 DAY)  and delivery_date ) ) b ";
			return $query = $this->db->query($query);
			//return $query->result_array();
		}



		
}