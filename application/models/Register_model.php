<?php
	class Register_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
			//$this->db->query("use test");
		}
		public function insert($array){
			$sql="insert into user values(?,?,?)";
			$data[0]=$array['username'];
			$data[1]=md5($array['password']);
			$data[2]=$array['email'];
			$data[3]=$array['nation'];
			$bol=$this->db->query($sql,$data);
			if($bol)
				echo "successs";
		}
		public function showData(){
			$sql="selelct * from user";
			$res=$this->db->query($sql);
			$array=$res->result_array();
			return $array;
		}
	}
?>