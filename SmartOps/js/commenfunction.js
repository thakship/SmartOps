function disableEnterKey(e){
			 var key;      
			 if(window.event)
				  key = window.event.keyCode; //IE
			 else
				  key = e.which; //firefox      
			 return (key != 13);
}
function hilightColoyr(setID){
	document.getElementById(setID).style.backgroundColor='#FAEEF8';
}

function colourLeave(getID){
	document.getElementById(getID).style.backgroundColor='#FFFFFF';
}

function codeID(setID,id){
		var num = /^([0-9])+$/;
		
		if(document.getElementById(setID).value.length!=id){
			alert("Plase only enter "+id+" numbers !");
			document.getElementById(setID).value ="";
			return false;
		}
		if(!document.getElementById(setID).value.match(num)){
			alert("Only numbers are allowed !");
			document.getElementById(setID).value ="";
			return false;
		}
		return true;
}
function codeIDnotVal(setID){
		var num = /^([0-9])+$/;
		if(!document.getElementById(setID).value.match(num)){
			alert("Plase only enter only number");
			document.getElementById(setID).value ="";
			return false;
		}
		return true;
}



