<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	

	$orderDate 						= date('Y-m-d', strtotime($_POST['orderDate']));	
  $clientName 					= $_POST['clientName'];
  $clientContact 				= $_POST['clientContact'];
  $subTotalValue 				= $_POST['subTotalValue'];
  $vatValue 						=	$_POST['vatValue'];
  $totalAmountValue     = $_POST['totalAmountValue'];
  $discount 						= $_POST['discount'];
  $grandTotalValue 			= $_POST['grandTotalValue'];
  $paid 								= $_POST['paid'];
  $dueValue 						= $_POST['dueValue'];
  $paymentType 					= $_POST['paymentType'];
  $paymentStatus 				= $_POST['paymentStatus'];

				
	$sql = "INSERT INTO orders (order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_type, payment_status, order_status) VALUES ('$orderDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', $paymentType, $paymentStatus, 1)";
	
	
	$order_id;
	$orderStatus = false;
	if($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

		$orderStatus = true;
	}

		
	// echo $_POST['productName'];
$orderItemStatus = false;

for($x = 0; $x < count($_POST['productName']); $x++) {
    
    // Skip completely empty or invalid rows
    if(empty($_POST['productName'][$x]) || 
       empty($_POST['quantity'][$x]) || 
       $_POST['quantity'][$x] <= 0 ||
       empty($_POST['rateValue'][$x])) {
        continue; // Skip this row — don't save garbage
    }

    $updateProductQuantitySql = "SELECT quantity FROM product WHERE product_id = ".$_POST['productName'][$x]."";
    $updateProductQuantityData = $connect->query($updateProductQuantitySql);
    
    if($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
        $newQuantity = $updateProductQuantityResult[0] - $_POST['quantity'][$x];
        
        if($newQuantity < 0) $newQuantity = 0;

        // Update stock
        $updateProductTable = "UPDATE product SET quantity = '$newQuantity' WHERE product_id = ".$_POST['productName'][$x]."";
        $connect->query($updateProductTable);

        // Save only valid item
        $itemDiscount = isset($_POST['ratedisc'][$x]) ? $_POST['ratedisc'][$x] : 0;

        $orderItemSql = "INSERT INTO order_item 
            (order_id, product_id, quantity, rate, total, discount, order_item_status) 
            VALUES (
                '$order_id', 
                '".$_POST['productName'][$x]."', 
                '".$_POST['quantity'][$x]."', 
                '".$_POST['rateValue'][$x]."', 
                '".$_POST['totalValue'][$x]."',
                '$itemDiscount',
                1
            )";

        $connect->query($orderItemSql);
        $orderItemStatus = true;
    }
}

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);