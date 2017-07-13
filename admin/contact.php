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
	$allapis=array(array(),array('total'=>"0", 'pages'=>0));
  	if(isLoggedin()){
		$allapis=getAllContacts();
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
		<a href="contact.php"><button>Refresh</button></a>
		<a href="index.php"><button>Back</button></a><br>
		<a href="index.php?logout=dshbf"><button>Logout</button></a>

							
			
		<div class="row">
		<!-- col-lg-8 -->	
		<div class="col-lg-4 col-sm-4 col-md-4 text-center">					
			<table class="table table-striped table-bordered table-condensed table-hover">
			<tr><td>
			REPLY MESSAGE
			<form method="POST" action="a/index.php?todo=sndresp">
				<input name='appid' type="text" placeholder='email'>
			</tr>
			<tr><td>
			<input name='new_appid' type="text" placeholder='Subject'>
			</td>
			</tr>
			<tr><td>
			<textarea name='msg' type="text" placeholder='Reponse'></textarea>
			</td>
			</tr>
			<tr><td>
			<input type="submit" value='Reply'>
			</form></td>
			</tr>
			</table>
		</div>
		
		<!-- col-lg-8 -->	
		<div class="col-lg-8 col-sm-8 col-md-8 text-center">					
			
		</div>					
			
		</div>
		<br>
		<?php
			echo '<button> Total users='.$allapis[1]['total'].'</button>';
			echo '<button> Total pages='.$allapis[1]['pages'].'</button>';
		?>
		<br>

		<?php
			echo '<a href="contact.php?page='.getPrevPage().'"><button>prev</button></a>';
			echo '<a href="contact.php?page='.getNextPage().'"><button>NEXT</button></a>';
		?>
		<table class="table table-striped table-bordered table-condensed table-hover">
			<tr><td>id</td><td>name</td><td>email</td><td>subject</td><td colspan=2>message</td><td>time</td></tr>
			<?php
				foreach ($allapis[0] as $key => $value) {
					echo "<tr><td>".$value['id']."</td><td>".$value['name']."</td><td>".$value['email']."</td><td>".$value['title']."</td><td colspan=2>".$value['message']."</td><td>".getDWM__($value['time'])."</td></tr>";
				}
			?>
		</table>
	</div>
		<?php
			echo '<a href="contact.php?page='.getPrevPage().'"><button>prev</button></a>';
			echo '<a href="contact.php?page='.getNextPage().'"><button>NEXT</button></a>';
		?>

	<?php include 'footer.php';?>
</body>
</html>