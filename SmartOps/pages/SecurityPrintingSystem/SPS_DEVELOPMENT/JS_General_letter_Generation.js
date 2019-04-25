//alert('JS OK');


function isLeaseAgreementProcess(){
    //console.log('Function OK');
    var fac_number = document.getElementById('txtLeaseAgreementFacilityNumber').value;
    var loguser = document.getElementById('txt_u_defiend').value;
    if(fac_number == ""){
        document.getElementById('lblMsgLeaseAgreementFacilityNumber').innerHTML = 'Missing Facility Number';
    }else{
        var r = confirm('Are you sure you want to Process this?');
        if (r == true) {
            $.ajax({
                type: 'POST',
                data: {get_fac_number : fac_number, get_loguser : loguser , setTitle: 'leaseAgreement'},
                url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_ODF_function.php',
                success: function (val_retn) {
                   
                    if(val_retn == 0){
                        document.getElementById('getErrorMsg').innerHTML = 'Invalid Letter Type';
                    }else{
                        document.getElementById('printablediv').innerHTML = val_retn;
                        receiptPrint();
                    }
                }
            });
        }
    }
}

