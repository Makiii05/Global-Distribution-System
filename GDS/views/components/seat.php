<?PHP
$seatPlanResult = $conn->query("SELECT * FROM tblseats WHERE fid = $row[id]");

$seatPlan = [];
while ($seat = $seatPlanResult->fetch_assoc()) {
    $seatPlan[] = $seat;
}
?>

<button type="button" class="btn text-success p-2 mx-2 border-success"
        onclick='modalSeat(<?= json_encode($row) ?>, "price")'>
  <i class="bi bi-currency-dollar me-2"></i>View Price
</button>

<button type="button" class="btn text-success p-2 mx-2 border-success"
        onclick='modalSeat(<?= json_encode($seatPlan) ?>, "status")'>
  <i class="bi bi-people-fill me-2"></i>Seat Status
</button>
