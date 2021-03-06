<?php 
include('header.php');
include('functions.php');?>
<title> Add Watermark To Images Using PHP</title>
<?php include('container.php');?>
<div class="container">
	<h2> Add Watermark To Images Using PHP</h2>	
	<br>
	<br>
	<form action="" method="post" enctype="multipart/form-data">		
		<input type="file" name="image" value="">
		<br>
		<select name="image_upload">
			<option value="">Select Water Mark Type</option>
			<option value="text_watermark">Text Water Mark</option>
			<option value="image_watermark">Image Water Mark</option>
		</select>
		<input type="submit" value="Upload">
	</form>
	<br>
	
	<?php
	if(isset($_FILES['image']['name'])){
		// Validating Type of uploaded image
		switch($_FILES['image']['type']){
			case 'image/jpeg':			
			case 'image/jpg':
			case 'image/png':
			case 'image/gif':
				// Add more validation if you like
				if(getimagesize($_FILES['image']['tmp_name']) < (1024*1024*1024*1024)){
					echo 'Image size is greater than 2MB';
				} elseif(empty($_POST['image_upload'])){
					echo 'Please select watermark type';
				} else {
					// Create new name for uploaded image with upload directory path
					list($txt, $ext) = explode(".", $_FILES['image']['name']);
					$file_name = "images/watermark.".$ext;
					$upload = copy($_FILES['image']['tmp_name'], $file_name);
					if($upload == true){
						// Check type of water mark is selected 
						if($_POST['image_upload'] == 'text_watermark'){
							// Add text watermark over image
							$watermark = "MINHAJ WELFARE ORGANIZATION"; // Add your own water mark here
							addTextWatermark($file_name, $watermark, $file_name);							
						} elseif($_POST['image_upload'] == 'image_watermark'){
							// Add image watermark over image
							$WaterMark = 'watermark.png';
							addImageWatermark ($file_name, $WaterMark, $file_name, 50);
						}
						echo '<br><img src="'.$file_name.'" class="preview" width="500"><br>';
					} else {
						echo 'Error uploading image';
					}
				}
			break;
			default:
			echo 'Please select jpeg / jpg / png / gif type file for upload';
		}
	}
	?>	
	<br>
	<br>
	
</div>
<?php include('footer.php');?>