<?php  
include_once('core/init.php');
if(isset($_REQUEST) && isset ($_REQUEST['method']))
{
	if (isset($_SESSION['id'])) {
		//purchase
		if ($_REQUEST['method'] == "post") {
		$barcode = $_GET['barcode'];
		$jumlah = $_GET['jumlah'];
		$id = $_SESSION['id'];

		$sql_item = "SELECT * FROM item WHERE barcode='".$barcode."'";
		$query = $connect->query($sql_item);
		$userdata_item = mysqli_fetch_array($query);

		$harga_item = $userdata_item['harga'];
		$jumlah_item = $userdata_item['jumlah'];
		$total_harga = $jumlah * $harga_item;
		$sisa_item = $jumlah_item - $jumlah;
		
		$sql_users = "SELECT * FROM users WHERE id='".$id."'";
		$query_users = $connect->query($sql_users);
		$userdata_users = mysqli_fetch_array($query_users);
		$wallet = $userdata_users['wallet'];
		$pembeli = $userdata_users['username'];
		$sisa_wallet = $wallet - $total_harga;

			if ($jumlah_item == 0) 
				{
					$data = [
							
							'message' => "Stock telah habis... / item tidak ada..."
					];
				
				header('Content-type: application/json');
				echo json_encode($data);}

			if ($wallet < $total_harga) 
				{
					$data = [
							
							'message' => "Wallet tidak mencukupi..."
					];
				
				header('Content-type: application/json');
				echo json_encode($data);}
				
				elseif ($jumlah_item > 0 && $sisa_wallet > 0)  {
				$insert = "INSERT INTO history_purchase (id_nama,barcode,jumlah_purchase,total_harga) VALUES ('".$id."','".$barcode."','".$jumlah."','".$total_harga."')";
				$req = $connect->query($insert);

				if($req === TRUE)
				{
					$data = [
							'nama pembeli' => $pembeli,
							'barcode' => $barcode,
							'jumlah item' => $jumlah,
							'total harga' => $total_harga,
							'message' => "Purchase Successfully"
					];
					//update jumlah item
					$update2 = "UPDATE item set jumlah='".$sisa_item."' WHERE barcode='".$barcode."'";
					$req2 = $connect->query($update2);
					//update sisa wallet
					$update3 = "UPDATE users set wallet='".$sisa_wallet."' WHERE id='".$id."'";
					$req3 = $connect->query($update3);
					header('Content-type: application/json');
				    echo json_encode($data);
				}
				else {
				$data = [
							'status' => "FAIL",
							'message' => "Something went wrong2"
					];
					header('Content-type: application/json');
				echo json_encode($data);
				}
				
			}
			
			}
				
			
		


		// top up wallet
		if ($_REQUEST['method'] == "put") {
		$id = $_SESSION['id'];
		$topup_wallet = $_GET['wallet'];
		$sql_users = "SELECT * FROM users WHERE id='".$id."'";
		$query = $connect->query($sql_users);
		$userdata_users = mysqli_fetch_array($query);
		$wallet = $userdata_users['wallet'];
		$pembeli = $userdata_users['nama'];
		$total_wallet = $topup_wallet + $wallet;
		$update = "UPDATE users set wallet='".$total_wallet."' WHERE id='".$id."'";
		$req = $connect->query($update);

		if($req === TRUE)
		{
			$data = [
			        
					'top up' => $topup_wallet,
					'message' => "Top up Successfully"
			];
					header('Content-type: application/json');
		            echo json_encode($data);
		}
		else
		{
			$data = [
					'status' => "FAIL",
					'message' => "Something went wrong"
			];
					header('Content-type: application/json');
		            echo json_encode($data);
		}


		}


		//list history purchase
		if ($_REQUEST['method'] == "get") {
		$level = "admin";
		$c_level = $_SESSION['level'];
			if($c_level == $level) {
				//menggunakan inner join untuk dpt value nya
			$select = "select users.username, item.nama_item, history_purchase.jumlah_purchase, history_purchase.waktu_purchase, total_harga From history_purchase inner join users ON history_purchase.id_nama = users.id INNER JOIN item on history_purchase.barcode = item.barcode";
			$req = $connect->query($select);
			$array = [];
			while ($data = $req->fetch_assoc()) {
				$array[] = $data;
			}
			header('Content-type: application/json');
			echo json_encode($array);
			}
			else{
			$data = [
					'message' => "gagal show...bukan users admin"];
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