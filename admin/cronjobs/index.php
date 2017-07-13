<?php
	//deactivate all existing codes
	//delete all unnecessary storage
	//send emails to all watchlists.
	include_once 'a/incl.php';

    deactivateAll_(); 

  deleteDir__("../../spread");
  deleteDir__("../../compressed");

	function deactivateAll_(){
		$qr="SELECT * FROM assign_teach WHERE deactivated_=0";
		$rows=fetch_assoc($qr);
		$time=time();
		for ($i=0; $i<count($rows); $i++){
			$id=$rows[$i]['id'];
			$deact=$rows[$i]['deactivation_time'];
			if ($time>$deact){
				$query="UPDATE assign_teach SET deactivated_=1, deactivated_time=$time WHERE id=$id";
				queryMysql($query);	
			}		
		}	
	}

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


	function sendWatchlistEmails(){
		// $query="SELECT * FROM watchlists INNER JOIN assign_teach WHERE assign_teach.deactivation_time -";
	}
?>