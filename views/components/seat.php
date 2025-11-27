<?PHP
$seatPlanResult = $conn->query("SELECT * FROM tblseats WHERE fid = $row[id]");

$sql = "SELECT
      ac.id AS id,
      ac.iata AS iata,
      ac.icao AS icao,
      ac.model AS model,
      acs.f_no AS first_class,
      acs.y_no AS business_class,
      acs.c_no AS economy_class,
      acs.f_col AS f_col,
      acs.f_row AS f_row,
      acs.f_no AS f_no,
      acs.f_seatplan AS f_seatplan,
      acs.f_orientation AS f_orientation,
      acs.y_col AS y_col,
      acs.y_row AS y_row,
      acs.y_no AS y_no,
      acs.y_seatplan AS y_seatplan,
      acs.y_orientation AS y_orientation,
      acs.c_col AS c_col,
      acs.c_row AS c_row,
      acs.c_no AS c_no,
      acs.c_seatplan AS c_seatplan,
      acs.c_orientation AS c_orientation
      FROM tblaircraft ac
      JOIN tblaircraftseat acs ON acs.acid = ac.id
      WHERE ac.id = $acid";
$seatLayout = $conn->query($sql)->fetch_assoc();
$seatStatus = $conn->query("SELECT 
                  s.id AS id, 
                  s.fid AS fid, 
                  s.ticket_no AS ticket_no, 
                  s.seat_name AS seat_name, 
                  s.class AS class, 
                  s.status AS status, 
                  s.passenger_name AS passenger_name, 
                  s.contact_agency AS contact_agency, 
                  s.contact_passenger AS contact_passenger,
                  fs.fclass_price AS f_price,
                  fs.cclass_price AS c_price,
                  fs.yclass_price AS y_price,
                  fs.inflation AS inflation,
                  fs.window_fee_percent AS window_fee,
                  fs.aisle_fee_percent AS aisle_fee
                  FROM tblseats s 
                  JOIN tblflightschedule fs ON fs.id = s.fid 
                  WHERE s.fid = $row[id]
                  ")->fetch_all(MYSQLI_ASSOC);

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

<button type="button" class="btn text-success p-2 mx-2 border-success"
        onclick='modalScheduleLayout(<?= json_encode($seatLayout) ?>, <?= json_encode($seatStatus) ?>)'>
  <i class="bi bi-people-fill me-2"></i>Seat Layout
</button>
