<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Call Dashnoard - chart
Purpose			: To Create dashboard with cal center module
Author			: Madushan Wikramaarachchi
Date & Time		: 09:25 AM 2018-03-16
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/044";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo $ass;
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Call Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- MetisMenu CSS -->
    <link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="../../../dist/css/realSolution_1.css" rel="stylesheet" />

    <!-- Custom Fonts -->
    <link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    
     <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">


    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- Common function Libariries -->
<!-- CSS-->
<!--<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../ADMIN_DEVELOPMENT/CSS/admin_Style_Sheet.css"/>-->
<!--Javascript-->

<!--Javascript-->

<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../ADMIN_DEVELOPMENT/JAVASCRIPT_FUNCTION/admin_JavaScript.js"></script>
<!--END Common fumction Libariries-->

<script type="text/javascript">
	
</script> 
<style type="text/css">    
    .pg-normal {
        color: black;
        font-weight: normal;
        text-decoration: none;    
        cursor: pointer;    
    }
    .pg-selected {
        color: black;
        font-weight: bold;        
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<script type="text/javascript" src="paging.js"></script>
</head>
<body oncontextmenu="return false">
<form class="form-horizontal" action="" method="post" style="margin-left: 20px;">
<h3>
<?php 
	echo $_REQUEST['DispName'];
?>
</h3>
<hr/>
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                <?php
                                $select_group = "select cc.enrtyby AS CALL_AGENT,
                                                                    GetUserName(cc.enrtyby) AS CALL_AGENT_NAME,
                                                                    count(*),
                                                                    (SELECT COUNT(*) FROM callcenterinquiry ccs WHERE ccs.call_answered = 'YES' AND ccs.call_feedback=1 and DATE(ccs.enryon) = DATE(NOW()) and ccs.enrtyby= cc.enrtyby) AS Verified,
                                                                    (SELECT COUNT(*) FROM callcenterinquiry ccs WHERE ccs.call_answered = 'YES' AND ccs.call_feedback=2 and DATE(ccs.enryon) = DATE(NOW()) and ccs.enrtyby= cc.enrtyby) AS Descrepency,
                                                                    (SELECT COUNT(*) FROM callcenterinquiry ccs WHERE ccs.call_answered = 'NO' and DATE(ccs.enryon) = DATE(NOW()) and ccs.enrtyby= cc.enrtyby) AS NotAnswered
                                                                    FROM callcenterinquiry cc WHERE DATE(cc.enryon) = DATE(NOW())
                                                                    group by cc.enrtyby
                                                                    order by 3 desc;";
                                $quary_group = mysqli_query($conn , $select_group);
                                echo mysqli_num_rows($quary_group);
                            ?>  
                                    </div>
                                    <div> Officer Wise Call Engagement !</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                     <?php
                                $select_group1 = "SELECT FMIS.ENGAGEMENT_STAUS,
                                                    COUNT(*) AS TOTAL,
                                                    if((select count(*) from  cdb_helpdesk c where c.cat_code = 1014 and c.callRecOn is not null and date(c.callRecOn) >= '2018-03-15')>0,COUNT(*)/(select count(*) from  cdb_helpdesk c where c.cat_code = 1014 and c.callRecOn is not null and date(c.callRecOn) >= '2018-03-15'),0) * 100 AS PERC
                                                    FROM(
                                                    SELECT MIS.*,
                                                    IF(MIS.ENGAGED IS NULL , 'NOT ENGAGED' , 'ENGAGED') AS ENGAGEMENT_STAUS
                                                    FROM(
                                                    select c.callRecOn  AS CALL_REQ_Q_ON,
                                                    (select min(cc.enryon) from callcenterinquiry cc where cc.helpid = c.helpid) AS ENGAGED
                                                    from cdb_helpdesk c
                                                    where c.cat_code = 1014 AND c.`cmb_code` = '5002'
                                                    and c.callRecOn is not null
                                                    and date(c.callRecOn) >= '2018-03-15') MIS ) FMIS
                                                    GROUP BY FMIS.ENGAGEMENT_STAUS;";
                                $quary_group1 = mysqli_query($conn , $select_group1);
                                echo mysqli_num_rows($quary_group1);
                            ?>  
                                    </div>
                                    <div>Agent Wise Performance.</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
 
<div class="row" style="font-size: 11px;">
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                For the day Current status - ALL 
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Total</th>
                                <th>CDB</th>
                                <th>UCL</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                $select_group = "SELECT if(cc.call_answered = 'YES',if(cc.call_feedback=1,'Called - Verified','Called - Descrepency'),'Called - Not Answered') AS Status,
                                                        COUNT(*) ,
                                                        (SELECT COUNT(*) FROM callcenterinquiry ccd,cdb_helpdesk WHERE DATE(ccd.enryon) = DATE(NOW()) and ccd.call_answered = cc.call_answered and ccd.call_feedback=cc.call_feedback and ccd.helpid = cdb_helpdesk.helpid and cdb_helpdesk.scat_code_2 not in ('10140108','10140109','10140110')) AS CDB,
                                                        (SELECT COUNT(*) FROM callcenterinquiry ccd,cdb_helpdesk WHERE DATE(ccd.enryon) = DATE(NOW()) and ccd.call_answered = cc.call_answered and ccd.call_feedback=cc.call_feedback and ccd.helpid = cdb_helpdesk.helpid and cdb_helpdesk.scat_code_2  in ('10140108','10140109','10140110')) AS UCL
                                                        FROM callcenterinquiry cc WHERE DATE(cc.enryon) = DATE(NOW())
                                                        group by cc.call_answered,cc.call_feedback
                                                        union
                                                        select 'New Calls' , COUNT(*),(select COUNT(*) from cdb_helpdesk cd where cd.cat_code = 1014 AND cd.`cmb_code` = '5002' and cd.callRecOn is not null and not exists (select 1 from callcenterinquiry cc where cc.helpid = cd.helpid) and cd.scat_code_2 not in ('10140108','10140109','10140110') ) AS CDB,
                                                        (select COUNT(*) from cdb_helpdesk cd where cd.cat_code = 1014 AND cd.`cmb_code` = '5002' and cd.callRecOn is not null and not exists (select 1 from callcenterinquiry cc where cc.helpid = cd.helpid) and cd.scat_code_2  in ('10140108','10140109','10140110') ) AS UCL
                                                        from cdb_helpdesk c
                                                        where c.cat_code = 1014 AND c.`cmb_code` = '5002'
                                                        and c.callRecOn is not null
                                                        and not exists (select 1 from callcenterinquiry cc where cc.helpid = c.helpid)
                                                        ;";
                                $quary_group = mysqli_query($conn , $select_group);
                                $x = 1;
                                while($result_group = mysqli_fetch_array($quary_group)){
                                    echo "<tr title='".$result_group[0]."|".$result_group[1]."' onclick='getdate(title);'>";
                                    echo "<td>".$x."</td>";
                                    echo "<td>".$result_group[0]."</td>";
                                    echo "<td>".$result_group[1]."</td>";
                                    echo "<td>".$result_group[2]."</td>";
                                    echo "<td>".$result_group[3]."</td>";
                                    echo "</tr>";
                                    $x++;
                                }
                            ?>  
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Engagement - For the day Q 
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="myTable3" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ENGAGEMENT STAUS</th>
                                <th>TOTAL</th>
                                <th>PERC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $select_group = "SELECT FMIS.ENGAGEMENT_STAUS,
                                                    COUNT(*) AS TOTAL,
                                                    if((select count(*) from  cdb_helpdesk c where c.cat_code = 1014 and c.callRecOn is not null and date(c.callRecOn) >= '2018-03-15')>0,COUNT(*)/(select count(*) from  cdb_helpdesk c where c.cat_code = 1014 and c.callRecOn is not null and date(c.callRecOn) >= '2018-03-15'),0) * 100 AS PERC
                                                    FROM(
                                                    SELECT MIS.*,
                                                    IF(MIS.ENGAGED IS NULL , 'NOT ENGAGED' , 'ENGAGED') AS ENGAGEMENT_STAUS
                                                    FROM(
                                                    select c.callRecOn  AS CALL_REQ_Q_ON,
                                                    (select min(cc.enryon) from callcenterinquiry cc where cc.helpid = c.helpid) AS ENGAGED
                                                    from cdb_helpdesk c
                                                    where c.cat_code = 1014 AND c.`cmb_code` = '5002'
                                                    and c.callRecOn is not null
                                                    and date(c.callRecOn) >= '2018-03-15') MIS ) FMIS
                                                    GROUP BY FMIS.ENGAGEMENT_STAUS;";
                                $quary_group = mysqli_query($conn , $select_group);
                                $x = 1;
                                while($result_group = mysqli_fetch_array($quary_group)){
                                    echo "<tr title='".$result_group[0]."|".$result_group[1]."' onclick='getdate(title);'>";
                                    echo "<td>".$x."</td>";
                                    echo "<td>".$result_group[0]."</td>";
                                    echo "<td>".$result_group[1]."</td>";
                                    echo "<td>".$result_group[2]."</td>";
                                    echo "</tr>";
                                    $x++;
                                }
                            ?>  
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>
<!-- /.row -->
<!------------------------------------------------------------------------------------------------------------------------------------>
            
           
                <div class="col-md-6">
           
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Engagement - For the day Q 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-pie-chart">
                                     <?php
                                        
                                        $select_group2 = "SELECT FMIS.ENGAGEMENT_STAUS,
                                                            COUNT(*) AS TOTAL,
                                                            if((select count(*) from  cdb_helpdesk c where c.cat_code = 1014 and c.callRecOn is not null and date(c.callRecOn) >= '2018-03-15')>0,COUNT(*)/(select count(*) from  cdb_helpdesk c where c.cat_code = 1014 and c.callRecOn is not null and date(c.callRecOn) >= '2018-03-15'),0) * 100 AS PERC
                                                            FROM(
                                                            SELECT MIS.*,
                                                            IF(MIS.ENGAGED IS NULL , 'NOT ENGAGED' , 'ENGAGED') AS ENGAGEMENT_STAUS
                                                            FROM(
                                                            select c.callRecOn  AS CALL_REQ_Q_ON,
                                                            (select min(cc.enryon) from callcenterinquiry cc where cc.helpid = c.helpid) AS ENGAGED
                                                            from cdb_helpdesk c
                                                            where c.cat_code = 1014 AND c.`cmb_code` = '5002'
                                                            and c.callRecOn is not null
                                                            and date(c.callRecOn) >= '2018-03-15') MIS ) FMIS
                                                            GROUP BY FMIS.ENGAGEMENT_STAUS ORDER BY FMIS.ENGAGEMENT_STAUS;";
                                        $quary_group2 = mysqli_query($conn , $select_group2);
                                        $x = 1;
                                        echo "<script type='text/javascript'>
                                                    $(function() {
                                                     var data = [{";
                                        while($result_group2 = mysqli_fetch_array($quary_group2)){
                                            if( mysqli_num_rows($quary_group2) == 1){
                                                if($result_group2[0] == 'ENGAGED'){
                                                    echo " label: 'ENGAGED',
                                                           data: ".$result_group2[2]."
                                                           }];";
                                                }
                                                if($result_group2[0] == 'NOT ENGAGED'){
                                                    echo " label: 'NOT ENGAGED',
                                                           data: ".$result_group2[2]."
                                                           }];";
                                                }
                                            }
                                            
                                            if( mysqli_num_rows($quary_group2) == 2){
                                                if($result_group2[0] == 'ENGAGED'){
                                                    echo " label: 'ENGAGED',
                                                           data: ".$result_group2[2]."
                                                          }, {";
                                                }
                                                if($result_group2[0] == 'NOT ENGAGED'){
                                                    echo " label: 'NOT ENGAGED',
                                                           data: ".$result_group2[2]."
                                                           }];";
                                                }
                                            }
                                        }
                                        echo "var plotObj = $.plot($('#flot-pie-chart'), data, {
                                                series: {
                                                    pie: {
                                                        show: true
                                                    }
                                                },
                                                grid: {
                                                    hoverable: true
                                                },
                                                tooltip: true,
                                                tooltipOpts: {
                                                    content: '%p.0%, %s', // show percentages, rounding to 2 decimal places
                                                    shifts: {
                                                        x: 20,
                                                        y: 0
                                                    },
                                                    defaultTheme: false
                                                }
                                            });
                                        
                                        });
                                    </script>";
                                    ?>  
                                    
                                           
                                               
                                             
                                        
                                            
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
 </form>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
function getdate(title){
    //alert(title);
    var [m,n]= title.split('|');
    document.getElementById('txtUsergroupNumber').value = [m];
    document.getElementById('txtUsergroupName').value = [n];
}
</script>
<!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Flot Charts JavaScript -->
    <script src="../vendor/flot/excanvas.min.js"></script>
    <script src="../vendor/flot/jquery.flot.js"></script>
    <script src="../vendor/flot/jquery.flot.pie.js"></script>
    <script src="../vendor/flot/jquery.flot.resize.js"></script>
    <script src="../vendor/flot/jquery.flot.time.js"></script>
    <script src="../vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>
    <!--<script src="../data/flot-data.js"></script>-->
</body>
</html>