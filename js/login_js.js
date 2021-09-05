
function Validate(txt) {
    txt.value = txt.value.replace(/[^a-zA-Z-'\n\r.]+/g, '');
}

// validate email
// function email_validate(email)
// {
// var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

//     if(regMail.test(email) == false)
//     {
//     document.getElementById("status").innerHTML    = "<span class='warning'>Email address is not valid yet.</span>";
//     }
//     else
//     {
//     document.getElementById("status").innerHTML	= "<span class='valid'>Thanks, you have entered a valid Email address!</span>";	
//     }
// }
function email_validate(email) {
    var status = document.getElementById("status");
    regMail = /^([a-zA-z0-9\.-]+)@([a-zA-z0-9-]+).([a-zA-z]{2,3}){1}$/;
    if (regMail.test(email)) {
        status.innerHTML = "<span class='valid'>Thanks, you have entered a valid Email address!</span>";
        status.style.color = "green";
    } else {
        status.innerHTML = "<span class='warning'>Email address is not valid yet.</span>";
        status.style.color = "red";

    }

}