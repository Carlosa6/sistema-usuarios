<?php

require_once "assets/php/admin-header.php";
require_once "assets/php/admin-db.php";
$count = new Admin();

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!-- TOTAL USERS -->
            <div class="card bg-primary">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->totalCount("users"); ?>
                    </h1>
                </div>
            </div>
            <!-- VERIFIED USERS -->
            <div class="card bg-warning">
                <div class="card-header">Verified Users</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->verified_users(1); ?>
                    </h1>
                </div>
            </div>
            <!-- UNVERIFIED USERS -->
            <div class="card bg-success">
                <div class="card-header">Unverified Users</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->verified_users(0); ?>
                    </h1>
                </div>
            </div>
            <!-- Website Hits. Cantidad de visitas a la página web -->
            <div class="card bg-danger">
                <div class="card-header">Website Hits</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?php $data = $count->site_hits(); echo $data['hits']; ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!-- TOTAL NOTES -->
            <div class="card bgmorado">
                <div class="card-header">Total Notes</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->totalCount("notes"); ?>
                    </h1>
                </div>
            </div>
            <!-- TOTAL FEEDBACK -->
            <div class="card bgrosa">
                <div class="card-header">Total Feedback</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->totalCount("feedback"); ?>
                    </h1>
                </div>
            </div>
            <!-- TOTAL NOTIFICATIONS -->
            <div class="card bgazulbajo">
                <div class="card-header">Total Notifications</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->totalCount("notification"); ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-deck my-3">
            <!-- Male/Female User's Percentage -->
            <div class="card borderguinda">
                <div class="card-header bgguinda text-center text-white lead">
                    Male/Female User's Percentage
                </div>
                <div id="chartOne" style="width: 99%;height: 400px;"></div>
            </div>
            <!-- Verified/Unverified User's Percentage -->
            <div class="card borderguinda2">
                <div class="card-header bgguinda2 text-center text-white lead">
                    Verified/Unverified User's Percentage
                </div>
                <div id="chartTwo" style="width: 99%;height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER AREA -->
</div>
</div>
</div>

<!-- SCRIPTS JS -->
<?php require_once "assets/php/scripts.php"; ?>

<!--Load the AJAX API - CDN GOOGLE CHARTS -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    ////////////////////// GRÁFICO PASTEL DE CANTIDAD DE USUARIOS SEGÚN SU GÉNERO
    google.charts.load("current",{ packages:["corechart"] });
    google.charts.setOnLoadCallback(pieChart);
    function pieChart(){
        var data = google.visualization.arrayToDataTable([
            ['Gender','Number'],
            <?php
                $gender = $count->genderPer();
                foreach($gender as $row){
                    echo '["'.$row['gender'].'",'.$row['number'].'],';
                }
            ?>
        ]);
        var options = {
            is3D:false
        };
        var chart = new google.visualization.PieChart(document.getElementById('chartOne'));
        chart.draw(data,options);
    }
    //////////////////////////////////////////

    ///////////////////GRÁFICO DE PASTEL DE % DE USUARIOS VERIFICADOS Y NO VERIFICADOS
    google.charts.load("current",{ packages:["corechart"] });
    google.charts.setOnLoadCallback(colChart);
    function colChart(){
        var data = google.visualization.arrayToDataTable([
            ['Verified','Number'],
            <?php
                $verified = $count->verifiedPer();
                foreach ($verified as $row) {
                    if($row['verified'] == 0){
                        $row['verified'] = "Unverified";
                    }else{
                        $row['verified'] = "Verified";
                    }
                    echo '["'.$row['verified'].'",'.$row['number'].'],';
                }
            ?>
        ]);
        var options = {
            pieHole:0.4
        };
        var chart = new google.visualization.PieChart(document.getElementById('chartTwo'));
        chart.draw(data,options);
    }
    ////////////////////////////////////////
</script>
</body>

</html>