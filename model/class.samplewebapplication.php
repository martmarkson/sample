<?php
class SampleWebApplication
{
	
	public $errors = array();
	public $safequery = true;
	public $db;


	function __construct(){
		$this->db = new DBase();
	}
	
	
	public function getRoutingInfo(){
		
		$arrUrl = explode('/', $_SERVER['REQUEST_URI']);
		//$staturl = '';
		//drop empty array elements
		foreach($arrUrl as $key => $value){
			
			if(empty($value)){
				unset($arrUrl[$key]);
			}
			//$staturl .= $value."/";
		}
		
		return $arrUrl[1];
			
	}
	
	
	
	public function getErrors(){
		return $this->errors;
	}
	
	
	private function PasswExists($encryptedMessage){
				
			if($this->db->getResultsCount("SELECT password FROM `test_companies` WHERE password = '".$encryptedMessage."'") > 0){
				return true;
			}
			
		return false;
		
	}
	
	
	private function UsernExists($username){
		
		if($this->db->getResultsCount("SELECT username FROM `test_companies` WHERE username = '".$username."'") > 0){
				return true;
		}
		
		return false;
		
	}
	
	
	private function ProtectVarSQL($toprotect){
		return mysqli_real_escape_string($this->db->getConnection(), $toprotect);
	}
	
	
	private function ProtectVarsSQL(){
		
		foreach($_POST as $key => $value){
				$_POST[$key] = mysqli_real_escape_string($this->db->getConnection(), $value);
		}
		
	}
	
	
	private function Encrypt($toencrypt){
		
		//check if user passwordexists in db
		$encryptionMethod = "AES-256-CBC";
		$secretHash = "secrethash";
		$iv = "numbersequence";
		
		return openssl_encrypt($toencrypt, $encryptionMethod, $secretHash, false, $iv);

	}
	
	
	private function ValidateCaptcha($code){
		
		include_once("components/securimage/securimage/securimage.php");
		$img = new Securimage();
		$valid = $img->check($code);

		if($valid === false){
			return false;
		} else {
			return true;
		}
		
	}
	
	
	
	public function validateRegisterFields(){
			
		$this->errors = false;
		

		if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/", $_POST["businessemail"])){
			$this->errors['businessemail'] = "Incorrect e-mail";
		}

		if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST["password"]) || strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 16) {
			$this->errors['password'] = "Incorrect password";
			$this->safequery = false;
		}

		if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST["username"]) || strlen($_POST["username"]) < 4){
			$this->errors['username'] = "Incorrect username";
			$this->safequery = false;
		}  
		
		
		if(strlen(trim($_POST["businessname"])) < 3){ // firma nime pikkus peab olema vähemalt 3 tähemärki
			$this->errors['businessname'] = "Please fill in company name";
			$this->safequery = false;//this is for against mysql injection
		} 
		
		$exploded = explode(' ', $_POST["businessname"]);
		 
		 
		 foreach($exploded as $key => $value){
			//check string validity taking into account	
			if(!empty($value) && !preg_match("/^[\w-]*$/u", $value)){ // \w	if not any word character or hyphen (letter, number, underscore) then error
				$this->errors['businessname'] = "Only characters or numbers are allowed";
				$exploded[$key] = $value;
			}
			
		 }
		 
		 $imploded = implode(' ', $exploded);
		 $_POST["businessname"] = $imploded;
		 
			
		if($this->PasswExists($this->Encrypt($_POST['password']))){
			$this->errors['passwordexists'] = "Password already exists!";
		}
		
		
		if($this->UsernExists($this->ProtectVarSQL($_POST["username"]))){
			$this->errors['usernameexists'] = "Username already exists!";
		}
		
		
		if(!$this->ValidateCaptcha($_POST["code"])){
			
			$this->errors['code'] = "Wrong security code";//wrong security code was entered
			
		} else {
			if(!isset($_SESSION["errcode"])){
				unset($_SESSION["errcode"]);
			}
		}
		
		
		$this->safequery = true;
		return $this->errors;

	}
	
	
	public function AddCompany(){
		
		// strip extra white space between business name
		$maptourl = preg_replace('/[\s]+/i', '-', $_POST["businessname"]);
					
		// get rid of the non Latin characters and non numbers
		$seofriendly = preg_replace('/[^a-z0-9_-]/i', '', $maptourl);
		$maptourl = $seofriendly;
		
		$this->ProtectVarsSQL();
		
		$this->db->queryDB("INSERT INTO test_companies_table VALUES ('', '".$_POST["businessname"]."', '".$this->Encrypt($_POST["password"])."', '".$_POST["username"]."', 'unactive', '".$_POST["firstname"]."', '".$_POST["lastname"]."','".$_POST["businessemail"]."', '', '".$_POST["businesszip"]."', '".$_POST["businessphone"]."', '".$_POST["businessfax"]."', '".$seofriendly."', '".$_POST["businessmobilephone"]."', '".$_POST["additionalinfo"]."', NOW(), '0000-00-00 00:00:00', 'regular')");
				 				 
		$lastvalidid = $this->db->getLastInsertedID(); // last inserted company ID
				 
		// create some new infrastructure for the company assets				
				 
		@mkdir("companies/".$lastvalidid);
		@mkdir("companies/".$lastvalidid."/productimages");
		@mkdir("companies/".$lastvalidid."/gallerymap");
				 
	}
		
}
?>