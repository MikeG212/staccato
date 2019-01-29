$(document).ready(function() {
    $("#hideLogin").click(function() {
        console.log("Hide login clicked");
        $("#loginForm").hide();
        $("#registerForm").show();
    });
    $("#hideRegister").click(function () {
        $("#registerForm").hide();
        $("#loginForm").show(); 
    });
});