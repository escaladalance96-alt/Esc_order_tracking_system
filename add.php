<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Add Order</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
<h3>Add New Order</h3>

<?php
if(isset($_POST['save'])){
  $tracking = 'ORD-'.rand(1000,9999);
  $stmt = $conn->prepare("INSERT INTO orders (tracking_number,customer_name,product_name,quantity,total_amount,status,order_date) VALUES (?,?,?,?,?,?,?)");
  $stmt->bind_param("sssidss", $tracking, $_POST['customer_name'], $_POST['product_name'], $_POST['quantity'], $_POST['total_amount'], $_POST['status'], $_POST['order_date']);
  if($stmt->execute()){
    echo "<div class='alert alert-success'>Order added! Tracking #: <b>$tracking</b> <a href='index.php'>Back to list</a></div>";
  }
}
?>

<form method="POST" class="card p-4">
<label>Customer Name</label>
<input required name="customer_name" class="form-control mb-2">

<label>Product Name</label>
<input required name="product_name" class="form-control mb-2">

<label>Quantity</label>
<input required type="number" name="quantity" class="form-control mb-2">

<label>Total Amount</label>
<input required type="number" step="0.01" name="total_amount" class="form-control mb-2">

<label>Order Date</label>
<input required type="date" name="order_date" value="2026-11-11" class="form-control mb-2">

<label>Status</label>
<select name="status" class="form-select mb-3">
<option>Pending</option>
<option>Processing</option>
<option>Shipped</option>
<option>Out for Delivery</option>
<option>Delivered</option>
<option>Cancelled</option>
</select>

<button name="save" class="btn btn-success">Save Order</button>
<a href="index.php" class="btn btn-secondary">Back</a>
</form>
</div>
</body>
</html>