function pageClose(){ //Page Close Function.......
	parent.location.href = parent.location.href;
}
function pageCloseDefineLetterTypes(){ //Page Close Function for Validate Define Letter Types...............
     window.open('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Masters/SPS_001_Define_Letter_Types.php?DispName=Define%20Letter%20Types','conectpage');
}
function pageCloseDefineSignatoryGroups(){ //Page Close Function for Validate Define Letter Types...............
     window.open('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Masters/SPS_003_Define_Signatory_Groups.php?DispName=Define%20Signatory%20Groups','conectpage');
}

function pageCloseDefineSignatoryGroupsUsers(){
    window.open('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Entry/sps_e_001_Define_Signatory_Groups_Users.php?DispName=Define%20Signatory%20Groups%20Users','conectpage');
}
function pageCloseAssignSignatoryGroups(){
    window.open('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Entry/sps_e_002_Assign_Signatory_Groups.php?DispName=Assign%20Signatory%20Groups','conectpage');
}
function pageCloseSecurityPrintinAuthorization(){
    window.open('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Authorization/sps_a_001_Security_Printing_Authorization.php?DispName=Security%20Printing%20Authorization','conectpage');
}

//************************************ Function For Define Letter Types ***********************************************************************************

function isCheckFromDefineLetterTypes(title){ // Check Data for Validate Define Letter Types........
    var val_LetterTypeCode = document.getElementById('txtLetterTypeCode').value;
    var val_Description = document.getElementById('txtDescription').value;
    var val_txtNumOfSig = document.getElementById('txtNumOfSig').value;
    var val_user = document.getElementById('txtUserID').value;
    
     if(val_user == ""){
        alert('Undefind User.');
     }else if(val_LetterTypeCode == ""){
        alert('Mising Letter Type Code.');
     }else if(val_Description == ""){
        alert('Description.');
     }else if(val_txtNumOfSig == ""){
        alert('Number of Signatories Required.');
     }else if(isNaN(val_txtNumOfSig) == true){
        alert('Num. of Signatories is an illegal number.');
     }else if(val_txtNumOfSig <= 0){
        alert('Num. of Signatories Greater Than 0.');
     }else{
        if(title == 1){
            var r = confirm('Are you sure you want to save this?')
            if (r==true){
    			$.ajax({ 
    				type:'POST', 
    				data: {get_LetterTypeCode : val_LetterTypeCode , get_Description : val_Description , get_val_txtNumOfSig : val_txtNumOfSig , val_Num_sql : title ,get_User : val_user }, 
    				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
    				success: function(val_retn) { 
    				    alert(val_retn); 
                        pageCloseDefineLetterTypes();
    				}
    			});	
            }else{
    			//alert('BBBBB');		
    		}
        }
        if(title == 2){
            var r = confirm('Are you sure you want to Update this?')
            if (r==true){
    			$.ajax({ 
    				type:'POST', 
    				data: {get_LetterTypeCode : val_LetterTypeCode , get_Description : val_Description , get_val_txtNumOfSig : val_txtNumOfSig , val_Num_sql : title ,get_User : val_user }, 
    				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
    				success: function(val_retn) { 
    				    alert(val_retn); 
                        pageCloseDefineLetterTypes();
    				}
    			});	
            }else{
    			//alert('BBBBB');		
    		}
        }
        if(title == 3){
            var r = confirm('Are you sure you want to Delete this?')
            if (r==true){
    			$.ajax({ 
    				type:'POST', 
    				data: {get_LetterTypeCode : val_LetterTypeCode , get_Description : val_Description , get_val_txtNumOfSig : val_txtNumOfSig , val_Num_sql : title ,get_User : val_user }, 
    				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
    				success: function(val_retn) { 
    				    alert(val_retn); 
                        pageCloseDefineLetterTypes();
    				}
    			});	
            }else{
    			//alert('BBBBB');		
    		}
        }
     }
}

//************************************ Function For Define Signatory Groups ***********************************************************************************

