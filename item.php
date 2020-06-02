<?php  
include_once('core/init.php');
if(isset($_REQUEST) && isset ($_REQUEST['method']))
{
	if (isset($_SESSION['id'])) {
		//list item
		if ($_REQUEST['method'] == "get") {
			
			$select = "SELECT * FROM item";
			$req = $connect->query($select);
			$array = [];
			while ($data = $req->fetch_assoc()) {
					$array[] = $data;}
				header('Content-type: application/json');
				echo json_encode($array);
		}

		//add item
		if ($_REQUEST['method'] == "post") {
		$barcode = $_GET['barcode'];
		$nama_item = $_GET['nama_item'];
		$jumlah = $_GET['jumlah'];
		$harga = $_GET['harga'];
		$level = "admin";
		$c_level = $_SESSION['level'];
			if($c_level == $level) {
    		$insert = "INSERT INTO item (barcode,nama_item,jumlah,harga) VALUES ('".$barcode."','".$nama_item."','".$jumlah."','".$harga."')";
    		$req = $connect->query($insert);
    
    		if($req === TRUE)
    		{
    			$data = [
    					
    					'message' => "Successfully add new item"
    			];
    		}
    		else
    		{
    			$data = [
    					'status' => "FAIL",
    					'message' => "Something went wrong"
    			];
    		}
    
    		header('Content-type: application/json');
    		echo json_encode($data);
		}
		 else{
			$data = [
					'message' => "gagal add item... bukan users admin"];
					header('Content-type: application/json');
					echo json_encode($data);
			}
	}

		// delete item
	if ($_REQUEST['method'] == "delete") {
		$barcode = $_GET['barcode'];
		$level = "admin";
		$c_level = $_SESSION['level'];
			if($c_level == $level) {
		$delete = "DELETE FROM item where barcode='".$barcode."'";
		$req = $connect->query($delete);

        		if($req === TRUE)
        		{
        			$data = [
        				
        					'message' => "Successfully delete the Item"
        			];
        		}
        		else
        		{
        			$data = [
        					'status' => "FAIL",
        					'message' => "Something went wrong"
        			];
        		}

        		header('Content-type: application/json');
        		echo json_encode($data);
        	  }
        	  else{
			$data = [
					'message' => "gagal delete... bukan users admin"];
					header('Content-type: application/json');
					echo json_encode($data);
			}
	}

	}
	else{
			$data = [
					'message' => "please re-login"];
					header('Content-type: application/json');
					echo json_encode($data);
		}
}
?>