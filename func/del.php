<?php
	include('../inc/db.php');

	$functionto = $_POST['ins'];

	switch ($functionto) {
		
		
		case "delUser":
        delUser();
		break;

		case "delExtension":
			delExtension();
		break;
		default:
			echo '<div class="alert alert-danger">
				Function does not Exist
			</div>';
	}

	function delUser(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('staff','user_id',$value);
		echo"Done";
	}
	
	function delExtension(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('Extensions','extensionID',$value);
		echo"Done";
	}
?>