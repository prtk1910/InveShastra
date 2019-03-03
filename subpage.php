<!doctype html>
<html lang="en">
<?
require 'connection.php';
require 'functions.php';
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pythrons - FinanceShastra</title>    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
             <nav class="navbar navbar-expand-lg bg-white fixed-top">
                 <a class="navbar-brand" href="searchpage.php">Pythrons</a>
                 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                 </button>
                 <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ml-auto navbar-right-top">
                         <li class="nav-item">
                             <div id="custom-search" class="top-search-bar">
                                 <input class="form-control" type="text" placeholder="Search..">
                             </div>
                         </li>



                     </ul>
                 </div>
             </nav>
         </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
              <div class="menu-list">
                  <nav class="navbar navbar-expand-lg navbar-light">
                      <a class="d-xl-none d-lg-none" href="page.php">Dashboard</a>
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarNav">
                          <ul class="navbar-nav flex-column">
                              <li class="nav-divider">
                                  Menu
                              </li>
                              <li class="nav-item ">
                                  <a class="nav-link active" href="searchpage.php" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fas fa-fw fa-chart-pie"></i>Search<span class="badge badge-success">6</span></a>
                                  <div id="submenu-1" class="collapse submenu" style="">
                                      <ul class="nav flex-column">
                                          <li class="nav-item">
                                              <a class="nav-link" href="subpage.php">Subscriptions<span class="badge badge-secondary">Subscriptions</span></a>
                                          </li>

                                      </ul>
                                  </div>

                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>Dashboards</a>
                                  <div id="submenu-2" class="collapse submenu" style="">
                                      <ul class="nav flex-column">
                                          <li class="nav-item">
                                              <a class="nav-link" href="visualizations.php">Visualizations<span class="badge badge-secondary">Visualizations</span></a>
                                          </li>

                                      </ul>
                                      <ul class="nav flex-column">
                                          <li class="nav-item">
                                              <a class="nav-link" href="substocks.php">Subscribed Stocks<span class="badge badge-secondary">Subscribed Stocks</span></a>
                                          </li>

                                      </ul>
                                  </div>
                              </li>

                              <li class="nav-item">
                                  <a class="nav-link" href="map.php" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-table"></i>Kibana</a>
                                      <div id="submenu-5" class="collapse submenu" style="">
                                          <ul class="nav flex-column">
                                              <li class="nav-item">
                                                  <a class="nav-link" href="kibana.php">Kibana<span class="badge badge-secondary">Kibana/</span></a>
                                              </li>




                                          </ul>
                                      </div>
                              </li>

                              <li class="nav-item">
                                  <a class="nav-link" href="testhousing.php" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-fw fa-file"></i>Housing</a>
                                      <div id="submenu-4" class="collapse submenu" style="">
                                          <ul class="nav flex-column">
                                              <li class="nav-item">
                                                  <a class="nav-link" href="testhousing.php">Search Listings<span class="badge badge-secondary">Search Listings</span></a>
                                              </li>



                                          </ul>
                                      </div>
                              </li>

                          </ul>
                      </div>
                  </nav>
              </div>
          </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                  <?php
                    if(isset($_GET["name"])) {

                      $sym=$_GET["name"];
                      $sql2="select symbol from stock where symbol like '%" . $sym . "%'";
                      $check=$con->query($sql2);

                      $num =$check->num_rows;

                      if($num==0) {
                        $res=callOverview($sym);
                        if($res != "Unknown symbol"){
                          $resarr=json_decode($res,true);

                          $symbol=$resarr["symbol"];
                          $companyName=$resarr["companyName"];
                          $open=$resarr["open"];
                          $close=$resarr["close"];
                          $latestPrice=$resarr["latestPrice"];
                          $changePercent=$resarr["changePercent"];
                          $avgTotalVolume=$resarr["avgTotalVolume"];
                          $latestTime=$resarr["latestTime"];

                          $sql="insert into stock(symbol, companyName, open, close, latestPrice, changePercent, avgTotalVolume, latestTime)
                          values('$symbol','$companyName',$open,$close,$latestPrice,$changePercent,$avgTotalVolume,'$latestTime')";

                          $res=  $con->query($sql);
                          //var_dump($res);

                          $res2=callHistorical($sym);
                          $res2arr=json_decode($res2,true);
                          foreach ($res2arr as $r) {
                          //$symbol
                          //$companyName;
                            $date=$r["date"];
                            $open=$r["open"];
                            $close=$r["close"];
                            $high=$r["high"];
                            $low=$r["low"];
                            $volume=$r["volume"];
                            $changePercent=$r["changePercent"];
                            $sql="insert into stockhistory(symbol,companyName,date,open,close,high,low,volume,changePercent) values('$symbol','$companyName','$date',$open,$close,$high,$low,$volume,$changePercent)";
                            $res=$con->query($sql);
                          }
                        }
                        else {
                          echo "Wrong name entered.";
                        }
                      }
                    }
                    $sql3="select * from substock";
                    $sql3res=$con->query($sql3);

                  ?>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                      <h2>Stocks</h2>
                        <div align="right">
                      <?php
                        $qq3="select bal from currentbalance";
                        $resqq3=$con->query($qq3);
                        $resarrqq3=$resqq3->fetch_assoc();
                        $bal=$resarrqq3["bal"];
                        echo "<h3>Balance: " . $bal . "</h3>";
                      ?>
                        </div>
                  </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                          <!---table start-->
                          <div class="card">
                              <h5 class="card-header">Your Shares</h5>
                              <div class="card-body">
                                  <table class="table table-hover">
                                      <thead>
                                          <tr>
                                              <th scope="col">#</th>
                                              <th scope="col">Symbol</th>
                                              <th scope="col">Company Name</th>
                                              <th scope="col">Open</th>
                                              <th scope="col">Close</th>
                                              <th scope="col">Latest Price</th>
                                              <th scope="col">Change Percent</th>
                                              <th scope="col">Average Total Volume</th>
                                              <th scope="col">Latest Time</th>
                                              <th scope="col">Quantity</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                        $arrlist=array();
                                        if ($sql3res->num_rows > 0) {
                                          // output data of each row
                                          while($row = $sql3res->fetch_assoc()) {
                                            echo "
                                            <tr>
                                                <th scope='row'> ". $row["id"]  ."</th>
                                                <td>" . $row["symbol"] . "</td>
                                                <td>". $row["companyName"] ."</td>
                                                <td>". $row["open"] ."</td>
                                                <td>". $row["close"] ."</td>
                                                <td>" . $row["latestPrice"] . "</td>
                                                <td>". $row["changePercent"] ."</td>
                                                <td>". $row["avgTotalVolume"] ."</td>
                                                <td>".$row["latestTime"] ."</td>
                                                <td>".$row["quantity"] ."</td>
                                            </tr> ";
                                            array_push($arrlist,$row["symbol"]);
                                          }
                                        } else {
                                            echo "0 results";
                                        }
                                         ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <!--table end-->
                          <!--<form name="enterstock" method="get">
                            <input type="text" name="name"</input>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>-->
                          <?php
                            $keeparr=array();
                            $sellarr=array();
                           foreach ($arrlist as $value) {
                             $query="select * from stockhistory where symbol like '$value'";
                             $res=$con->query($query);
                             if ($res->num_rows > 0) {
                               // output data of each row
                               $change=0;
                               while($row = $res->fetch_assoc()) {
                                 $change+=$row["changePercent"];
                               }
                               //echo $change . "<br>";
                               if($change>=0) {
                                 array_push($keeparr,array($value,$change));

                               }
                               else {
                                 array_push($sellarr,array($value,$change));

                               }
                             }
                            }
                          ?>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                          <div class="card-header">
                              Expected Rises over 30 days
                              <img src="https://image.flaticon.com/icons/svg/248/248515.svg" width='15px' height='15px' align=right>
                          </div>
                            <div class="card-body">
                                          <table class="table">
                                              <thead>
                                                  <tr>

                                                      <th scope="col">Name</th>
                                                      <th scope="col">Current Price</th>
                                                      <th scope="col">Expected Price</th>
                                                      <th scope="col">Percent Change</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php
                                                  foreach ($keeparr as $value) {
                                                    echo "<tr>";
                                                    echo "<td>" . $value[0] . "</td>";
                                                    $a="select latestPrice from substock where symbol like '%$value[0]%'";
                                                    $res=$con->query($a);
                                                    $arres=$res->fetch_assoc();
                                                    $currprice=$arres["latestPrice"];
                                                    echo "<td>$" . $currprice . "</td>";
                                                    $percent=$value[1]/100;
                                                    $expprice=$currprice+($currprice*$percent);
                                                    echo "<td>$" . $expprice . "</td>";
                                                    echo "<td>" . $value[1] . "%</td>";
                                                    echo "</tr>";
                                                  }
                                                  ?>
                                              </tbody>
                                          </table>
                            </div>
                            <div class="card-footer d-flex text-muted">
                                Card Footer
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                Expected falls over 30 days
                                <img src="https://image.flaticon.com/icons/svg/248/248607.svg" width='15px' height='15px' align=right>
                            </div>
                            <div class="card-body">
                              <table class="table">
                                  <thead>
                                      <tr>

                                          <th scope="col">Name</th>
                                          <th scope="col">Current Price</th>
                                          <th scope="col">Expected Price</th>
                                          <th scope="col">Percent Change</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      foreach ($sellarr as $value) {
                                        echo "<tr>";
                                        echo "<td>" . $value[0] . "</td>";
                                        $a="select latestPrice from substock where symbol like '%$value[0]%'";
                                        $res=$con->query($a);
                                        $arres=$res->fetch_assoc();
                                        $currprice=$arres["latestPrice"];
                                        echo "<td>$" . $currprice . "</td>";
                                        $percent=$value[1]/100;
                                        $expprice=$currprice+($currprice*$percent);
                                        echo "<td>$" . $expprice . "</td>";
                                        echo "<td>" . $value[1] . "%</td>";
                                        echo "</tr>";
                                      }
                                      ?>
                                  </tbody>
                              </table>
                            </div>
                            <div class="card-footer d-flex text-muted">
                                Card Footer
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                              Ownership
                            </div>
                            <div class="card-body">
                              <?php
                                $q="select companyName,quantity,latestPrice from substock";
                                $res=$con->query($q);
                              ?>
                              <script type="text/javascript">
                                google.charts.load('current', {'packages':['corechart']});
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() {

                                  var data = google.visualization.arrayToDataTable([
                                    ['Company', 'Amount'],
                                    <?php
                                    if ($res->num_rows > 0) {
                                        // output data of each row
                                        while($row = $res->fetch_assoc()) {
                                            $companyName=$row["companyName"];
                                            $quantity=$row["quantity"];
                                            $latestPrice=$row["latestPrice"];
                                            $total=$quantity*$latestPrice;
                                            echo "['$companyName',$total],
                                            ";
                                        }
                                    }
                                    ?>
                                  ]);

                                  var options = {
                                    title: 'Ownership',
                                    colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
                                  };

                                  var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                                  chart.draw(data, options);
                                }
                            </script>
                              <?php

                              ?>
                              <div id="piechart" style="height: 300px;"></div>
                            </div>
                            <div class="card-footer d-flex text-muted">
                                Card Footer
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                Portfolio Value
                            </div>
                            <div class="card-body">
                              <?php

                                $q="select id,value from portfoliovalue";
                                $res4=$con->query($q);

                               ?>
                              <script type="text/javascript">
                                google.charts.load('current', {'packages':['corechart']});
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() {
                                  var data = google.visualization.arrayToDataTable([
                                    ['Date', 'Value'],
                                    <?php

                                    if ($res4->num_rows > 0) {
                                        // output data of each row
                                        while($row = $res4->fetch_assoc()) {
                                            $id=$row["id"];
                                            $value=$row["value"];
                                            echo "['$id',$value],
                                            ";
                                        }
                                    }

                                     ?>
                                  ]);

                                  var options = {
                                    title: 'Portfolio Value',
                                    legend: { position: 'bottom' }
                                  };

                                  var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                                  chart.draw(data, options);
                                }
                              </script>
                              <div id="curve_chart" style="height: 300px"></div>
                            </div>
                            <div class="card-footer d-flex text-muted">
                                Card Footer
                            </div>
                        </div>
                    </div>

                    <br>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            Copyright © 2019
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end main wrapper -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
</body>

</html>