function isCheckFromDefineSignatoryGroups(title){ // Check the Define Signatory Groups
    //alert(title);
    var val_sel_sps_let_types = document.getElementById('sel_sps_let_types').value;
    var val_txtGroupCode = document.getElementById('txtGroupCode').value;
    var val_txtGroupName = document.getElementById('txtGroupName').value;
    var val_user = document.getElementById('txtUserID').value;
    //alert(val_sel_sps_let_types+"--"+val_txtGroupCode+"--"+val_txtGroupName+"--"+val_user);
    if(val_user == ""){
        alert('Undefind User.');
    }else if(val_sel_sps_let_types == ""){
        alert('Select Letter Type Code.');
    }else if(val_txtGroupCode == ""){
        alert('Missing Signatory Group Code.');
    }else if (val_txtGroupName == ""){
        alert('Missing Signatory Group Name.');
    }else{
        if(title == 1){
            var r = confirm('Are you sure you want to save this?')
            if (r==true){
    			$.ajax({ 
    				type:'POST', 
    				data: {dsg_sel_sps_let_types : val_sel_sps_let_types , dsg_txtGroupCode : val_txtGroupCode , dsg_txtGroupName : val_txtGroupName , dsg_Num_sql : title ,dsg_User : val_user }, 
    				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
    				success: function(val_retn) { 
    				    alert(val_retn); 
                        pageCloseDefineSignatoryGroups();
    				}
    			});	
            }else{
    			//alert('BBBBB');		
    		}
        }
        if(title == 2){
            var r = confirm('Are you sure you want to Modify this?')
            if (r==true){
    			$.ajax({ 
    				type:'POST', 
    				data: {dsg_sel_sps_let_types : val_sel_sps_let_types , dsg_txtGroupCode : val_txtGroupCode , dsg_txtGroupName : val_txtGroupName , dsg_Num_sql : title ,dsg_User : val_user }, 
    				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
    				success: function(val_retn) { 
    				    alert(val_retn); 
                        pageCloseDefineSignatoryGroups();
    				}
    			});	
            }else{
    			//alert('BBBBB');		
    		}
        }
        if(title == 3){
            var r = confirm('Are you sure you want to Delete this?')
            if (r==true){
    			$.ajax({ 
    				type:'POST', 
    				data: {dsg_sel_sps_let_types : val_sel_sps_let_types , dsg_txtGroupCode : val_txtGroupCode , dsg_txtGroupName : val_txtGroupName , dsg_Num_sql : title ,dsg_User : val_user }, 
    				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
    				success: function(val_retn) { 
    				    alert(val_retn); 
                        pageCloseDefineSignatoryGroups();
    				}
    			});	
            }else{
    			//alert('BBBBB');		
    		}
        }
    }
}

//************************************ Function For Define Signatory Groups Users ***********************************************************************************

function isCheckFromDefineSignatoryGroupsUsers(title){ // Check the Define Signatory Groups Users
    var val_sel_sps_let_types = document.getElementById('sel_sgu_let_types').value;
    var val_sel_sug_Signatory_Group = document.getElementById('sel_sug_Signatory_Group').value;
    var val_sel_txtUserName = document.getElementById('txtUserName').value;
    var val_sel_txtMyUserID = document.getElementById('txtMyUserID').value;
    if(val_sel_txtMyUserID == ""){
        alert('Undefind User.');
    }else if(val_sel_sps_let_types == ""){
        alert('Select Letter Type Code.');
    }else if(val_sel_sug_Signatory_Group == ""){
        alert('Select Signatory Group.');
    }else if (val_sel_txtUserName == ""){
        alert('Missing Assign User ID.');
    }else{
        if(title == 1){
            var r = confirm('Are you sure you want to save this?')
            if (r==true){
    			$.ajax({ 
    				type:'POST', 
    				data: {dsgu_sel_sps_let_types : val_sel_sps_let_types , dsgu_sel_sug_Signatory_Group : val_sel_sug_Signatory_Group , dsgu_val_sel_txtUserName : val_sel_txtUserName , dsgu_Num_sql : title ,dsgu_User : val_sel_txtMyUserID }, 
    				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
    				success: function(val_retn) { 
    				    alert(val_retn); 
                        pageCloseDefineSignatoryGroupsUsers();
    				}
    			});	
            }else{
    			//alert('BBBBB');		
    		}
        }
        
         if(title == 2){
            var r = confirm('Are you sure you want to update this?')
            if (r==true){
    			$.ajax({ 
    				type:'POST', 
    				data: {dsgu_sel_sps_let_types : val_sel_sps_let_types , dsgu_sel_sug_Signatory_Group : val_sel_sug_Signatory_Group , dsgu_val_sel_txtUserName : val_sel_txtUserName , dsgu_Num_sql : title ,dsgu_User : val_sel_txtMyUserID }, 
    				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
    				success: function(val_retn) { 
    				    alert(val_retn); 
                        pageCloseDefineSignatoryGroupsUsers();
    				}
    			});	
            }else{
    			//alert('BBBBB');		
    		}
        }
        
        if(title == 3){
            var r = confirm('Are you sure you want to Delete this?')
            if (r==true){
    			$.ajax({ 
    				type:'POST', 
    				data: {dsgu_sel_sps_let_types : val_sel_sps_let_types , dsgu_sel_sug_Signatory_Group : val_sel_sug_Signatory_Group , dsgu_val_sel_txtUserName : val_sel_txtUserName , dsgu_Num_sql : title ,dsgu_User : val_sel_txtMyUserID }, 
    				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
    				success: function(val_retn) { 
    				    alert(val_retn); 
                        pageCloseDefineSignatoryGroupsUsers();
    				}
    			});	
            }else{
    			//alert('BBBBB');		
    		}
        }
    }
}

