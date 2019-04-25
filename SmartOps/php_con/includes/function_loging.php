<?php
function cakeuser()
{
	//$a =  $_SESSION['lockattamp']
	if(0 == $_SESSION['lockattamp']){
		$_SESSION['count1'] = $_SESSION['lockattamp'];
		$_SESSION['sub1'] = $_SESSION['userprivias'];
		//echo $_SESSION['count1'];
		//echo $_SESSION['sub1'];
	}else if(1 == $_SESSION['lockattamp'] && $_SESSION['sub1']== $_SESSION['userprivias']){
		//echo "bbb";
		$_SESSION['count2'] = $_SESSION['lockattamp'];
		$_SESSION['sub2'] = $_SESSION['userprivias'];
		 //echo $_SESSION['count2'];
		 //echo $_SESSION['sub2'];
	 }else if(2 == $_SESSION['lockattamp'] && $_SESSION['sub2']== $_SESSION['userprivias']){
	 	//echo "ccc";
		$_SESSION['count3'] = $_SESSION['lockattamp'];
		$_SESSION['sub3'] = $_SESSION['userprivias'];
	 	//echo $_SESSION['count3'];
	 	//echo $_SESSION['sub3'];
	 }else if(1 == $_SESSION['lockattamp'] && $_SESSION['sub1']!= $_SESSION['userprivias']){
	  	//echo "sssss";
		$_SESSION['lockattamp']= 0;
	  	$_SESSION['count1'] = $_SESSION['lockattamp'];
	  	$_SESSION['sub1'] = $_SESSION['userprivias'];
	  	//echo $_SESSION['count1'];
	  	//echo $_SESSION['sub1'];
		$_SESSION['count2'] = 0;
		$_SESSION['sub2'] = 0;
		$_SESSION['count3'] = 0;
		$_SESSION['sub3'] = 0;
	 }else if(2 == $_SESSION['lockattamp'] && $_SESSION['sub2']!= $_SESSION['userprivias']){
	  	//echo "eee";
	 	$_SESSION['lockattamp']= 0;
	  	$_SESSION['count1'] = $_SESSION['lockattamp'];
	  	$_SESSION['sub1'] = $_SESSION['userprivias'];
	 	// echo $_SESSION['count1'];
	  	//echo $_SESSION['sub1'];
		$_SESSION['count2'] = 0;
		$_SESSION['sub2'] = 0;
		$_SESSION['count3'] = 0;
		$_SESSION['sub3'] = 0;    
	}else{
		//echo "dddd";
	}
	return;
}

?>