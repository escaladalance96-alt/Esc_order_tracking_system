<?php include 'db_connect.php';
$id = intval($_GET['id']);
$row = $conn->query("SELECT * FROM orders WHERE id=$id")->fetch_assoc();
if(isset($_POST['update'])){
  $stmt = $conn->prepare("UPDATE orders SET customer_name=?, product_name=?, quantity=?, total_amount=?, status=?, order_date=? WHERE id=?");
  $stmt->bind_param("ssidssi", $_POST['customer_name'], $_POST['product_name'], $_POST['quantity'], $_POST['total_amount'], $_POST['status'], $_POST['order_date'], $id);
  if($stmt->execute()){ header("Location: index.php"); exit; }
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Order</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
<h3>Edit Order - <?php echo $row['tracking_number']; ?></h3>
<form method="POST" class="card p-4">
<label>Customer Name</label>
<input required name="customer_name" value="<?php echo $row['customer_name']; ?>" class="form-control mb-2">
<label>Product Name</label>
<input required name="product_name" value="<?php echo $row['product_name']; ?>" class="form-control mb-2">
<label>Quantity</label>
<input required type="number" name="quantity" value="<?php echo $row['quantity']; ?>" class="form-control mb-2">
<label>Total Amount</label>
<input required type="number" step="0.01" name="total_amount" value="<?php echo $row['total_amount']; ?>" class="form-control mb-2">
<label>Order Date</label>
<input required type="date" name="order_date" value="<?php echo $row['order_date']; ?>" class="form-control mb-2">
<label>Status</label>
<select name="status" class="form-select mb-3">
<?php
foreach(['Pending','Processing','Shipped','Out for Delivery','Delivered','Cancelled'] as $s){
  $sel = ($row['status']==$s) ? 'selected' : '';
  echo "<option $sel>$s</option>";
}
?>
</select>
<button name="update" class="btn btn-warning">Update Order</button>
<a href="index.php" class="btn btn-secondary">Back</a>
</form>
</div>
</body>
</html>