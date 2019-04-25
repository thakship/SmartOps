<?php
//.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}


if(isset($_REQUEST['get_ExamYear']) && isset($_REQUEST['get_HRISNumber'])){
    getResalt_view(trim($_REQUEST['get_ExamYear']),trim($_REQUEST['get_HRISNumber']));
}

function getResalt_view($get_ExamYear,$get_HRISNumber){
   $conn = DatabaseConnection();
   $sql_select_r = "SELECT er.c_year , er.hris , er.e_name , er.paper_type , er.grade 
                    FROM exam_results AS er
                    WHERE er.c_year = '".$get_ExamYear."' AND
                          er.hris = '".$get_HRISNumber."';";
   $que_select_r = mysqli_query($conn,$sql_select_r) or die(mysqli_error($conn));
   if(mysqli_num_rows($que_select_r) == 1){
         echo "<table id='myTable' class='table table-striped table-bordered table-hover'>
         <tbody>";
           while($rec_select_r = mysqli_fetch_array($que_select_r)){
                echo "<tr>
                    <td class='col-lg-2'>Year </td>
                    <td>: ".$rec_select_r[0]."</td>
                </tr>
                <tr>
                    <td class='col-lg-2'>HRIS Number </td>
                    <td>: ".$rec_select_r[1]."</td>
                </tr>
                <tr>
                    <td class='col-lg-2'>Name </td>
                    <td>: ".$rec_select_r[2]."</td>
                </tr>
                <tr>
                    <td class='col-lg-2'>Paper Type </td>
                    <td>: ".$rec_select_r[3]."</td>
                </tr>
                <tr>
                    <td class='col-lg-2'>Grade </td>
                    <td>: ".$rec_select_r[4]."</td>
                </tr>";
           }
           echo "</tbody>
                 </table>";
           echo "<table id='myTable' class='table table-striped table-bordered table-hover'>
                        <thead>
                            <tr>
                                <th>Paper Type B</th>
                                <th>Paper Type A</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>75 and Above : A</td>
                                <td>70 and Above : A</td>
                            </tr>
                            <tr>
                                <td>60-74 : B</td>
                                <td>55-69 : B</td>
                            </tr>
                             <tr>
                                <td>50-59 : C</td>
                                <td>45-54 : C</td>
                            </tr>
                           
                            <tr>
                                <td>40-49 : W</td>
                                <td>35-44 : W</td>
                            </tr>
                            <tr>
                                <td>Below 40 : F</td>
                                <td>Below 35 : F</td>
                            </tr>
                        </tbody>
                        ";
     }else{
        echo "<label style='color: #970000; font-weight: bold;'>Results Not Found.</label>";
     }
  
   
}
?>
       