<?php 
	if(isset($_FILES)){
		$size=0;
		foreach ($_FILES as $key => $value) {
			// var_dump();
			$size+=$value['size'];
		}
		var_dump($size);
	};
	

?>
<form method='POST' enctype='multipart/form-data' action="<?php echo $_SERVER['PHP_SELF'];?>">
	<input type='file' name='assign'><br> 
	<input type='file' name='assignd'><br> 
	<input type='file' name='assignf'><br> 
	<input type='file' name='assignsd'><br> 
	<input type='file' name='assignfds'><br> 
	<input type='hidden' value='remember-me' name='ddmy'> 
	<input type='hidden' value='remember-me' name='dummy'>   
	<input type='hidden' value='remember-me' name='upldfile'> 
	<input type='submit' class='btn btn-sm btn-lng btn-success' value='ghvcfgc f'/> 
</form>
