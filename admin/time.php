<?php
	include_once 'a/incl.php';
	$message="";
	if(!empty(getGetString('alert'))){	
	    if(getGetString('alert')=="getuser"){
	    	$message.="<div class='alert alert-block alert-info'>
	                  <button type='button' class='close' data-dismiss='alert'>×</button>
	                  <h4>timestamp</h4>
	                    ".deserialiseHr(getPostString('day').'-'.getPostString('time'))."
	                </div>";
	    }  
	    else 
	    if(getGetString('alert')=="stamp"){
	    	$message.="<div class='alert alert-block alert-info'>
	                  <button type='button' class='close' data-dismiss='alert'>×</button>
	                  <h4>timestamp</h4>
	                    ".json_encode(getdate(getPostString('time')))."
	                </div>";
	    }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include 'head.php';?>
</head>
<body>
	<div>			
		<?php 
			echo $message;
		?>
		<a href="time.php"><button>Refresh</button></a>
		<a href="index.php"><button>Back</button></a><br>
		GET TIMESTAMP
		<form method="POST" action="time.php?alert=getuser">
			<input name='day' type="text" placeholder='day'>
			<input name='time' type="text" placeholder='time'>
			<input type="submit" value='Submit'>
		</form>
		GET DATE
		<form method="POST" action="time.php?alert=stamp">
			<input name='time' type="text" placeholder='timestamp'>
			<input type="submit" value='Submit'>
		</form>
	</div>

	<?php include 'footer.php';?>
</body>
</html>