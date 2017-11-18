<?php
class DB {
    private $dbh, $connect_ok;

	function __construct() {
		$host = "127.0.0.1";
		$username = "car_info";
		$password = "car_info_123";
		$database = "car_info";

		$this->dbh = mysqli_connect($host, $username, $password, $database);
		if($this->dbh){
		    $this->connect_ok = true;
		    mysqli_query($this->dbh, "set names 'utf8'");
		}
	}
	
	function __destruct() {
	    if($this->connect_ok){
	        mysqli_close($this->dbh);
	    }
	}

	function query($sql) {
	    $query = mysqli_query($this->dbh, $sql);

		$queryResult = array();

		$i = 0;
		$rowsNum = mysqli_num_rows($query);

		for ($i = 0; $i < $rowsNum; $i ++) {
			$res = mysqli_fetch_assoc($query);
			$queryResult[$i] = $res;
		}

		return $queryResult;
	}
	
	function update_query($sql) {
	    return mysqli_query($this->dbh, $sql);
	}
	
	function last_insert_id() {
	    return mysqli_insert_id($this->dbh);
	}
}