//************************************ Function For Assign Signatory Groups ***********************************************************************************

function isCheckFromAssignSignatoryGroups(title){ // Check from Assign Signatory Groups 
    //alert(title);
    var val_sel_sgu_let_types = document.getElementById('sel_sgu_let_types').value; // get Letter Type
    var val_sel_asg_Signatory_Group = document.getElementById('sel_sug_Signatory_Group').value; // get Signatory Group
    var val_txtAmount_From = document.getElementById('txtAmount_From').value; // get Amount From
    var val_txtAmount_To = document.getElementById('txtAmount_To').value; // Amount To
    var val_sel_txtMyUserID = document.getElementById('txtMyUserID').value; // Sesson User ID
    var val_txtsqe = document.getElementById('txtsqe').value; // Sesson User ID
    //alert(val_txtsqe);
    if(val_sel_txtMyUserID == ""){
        alert('Undefind User.');
    }else if(val_sel_sgu_let_types == ""){
        alert('Select Letter Type Code.');
    }else if(val_sel_asg_Signatory_Group == ""){
        alert('Select Signatory Group.');
    }else if(val_txtAmount_From == ""){
        alert('Missing value for Amount From .');
    }else if (val_txtAmount_To == ""){
        alert('Missing Value for Amount To.');
    }else if(isNaN(val_txtAmount_From) == true){
        alert('Amount From record is an illegal number.');
    }else if(isNaN(val_txtAmount_To) == true){
        alert('Amount To record is an illegal number.');
    }else if(Number(val_txtAmount_From) > Number(val_txtAmount_To)){
        alert('Invalid Amount(s).');
    }else{
        if(title == 1){
            var r = confirm('Are you sure you want to save this?')
            if (r==true){
    			$.ajax({ 
    				type:'POST', 
    				data: {asg_sel_sps_let_types : val_sel_sgu_let_types , asg_sel_asg_Signatory_Group : val_sel_asg_Signatory_Group , asg_txtAmount_From : val_txtAmount_From , asg_txtAmount_To : val_txtAmount_To, asg_Num_sql : title ,asg_User : val_sel_txtMyUserID }, 
    				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
    				success: function(val_retn) { 
    				    //document.getElementById('aaaa').innerHTML = val_retn;
    				    alert(val_retn); 
                        pageCloseAssignSignatoryGroups();
    				}
    			});	
            }else{
    			//alert('BBBBB');		
    		}
        }
        if(title == 2){
            var r = confirm('Are you sure you want to update this?')
            if (r==true){
    			$.ajax({ 
    				type:'POST', 
    				data: {asg_sel_sps_let_types : val_sel_sgu_let_types , asg_sel_asg_Signatory_Group : val_sel_asg_Signatory_Group , asg_txtAmount_From : val_txtAmount_From , asg_txtAmount_To : val_txtAmount_To, asg_Num_sql : title ,asg_User : val_sel_txtMyUserID , asg_txtsqe : val_txtsqe }, 
    				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
    				success: function(val_retn) { 
    				    alert(val_retn); 
                        //document.getElementById('aaaa').innerHTML = val_retn;
                       pageCloseAssignSignatoryGroups();
    				}
    			});	
            }else{
    			//alert('BBBBB');		
    		}
        }
        if(title == 3){
            var r = confirm('Are you sure you want to Delete this?')
            if (r==true){
    			$.ajax({ 
    				type:'POST', 
    				data: {asg_sel_sps_let_types : val_sel_sgu_let_types , asg_sel_asg_Signatory_Group : val_sel_asg_Signatory_Group , asg_txtAmount_From : val_txtAmount_From , asg_txtAmount_To : val_txtAmount_To, asg_Num_sql : title ,asg_User : val_sel_txtMyUserID , asg_txtsqe : val_txtsqe }, 
    				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
    				success: function(val_retn) { 
    				    alert(val_retn); 
                        //document.getElementById('aaaa').innerHTML = val_retn;
                       pageCloseAssignSignatoryGroups();
    				}
    			});	
            }else{
    			//alert('BBBBB');		
    		}
        }
    }
}
