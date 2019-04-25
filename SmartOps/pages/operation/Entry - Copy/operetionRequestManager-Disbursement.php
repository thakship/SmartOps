<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Operation
Page Name		: Request Manager - Disbursement
Purpose			: To Close Request Request Manager - Disbursement
Author			: Madushan Wikramaarachchi
Date & Time		: 12.36 P.M 27/01/2017
Modified		: by Rizvi On 2:11 PM 05/04/2017 to Unit 2 Operation support
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="ope/e/002";
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
    include('../Operation_DEVELOPMENT/PHP_FUNCTION/operation_php_function.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Request Manager - Disbursement</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../Operation_DEVELOPMENT/CSS/operation_Style_Sheet.css"/>
    
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../Operation_DEVELOPMENT/JAVASCRIPT_FUNCTION/operation_js_function"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
  	#outer{
		visibility: hidden;
		position: fixed;
		left: 0px;
		top:0px;
		width: 100%;
		height: 100%;
		background: #6DA6E4;
		opacity: 0.7;
	}
	#conten{
		position: fixed;
		margin-top:-150px;
		margin-left: -200px;
		top:50%;
		left:50%;
		visibility: hidden;
		background: #ffffff;
		z-index: 5;
		height:275px;
		overflow-y: scroll;
		border:#000000 solid 1px;
	}
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src="jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	parent.location.href = parent.location.href;
}
function isDeleteRequset(getTitle){
    var getId = document.getElementById(getTitle).value;
    var getUser = document.getElementById('txt_user').value;
    var r = confirm('Are you sure you want to Close this?')
    if (r==true){
		$.ajax({ 
			type:'POST', 
			data: {hid : getId , huser : getUser}, 
			url: '../Operation_DEVELOPMENT/PHP_FUNCTION/operation_php_function.php', 
			success: function(dat) {
			 document.getElementById('maneSpan').innerHTML = dat;
			 //alert('updated success!'); 
             //pageClose();
			}
		});	
    }else{
		//alert('BBBBB');		
	}
}

function isEditRequset(getTitle){
    var editHelpID = document.getElementById(getTitle).value;
    mydata1= new XMLHttpRequest();
    mydata1.onreadystatechange=function(){
                if(mydata1.readyState==4){
                    document.getElementById('maneSpan').innerHTML=mydata1.responseText;
                    var v_geturg = document.getElementById('sel_Urgency_defolt').value;
                    var v_getpri = document.getElementById('sel_Priority_defolt').value;
                    var v_getsou = document.getElementById('sel_Source_defolt').value;
                    var vgetBranch = document.getElementById('txt_Branch_defolt').value;
                    var vgetDepartmnet = document.getElementById('txt_Department_defolt').value;
                    if(v_geturg !=""){
                        document.getElementById('sel_Urgency').value =  v_geturg; 
                    } 
                    if(v_getpri != ""){
                        document.getElementById('sel_Priority').value =  v_getpri; 
                    }
                    if(v_getsou != ""){
                        document.getElementById('sel_Source').value =  v_getsou;
                    }
                    if(vgetBranch != ""){
                        document.getElementById('txt_Branch').value =  vgetBranch;
                    }
                    if(vgetDepartmnet != ""){
                        document.getElementById('txt_Department').value =  vgetDepartmnet;
                    }        
                }
            }
            mydata1.open("GET","../Operation_DEVELOPMENT/PHP_FUNCTION/operation_Ajax.php"+"?editHelpReq_ID="+editHelpID,true);
            mydata1.send();
}

function isRemoveAttachment(title){
    var r = confirm('Are you sure you want to Remove this Attachment?')
    if (r==true){
		$.ajax({ 
			type:'POST', 
			data: {getAttach : title}, 
			url: '../Operation_DEVELOPMENT/PHP_FUNCTION/operation_php_function.php', 
			success: function() { 
                alert('updated success!'); 
                document.getElementById('fileAttachment').disabled = false;
                document.getElementById('link_att').style.display = "none";
                document.getElementById('btnCloseAtt').style.display = "none";
                document.getElementById('fileAttachment1').value = 0;
                
			}
		});	
    }else{
		//alert('BBBBB');		
	}   
}
function isRemoveAttachment1(title){
    var r = confirm('Are you sure you want to Remove this Attachment1?')
    if (r==true){
		$.ajax({ 
			type:'POST', 
			data: {getAttachsub : title}, 
			url: '../Operation_DEVELOPMENT/PHP_FUNCTION/operation_php_function.php', 
			success: function() { 
                alert('updated success!'); 
                document.getElementById('fileAttachment2').disabled = false;
                document.getElementById('link_att1').style.display = "none";
                document.getElementById('btnCloseAtt1').style.display = "none";
                document.getElementById('fileAttachment2').value = 0;
                
			}
		});	
    }else{
		//alert('BBBBB');		
	}   
}
function deleteRow(n){ // this fuction is Delete Row(s) in table
        //alert(n);
        var m=n.parentNode.parentNode.rowIndex;
        document.getElementById('myTable').deleteRow(m);
        var num1 = document.getElementById("myTable").rows.length;
        var num2 = num1 - 1;
        var y = 1;
        var  rowcount = document.getElementById("myTable").rows.length;
        document.getElementById('row_COUNT').value =  document.getElementById("myTable").rows.length-1;
        var i = rowcount-1;    
       	for(var mloop=2;mloop <=100;mloop++){
            var elementA =  document.getElementById('txta' + (mloop - 1));
            var elementB =  document.getElementById('txtb' + (mloop - 1));
            if (elementA != null){
                // Re-order the sequence of the table rows.............
                elementA.value = y;
                //Changing the element ID's to capture in the php
                elementA.id = 'txta' + y;				  
                elementB.id = 'txtb' + y;
                //Changing the element name's to capture in the php				  
                elementA.name = 'txta' + y;				  
                elementB.name = 'txtb' + y;
                y++;
            }			
        }
}

