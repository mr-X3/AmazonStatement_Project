<?php
// Database Connection
include ('sql/mainSql.php');
$queryPie = "SELECT  
    CONCAT(settlement_start_date,' - ', settlement_end_date) As Date,
    total_amount
FROM settlements
GROUP BY settlement_id";
$result = mysqli_query($conn, $queryPie);
?>  

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart()
    {
        var data = google.visualization.arrayToDataTable([
            ['Date', 'total_amount'],
<?php
while ($row = mysqli_fetch_array($result)) {
    echo "['" . $row["Date"] . "', " . $row["total_amount"] . "],";
}
?>
        ]);
        var options = {
            title: 'total amount fornight',
            hAxis: {title: 'total amount', titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
            //is3D:true,  
            //pieHole: 0.4  
        };
        var chart = new google.visualization.AreaChart(document.getElementById('piechartTotalamountuk'));
        chart.draw(data, options);
    }
</script>



  