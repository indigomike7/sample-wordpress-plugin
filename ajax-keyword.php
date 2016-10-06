<?php
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( '../../../wp-load.php' );
wp();
get_currentuserinfo();
if(isset($_POST['action']))
{
	switch($_POST["action"])
	{
		case "add":
			$wpdb->insert('drlam_target_keyword', array(
				'keyword' => $_POST['tk_add'],
				'added_by' => $current_user->user_login  // ... and so on
			));
			echo json_encode(array("message"=>"Data Added"));
			break;
		case "edit":
			$tk = $wpdb->get_results( "SELECT * FROM drlam_target_keyword where id = '".$_POST['id']."'" );
			echo json_encode(array(0=>array("id"=>$tk[0]->id,"keyword"=>$tk[0]->keyword)));
			break;
		case "update":
			$wpdb->update('drlam_target_keyword', array(
				'keyword' => $_POST['tk_edit'],
				'added_by' => $current_user->user_login  // ... and so on
			),array('id'=>$_POST['id'])
				);
			echo json_encode(array("message"=>"Data Updated"));
			break;
		case "delete":
			$wpdb->delete('drlam_target_keyword',array('id'=>$_POST['id'])
				);
			echo json_encode(array("message"=>"Data Deleted"));
			break;

		/* POWER KEYWORD */
		
		case "add2":
			$wpdb->insert('drlam_power_keyword', array(
				'keyword' => $_POST['tk_add'],
				'added_by' => $current_user->user_login  // ... and so on
			));
			echo json_encode(array("message"=>"Data Added"));
			break;
		case "edit2":
			$tk = $wpdb->get_results( "SELECT * FROM drlam_power_keyword where id = '".$_POST['id']."'" );
			echo json_encode(array(0=>array("id"=>$tk[0]->id,"keyword"=>$tk[0]->keyword)));
			break;
		case "update2":
			$wpdb->update('drlam_power_keyword', array(
				'keyword' => $_POST['tk_edit'],
				'added_by' => $current_user->user_login  // ... and so on
			),array('id'=>$_POST['id'])
				);
			echo json_encode(array("message"=>"Data Updated"));
			break;
		case "delete2":
			$wpdb->delete('drlam_power_keyword',array('id'=>$_POST['id'])
				);
			echo json_encode(array("message"=>"Data Deleted"));
			break;
		default:
			break;
	}
}
else
{
	echo "No Action";
}
?>
