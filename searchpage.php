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
    <title>Pythrons - FinanceShastra</title>
    <!-- Bootstrap CSS -->
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
                    $sql3="select * from stock";
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

                          <form name="enterstock" method="get" class="form-group">
                            <input class="form-control" type="text" name="name"</input><br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form><br>
                      <?php
                      if(isset($_GET["name"])) {
                        $sql="select * from stock where symbol like '$sym'";
                        $res=$con->query($sql);
                        $res=$res->fetch_assoc();
                        echo "<h2>Details</h2><br>";
                        echo "
                        <div class='card'>
                            <div class='card-body'>
                                <h1 class='card-title'>". $res["companyName"] ."</h1>
                                <h4 class='card-subtitle mb-2 text-muted'>" . $res["symbol"] . "</h4><br>
                                <h3><b>Open: </b>INR ". $res["open"] . " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b>Close: </b>INR ". $res["close"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b>Latest Price: </b>INR ". $res["latestPrice"] . "</h3>
                                <h3><b>Change Percent: </b>". $res["changePercent"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b>Average Total Volume: </b>". $res["avgTotalVolume"] . "</h3>
                                <h3><b>Latest Date: </b>". $res["latestTime"] . "</h3>
                            </div>
                        </div>";

                        ?>
                        <?php
                        if(isset($_GET["name"])) {
                          $symbol=$_GET["name"];
                          $q="select date,high,low from stockhistory where symbol like '$symbol'";
                          $res4=$con->query($q);
                        }
                         ?>
                        <script type="text/javascript">
                          google.charts.load('current', {'packages':['corechart']});
                          google.charts.setOnLoadCallback(drawChart);

                          function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                              ['Date', 'High', 'Low'],
                              <?php

                              if ($res4->num_rows > 0) {
                                  // output data of each row
                                  while($row = $res4->fetch_assoc()) {
                                      $date=$row["date"];
                                      $high=$row["high"];
                                      $low=$row["low"];
                                      echo "['$date',$high,$low],
                                      ";
                                  }
                              }

                               ?>
                            ]);

                            var options = {
                              title: 'Company Performance',
                              legend: { position: 'bottom' }
                            };

                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                            chart.draw(data, options);
                          }
                        </script>
                        <div id="curve_chart" style="height: 500px"></div>
                        <br><h3>Add to your Portfolio:</h3>
                      <form name="addtosub" class="form-group" method="get">
                        <input type="number" class="form-control" name="quantity"><br>
                        <button type="submit" class="btn btn-primary">Add</button>
                        <input type="hidden" name="name" value="<?php echo $sym;?>">
                      </form>
                    <?php
                    }
                    if(isset($_GET["quantity"])) {

                      $quantity=$_GET["quantity"];
                      $symbol=$res["symbol"];
                      $sql2="select symbol from substock where symbol like '%" . $symbol . "%'";
                      $check=$con->query($sql2);

                      $num =$check->num_rows;

                      if($num==0) {
                        $companyName=$res["companyName"];
                        $open=$res["open"];
                        $close=$res["close"];
                        $latestPrice=$res["latestPrice"];
                        $changePercent=$res["changePercent"];
                        $avgTotalVolume=$res["avgTotalVolume"];
                        $latestTime=$res["latestTime"];
                        $sql="insert into substock(symbol, companyName, open, close, latestPrice, changePercent, avgTotalVolume, latestTime,quantity)
                        values('$symbol','$companyName',$open,$close,$latestPrice,$changePercent,$avgTotalVolume,'$latestTime',$quantity)";
                        $res=  $con->query($sql);
                        $qq3="select bal from currentbalance";
                        $resqq3=$con->query($qq3);
                        $resarrqq3=$resqq3->fetch_assoc();
                        $bal=$resarrqq3["bal"];
                        $bal=$bal-($latestPrice*$quantity);
                        $qq3="update currentbalance set bal=$bal";
                        $con->query($qq3);
                        echo "<br>Added. <a href='subpage.php'>Go to list</a></br>";

                        $qq="select latestPrice,quantity from substock";
                        $qqres=$con->query($qq);
                        $sum=0;
                        if ($qqres->num_rows > 0) {
                          // output data of each row
                          while($row = $qqres->fetch_assoc()) {
                            $sum=$sum+($row["latestPrice"]*$row["quantity"]);

                          }
                            $qq2="insert into portfoliovalue(value) values($sum)";
                            $con->query($qq2);
                        }

                      }
                      else {
                        echo "<br>Already Added."; ?>
                        <script type="text/javascript">
                          window.location= "subpage.php";
                        </script>
                        <?php
                      }
                    }




                    $string = "";
                    if(isset($_GET["name"])) {
                      $keyword=$_GET["name"];
                      $keywordurl=str_replace(" ","+",$keyword);
                      $json =file_get_contents("https://newsapi.org/v2/everything?q=" . $keywordurl . "&apiKey=1716bcf695204650a77b6b2bb9232c1c");
                      $news = json_decode($json, true);



                      foreach ($news["articles"] as $i => $article) {

                        echo "<br>
                        <div class='card'>
                            <div class='card-header'>
                                " . $article["title"]  . " - " . $article["publishedAt"] ."
                            </div>
                            <div class='card-body'>
                                <blockquote class='blockquote mb-0'>
                                    <img height='100px' src=". $article['urlToImage'] .">
                                    <p>"  . $article["description"] .  "</p>

                                    <footer class='blockquote-footer'>

                                        <a href=" . $article['url'] . ">Read More</a>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>";

                        }
                  }


                  ?>

                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
