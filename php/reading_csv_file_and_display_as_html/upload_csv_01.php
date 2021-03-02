<?php

include("functions.php");
   
   if(isset($_FILES['datoteka'])){
      $name = $_FILES['datoteka']['name'];
      $size = $_FILES['datoteka']['size'];
      $tmp_name = $_FILES['datoteka']['tmp_name'];
      $type = $_FILES['datoteka']['type'];
   }
   
   mkdir('UPLOADS/');
   $upload_directory = '/UPLOADS';
   $upload_ok = 1;
   $upload_file = basename($_FILES['datoteka']['name']);
   $file_array = explode(".",$upload_file);
   $ext = strtolower(end($file_array)); 
   
   $file_onserver = "file_".time().".".$ext;
   $new_file_name = $upload_directory.$file_onserver;
	  
	if(isset($_POST["btn_upload"])) {
    
		if(file_exists($new_file_name)) {
		echo 'Sorry, file already exists.';
		$upload_ok = 0;
		}
	}	  
	  
	if($upload_ok == 1){
		move_uploaded_file($tmp_name,"UPLOADS/".$name);
		$file_array = readCSV("UPLOADS/".$name);
		
		echo '
		
			<!DOCTYPE html>
			<html lang="en">
			<head>
			  <meta charset="UTF-8">
			  <meta name="viewport" content="width=device-width, initial-scale=1.0">
			  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
			  <title>Upload file</title>
			</head>
			
			<body>
				<style>
				html,
				body {
				  height: 100%;
				}

				body {
				  display: -ms-flexbox;
				  display: flex;
				  -ms-flex-align: center;
				  align-items: center;
				  padding-top: 40px;
				  padding-bottom: 40px;
				  background-color: #f5f5f5;
				}
				</style>
			
			<table class="table table-danger">
			<thead>
			<tr>';
		
			$row_array = end($file_array);
			if(is_array($row_array)) {
				foreach($row_array as $key => $val)
				{
					echo '<th scope="col">'.$key.'</th>';
				}
			}
		
			echo '
			</tr>
			</thead>
			<tbody>';
		
				if(is_array($file_array)) {
					
					foreach($file_array as $key => $row_array) {
						
						echo '
						<tr>';
						
							if(is_array($row_array))
							{
								foreach($row_array as $k => $v)
								{
									echo '<td>'.$v.'</td>';
								}
							}	
					echo '
					</tr>';
					}
				}		
	
		echo'
		</tbody>
		</table>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		</body>
		</html>	
		';

	}
	else {
		echo 'Sorry, there was an error uploading your file.';
	}
?>

