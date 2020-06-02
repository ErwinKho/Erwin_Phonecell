<?php require_once 'core/init.php'; 

		if ($_REQUEST['method'] == "get") {
		    $logout = $_GET['confirm'];
		    if($logout == "yes") {
		        session_destroy();
		       $data = [
					'message' => "anda telah logout"];
					header('Content-type: application/json');
					echo json_encode($data);
            
			
			
		}
}
?>