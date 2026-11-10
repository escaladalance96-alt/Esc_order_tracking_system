<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Track Order</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
<h3>Track Your Order</h3>
<form class="card p-4" method="GET">
<label>Enter Tracking Number (e.g. ORD-1001)</label>
<div class="input-group mt-2">
<input name="tracking" class="form-control" placeholder="ORD-xxxx" required>
<button class="btn btn-primary">Track</button>
</div>
</form>

<?php
if(isset($_GET['tracking'])){
  $t = $conn->real_escape_string($_GET['tracking']);
  $r = $conn->query("SELECT * FROM orders WHERE tracking_number='$t'");
  $found = $r->fetch_assoc();
  if(!$found){
    echo "<div class='alert alert-danger mt-3'>No order found for that tracking number.</div>";
  } else {
    echo "<div class='card p-4 mt-3'>";
    echo "<h5>".$found['tracking_number']." - ".$found['product_name']."</h5>";
    echo "<p>Customer: ".$found['customer_name']." | Status: <b>".$found['status']."</b> | Total: ₱".number_format($found['total_amount'],2)."</p>";
    echo "<a href='view.php?id=".$found['id']."' class='btn btn-info'>View Full Tracking</a>";
    echo "</div>";
  }
}
?>
<a href="index.php" class="btn btn-secondary mt-3">Back to All Orders</a>
</div>
</body>
</html>