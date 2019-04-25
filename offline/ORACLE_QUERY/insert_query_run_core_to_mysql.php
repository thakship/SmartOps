<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'Off');

$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = cmbproda-scan.cdb.lk)(PORT = 1521))(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = cdbprod)))";
$dbConn = oci_connect('cdberp','cdberp',$dbstr1); 

date_default_timezone_set("Asia/Calcutta");

echo date("Y/m/d H:i:s")."<br/></br/>";

if(!$dbConn){
	//$err = OCIError();
	$err = ocierror();
	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
 	echo "Connection failed.".$err['message'];
	exit;
}else {
	//print "Connected to Oracle!";
	echo "Successfully connected to Oracle.<br/><br/>";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$conn = mysqli_connect("localhost","root","1234","cdberp");
// Check connection
if (mysqli_connect_errno($conn)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
    echo "Successfully connected to Mysql.<br/><br/>";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$stid = oci_parse($dbConn, "
select 'truncate table cdbZonePerformanceBrn;' from dual
union all
select smis.cdbZonePerformanceBrn from (
select co.brn_code , decode(co.zzone, 'ZONE 1' , 'ZONE 01',
                        'ZONE 2' , 'ZONE 02',
                        'ZONE 3' , 'ZONE 03',
                        'ZONE 4' , 'ZONE 04',
                        'ZONE 5' , 'ZONE 05',
                        'ZONE 6' , 'ZONE 06',
                        'ZONE 7' , 'ZONE 07',
                        'ZONE 8' , 'ZONE 08',
                        'ZONE 9' , 'ZONE 09',co.zzone) as zz,
       sum(co.rt_into_inflow_act) /sum(co.inflow) , max(co.run_dt),
       'insert into cdbZonePerformanceBrn (branchNumber,CDBZONE,LENDING_INFLOW,LENDING_WAVG,LASTUPDATE) VALUES (' || co.brn_code || ',' || CHR(39) || decode(co.zzone, 'ZONE 1' , 'ZONE 01',
                        'ZONE 2' , 'ZONE 02',
                        'ZONE 3' , 'ZONE 03',
                        'ZONE 4' , 'ZONE 04',
                        'ZONE 5' , 'ZONE 05',
                        'ZONE 6' , 'ZONE 06',
                        'ZONE 7' , 'ZONE 07',
                        'ZONE 8' , 'ZONE 08',
                        'ZONE 9' , 'ZONE 09',co.zzone) || ''',' || round(sum(co.inflow),2) || ',' || round(sum(co.rt_into_inflow_act) /sum(co.inflow),2) || ',' || chr(39) || max(co.run_dt) || chr(39) || ');' AS cdbZonePerformanceBrn
from cdbproddb.cdb_wager_online co
where co.kkey IN ('LI')
 and co.brn_name not in ('PERSONAL LOAN UNIT-HO' , 'PATPAT_UNIT')
 and co.zzone is not null
 and co.trn_date >= (to_date(cdbproddb.fn_get_currbuss_date(1,'LKR')) - extract( day from to_date(cdbproddb.fn_get_currbuss_date(1,'LKR'))) + 1) 
 and co.trn_date <= to_date(cdbproddb.fn_get_currbuss_date(1,'LKR'))
group by co.brn_code,co.zzone
union 
select co.brn_code ,'PSNLLOAN', sum(co.rt_into_inflow_act) /sum(co.inflow) , max(co.run_dt),
       'insert into cdbZonePerformanceBrn (branchNumber,CDBZONE,LENDING_INFLOW,LENDING_WAVG,LASTUPDATE) VALUES (' || co.brn_code || ',' || CHR(39) || 'PSNLLOAN' || ''',' || round(sum(co.inflow),2) || ',' || round(sum(co.rt_into_inflow_act) /sum(co.inflow),2) || ',' || chr(39) || max(co.run_dt) || chr(39) || ');'
from cdbproddb.cdb_wager_online co
where co.kkey IN ('LI')
 and co.brn_name = 'PERSONAL LOAN UNIT-HO'
 and co.trn_date >= (to_date(cdbproddb.fn_get_currbuss_date(1,'LKR')) - extract( day from to_date(cdbproddb.fn_get_currbuss_date(1,'LKR'))) + 1) 
 and co.trn_date <= to_date(cdbproddb.fn_get_currbuss_date(1,'LKR')) 
 group by co.brn_code, co.brn_name
union 
select co.brn_code, 'PATPAT', sum(co.rt_into_inflow_act) /sum(co.inflow) , max(co.run_dt),
       'insert into cdbZonePerformanceBrn (branchNumber,CDBZONE,LENDING_INFLOW,LENDING_WAVG,LASTUPDATE) VALUES (''' || co.brn_code || ',' || CHR(39) || 'PATPAT' || ''',' || round(sum(co.inflow),2) || ',' || round(sum(co.rt_into_inflow_act) /sum(co.inflow),2) || ',' || chr(39) || max(co.run_dt) || chr(39) || ');'       
from cdbproddb.cdb_wager_online co
where co.kkey IN ('LI')
 and co.brn_name = 'PATPAT_UNIT'
 and co.trn_date >= (to_date(cdbproddb.fn_get_currbuss_date(1,'LKR')) - extract( day from to_date(cdbproddb.fn_get_currbuss_date(1,'LKR'))) + 1) 
 and co.trn_date <= to_date(cdbproddb.fn_get_currbuss_date(1,'LKR')) 
 group by co.brn_code, co.brn_name)  smis
union all 
select 'truncate table cdbZonePerformance;' from dual
union all
select smis.cdbZonePerformance from (
select decode(co.zzone, 'ZONE 1' , 'ZONE 01',
                        'ZONE 2' , 'ZONE 02',
                        'ZONE 3' , 'ZONE 03',
                        'ZONE 4' , 'ZONE 04',
                        'ZONE 5' , 'ZONE 05',
                        'ZONE 6' , 'ZONE 06',
                        'ZONE 7' , 'ZONE 07',
                        'ZONE 8' , 'ZONE 08',
                        'ZONE 9' , 'ZONE 09',co.zzone) as zz,
       sum(co.rt_into_inflow_act) /sum(co.inflow) , max(co.run_dt),
       'insert into cdbZonePerformance (CDBZONE,LENDING_INFLOW,LENDING_WAVG,LASTUPDATE) VALUES (''' || decode(co.zzone, 'ZONE 1' , 'ZONE 01',
                        'ZONE 2' , 'ZONE 02',
                        'ZONE 3' , 'ZONE 03',
                        'ZONE 4' , 'ZONE 04',
                        'ZONE 5' , 'ZONE 05',
                        'ZONE 6' , 'ZONE 06',
                        'ZONE 7' , 'ZONE 07',
                        'ZONE 8' , 'ZONE 08',
                        'ZONE 9' , 'ZONE 09',co.zzone) || ''',' || round(sum(co.inflow),2) || ',' || round(sum(co.rt_into_inflow_act) /sum(co.inflow),2) || ',' || chr(39) || max(co.run_dt) || chr(39) || ');' AS cdbZonePerformance
from cdbproddb.cdb_wager_online co
where co.kkey IN ('LI')
 and co.brn_name not in ('PERSONAL LOAN UNIT-HO' , 'PATPAT_UNIT')
 and co.zzone is not null
 and co.trn_date >= (to_date(cdbproddb.fn_get_currbuss_date(1,'LKR')) - extract( day from to_date(cdbproddb.fn_get_currbuss_date(1,'LKR'))) + 1) 
 and co.trn_date <= to_date(cdbproddb.fn_get_currbuss_date(1,'LKR'))
group by co.zzone
union 
select 'PSNLLOAN', sum(co.rt_into_inflow_act) /sum(co.inflow) , max(co.run_dt),
       'insert into cdbZonePerformance (CDBZONE,LENDING_INFLOW,LENDING_WAVG,LASTUPDATE) VALUES (''' || 'PSNLLOAN' || ''',' || round(sum(co.inflow),2) || ',' || round(sum(co.rt_into_inflow_act) /sum(co.inflow),2) || ',' || chr(39) || max(co.run_dt) || chr(39) || ');'
from cdbproddb.cdb_wager_online co
where co.kkey IN ('LI')
 and co.brn_name = 'PERSONAL LOAN UNIT-HO'
 and co.trn_date >= (to_date(cdbproddb.fn_get_currbuss_date(1,'LKR')) - extract( day from to_date(cdbproddb.fn_get_currbuss_date(1,'LKR'))) + 1) 
 and co.trn_date <= to_date(cdbproddb.fn_get_currbuss_date(1,'LKR')) 
 group by co.brn_name
union 
select 'PATPAT', sum(co.rt_into_inflow_act) /sum(co.inflow) , max(co.run_dt),
       'insert into cdbZonePerformance (CDBZONE,LENDING_INFLOW,LENDING_WAVG,LASTUPDATE) VALUES (''' || 'PATPAT' || ''',' || round(sum(co.inflow),2) || ',' || round(sum(co.rt_into_inflow_act) /sum(co.inflow),2) || ',' || chr(39) || max(co.run_dt) || chr(39) || ');'       
from cdbproddb.cdb_wager_online co
where co.kkey IN ('LI')
 and co.brn_name = 'PATPAT_UNIT'
 and co.trn_date >= (to_date(cdbproddb.fn_get_currbuss_date(1,'LKR')) - extract( day from to_date(cdbproddb.fn_get_currbuss_date(1,'LKR'))) + 1) 
 and co.trn_date <= to_date(cdbproddb.fn_get_currbuss_date(1,'LKR')) 
 group by co.brn_name)  smis
union all
select 'truncate table emp_coll_mon;' from dual
union all
SELECT 'INSERT INTO emp_coll_mon VALUES('|| CHR(39) || nvl(SCRIPT.HRIS,TO_CHAR(ROWNUM)) || CHR(39) || ','||SCRIPT.NUM_FILES||','|| SCRIPT.COL_RAT ||',' || CHR(39) || SCRIPT.OFF_JOIN_DATE || CHR(39) || ',' || CHR(39) || SCRIPT.OFF_STATUS || CHR(39) || ','|| CHR(39) || SCRIPT.LSTUPD || CHR(39) || ',0,' || CHR(39) || SCRIPT.MEMP_DESIG_CODE || CHR(39) ||',' || CHR(39) || SCRIPT.DESIG_DESCN || CHR(39) || ');' FROM (
SELECT 
       MIS.RECOVERY_OFFICER AS HRIS,
       SUM(MIS.NUM_FILES) AS NUM_FILES,
       decode(NVL(SUM(MIS.DUE),0),0,0,ROUND(SUM(MIS.COLLECTION)/SUM(MIS.DUE) * 100,2) ) AS COL_RAT,
       (select to_char(CDBPRODDB.memp.memp_date_of_joining_bk,'YYYY-MM-DD') from CDBPRODDB.memp where CDBPRODDB.memp.memp_num = MIS.RECOVERY_OFFICER) as OFF_JOIN_DATE,       
       (select decode(CDBPRODDB.users.user_susp_rel_flag,'S','SUSPENDED','R','RESIGNED','T','TERMINATED','ACTIVE') from CDBPRODDB.users where CDBPRODDB.users.user_id = MIS.RECOVERY_OFFICER) as OFF_STATUS,
       to_char(SYSDATE,'YYYY-MM-DD hh:mi:ss') AS LSTUPD,
       (select CDBPRODDB.memp.MEMP_DESIG_CODE  from CDBPRODDB.memp where CDBPRODDB.memp.MEMP_NUM = MIS.RECOVERY_OFFICER) as MEMP_DESIG_CODE,       
       (select CDBPRODDB.DESIGNATIONS.DESIG_DESCN  from CDBPRODDB.memp,CDBPRODDB.DESIGNATIONS where CDBPRODDB.memp.MEMP_NUM = MIS.RECOVERY_OFFICER AND CDBPRODDB.DESIGNATIONS.DESIG_CODE = CDBPRODDB.memp.MEMP_DESIG_CODE) as DESIG_DESCN              
 FROM(
select mysum.RECOVERY_OFFICER,
       COUNT(*) AS NUM_FILES,
       SUM(mysum.DUE_FOR_THE_MONTH) AS DUE,
       SUM(mysum.TOTAL_PAID) AS COLLECTION 
from (
select (select
       (select nvl(sum(lp.lerepay_total_amt),0) from CDBPRODDB.lserepay lp where lp.lerepay_entity_num = 1 and lp.lerepay_internal_acnum = ac.acnts_internal_acnum and lp.lerepay_repay_slno <= 12 AND lp.lerepay_repay_date <= mn.mn_curr_business_date and (ac.acnts_closure_date is null or ac.acnts_closure_date >= lp.lerepay_repay_date) ) 
       +
       (select nvl(sum(lph.lerepay_total_amt),0) from CDBPRODDB.lserepayhist lph where lph.lerepay_entity_num = 1 and lph.lerepay_internal_acnum = ac.acnts_internal_acnum and lph.lerepay_repay_slno <= 12 AND lph.lerepay_repay_date <= mn.mn_curr_business_date and (ac.acnts_closure_date is null or ac.acnts_closure_date >= lph.lerepay_repay_date) ) 
       from dual) as DUE_FOR_THE_MONTH,
       (select (SELECT nvl(SUM(lrp.lerepay_princ_amt_paid + lrp.lerepay_int_amt_paid + lrp.lerepay_service_tax_amt_paid + lrp.lerepay_vat_amt_paid + lrp.lerepay_chg_amt_paid),0) as TOTAL_PAID from CDBPRODDB.lserepaypay lrp where lrp.lerepay_entity_num = 1 and lrp.lerepay_internal_acnum = ac.acnts_internal_acnum and lrp.lerepay_repay_slno <= 12 and lrp.lerepay_pay_date <= mn.mn_curr_business_date)
       +
       (SELECT nvl(SUM(lrph.lerepay_princ_amt_paid + lrph.lerepay_int_amt_paid + lrph.lerepay_service_tax_amt_paid + lrph.lerepay_vat_amt_paid + lrph.lerepay_chg_amt_paid),0) as TOTAL_PAID from CDBPRODDB.lserepaypayhist lrph where lrph.lerepay_entity_num = 1 and lrph.lerepay_internal_acnum = ac.acnts_internal_acnum and lrph.lerepay_repay_slno <=12  and lrph.lerepay_pay_date <= mn.mn_curr_business_date) from dual)  as TOTAL_PAID,
       
        CDBPRODDB.pkg_cdb_inh_common.FN_GETCDBOFFICER(ac.acnts_internal_acnum) as RECOVERY_OFFICER
       from  CDBPRODDB.lseacnt le, CDBPRODDB.acnts ac, CDBPRODDB.clients cc, CDBPRODDB.leasedisb ld, CDBPRODDB.maincont mn, CDBPRODDB.leaseacntmis lm
where ac.acnts_entity_num = 1 and ac.acnts_internal_acnum = le.lse_internal_acnum 
and cc.clients_code = ac.acnts_client_num
and LD.ledisb_entity_num = 1 and LD.ledisb_internal_acnum = ac.acnts_internal_acnum  and LD.ledisb_auth_on is not null
and lm.leacntm_entity_num = 1 and lm.leacntm_internal_acnum = ac.acnts_internal_acnum
and not exists (select 1 from CDBPRODDB.recdispose RD where RD.rd_entity_num = 1 and RD.rd_acnt_num = ac.acnts_internal_acnum and RD.rd_auth_on is not null)
and ld.ledisb_date >= add_months(mn.mn_curr_business_date,(12 * -1))
and ld.ledisb_date <= mn.mn_curr_business_date
) mysum group by mysum.RECOVERY_OFFICER
) MIS GROUP BY MIS.RECOVERY_OFFICER) SCRIPT
");

oci_execute($stid);
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
$x = 1;
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
    echo $x. ". ".$row[0]." - ";
    $query_excute = mysqli_query($conn,$row[0]) or die(mysqli_error($conn));
    if($query_excute){
        echo "SQL Execute OK.<br/>";
    }else{
        echo "SQL Execute ERROR.<br/>";
    }
}



?>