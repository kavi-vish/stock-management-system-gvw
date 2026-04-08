<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$productName     = $_POST['productName'];
	$quantity        = $_POST['quantity'];
	$rate            = $_POST['rate'];
	$brandName       = $_POST['brandName'];
	$categoryName    = $_POST['categoryName'];
	$productStatus   = $_POST['productStatus'];

	// Default image if none uploaded
// Default placeholder image (make sure this file exists!)
$productImage = '../assests/images/stock/photo_default.png';

// Only process upload if a file was actually selected and uploaded without errors
if (!empty($_FILES['productImage']['name']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {

    // Get file extension safely
    $fileName    = $_FILES['productImage']['name'];
    $tmpName     = $_FILES['productImage']['tmp_name'];
    $fileExt     = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Allowed extensions
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileExt, $allowed)) {

        // Prevent overwriting + unique name
        $newFileName = uniqid('prod_', true) . '.' . $fileExt;
        $uploadPath  = '../assests/images/stock/' . $newFileName;

        if (move_uploaded_file($tmpName, $uploadPath)) {
            $productImage = $uploadPath; // Success → use uploaded image
        }
        // If move fails, we silently keep the default image (no error thrown to user)
    }
    // If invalid extension → keep default image (no error)
}
// If no file uploaded → $productImage remains the default placeholder
	// If no valid image uploaded, $productImage remains the default placeholder

	// Sanitize inputs (recommended)
	$productName = mysqli_real_escape_string($connect, $productName);

	$sql = "INSERT INTO product 
			(product_name, product_image, brand_id, categories_id, quantity, rate, active, status) 
			VALUES 
			('$productName', '$productImage', '$brandName', '$categoryName', '$quantity', '$rate', '$productStatus', 1)";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the product: " . $connect->error;
	}

	$connect->close();
	echo json_encode($valid);
}
?>