let login = document.getElementById('login');
let reg = document.getElementById('reg');
let loginbtn = document.getElementById('loginbtn');
let regbtn = document.getElementById('regbtn');
let box = document.getElementById('box');
let pass = document.getElementById('pass');
let rpass = document.getElementById('rpass');
let msg = document.getElementById('msg');
let email = document.getElementById('email');
let name = document.getElementById('name');
let userName = document.getElementById('Username');
let submit = document.getElementById('regg');

let changeToReg = function () {
    loginbtn.className = "btn1";
    regbtn.className = "btn1 btn1-active";
    login.style.display = "none";
    reg.style.display = "block";
    reg.style.animationName = "animelogin";
    box.style.height= "600px";
    box.style.marginTop = "1%";
    
}

let changeToLogin = function () {
    loginbtn.className = "btn1 btn1-active";
    regbtn.className = "btn1";
    login.style.display = "block";
    login.style.animationName = "animelogin";
    reg.style.display = "none";
     box.style.height= "500px";
    box.style.marginTop = "7%";
     msg.style.display = "none";
}
let pwd = 0;
let eml = 0;
let check = function() {
    
    if(pass.value != rpass.value ) {
       
        msg.innerHTML = "Password did not match";
        msg.style.display = "inline-block";
        msg.style.animationName = "msg";
        pwd = 0;
       }
    else if( pass.value.length < 8 ) {
        
        msg.innerHTML = "Password must contain at least 8 characters";
        msg.style.display = "inline-block";
        msg.style.animationName = "msg";
        pwd = 0;
    }
    else {
        
        msg.style.display = "none";
        pwd = 1;
    }
    
}
let time = setInterval("btn()" , 10);

let  btn = function() {   
    console.log(pwd + " " + eml);
    
    if(pwd == 1 && eml == 1 && name.value != "" && userName.value != "" && email.value != "") {
       
            console.log(2);        
            submit.style.display = "inline-block";
            submit.style.animationName = "reg";
            clearInterval(time);
       }
                       
    }

let checkEmail = function() {
    
    if(!email.value.includes('@') && !email.value.includes('.')) {
        
        msg.innerHTML = "Invalid Email";
        msg.style.display = "inline-block";
        msg.style.animationName = "msg";
        eml = 0;
    }
    else {
         eml = 1;
         msg.style.display = "none";
    }
}