function is_add_row(){
    var x = document.getElementById("myTable").rows.length;
    var getVal = document.getElementById('txtb'+(x-1)).value;
    if(getVal != ""){
        var table=document.getElementById("myTable");
        var row=table.insertRow(-1);
        var cell1=row.insertCell(0);
        var cell2=row.insertCell(1);
        var cell3=row.insertCell(2);
        cell1.innerHTML="<input style='width:50px;text-align: right;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value='"+(x)+"'  onKeyPress='return disableEnterKey(event)' readonly='readonly'/>";
        cell2.innerHTML="<input style='width:600px;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell3.innerHTML="<img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/>";
        document.getElementById('row_COUNT').value =  document.getElementById("myTable").rows.length-1;
    }else{
       alert('Note text box empty.');
    }
}

  function popup(x){
		if(x==1){
			var mydataGried;
			mydataGried= new XMLHttpRequest();
			mydataGried.onreadystatechange=function(){
				if(mydataGried.readyState==4){
					document.getElementById('getGried').innerHTML=mydataGried.responseText;  
					document.getElementById('outer').style.visibility = "visible";
					document.getElementById('conten').style.visibility = "visible";           
				}
			}
			mydataGried.open("GET","ajax_Gried.php"+"?sr_gried="+x,true);
			mydataGried.send();
			/*document.getElementById('outer').style.visibility = "visible";
			document.getElementById('conten').style.visibility = "visible";*/
		
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
	}
	
	function selectDB(xx){
			var id1 = document.getElementById('txt1'+xx).value;
			var id2 = document.getElementById('txt2'+xx).value;
			//alert(id1);
			//alert(id2);
			document.getElementById('txt_inner_User1').value = id1;
			document.getElementById('txt_inner_User2').value = id2;
	}
	
	function fileSelect(){
		var mydata5;
		mydata5= new XMLHttpRequest();
		mydata5.onreadystatechange=function(){
			if(mydata5.readyState==4){
				document.getElementById('getNewtblPopup').innerHTML=mydata5.responseText;
			}
		}
		var searchup=document.getElementById('popupsearch').value;
		mydata5.open('GET','ajaxEntryPopu1.php'+'?txtsearch='+searchup,true);
		mydata5.send();
  }
 function removeUsreID(){
    document.getElementById('txt_inner_User1').value = '';
    document.getElementById('txt_inner_User2').value = '';
} 
 function is_getScat_01(getID,getTitle){
    var getCat = document.getElementById(getID).value;
    if(getTitle == 3){
        var divID = 'divc';
    }
    if(getCat == "" &&  getTitle == 3){
        document.getElementById('txt_Department').value = "";
        document.getElementById('txt_Department').disabled = true; 
    }else{
        var mydata;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById(divID).innerHTML=mydata.responseText;             
            }
        }
        mydata.open("GET","ajax_serviceRequset_01.php"+"?txt1="+getCat+"&txt2="+getTitle,true);
        mydata.send();
    }
    
}

