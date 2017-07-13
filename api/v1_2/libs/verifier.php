<?php 

	define('NO_OF_MSGS', 4);
	define('TIMEOUT', 3600);//timeout for each upload b4 it is deleted
	define('JUST_NOW', 600);
	define('COOKIE_TIMEOUT', 3600*24*10*10);	//cookie


	function deleteDir($dir){
	    $time=time();
	    $arr=scandir($dir);
	    foreach ($arr as $key => $value) {
	        if(($value!='..' && $value!='.')){
	            //if less than 1hr  ago.
	            $this__=$dir."/".$value;
	            // 
	            if (is_dir($this__)) {
	            	array_map('unlink', glob("$this__/*.*"));
	            	deleteDir($this__);
	            	rmdir($this__);
	            }else{
	            	@unlink($this__);
	            }
	        }
	    }
	}

    function mkdire($lop){
    	if(is_dir($lop)){
    	}else{
    		mkdir($lop, 0777, true);
    	}
    	return $lop;
    }

	function deleteDir__($dir){
	    $time=time();
	    mkdire($dir);
	    $arr=scandir($dir);
	    foreach ($arr as $key => $value) {
	        if(intval($value)<($time-TIMEOUT) &&($value!='..' && $value!='.')){
	            //if less than 1hr  ago.
	            $this__=$dir."/".$value;
	            // 
	            if (is_dir($this__)) {
	            	array_map('unlink', glob("$this__/*.*"));
	            	deleteDir($this__);
	            	rmdir($this__);
	            }else{
	            	@unlink($this__);
	            }
	        }
	    }
	}
	function frename_($src, $dest){
		return @rename($src, $dest);
	}

	function getDescDir($dell){
		$ass=new Assignment();
		$dirc=$ass->getLoc()."description/";
		crtDir($dirc);
		$file=$dirc.$dell.".txt";
		return $file;
	}

	function fwrite_($file, $src){
		fcreate_($file);
		fwrite(fopen($file, "w"), $src);
	}

	function fcreate_($file){
		fopen($file, "a+");		
	}

	function fread_($file){
		fcreate_($file);
		$fsize=(filesize($file)<1)?1:filesize($file);
		$r=fread(fopen($file, "r"), $fsize);
		return $r;
	}

	function crtDir($dir){
    	@mkdir($dir,0777, true);   			
	}

    function rw_url($v){
    	//make it url purified
    	return str_replace("\\", DIRECTORY_SEPARATOR, str_replace("/", DIRECTORY_SEPARATOR, $v));
    }
    
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
		if($vr=="link" || $vr=="user"||$vr=="newlink"){
			if($vr=="link" || $vr=="newlink"){
				return str_replace(".", "", str_replace(" ", "", sanitizeString($_POST[$vr])));
			}
				return str_replace(" ", "", sanitizeString($_POST[$vr]));
		}
		return changeLessandgt($_POST[$vr]);
	}else{
	  $jdf=fopen("noString.txt", "a+");
	  fwrite($jdf, " getpoststring \t".$vr."\t".time()."/n");
		// release(undefReq());
		// exit();
	}
	return "";
}

function changeLessandgt($string){
	// return $string;
	return htmlentities($string);
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
    		return " LIMIT $skip, $results_per_page";
		}			
	}
	else return "";	
}
    function getLoc(){
    	return "../../";
    }

    function returnOneString($res){
    	return array("result"=>$res);
    }


    function teil($r){
    	return ceil($r);
    }
    
	function getGetorPostString($vr){
		return (!empty(getGetString($vr)))?getGetString($vr):getPostString($vr);
	}

	function getCurrentPage(){
		$cur_page = (!empty(getGetorPostString('page'))) ? getGetorPostString('page') : 1;
		if ($cur_page<1 || !is_numeric($cur_page)){
			$cur_page=1;
		}
		return $cur_page;
	}

	function getNextPage(){
		return getCurrentPage()+1;
	}
	function getPrevPage(){
		return getCurrentPage()-1;
	}
 ?>