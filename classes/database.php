<?php 

Class Database
{

	private $con;

	//construct
	function __construct()
	{

		$this->con = $this->connect();
	}

	//connect to db
	private function connect()
	{

		$string = "mysql:host=localhost;dbname=chat_app";
		try
		{

			$connection = new PDO($string,DBUSER,DBPASS);
			return $connection;

		}catch(PDOException $e)
		{
			echo $e->getMessage();
			die;
		}

		return false;

	}

	public function write($query, $data_array=[]){

		$con = $this->connect();
		//using prepared statemnst for security
		$statement = $con->prepare($query);
		$check = $statement->execute($data_array);

		if($check){
			return true;
		}
		return false;


	}

	public function read($query, $data_array=[]){

		$con = $this->connect();
		//using prepared statemnst for security
		$statement = $con->prepare($query);
		$check = $statement->execute($data_array);
		
		if($check){
			$result = $statement->fetchAll(PDO::FETCH_OBJ);
			if(is_array($result) && count($result) > 0){
				return $result;
			}
			return false;
		}
		return false;


	}

	//auto generate the userid parameter 
	public function generate_id($max){
		$rand = "";
		$rand_count = rand(4,$max);
		for ($i=0; $i < $rand_count; $i++) { 
			$r = rand(0,9);
			$rand .= $r;
		}
		return $rand;
	}

	public function get_user($userid){

		$con = $this->connect();
		//using prepared statemnst for security
		$arr['userid'] = $userid;
		$query = "select * from users where user_id =:userid limit 1";
		$statement = $con->prepare($query);
		$check = $statement->execute($arr);
		
		if($check){
			$result = $statement->fetchAll(PDO::FETCH_OBJ);
			if(is_array($result) && count($result) > 0){
				return $result[0];
			}
			return false;
		}
		return false;


	}

}


