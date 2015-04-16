<?php
	class Form_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
			$this->db->query("use test");
		}
		public function putApp(){
			$data[0]=$this->input->post('id');
			$data[1]=$this->input->post('fname');
			$data[2]=$this->input->post('lname');
			$data[3]=$this->input->post('gpa');
			$data[4]=$this->input->post('phone');
			$data[5]=$this->input->post('email');
			$data[6]=$this->input->post('gradDate');
			$data[7]=$this->input->post('work');
			$sql='insert into app values(?,?,?,?,?,?,?,?)';
			
			$boo=$this->db->query($sql,$data);
			
			return $boo;
		}
		public function putTeaching(){
			
			$id=$this->input->post('id');
			$teach=$this->input->post('teaching');
			foreach($teach as $course){
				$data[0]=$id;
				$data[1]=$course;
				$sql="insert into curTeach values(?,?)";
				$bool=$this->db->query($sql,$data);
			}
			
			return $bool;
		}
		public function putTaught(){
			$id=$this->input->post('id');
			$teach=$this->input->post('taught');
			
			foreach($teach as $course){
				$data[0]=$id;
				$data[1]=$course;
				$sql="insert into preTeach values(?,?)";
				$bool=$this->db->query($sql,$data);
			}
			
			return $bool;
		}
		public function putTeach(){
			$teach=$this->input->post('teach');
			$id=$this->input->post('id');
			foreach($teach as $name){
				$course[$name]=$this->input->post($name);
			}
			
			foreach($course as $name=>$score){
				$data[0]=$id;
				$data[1]=$name;
				$data[2]=$score;
				$sql="insert into likeTeach values(?,?,?)";
				$bool=$this->db->query($sql,$data);
			}
			
			return $bool;
		}
		public function putUnder(){
			$under[0]=$this->input->post('id');
			$under[1]=$this->input->post('program');
			$under[2]=$this->input->post('level');
			$sql='insert into undergraduate values(?,?,?)';
			
			$boo=$this->db->query($sql,$under);
			
			return $boo;
		}
		public function putInter(){
			$inter[0]=$this->input->post('id');
			$inter[1]=$this->input->post('score');
			$inter[2]=$this->input->post('test');
			
			$sql='insert into interStudent values(?,?,?)';
			$boo=$this->db->query($sql,$inter);
			
			return $boo;
		}
		public function putGra(){
			$data[0]=$this->input->post('id');
			$data[1]=$this->input->post("position");
			$data[2]=$this->input->post("advisor");
			$sql='insert into graduate values(?,?,?)';
			
			$boo=$this->db->query($sql,$data);
			
			return $boo;
		}
		public function generalInfo(){
			//$this->db->trans_start();
			$this->putApp();
			$this->putTeaching();
			$this->putTaught();
			$this->putTeach();
			//$this->db->trans_complete();
		}
		public function interUnder(){
			$this->db->trans_start();
			$this->generalInfo();
			$this->putUnder();
			$this->putInter();
			$this->db->trans_complete();
		}
		public function interGra(){
			$this->db->trans_start();
			$this->generalInfo();
			$this->putGra();
			$this->putInter();
			$this->db->trans_complete();
		}
		public function natUnder(){
			$this->db->trans_start();
			$this->generalInfo();
			$this->putUnder();
			$this->db->trans_complete();
		}
		public function natGra(){
			$this->db->trans_start();
			$this->generalInfo();
			$this->putGra();
			$this->db->trans_complete();
		}
	}
?>