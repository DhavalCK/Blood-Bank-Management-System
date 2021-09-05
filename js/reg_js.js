//which role selected
function reg_user() {
    var a = document.getElementById("blood_bank").checked;
    console.log(a);
    if (a) {
       for (var i = 0; i < 3; i++) {
          document.getElementsByClassName("non_b_bank")[i].style.display = "none";
 
       }
     
    }
    else {
       for (var i = 0; i < 3; i++) {
          document.getElementsByClassName("non_b_bank")[i].style.display = "block";
 
       }
     
    }
 }
// function val_Pass(pwd)
// {
//     var regpass = (/[^a-zA-Z0-9-'\n\r.]+*[a-z]+*[A-Z]+*[0-9]+/g, '');
//     if(regpass.test(pwd) == false)
//     {
//     document.getElementById("pstatus").innerHTML    = "<span class='warning'>Password must contain capital,small letter and number.</span>";
//     }
//     else
//     {
//     document.getElementById("pstatus").innerHTML	= "<span class='valid'>You have entered a valid Password!</span>";	
//     }
// }
function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
} 
function validatephone(phone) 
{
    var maintainplus = '';
    var numval = phone.value
    if ( numval.charAt(0)=='+' )
    {
        var maintainplus = '';
    }
    curphonevar = numval.replace(/[\\A-Za-z!"£$%^&\,*+_={};:'@#~,.Š\/<>?|`¬\]\[]/g,'');
    phone.value = maintainplus + curphonevar;
    var maintainplus = '';
    phone.focus;
}
function userValidate(txt) {
    txt.value = txt.value.replace(/[^a-zA-Z0-9-'\n\r.]+/g, '');
}
// validates text only

function Validate(txt) {
    txt.value = txt.value.replace(/[^a-zA-Z-'\n\r.]+/g, '');
}
function nameValidate(txt) {
    txt.value = txt.value.replace(/[^a-zA-Z' '-'\n\r.]+/g, '');
}


// validate email
// function email_validate(email)
// {
// var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
// regMail = /^([a-zA-z0-9\.-]+)@([a-zA-z0-9-]+).([a-zA-z]{2,3}){1}$/;
            
//     if(regMail.test(email))
//     {
//         document.getElementById("status").innerHTML	= "<span class='valid'>Thanks, you have entered a valid Email address!</span>";	
//     }
//     else
//     {
//         document.getElementById("status").innerHTML    = "<span class='warning'>Email address is not valid yet.</span>";
//     }
    
// }

// validate date of birth
function dob_validate(dob)
{
var regDOB = /^(\d{1,2})[-\/](\d{1,2})[-\/](\d{4})$/;

    if(regDOB.test(dob) == false)
    {
    document.getElementById("statusDOB").innerHTML	= "<span class='warning'>DOB is only used to verify your age.</span>";
    }
    else
    {
    document.getElementById("statusDOB").innerHTML	= "<span class='valid'>Thanks, you have entered a valid DOB!</span>";	
    }
}
// validate address
function add_validate(address)
{
var regAdd = /^(?=.*\d)[a-zA-Z\s\d\/]+$/;
  
    if(regAdd.test(address) == false)
    {
    document.getElementById("statusAdd").innerHTML	= "<span class='warning'>Address is not valid yet.</span>";
    }
    else
    {
    document.getElementById("statusAdd").innerHTML	= "<span class='valid'>Thanks, Address looks valid!</span>";	
    }
}