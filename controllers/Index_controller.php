<?php 

class Index_controller{
	public function index($param = null){
		if(empty($param)){
			$param = 'tu';
		}
		echo 'Hola '.$param.'!';
	}
}