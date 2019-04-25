 // fornction for User ID and Password validation inn Javascript ...........................................................
function validatePassword(){
    if(document.getElementById('user_id').value == false){
        alert("Enter User ID. ");
        document.getElementById('user_id').focus();
        return false;
    }
    if(document.getElementById('user_password').value == false){
        alert("Enter Password.");
        document.getElementById('user_password').focus();
        return false;
    }
    return true;
}