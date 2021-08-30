<?php
	class Router{
		private $host = '192.168.84.1';
		private $community = 'public';
		public function __construct($host,$community){
			$this->host = $host; $this->community = $community;
		}

		public function getHost(){
			return $this->host;
		}

		public function getCommunity(){
			return $this->community;
		}
	}
?>