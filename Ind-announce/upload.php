<?php
$target_dir = "./uploads/";
$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
$target_file = $target_dir . basename($_POST["filename"].".".$imageFileType);
$uploadOk = 1;
$final_op ="";
$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["tmp_name"],PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $final_op =$final_op. "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $final_op =$final_op. "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists

// Check file size
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $final_op =$final_op. "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $final_op =$final_op. "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        $final_op =$final_op. "Sorry, there was an error uploading your file.";
    }
}
?>
<script>
alert("<?php echo $final_op; ?>");
window.location.href = "http://10.0.0.2";
</script>