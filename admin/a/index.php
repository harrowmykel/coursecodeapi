<?php
	include_once 'incl.php';
	$req=getGetString('todo');
	define('todo', $req);

  	if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']=="frfejhserjcfjkhg"){
  		echo "is_logged_in<br>";
  	}else{
		goBack__("alert=error+is_not_logged_in&fn=".todo);
  		exit();
  	}

	
// sendreqconfirmreqdeletereqreport,block
	switch ($req) {
		case 'addapi':
			addapi();
			break;
		case 'rmvapi':
			rmvapi();
			break;	
		case 'sndresp':
			sndresp();
			break;
		case 'alterapi':
			alterapi();
			break;		
		case 'getuser':
			getUser();
			break;
		case 'rmvuser':
			rmvUser();
			break;
		case 'resetuser':
			resetuser();
			break;
	}
	// goBack();
	function rmvapi(){
		$time=is_numeric(getPostString('time'))?getPostString('time'):0;
		$app_id=getPostString('appid');
		$size=getPostString('size');
		$mem_use=getPostString('mem_use');
		$concant="";
		if(!empty($size)){
			$concant.=", size__=$size ";
		}
		if(!empty($mem_use)){
			$concant.=", memory_use=$size ";
		}
		
		$quer="UPDATE app_id_storage SET expiry_time=$time".$concant." where app_id='$app_id'";

		queryMysql($quer);
		goBack__("alert=done+set+to+$time&fn=".todo);
	}

	function addapi(){
		$time=getPostString('time');
		$app_id=getPostString('appid');
		$name=getPostString('name');
		$size=getPostString('size');
		$mem_use=getPostString('mem_use');
		if(checknum("SELECT * FROM app_id_storage WHERE app_id='$app_id'")>0){
			goBack__("alert=error+appid+already+defined&fn=addapi");
		}else{
			$quer="INSERT INTO app_id_storage (id, name, expiry_time, size__, memory_use, app_id) VALUES (NULL,'$name', '$time',$size, 0 '$app_id')";
			queryMysql($quer);			
			goBack__("alert=done&fn=".todo);
		}
	}

	function alterapi(){
		$new_id=getPostString('new_appid');
		$app_id=getPostString('appid');
		$quer="UPDATE app_id_storage SET app_id='$new_id' where app_id='$app_id'";
		queryMysql($quer);
		goBack__("alert=done+set+to+$time&fn=".todo);
	}

	function rmvuser(){
		$napp_id=getPostString('new_appid');
		$app_id=getPostString('appid');
		$size=getPostString('size');
		$quer="UPDATE passtable SET pass='$napp_id' where username='$app_id'";
		if(!empty($size)){
			$quer="UPDATE passtable SET pass='$napp_id', size__=$size where username='$app_id'";
		}
		queryMysql($quer);
		goBack__("alert=done+$app_id+set+to+$napp_id&fn=".todo);
	}

	function getuser(){
		$app_id=getPostString('name');
		$quer="SELECT * FROM passtable where username='$app_id'";
		if(checknum($quer)>0){
			$pass=queryMysql($quer)->fetch_array(MYSQLI_ASSOC)['pass'];
			$quer="SELECT * FROM profile where username='$app_id'";
			$all=json_encode(queryMysql($quer)->fetch_array(MYSQLI_ASSOC));
			goBack__("alert=done+pass+for+$app_id+is+$pass+and+about+is+$all&fn=".todo);			
		}else{
			goBack__("alert=error+no+such+user+$app_id&fn=".todo);
		}
	}

	function resetuser(){
		goBack__("alert=error+this+is+impossible&fn=".todo);
	}

	function sndresp(){
		$subj=getPostString('new_appid');
		$email=getPostString('new_appid');
		$msg=getPostString('msg');

		$headers = "From: adminteam@coursecode.com.ng\r\n";
		$headers .= "Reply-To: adminteam@coursecode.com.ng\r\n";
		$headers .= "Return-Path: adminteam@coursecode.com.ng\r\n";
		$headers .= "CC: $email\r\n";
		// $headers .= "BCC: hidden@example.com\r\n";
		$subject = "CourseCode:".$subj;

		$time=time();

		$message=$msg."\n \t \t The CourseCode Team.";
		$mail=@mail($email,$subject,$message,$headers);
		if($mail){
			goBack__("alert=email+sent&fn=".todo);
		}else
		goBack__("alert=error+this+is+impossible&fn=".todo);
	}

?>