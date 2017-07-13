<?php
	define('LOGINKEY',"frfejhserjcfjkhg");
	define('JUST_NOW', 40);//1min


	$dbhost  = 'localhost';    // Unlikely to require changing 
	$dbname  = 'coursecode';   // Modify these...
	$dbuser  = 'root';   // ...variables according
	$dbpass  = '';   // ...to your installation

	$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if ($connection->connect_error) die($connection->connect_error);
	session_start();

	function createTable($name, $query)
	{   global $imgsu; global $messu; global $bgsu;
		queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
		echo "Table '$name' created or already exists.<br>";
	}

	function queryMysql($query)
	{
		global $connection;
		$result = $connection->query($query);
		if (!$result) die($connection->error);
		return $result;
	}

	function destroySession()
	{
		$_SESSION=array();
		session_destroy();


		if (isset($_COOKIE['userpiccmaq']) 
			|| isset($_COOKIE['passpiccmaq']))
			setcookie('userpiccmaq', '', time()-2592000, '/');
	      // Delete the user ID and username cookies by setting their expirations to an hour ago (3600)
		setcookie('userpiccmaq', '', time() - 545450);
		setcookie('passpiccmaq', '', time() - 35676676);
	}

	function sanitizeString($var)
	{
		global $connection;
		$var = strip_tags($var);
		$var = htmlentities($var);
		$var = stripslashes($var);
		return $connection->real_escape_string($var);
	}

	function checknum($query){
		$resy=queryMysql("$query");
		$num= $resy-> num_rows;
		return $num;
	}


	function getGetString($vr){
		if (isset($_GET[$vr])){
			return $_GET[$vr];
		}
		return "";
	}

	function getPostString($vr){
		if (isset($_POST[$vr])){		
			if($vr=="link" || $vr=="user"){
				return str_replace(" ", "", $_POST[$vr]);
			}
			return $_POST[$vr];
		}else{/*
		  $jdf=fopen("noString.txt", "a+");
		  fwrite($jdf, " getpoststring \t".$vr."\t".time()."/n");*/
			// release(undefReq());
			// exit();
		}
		return "";
	}

	function getGetorPostString($vr){
		return (!empty(getGetString($vr)))?getGetString($vr):getPostString($vr);
	}

	function calcpages($total, $results_per_page){
	 // Calculate pagination information
		$cur_page = getCurrentPage();

		if(is_numeric($cur_page)){
	  		$skip = (($cur_page - 1) * $results_per_page);
	  		$num_pages = ceil($total / $results_per_page);

	    	// if ($num_pages > 1) {
	    		return " LIMIT $skip, $results_per_page";
			// }
			// if($)			
		}
		 return "";	
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


	function url_rewrite_query($req){
		//adds a value to the already initiated get req;
		$url_get=$_SERVER['REQUEST_URI'];

	    $var_=explode("?", ($url_get));
	    $num=count($var_);
	    $var__=explode("&", ($url_get));
	    $num_=count($var__);
	    if((strlen($var_[$num-1]))<1){
	        $res=$url_get.$req;
	    }else
	    if((strlen($var__[$num_-1]))<1){
	        $res=$url_get.$req;
	    }else
		if(strpos($url_get, "?")>-1){
			$res=$url_get."&".$req;
		}else{
			$res=$url_get."?".$req;
		}
		return $res;
	}



	function url_rewrite_query__($url_get, $req){
		//adds a value to the already initiated get req;
	    $var_=explode("?", ($url_get));
	    $num=count($var_);
	    $var__=explode("&", ($url_get));
	    $num_=count($var__);
	    if((strlen($var_[$num-1]))<1){
	        $res=$url_get.$req;
	    }else
	    if((strlen($var__[$num_-1]))<1){
	        $res=$url_get.$req;
	    }else
		if(strpos($url_get, "?")>-1){
			$res=$url_get."&".$req;
		}else{
			$res=$url_get."?".$req;
		}
		return $res;
	}


	function deserialiseHr($dob){
        $dobo=explode("-", "$dob");
        if (count($dobo)==5){
            for ($ri=0; $ri<5; $ri++){
                //check numericity
                if(!is_numeric($dobo[$ri])){
                    return 0;
                } 
            }
            $day=$dobo[0];
            $month=$dobo[1];
            $year=$dobo[2];
            $hr=$dobo[3];
            $min=$dobo[4];

            $dob=$day;
            $mob=$month;
            $yob=$year;

            $job = checkdate($mob,$dob,$yob) ? 'trueo' :'falseo'; // checks if date is corrr
            // $job="trueo"; 
            $jobs = $hr<25 && $hr>0 ? 'trueo' :'falseo'; // checks if time is corrr
            // $job="trueo";
            if ($job == 'trueo' && $jobs=="trueo"){
                $importantDate = mktime($hr,$min,0,$month,$day,$year);
                return $importantDate;
            } 
        }
         return 0;
        // print_r($dobo);
    }

	function goBack(){
		$ref=(!empty(getGetString('redir_uri')))?getGetString('redir_uri'):"";
		$ref=(empty($ref) && !empty($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:$ref;
		$ref=(empty($ref))?BASESES."/home.php":$ref;
		header("Location:$ref");
	}

	function goBack__($var){
		$ref=(!empty(getGetString('redir_uri')))?getGetString('redir_uri'):"";
		$ref=(empty($ref) && !empty($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:$ref;
		$ref=(empty($ref))?BASESES."/home.php":$ref;
		header("Location:".url_rewrite_query__($ref,$var));
	}

	function getAllApis(){
		$arr=array();
		$quer="SELECT * FROM app_id_storage";
		$num=checknum($quer);
		$res=queryMysql($quer);
		while ($num>=0) {
			$ars=$res->fetch_array(MYSQLI_ASSOC);
			array_push($arr, $ars);
			$num--;			
		}
		return $arr;
	}

	function getAllUsers(){
		$arr=$ert=array();
		$quer="SELECT * FROM profile LIMIT 15";
		$num=checknum($quer);
		$res=queryMysql($quer);
		while ($num>=0) {
			$ars=$res->fetch_array(MYSQLI_ASSOC);
			array_push($arr, $ars);
			$num--;			
		}
		$quer="SELECT * FROM profile";
		$num=checknum($quer);
		array_push($ert, $arr);
		array_push($ert, array("total"=>$num));
		return $ert;
	}

	function getAllContacts(){
		$arr=$ert=array();
		$quer="SELECT * FROM contacttable "; 
		$num=$total=checknum($quer);
		$results_per_page=15;
	  	$num_pages = ceil($total / $results_per_page); 
		$quer=$quer." ORDER BY time ".calcpages__($total, $results_per_page);
		$num=checknum($quer);
		$res=queryMysql($quer);
		while ($num>=0) {
			$ars=$res->fetch_array(MYSQLI_ASSOC);
			array_push($arr, $ars);
			$num--;			
		}
		array_push($ert, $arr);
		array_push($ert, array("total"=>$total, "pages"=>$num_pages));
		return $ert;
	}

	function isLoggedIn(){
		return (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']==LOGINKEY);
	}



	function getDWM__($TtimeStamp){
        //tobe returned
        if(empty($TtimeStamp)){
            return "";
        }
		
		$time_diff=time()-$TtimeStamp;

        $one_min=60;
        $one_hr=3600;
        $one_day=$one_hr*24;
        $one_week=$one_day*7;

        $numb=$time_diff/$one_day;
        $tbr="1min";
        $to=$time_diff;

        if($numb>=1){
            //check for number of days
            if($numb>30){
                //show dd/mm
                $art=getdate($TtimeStamp);
                $min=$art['minutes'];
                $mon=$art['mon'];
                $dayy=$art['mday'];
                $tbr="".$dayy+'/'.$mon;
            }else if($numb>7){
                //show 1w
                $tbr=teil($numb) ."w";
            }else{
                $tbr=teil($numb)."d";
            }
        }else{
            //show 1d
            $tbr="1d";
            $num_hr=$to/$one_hr;
            $num_min=$to/$one_min;

            if($num_hr>=1){
                $tbr=teil($num_hr)."hr";
            }else if($num_min>=1){
                //min
                $tbr=teil($num_min)."min";
            }else{
                //sec
                if(teil($to)<JUST_NOW)
                	$tbr="Just now";
                else
                	$tbr=teil($to)."s";
            }
        }
        return $tbr;
    }


    function teil($r){
    	return ceil($r);
    }

	function calcpages__($total, $results_per_page){
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

?>
