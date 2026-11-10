<?php include 'db_connect.php';
$id = intval($_GET['id']);
$row = $conn->query("SELECT * FROM orders WHERE id=$id")->fetch_assoc();
$steps = ['Pending','Processing','Shipped','Out for Delivery','Delivered'];
$idx = array_search($row['status'], $steps);
$percent = ($row['status']=='Cancelled') ? 100 : (($idx+1)/5*100);
?>
<!DOCTYPE html>
<html>
<head><title>View Order</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
<h3>Order Details - <?php echo $row['tracking_number']; ?></h3>
<div class="card p-4">
<p><b>Customer:</b> <?php echo $row['customer_name']; ?></p>
<p><b>Product:</b> <?php echo $row['product_name']; ?></p>
<p><b>Quantity:</b> <?php echo $row['quantity']; ?></p>
<p><b>Total:</b> ₱<?php echo number_format($row['total_amount'],2); ?></p>
<p><b>Date:</b> <?php echo $row['order_date']; ?></p>
<p><b>Status:</b> <span class="badge bg-primary"><?php echo $row['status']; ?></span></p>

<h5 class="mt-4">Tracking Progress</h5>
<div class="progress mb-2" style="height:25px">
<div class="progress-bar <?php echo ($row['status']=='Cancelled')?'bg-danger':'bg-success'; ?>" style="width:<?php echo $percent; ?>%"><?php echo $row['status']; ?></div>
</div>
<div class="d-flex justify-content-between"><span>Pending</span><span>Processing</span><span>Shipped</span><span>Out for Delivery</span><span>Delivered</span></div>
<?php if($row['status']=='Cancelled') echo "<div class='alert alert-danger mt-3'>This order was cancelled.</div>"; ?>
</div>
<a href="index.php" class="btn btn-secondary mt-3">Back</a>
</div>
</body>
</html>