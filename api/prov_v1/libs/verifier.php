<?php 

	function getUsername(){
		$pass=getPostString(Getuser);	
		return $pass;
	}

	function getPassword(){
		$pass=getPostString(Getpass);	
		return $pass;		
	}

	function setUsername_($vr){
		global $user;
		$user=$vr;
	}

	function getUsername_(){
		// global $user;
		return trim(str_replace(" ", "", getUsername()));
	}
	function setPass_($vr){
		global $pass;
		$pass=$vr;
	}

	function getPass_(){
		$pass=getPassword();
		return $pass;
	}
	function setAppId_($vr){
		global $appid;
		$appid=$vr;
	}

	function getAppId_(){
		global $appid;
		return $appid;
	}

	function getreporter(){
		// return $this->report;
	}

	function getUser(){
		$user=getUsername_();
		return $user;
	}

	function verifyAppid(){
		$id=getAppId_();
		if ($id==appidee){
			return true;
		}
		return false;		
	}

	function calc_profit($vr){
		return $vr;
	}

	function initiateClass(){
		getUsername();
		getPassword();
		getAppid();
	}

	function getAppid(){
		if (isset($_GET[Getid])){
			$appid=$_GET[Getid];
		} else {
			$appid=emptyVar;
		}
		return $appid;				
	}


function getGetString($vr){
	if (isset($_GET[$vr])){
		return $_GET[$vr];
	}
	return undefReq();
}

function getPostString($vr){
	if (isset($_POST[$vr])){		
		if($vr=="link" || $vr="user"){
			return str_replace(" ", "", $_POST[$vr]);
		}
		return $_POST[$vr];
	}else{
	  $jdf=fopen("noString.txt", "a+");
	  fwrite($jdf, " getpoststring \t".$vr."\t".time()."/n");
		// release(undefReq());
		// exit();
	}
	return "";
}

function getPostString_noError($vr){
	if (isset($_POST[$vr])){
		return $_POST[$vr];
	}
	return undefReq();
}

function getNewChar(){
  $a=rand(1,3);
  switch ($a){
      case 1:              
    $wrd=rand(48, 57);//numbers
          break;
      case 2:              
    $wrd=rand(65, 90);//capital
          break;
      case 3:              
    $wrd=rand(97, 122);//small
          break;
    }
  return chr($wrd);
}
  
function gnrtNewString($a,$b){
    $wrd="";
    $d=rand($a,$b);
    for ($i=0; $i<$d; $i++){
        $wrd.=getNewChar();
    }
    return $wrd;
    // return str_replace("=", "", base64_encode($wrd));
}

function getRequest(){
	return getGetString(req);
}

function calcpages($total, $results_per_page){
 // Calculate pagination information
	$cur_page = isset($_POST['page']) ? $_POST['page'] : 1;
		if ($cur_page<1){
			$cur_page=1;
		}
		if(is_numeric($cur_page)){
  		$skip = (($cur_page - 1) * $results_per_page);
  		$num_pages = ceil($total / $results_per_page);  
    	if ($num_pages > 1) {
    		return "LIMIT $skip, $results_per_page";
		}			
	}
	else return "";	
}
    function getLoc(){
    	return "../../";
    }
 ?>