<?php
class DBase
{
	private $connection;
	private $hostname;
	private $dbuser;
	private $dbpass;
	private $dbname;

	public $resultset;
	
	
	function __construct(){
		$this->hostname = "localhost";
		$this->dbuser = "yourusername";
		$this->dbpass = "yourpassword";
		$this->dbname = "yourdatabase";	
	}


	public function setDB($databasename){
		$this->dbname = $databasename;	
	}

	public function DBConnect(){
		
		$this->connection = mysqli_connect($this->hostname, $this->dbuser, $this->dbpass, $this->dbname);

		if (!$this->connection) {
    		die('Connect Error: ' . mysqli_connect_error());
		}	
		
	}

	public function getConnection(){
		return $this->connection;	
	}

		

	/**
	 * @author Märt Märkson <admin@kysi.ee>
	 * @return MySQL resultset
	 */

	public function queryDB($query){
		$this->DBConnect();
		mysqli_set_charset($this->getConnection(), "utf8");
        return ($this->resultset = mysqli_query($this->getConnection(), $query));
	}


	public function getDBResultset(){
		return $this->resultset;
	}

	public function fetchArrayDB($results){		
		return @mysqli_fetch_array($results, MYSQLI_ASSOC);
	}

	/**
	 * @author Märt Märkson <admin@kysi.ee>
	 * @return MySQL resultrows count
	 */

	public function getResultsCount($query){
		return @mysqli_num_rows($this->queryDB($query));	
	}
	
	public function getResultsCountByResult($resultset){
		return mysqli_num_rows($resultset);
	}
	

	public function getLastInsertedID(){
		return mysqli_insert_id($this->getConnection());
	}
	
	
	public function closeConnection(){
		mysqli_close($this->getConnection());
	}


}

?>