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
	$allapis=array(array(),array('total'=>"0"));
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
		<a href="user.php"><button>Refresh</button></a>
		<a href="index.php"><button>Back</button></a><br>

		<!-- col-lg-8 -->	
		<div class="col-lg-4 col-sm-4 col-md-4 text-center">					
			<table class="table table-striped table-bordered table-condensed table-hover">
			<tr><td>
				GET USER
				<form method="POST" action="a/index.php?todo=getuser">
					<input name='name' type="text" placeholder='name'>
			</tr>
			<tr><td>
			<input type="submit" value='Submit'>
			</form></td>
			</tr>
			</table>
		</div>
		<!-- col-lg-8 -->	
		<div class="col-lg-4 col-sm-4 col-md-4 text-center">					
			<table class="table table-striped table-bordered table-condensed table-hover">
			<tr><td>
			REMOVE USER
			<form method="POST" action="a/index.php?todo=rmvuser">
				<input name='appid' type="text" placeholder='Username'>
			</tr>
			<tr><td>
			<input name='new_appid' type="text" placeholder='New password'>
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
					RESET USERNAME 
					<form method="POST" action="a/index.php?todo=resetuser">
						<input name='name' type="text" placeholder='username'>
					</tr>
					<tr><td>
						<input name='new_name' type="text" placeholder='New username'>
					</td>
				</tr>
				<tr><td>
					<input type="submit" value='Alter'>
				</form></td>
			</tr>
		</table>
	</div>
		<br>
		<table class="table table-striped table-bordered table-condensed table-hover">
			<tr><td>id</td><td>name</td><td>username</td><td>School</td></tr>
			<?php
				echo '<button> Total users='.$allapis[1]['total'].'</button>';
				foreach ($allapis[0] as $key => $value) {
					echo "<tr><td>".$value['id']."</td><td>".$value['name']."</td><td>".$value['username']."</td><td>".$value['school']."</td></tr>";
				}
			?>
		</table>
	</div>

	<?php include 'footer.php';?>
</body>
</html>