function isAddiImgRequset(title){
    //alert(title);
    var helpID = document.getElementById(title).value;
    //alert(helpID);
    var aIType = "K";
   /* var mydata;
    mydata= new XMLHttpRequest();
    mydata.onreadystatechange=function(){
        if(mydata.readyState==4){
            document.getElementById('maneSpan_sub').innerHTML=mydata.responseText;             
        }
    }
    mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?AddImg_helpID="+helpID+"&AddImg_aIType="+aIType,true);
    mydata.send();*/
    window.open('http://cdberp:8080/cdb/pages/operation/Entry/applicationPendingUpload.php?DispName=Application%20%20Pending%20Upload&helpID='+helpID+'&pendingUploadImgType='+aIType,'conectpage');
    
}
</script>
<script>
/* jquery.form.min.js */
(function(e){"use strict";if(typeof define==="function"&&define.amd){define(["jquery"],e)}else{e(typeof jQuery!="undefined"?jQuery:window.Zepto)}})(function(e){"use strict";function r(t){var n=t.data;if(!t.isDefaultPrevented()){t.preventDefault();e(t.target).ajaxSubmit(n)}}function i(t){var n=t.target;var r=e(n);if(!r.is("[type=submit],[type=image]")){var i=r.closest("[type=submit]");if(i.length===0){return}n=i[0]}var s=this;s.clk=n;if(n.type=="image"){if(t.offsetX!==undefined){s.clk_x=t.offsetX;s.clk_y=t.offsetY}else if(typeof e.fn.offset=="function"){var o=r.offset();s.clk_x=t.pageX-o.left;s.clk_y=t.pageY-o.top}else{s.clk_x=t.pageX-n.offsetLeft;s.clk_y=t.pageY-n.offsetTop}}setTimeout(function(){s.clk=s.clk_x=s.clk_y=null},100)}function s(){if(!e.fn.ajaxSubmit.debug){return}var t="[jquery.form] "+Array.prototype.join.call(arguments,"");if(window.console&&window.console.log){window.console.log(t)}else if(window.opera&&window.opera.postError){window.opera.postError(t)}}var t={};t.fileapi=e("<input type='file'/>").get(0).files!==undefined;t.formdata=window.FormData!==undefined;var n=!!e.fn.prop;e.fn.attr2=function(){if(!n){return this.attr.apply(this,arguments)}var e=this.prop.apply(this,arguments);if(e&&e.jquery||typeof e==="string"){return e}return this.attr.apply(this,arguments)};e.fn.ajaxSubmit=function(r){function k(t){var n=e.param(t,r.traditional).split("&");var i=n.length;var s=[];var o,u;for(o=0;o<i;o++){n[o]=n[o].replace(/\+/g," ");u=n[o].split("=");s.push([decodeURIComponent(u[0]),decodeURIComponent(u[1])])}return s}function L(t){var n=new FormData;for(var s=0;s<t.length;s++){n.append(t[s].name,t[s].value)}if(r.extraData){var o=k(r.extraData);for(s=0;s<o.length;s++){if(o[s]){n.append(o[s][0],o[s][1])}}}r.data=null;var u=e.extend(true,{},e.ajaxSettings,r,{contentType:false,processData:false,cache:false,type:i||"POST"});if(r.uploadProgress){u.xhr=function(){var t=e.ajaxSettings.xhr();if(t.upload){t.upload.addEventListener("progress",function(e){var t=0;var n=e.loaded||e.position;var i=e.total;if(e.lengthComputable){t=Math.ceil(n/i*100)}r.uploadProgress(e,n,i,t)},false)}return t}}u.data=null;var a=u.beforeSend;u.beforeSend=function(e,t){if(r.formData){t.data=r.formData}else{t.data=n}if(a){a.call(this,e,t)}};return e.ajax(u)}function A(t){function T(e){var t=null;try{if(e.contentWindow){t=e.contentWindow.document}}catch(n){s("cannot get iframe.contentWindow document: "+n)}if(t){return t}try{t=e.contentDocument?e.contentDocument:e.document}catch(n){s("cannot get iframe.contentDocument: "+n);t=e.document}return t}function k(){function f(){try{var e=T(v).readyState;s("state = "+e);if(e&&e.toLowerCase()=="uninitialized"){setTimeout(f,50)}}catch(t){s("Server abort: ",t," (",t.name,")");_(x);if(w){clearTimeout(w)}w=undefined}}var t=a.attr2("target"),n=a.attr2("action"),r="multipart/form-data",u=a.attr("enctype")||a.attr("encoding")||r;o.setAttribute("target",p);if(!i||/post/i.test(i)){o.setAttribute("method","POST")}if(n!=l.url){o.setAttribute("action",l.url)}if(!l.skipEncodingOverride&&(!i||/post/i.test(i))){a.attr({encoding:"multipart/form-data",enctype:"multipart/form-data"})}if(l.timeout){w=setTimeout(function(){b=true;_(S)},l.timeout)}var c=[];try{if(l.extraData){for(var h in l.extraData){if(l.extraData.hasOwnProperty(h)){if(e.isPlainObject(l.extraData[h])&&l.extraData[h].hasOwnProperty("name")&&l.extraData[h].hasOwnProperty("value")){c.push(e('<input type="hidden" name="'+l.extraData[h].name+'">').val(l.extraData[h].value).appendTo(o)[0])}else{c.push(e('<input type="hidden" name="'+h+'">').val(l.extraData[h]).appendTo(o)[0])}}}}if(!l.iframeTarget){d.appendTo("body")}if(v.attachEvent){v.attachEvent("onload",_)}else{v.addEventListener("load",_,false)}setTimeout(f,15);try{o.submit()}catch(m){var g=document.createElement("form").submit;g.apply(o)}}finally{o.setAttribute("action",n);o.setAttribute("enctype",u);if(t){o.setAttribute("target",t)}else{a.removeAttr("target")}e(c).remove()}}function _(t){if(m.aborted||M){return}A=T(v);if(!A){s("cannot access response document");t=x}if(t===S&&m){m.abort("timeout");E.reject(m,"timeout");return}else if(t==x&&m){m.abort("server abort");E.reject(m,"error","server abort");return}if(!A||A.location.href==l.iframeSrc){if(!b){return}}if(v.detachEvent){v.detachEvent("onload",_)}else{v.removeEventListener("load",_,false)}var n="success",r;try{if(b){throw"timeout"}var i=l.dataType=="xml"||A.XMLDocument||e.isXMLDoc(A);s("isXml="+i);if(!i&&window.opera&&(A.body===null||!A.body.innerHTML)){if(--O){s("requeing onLoad callback, DOM not available");setTimeout(_,250);return}}var o=A.body?A.body:A.documentElement;m.responseText=o?o.innerHTML:null;m.responseXML=A.XMLDocument?A.XMLDocument:A;if(i){l.dataType="xml"}m.getResponseHeader=function(e){var t={"content-type":l.dataType};return t[e.toLowerCase()]};if(o){m.status=Number(o.getAttribute("status"))||m.status;m.statusText=o.getAttribute("statusText")||m.statusText}var u=(l.dataType||"").toLowerCase();var a=/(json|script|text)/.test(u);if(a||l.textarea){var f=A.getElementsByTagName("textarea")[0];if(f){m.responseText=f.value;m.status=Number(f.getAttribute("status"))||m.status;m.statusText=f.getAttribute("statusText")||m.statusText}else if(a){var c=A.getElementsByTagName("pre")[0];var p=A.getElementsByTagName("body")[0];if(c){m.responseText=c.textContent?c.textContent:c.innerText}else if(p){m.responseText=p.textContent?p.textContent:p.innerText}}}else if(u=="xml"&&!m.responseXML&&m.responseText){m.responseXML=D(m.responseText)}try{L=H(m,u,l)}catch(g){n="parsererror";m.error=r=g||n}}catch(g){s("error caught: ",g);n="error";m.error=r=g||n}if(m.aborted){s("upload aborted");n=null}if(m.status){n=m.status>=200&&m.status<300||m.status===304?"success":"error"}if(n==="success"){if(l.success){l.success.call(l.context,L,"success",m)}E.resolve(m.responseText,"success",m);if(h){e.event.trigger("ajaxSuccess",[m,l])}}else if(n){if(r===undefined){r=m.statusText}if(l.error){l.error.call(l.context,m,n,r)}E.reject(m,"error",r);if(h){e.event.trigger("ajaxError",[m,l,r])}}if(h){e.event.trigger("ajaxComplete",[m,l])}if(h&&!--e.active){e.event.trigger("ajaxStop")}if(l.complete){l.complete.call(l.context,m,n)}M=true;if(l.timeout){clearTimeout(w)}setTimeout(function(){if(!l.iframeTarget){d.remove()}else{d.attr("src",l.iframeSrc)}m.responseXML=null},100)}var o=a[0],u,f,l,h,p,d,v,m,g,y,b,w;var E=e.Deferred();E.abort=function(e){m.abort(e)};if(t){for(f=0;f<c.length;f++){u=e(c[f]);if(n){u.prop("disabled",false)}else{u.removeAttr("disabled")}}}l=e.extend(true,{},e.ajaxSettings,r);l.context=l.context||l;p="jqFormIO"+(new Date).getTime();if(l.iframeTarget){d=e(l.iframeTarget);y=d.attr2("name");if(!y){d.attr2("name",p)}else{p=y}}else{d=e('<iframe name="'+p+'" src="'+l.iframeSrc+'" />');d.css({position:"absolute",top:"-1000px",left:"-1000px"})}v=d[0];m={aborted:0,responseText:null,responseXML:null,status:0,statusText:"n/a",getAllResponseHeaders:function(){},getResponseHeader:function(){},setRequestHeader:function(){},abort:function(t){var n=t==="timeout"?"timeout":"aborted";s("aborting upload... "+n);this.aborted=1;try{if(v.contentWindow.document.execCommand){v.contentWindow.document.execCommand("Stop")}}catch(r){}d.attr("src",l.iframeSrc);m.error=n;if(l.error){l.error.call(l.context,m,n,t)}if(h){e.event.trigger("ajaxError",[m,l,n])}if(l.complete){l.complete.call(l.context,m,n)}}};h=l.global;if(h&&0===e.active++){e.event.trigger("ajaxStart")}if(h){e.event.trigger("ajaxSend",[m,l])}if(l.beforeSend&&l.beforeSend.call(l.context,m,l)===false){if(l.global){e.active--}E.reject();return E}if(m.aborted){E.reject();return E}g=o.clk;if(g){y=g.name;if(y&&!g.disabled){l.extraData=l.extraData||{};l.extraData[y]=g.value;if(g.type=="image"){l.extraData[y+".x"]=o.clk_x;l.extraData[y+".y"]=o.clk_y}}}var S=1;var x=2;var N=e("meta[name=csrf-token]").attr("content");var C=e("meta[name=csrf-param]").attr("content");if(C&&N){l.extraData=l.extraData||{};l.extraData[C]=N}if(l.forceSync){k()}else{setTimeout(k,10)}var L,A,O=50,M;var D=e.parseXML||function(e,t){if(window.ActiveXObject){t=new ActiveXObject("Microsoft.XMLDOM");t.async="false";t.loadXML(e)}else{t=(new DOMParser).parseFromString(e,"text/xml")}return t&&t.documentElement&&t.documentElement.nodeName!="parsererror"?t:null};var P=e.parseJSON||function(e){return window["eval"]("("+e+")")};var H=function(t,n,r){var i=t.getResponseHeader("content-type")||"",s=n==="xml"||!n&&i.indexOf("xml")>=0,o=s?t.responseXML:t.responseText;if(s&&o.documentElement.nodeName==="parsererror"){if(e.error){e.error("parsererror")}}if(r&&r.dataFilter){o=r.dataFilter(o,n)}if(typeof o==="string"){if(n==="json"||!n&&i.indexOf("json")>=0){o=P(o)}else if(n==="script"||!n&&i.indexOf("javascript")>=0){e.globalEval(o)}}return o};return E}if(!this.length){s("ajaxSubmit: skipping submit process - no element selected");return this}var i,o,u,a=this;if(typeof r=="function"){r={success:r}}else if(r===undefined){r={}}i=r.type||this.attr2("method");o=r.url||this.attr2("action");u=typeof o==="string"?e.trim(o):"";u=u||window.location.href||"";if(u){u=(u.match(/^([^#]+)/)||[])[1]}r=e.extend(true,{url:u,success:e.ajaxSettings.success,type:i||e.ajaxSettings.type,iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank"},r);var f={};this.trigger("form-pre-serialize",[this,r,f]);if(f.veto){s("ajaxSubmit: submit vetoed via form-pre-serialize trigger");return this}if(r.beforeSerialize&&r.beforeSerialize(this,r)===false){s("ajaxSubmit: submit aborted via beforeSerialize callback");return this}var l=r.traditional;if(l===undefined){l=e.ajaxSettings.traditional}var c=[];var h,p=this.formToArray(r.semantic,c);if(r.data){r.extraData=r.data;h=e.param(r.data,l)}if(r.beforeSubmit&&r.beforeSubmit(p,this,r)===false){s("ajaxSubmit: submit aborted via beforeSubmit callback");return this}this.trigger("form-submit-validate",[p,this,r,f]);if(f.veto){s("ajaxSubmit: submit vetoed via form-submit-validate trigger");return this}var d=e.param(p,l);if(h){d=d?d+"&"+h:h}if(r.type.toUpperCase()=="GET"){r.url+=(r.url.indexOf("?")>=0?"&":"?")+d;r.data=null}else{r.data=d}var v=[];if(r.resetForm){v.push(function(){a.resetForm()})}if(r.clearForm){v.push(function(){a.clearForm(r.includeHidden)})}if(!r.dataType&&r.target){var m=r.success||function(){};v.push(function(t){var n=r.replaceTarget?"replaceWith":"html";e(r.target)[n](t).each(m,arguments)})}else if(r.success){v.push(r.success)}r.success=function(e,t,n){var i=r.context||this;for(var s=0,o=v.length;s<o;s++){v[s].apply(i,[e,t,n||a,a])}};if(r.error){var g=r.error;r.error=function(e,t,n){var i=r.context||this;g.apply(i,[e,t,n,a])}}if(r.complete){var y=r.complete;r.complete=function(e,t){var n=r.context||this;y.apply(n,[e,t,a])}}var b=e("input[type=file]:enabled",this).filter(function(){return e(this).val()!==""});var w=b.length>0;var E="multipart/form-data";var S=a.attr("enctype")==E||a.attr("encoding")==E;var x=t.fileapi&&t.formdata;s("fileAPI :"+x);var T=(w||S)&&!x;var N;if(r.iframe!==false&&(r.iframe||T)){if(r.closeKeepAlive){e.get(r.closeKeepAlive,function(){N=A(p)})}else{N=A(p)}}else if((w||S)&&x){N=L(p)}else{N=e.ajax(r)}a.removeData("jqxhr").data("jqxhr",N);for(var C=0;C<c.length;C++){c[C]=null}this.trigger("form-submit-notify",[this,r]);return this};e.fn.ajaxForm=function(t){t=t||{};t.delegation=t.delegation&&e.isFunction(e.fn.on);if(!t.delegation&&this.length===0){var n={s:this.selector,c:this.context};if(!e.isReady&&n.s){s("DOM not ready, queuing ajaxForm");e(function(){e(n.s,n.c).ajaxForm(t)});return this}s("terminating; zero elements found by selector"+(e.isReady?"":" (DOM not ready)"));return this}if(t.delegation){e(document).off("submit.form-plugin",this.selector,r).off("click.form-plugin",this.selector,i).on("submit.form-plugin",this.selector,t,r).on("click.form-plugin",this.selector,t,i);return this}return this.ajaxFormUnbind().bind("submit.form-plugin",t,r).bind("click.form-plugin",t,i)};e.fn.ajaxFormUnbind=function(){return this.unbind("submit.form-plugin click.form-plugin")};e.fn.formToArray=function(n,r){var i=[];if(this.length===0){return i}var s=this[0];var o=this.attr("id");var u=n?s.getElementsByTagName("*"):s.elements;var a;if(u&&!/MSIE [678]/.test(navigator.userAgent)){u=e(u).get()}if(o){a=e(':input[form="'+o+'"]').get();if(a.length){u=(u||[]).concat(a)}}if(!u||!u.length){return i}var f,l,c,h,p,d,v;for(f=0,d=u.length;f<d;f++){p=u[f];c=p.name;if(!c||p.disabled){continue}if(n&&s.clk&&p.type=="image"){if(s.clk==p){i.push({name:c,value:e(p).val(),type:p.type});i.push({name:c+".x",value:s.clk_x},{name:c+".y",value:s.clk_y})}continue}h=e.fieldValue(p,true);if(h&&h.constructor==Array){if(r){r.push(p)}for(l=0,v=h.length;l<v;l++){i.push({name:c,value:h[l]})}}else if(t.fileapi&&p.type=="file"){if(r){r.push(p)}var m=p.files;if(m.length){for(l=0;l<m.length;l++){i.push({name:c,value:m[l],type:p.type})}}else{i.push({name:c,value:"",type:p.type})}}else if(h!==null&&typeof h!="undefined"){if(r){r.push(p)}i.push({name:c,value:h,type:p.type,required:p.required})}}if(!n&&s.clk){var g=e(s.clk),y=g[0];c=y.name;if(c&&!y.disabled&&y.type=="image"){i.push({name:c,value:g.val()});i.push({name:c+".x",value:s.clk_x},{name:c+".y",value:s.clk_y})}}return i};e.fn.formSerialize=function(t){return e.param(this.formToArray(t))};e.fn.fieldSerialize=function(t){var n=[];this.each(function(){var r=this.name;if(!r){return}var i=e.fieldValue(this,t);if(i&&i.constructor==Array){for(var s=0,o=i.length;s<o;s++){n.push({name:r,value:i[s]})}}else if(i!==null&&typeof i!="undefined"){n.push({name:this.name,value:i})}});return e.param(n)};e.fn.fieldValue=function(t){for(var n=[],r=0,i=this.length;r<i;r++){var s=this[r];var o=e.fieldValue(s,t);if(o===null||typeof o=="undefined"||o.constructor==Array&&!o.length){continue}if(o.constructor==Array){e.merge(n,o)}else{n.push(o)}}return n};e.fieldValue=function(t,n){var r=t.name,i=t.type,s=t.tagName.toLowerCase();if(n===undefined){n=true}if(n&&(!r||t.disabled||i=="reset"||i=="button"||(i=="checkbox"||i=="radio")&&!t.checked||(i=="submit"||i=="image")&&t.form&&t.form.clk!=t||s=="select"&&t.selectedIndex==-1)){return null}if(s=="select"){var o=t.selectedIndex;if(o<0){return null}var u=[],a=t.options;var f=i=="select-one";var l=f?o+1:a.length;for(var c=f?o:0;c<l;c++){var h=a[c];if(h.selected){var p=h.value;if(!p){p=h.attributes&&h.attributes.value&&!h.attributes.value.specified?h.text:h.value}if(f){return p}u.push(p)}}return u}return e(t).val()};e.fn.clearForm=function(t){return this.each(function(){e("input,select,textarea",this).clearFields(t)})};e.fn.clearFields=e.fn.clearInputs=function(t){var n=/^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;return this.each(function(){var r=this.type,i=this.tagName.toLowerCase();if(n.test(r)||i=="textarea"){this.value=""}else if(r=="checkbox"||r=="radio"){this.checked=false}else if(i=="select"){this.selectedIndex=-1}else if(r=="file"){if(/MSIE/.test(navigator.userAgent)){e(this).replaceWith(e(this).clone(true))}else{e(this).val("")}}else if(t){if(t===true&&/hidden/.test(r)||typeof t=="string"&&e(this).is(t)){this.value=""}}})};e.fn.resetForm=function(){return this.each(function(){if(typeof this.reset=="function"||typeof this.reset=="object"&&!this.reset.nodeType){this.reset()}})};e.fn.enable=function(e){if(e===undefined){e=true}return this.each(function(){this.disabled=!e})};e.fn.selected=function(t){if(t===undefined){t=true}return this.each(function(){var n=this.type;if(n=="checkbox"||n=="radio"){this.checked=t}else if(this.tagName.toLowerCase()=="option"){var r=e(this).parent("select");if(t&&r[0]&&r[0].type=="select-one"){r.find("option").selected(false)}this.selected=t}})};e.fn.ajaxSubmit.debug=false})
</script>
<script type="text/javascript">
$(document).ready(function() { 
	 $('#uploadForm').submit(function(e) {	
		if($('#fileAttachment').val()) {
			e.preventDefault();
			//$('#loader-icon').show();
			$(this).ajaxSubmit({ 
				//target:   '#targetLayer', 
				beforeSubmit: function() {
				  $("#progress-bar").width('0%');
				},
				uploadProgress: function (event, position, total, percentComplete){	
					$("#progress-bar").width(percentComplete + '%');
					$("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
				},
			     success:function (datav){
				//	$('#loader-icon').hide();
                    //document.getElementById('targetLayer').innerHTML = datav;
                    alert(datav);
                    pageClose();
                    
                    
				},
				//resetForm: true 
			}); 
			return false; 
		}
	});
}); 

</script>
<style>

#progress-bar {background-color: #12CC1A;height:12px;color: #FFFFFF;width:0%;-webkit-transition: width .3s;-moz-transition: width .3s;transition: width .3s;}
#progress-div {border:#0FA015 1px solid;padding: 1px 0px;margin:1px 0px;border-radius:4px;text-align:center; font-size: 10px; font-weight: bold; color: black;}
#targetLayer{width:100%;text-align:center;}

</style>
</head>
<body oncontextmenu="return false">
  
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<span id="maneSpan_sub">
<form action="UPLOAD_FILE_close.php" method="post" id="uploadForm" name="uploadForm" enctype="multipart/form-data">
<div id="targetLayer"></div>
<div id="loader-icon" style="display:none;"><img src="LoaderIcon.gif" /></div>
<span id="maneSpan">
<table border="1" id="myTable" cellpadding="0" cellspacing="0" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
            <tr style="background-color: #BEBABA;">
                <td style="width:80px; text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
                <td style="width:100px; text-align: right;"><span style="margin-right: 5px;">Entry Date</span></td>
                <td style="width:500px;text-align: left;"><span  style="margin-left: 5px;">Issue</span></td>
                <td style="width:150px;"></td>
            </tr>
<?php
    //
	echo "BRANCH CODE : ". $_SESSION['userBranch'];
    $v_sql_select = "SELECT `helpid`, DATE(`enterDateTime`) AS getDate,`issue` 
                           FROM `cdb_helpdesk` 
                           WHERE `cdb_helpdesk`.`cat_code` = '1014' AND 
                                 `cdb_helpdesk`.`cmb_code` = '5002' AND 
                                 `cdb_helpdesk`.COD_STATUS = '001'  AND
								 (`cdb_helpdesk`.`entry_branch` = '".$_SESSION['userBranch']."')  AND  
								 `cdb_helpdesk`.`entry_department` = '".$_SESSION['userDepartment']."' UNION ALL
					 SELECT `helpid`, DATE(`enterDateTime`) AS getDate,`issue` 
                           FROM `cdb_helpdesk` 
                           WHERE `cdb_helpdesk`.`cat_code` = '1014' AND 
                                 `cdb_helpdesk`.`cmb_code` = '5002' AND 
                                 `cdb_helpdesk`.COD_STATUS = '001'  AND
						         `cdb_helpdesk`.`entry_branch`  = '".$_SESSION['userBranch']."'"                            
                                 ;
							     // Where condition has been changed by Rizvi Kareem
								 // Was : `cdb_helpdesk`.`entry_branch` IN (select CDB_UNIT_BRANCHNUMBER from cdb_unit_op where CDB_PARENT_BRANCHNUMBER = '".$_SESSION['userBranch']."')"
								 // Changed to : `cdb_helpdesk`.`entry_branch`  = '".$_SESSION['userBranch']."'"  
    //echo $v_sql_select;
    $v_que_select = mysqli_query($conn,$v_sql_select);
    $index = 0;
    while($res_Select = mysqli_fetch_assoc($v_que_select)){
        $index++;
         if($index%2 == 1){
            $col = "#C7C9C5";
            $col = "#FFFFFF";
        }else{
             $col = "#FFFFFF";
        }
        echo "<tr style='background-color: ".$col.";'>";
        echo "<td style='width:80px; text-align: right;'><div style='display: none;'><input type='text' name='txtclose".$index."' id='txtclose".$index."' value='".$res_Select['helpid']."'  onKeyPress='return disableEnterKey(event)'/></div><span  style='margin-right: 5px;'>".$res_Select['helpid']."</span></td>";
        echo "<td style='width:100px; text-align: right;'><span  style='margin-right: 5px;'>".$res_Select['getDate']."</span></td>";
        echo "<td style='width:500px; text-align: left;'><span  style='margin-left: 5px;'>".$res_Select['issue']."</span></td>";
        echo "<td style='width:250px;'>
                <input type='button' class='buttonManage' id='btn_Edit' name='btn_Edit' value='Edit' title='txtclose".$index."' onclick='isEditRequset(title);'/>
                <input type='button' class='buttonManage' id='btn_uplad' name='btn_uplad' value='Additional Img' title='txtclose".$index."' onclick='isAddiImgRequset(title);'/>
            </td>";
        echo "</tr>";
    }
?>
</table>
</span>
</span>
<?php
    /*if(isset($_POST['btnSolution']) && $_POST['btnSolution']=='Update'){
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            if(trim($_POST['txt_help_ID']) != ""){
                $getUploadStates = is_upload_file($conn,trim($_POST['txt_help_ID']));
                $getUploadStates1 = "";
                if($getUploadStates == 1){
                    echo "<script> alert('maximum file size. < 10MB >');</script>";
                }else{
                    if($getUploadStates == 2){
                        echo "<script> alert('already exists. File Error.');</script>";   
                    }else{
                        if($getUploadStates == 3){
                            echo "<script> alert('already exists. Path.');</script>";
                        }else{
                            $hetCheck = 0;
                            
                            if(trim($_POST['txt_Branch']) != ''){
                                 $hetCheck = 1;
                            }
                            if(trim($_POST['fileAttachment1']) == ""){
                                 $getUploadStates1 = "";
                            }
                            if(trim($_POST['fileAttachment1']) == 0){
                                $getUploadStates1 = $getUploadStates;
                            }
                            $v_getSQL_insert = "UPDATE `cdb_helpdesk` 
                                                SET `ur_code`='".trim($_POST['sel_Urgency'])."', `pr_code`='".trim($_POST['sel_Priority'])."', `issue`='".trim($_POST['txt_issue'])."', `help_discr`='".trim($_POST['txt_Description'])."', `enterBy`='".$_SESSION['user']."', `enterDateTime`= now(), `attachment_name`='".$getUploadStates1."', `entry_branch`='".$_SESSION['userBranch']."', `entry_department`='".$_SESSION['userDepartment']."', `s_type`='".trim($_POST['sel_Source'])."', `inner_brCode`= '".trim($_POST['txt_Branch'])."', `inner_dept`= '".trim($_POST['txt_Department'])."', `inner_user`= '".trim($_POST['txt_inner_User1'])."', `inner_remark`= '".trim($_POST['inner_Remark'])."', `inner_get`= '".$hetCheck."', `ssb_type` = 'File re-submitted'  
                                                WHERE `helpid` = '".trim($_POST['txt_help_ID'])."';";
                            $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                            isHelpDeskHistory(trim($_POST['txt_help_ID']));// helpdesk Hisroty.......
                            $v_delete_note = "DELETE FROM `cdb_help_note` WHERE `helpid` = '".trim($_POST['txt_help_ID'])."';";
                            $que_delete_note = mysqli_query($conn,$v_delete_note) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                            for($y = 1 ; $y <= trim($_POST['row_COUNT']) ; $y++){
                                if(trim($_POST['txtb'.$y])!= ""){
                                    $v_getSQL_Note =  "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) VALUES ('".trim($_POST['txt_help_ID'])."','".$y."','".trim($_POST['txtb'.$y])."','".$_SESSION['user']."',now());";
                                    $que_getSQL_Note = mysqli_query($conn,$v_getSQL_Note) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                                 }
                            }
                            
                            if($_POST['sel_catagory_1'] == '1014'){
                                $v_getSQL_Note =  "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) VALUES ('".trim($_POST['txt_help_ID'])."','".($y-1)."',CONCAT('File re-submitted on ', now()),'".$_SESSION['user']."',now());";
                                $que_getSQL_Note = mysqli_query($conn,$v_getSQL_Note) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                            }
                            //1014
                            
                            
                            $stringMessage = "Service request Update. \\n\\nYour SR Number : ".trim($_POST['txt_help_ID']);
                            echo "<script> alert('". $stringMessage ."');</script>";
                            $_SESSION['fileAttachment'] = "";
                            mysqli_commit($conn); 
			    echo "<script> pageClose();</script>";
                        }
                    }
                }
                /*if($getUploadStates == 0){
                    echo "<script> alert('already exists".$getUploadStates."');</script>";
                }else{
                        
                }*/ 
           /* }else{
                
            }
            
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }*/
?>
<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
<div style="display: none;">
    <input type="text" name="txt_user" id="txt_user" value="<?php echo  $_SESSION['user']; ?>" />
</div>
</form>
</body>
</html>

