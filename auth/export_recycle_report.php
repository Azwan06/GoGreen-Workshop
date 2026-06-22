<?php

include "../config/database.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=recycle_report.xls");

echo "User ID\tWaste Type\tWeight\tPoints\tStatus\tDate\n";

$sql = "
SELECT *
FROM recycle_submissions
ORDER BY created_at DESC
";

$result = mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result))
{
echo
$row['user_id']."\t".
$row['waste_type']."\t".
$row['weight']."\t".
$row['points_earned']."\t".
$row['status']."\t".
$row['created_at']."\n";
}