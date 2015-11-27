<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include_once('/model/class.db.php');
include_once('/model/class.samplewebapplication.php');
include_once('/view/class.view.php');
$register = new SampleWebApplication();


if(is_array($_SERVER['REQUEST_URI']) || $_SERVER['REQUEST_URI'] == '/'){
	
	switch(($register->getRoutingInfo())){
		
		case 'register':
		{
			// add new company through registration form
						
			if(isset($_POST['newcompany'])){
				
				if(!$register->validateRegisterFields()){
					$register->AddCompany();
				} else {
					$register->DisplayErrors($register->getErrors());
				}
				
			}
			
			$view = new View();
			$view->DisplayHeader();
			$view->displayRegisterForm();
			$view->DisplayBodyEnd();
		
		}
	
	break;
	
	
	default:
	break;
		
		
	}
	
}


?>