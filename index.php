<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Esclada Order Tracking System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
<h2>📦 Esclada Order Tracking System</h2>
<a href="add.php" class="btn btn-success mb-3">+ Add New Order</a>
<a href="track.php" class="btn btn-primary mb-3">Track Order</a>

<table class="table table-bordered table-striped">
<tr>
<th>Tracking #</th>
<th>Customer</th>
<th>Product</th>
<th>Qty</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM orders ORDER BY id DESC");
while($row = $result->fetch_assoc()){
echo "<tr>";
echo "<td><b>".$row['tracking_number']."</b></td>";
echo "<td>".$row['customer_name']."</td>";
echo "<td>".$row['product_name']."</td>";
echo "<td>".$row['quantity']."</td>";
echo "<td>₱".number_format($row['total_amount'],2)."</td>";
echo "<td>".$row['status']."</td>";
echo "<td>".$row['order_date']."</td>";
echo "<td><a href='view.php?id=".$row['id']."' class='btn btn-sm btn-info'>View</a> ";
echo "<a href='edit.php?id=".$row['id']."' class='btn btn-sm btn-warning'>Edit</a> ";
echo "<a href='delete.php?id=".$row['id']."' onclick=\"return confirm('Delete?')\" class='btn btn-sm btn-danger'>Delete</a></td>";
echo "</tr>";
}
?>
</table>
</div>
</body>
</html>
