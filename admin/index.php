<?php
	
	include_once 'a/incl.php';
/*
  	$username = 'piccmaq';
  	$password = '08036660086';*/
  	$username = 'admin';
  	$password = $username;


  	if(isset($_POST['username']) ){
  		if( getPostString('username')==$username && getPostString('pass')=="$password"){
	  		$_SESSION['is_logged_in']=LOGINKEY;
	  	}else {
	  		$_SESSION['is_logged_in']=LOGINKEY."fndbfjf";
	  	}
  	}
  	if (!empty(getGetString('logout'))) {
	  	$_SESSION['is_logged_in']=LOGINKEY."djhdhghfg";
  	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include 'head.php';?>
</head>
<body>
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
			<div class="col-lg-8 col-sm-8 col-md-8 text-center">
				<div>
					<table class="table table-striped table-bordered table-condensed table-hover">
						<tr>
							<td><a href="index.php"><button>Refresh</button></a></td>
							<td><a href="user.php"><button>User Profiles Edit</button></a>
							</td>
						<tr>
							<td><a href="time.php"><button>Time parser</button></a></td>
							<td><a href="appid.php"><button>App id locker</button></a></td></tr>
						<tr>
						<tr>
							<td><a href="contact.php"><button>Contact</button></a></td>
							<td><a href="index.php?logout=dshbf"><button>Logout</button></a></td></tr>
						<tr><td colspan="2"><a href="index.php?logout=dshbf"><button>Logout</button></a></td></tr>
					</table>
				</div>
				
			</div>
			<!-- col-lg-8 -->
			<!-- col-lg-4 -->
			<div class="col-lg-4 col-sm-4 col-md-4 text-center">
				<div>
					<table class="table table-striped table-bordered table-condensed table-hover">
						<tr>
							<td>LOGIN </td>
						</tr>
						<tr>
							<td><form method="POST" action="index.php">
								<input name='username' type="text" placeholder='Username'></td>
						<tr>
							<td><input name='pass' type="password" placeholder='Pass'></td>
						<tr>
							<td><input type="submit" value='LOGIN'></form>
								<a href="index.php?logout=dshbf"><button>Logout</button></a>
							</td>
						</tr>
					</table>
				</div>				
			</div>
			<!-- col-lg-4 -->
		</div>
	</div>
	<?php include 'footer.php';?>
</body>
</html>