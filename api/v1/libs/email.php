<?php

	function sendRecoveryEmail__($email, $uusername){
		$hashCode=gnrtNewString(7,10);
		$time=time();
		$likn="http://coursecode.com.ng/passrecovery.php?hash=$hashCode&user=$uusername";

		queryMysql("INSERT INTO password_gen (id, hash_code, username, time, deactivated_) VALUES (NULL, '$hashCode', '$uusername', $time, 0)");
		$message="Hello $uusername, \n \t \t You are receiving this message because you clicked on forgot password, please use this link $likn to login again.\n \t \t if you did not make this request, please discard this message.\n \t \t The CourseCode Team.";

		return @mail("$email","CourseCode:New Password Request","$message");
	}

	function sendRecoveryEmail($email, $uusername){
		$headers = "From: adminteam@coursecode.com.ng\r\n";
		$headers .= "Reply-To: adminteam@coursecode.com.ng\r\n";
		$headers .= "Return-Path: adminteam@coursecode.com.ng\r\n";
		$headers .= "CC: $email\r\n";
		// $headers .= "BCC: hidden@example.com\r\n";
		$subject = "CourseCode:New Password Request";

		$hashCode=gnrtNewString(7,10);
		$time=time();
		$likn="http://coursecode.com.ng/passrecovery.php?hash=$hashCode&user=$uusername";

		queryMysql("INSERT INTO password_gen (id, hash_code, username, time, deactivated_) VALUES (NULL, '$hashCode', '$uusername', $time, 0)");
		$message="Hello $uusername, \n \t \t You are receiving this message because you clicked on forgot password, please use this link $likn to login again.\n \t \t if you did not make this request, please discard this message.\n \t \t The CourseCode Team.";

		return @mail($email,$subject,$message,$headers);
	}

	function notifyNewMessage($user, $auth){
		$query="SELECT * FROM profile WHERE username='$user'";
		if (queryNum($query)>0){
			$ERRRR=queryMysql($query)->fetch_array(MYSQLI_ASSOC);
			$email=$ERRRR['email'];
		}else 
		return false;
		$headers = "From: adminteam@coursecode.com.ng\r\n";
		$headers .= "Reply-To: adminteam@coursecode.com.ng\r\n";
		$headers .= "Return-Path: adminteam@coursecode.com.ng\r\n";
		$headers .= "CC: $email\r\n";
		// $headers .= "BCC: hidden@example.com\r\n";
		$subject = "CourseCode:New Message from $auth";

		$hashCode=gnrtNewString(7,10);
		$time=time();

		$message="Hello $user, \n \t \t $auth just sent you a new message, please login to view this message. http://coursecode.com.ng/nxt/index.php \n \t \t The CourseCode Team.";

		return @mail($email,$subject,$message,$headers);		
	}

?>