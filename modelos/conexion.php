<?php
class Cinexion{
	public function conectar(){
		$slink = new PDO("mysql:host;dbname=pos", "root","");

		$link ->exec("set na,es utf8");

		return $link;

	}


}



?>