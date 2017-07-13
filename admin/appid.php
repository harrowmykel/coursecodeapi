<?php
	include_once 'a/incl.php';
	$message="";
	if(!empty(getGetString('alert'))){			
	    $message.="<div class='alert alert-block alert-info'>
	                  <button type='button' class='close' data-dismiss='alert'>×</button>
	                  <h4>".getGetString('fn')."</h4>
	                    ".getGetString('alert')."
	                </div>";  
	}
	$allapis=array();
  	if(isLoggedin()){
		$allapis=getAllApis();
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

		<div class="container">
			<div class="text-center" style="width:100%">ADMIN PANEL |
				<?php				
				  	if(isLoggedin()){
				  		echo "is_logged_in<br>";
				  	}else{
				  		echo "not logged in<br>";
				  	}
				?>		
			</div>
			<div class="row">
				<!-- col-lg-8 -->	
				<div class="col-lg-4 col-sm-4 col-md-4 text-center">					
					<table class="table table-striped table-bordered table-condensed table-hover">
					<tr><td>
					ADD API KEY
					<form method="POST" action="a/index.php?todo=addapi">
						<input name='name' type="text" placeholder='name'>
					</td>
					</tr>
					<tr><td>
						<input name='appid' type="text" placeholder='Appid'>
						</td>
					</tr>
					<tr><td>
						<input name='time' type="text" placeholder='Expiry Date'>
						</td>
					</tr>
					<tr><td>
						<input name='size' type="text" placeholder='Size'>
						</td>
					</tr>
					<tr><td>
						<input type="submit" value='Submit'>
					</form>
						</td>
					</tr>
					</table>
				</div>
				<!-- col-lg-8 -->	
				<div class="col-lg-4 col-sm-4 col-md-4 text-center">					
					<table class="table table-striped table-bordered table-condensed table-hover">
					<tr><td>
					REMOVE API KEY
					<form method="POST" action="a/index.php?todo=rmvapi">
						<input name='appid' type="text" placeholder='Appid'></td>
					</tr>
					<tr><td>
						<input name='time' type="text" placeholder='Expiry Date'></td>
					</tr>
					<tr><td>
						<input name='size' type="text" placeholder='Size'>
						</td>
					</tr>
					<tr><td>
						<input name='mem_use' type="text" placeholder='Memory use'>
						</td>
					</tr>
					<tr><td>
						<input type="submit" value='Alter'>
					</form></td>
					</tr>
					</table>
				</div>
				<!-- col-lg-8 -->	
				<div class="col-lg-4 col-sm-4 col-md-4 text-center">					
					<table class="table table-striped table-bordered table-condensed table-hover">
					<tr><td>
					ALTER API KEY
					<form method="POST" action="a/index.php?todo=alterapi">
						<input name='appid' type="text" placeholder='OLD Appid'></td>
					</tr>
					<tr><td>
						<input name='new_appid' type="text" placeholder='New Appid'></td>
					</tr>
					<tr><td>
						<input type="submit" value='Alter'>
					</form></td>
					</tr>
					</table>
					<br>					
				</div>	
				<a href="appid.php"><button>Refresh</button></a>
				<a href="index.php"><button>Back</button></a><br>
				<table class="table table-striped table-bordered table-condensed table-hover">
					<tr><td>id</td><td>name</td><td>api_id</td><td>Expiry_date</td><td>Size</td><td>Memory_use</td></tr>
					<?php
						foreach ($allapis as $key => $value) {
							echo "<tr><td>".$value['id']."</td><td>".$value['name']."</td><td>".$value['app_id']."</td><td>".$value['expiry_time']."</td><td>".$value['size__']."</td><td>".$value['memory_use']."</td></tr>";
						}
					?>
				</table>
	</div>
	<?php include 'footer.php';?>
</body>
</html>