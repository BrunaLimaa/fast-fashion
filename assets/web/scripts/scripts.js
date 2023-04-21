var menuItems = document.getElementById("menuItems");

menuItems.style.maxHeight = "0px";

function menutoggle(){

    if( menuItems.style.maxHeight == "0px" ) {

        menuItems.style.maxHeight = "300px";
        
    } else {
        menuItems.style.maxHeight = "0px";
    }
}


var loginForm = document.getElementById("login-form");
var registerForm = document.getElementById("register-form");
var indicator = document.getElementById("indicator");

function register(){
    registerForm.style.transform = "translateX(0px)";
    loginForm.style.transform = "translateX(0px)";
    indicator.style.transform = "translateX(60px)";
}

function login(){
    registerForm.style.transform = "translateX(300px)";
    loginForm.style.transform = "translateX(300px)";
    indicator.style.transform = "translateX(-60px)";

}