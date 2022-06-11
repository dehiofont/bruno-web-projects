let password = document.getElementById("cPassword");
let vPassword = document.getElementById("vcPassword");
password.addEventListener('keyup', validate);
vPassword.addEventListener('keyup', validate);

let passMatchReq = document.getElementById("passMatchReq");
let passLengthReq = document.getElementById("passLengthReq");
let passNumReq = document.getElementById("passNumReq");

let pmatch = false;
let plength = false;
let pnum = false;

let createButton = document.getElementById("create-button");

let frontImg_darksouls = document.getElementById("front-image-darksouls");
let frontImg_zeldabreathofthewild = document.getElementById("front-image-zeldabreathofthewild");
let frontImg_celeste = document.getElementById("front-image-celeste");
let frontImg_supersmashbros = document.getElementById("front-image-supersmashbros");




createButton.setAttribute("disabled", "disabled");
//createButton.value = 'poop';


console.log

function validate(e)
{
    console.log('hit');
    if (password.value == vPassword.value)
    {
        if (password.value && vPassword.value)
        {
            passMatchReq.innerText = "PASSWORDS MATCH";
            passMatchReq.classList.remove("invalid");
            passMatchReq.classList.add("valid");
            pmatch = true;
        }
        else
        {
            passMatchReq.innerText = "";
            pmatch = false;
        }
    }
    else
    {
        passMatchReq.innerText = "PASSWORDS DO NOT MATCH";
        passMatchReq.classList.add("invalid");
        passMatchReq.classList.remove("valid");
        pmatch = false;
    }

    if (password.value.length >= 8)
    {
        if (password.value)
        {
            passLengthReq.innerText = "PASSWORD MINIMUM MET";
            passLengthReq.classList.remove("invalid");
            passLengthReq.classList.add("valid");
            plength = true;
        }
        else
        {
            passLengthReq.innerText = "";
            plength = false;
        }
    }
    else
    {
        passLengthReq.innerText = "PASSWORD 8 CHARACTER REQUIREMENT NOT MET";
        passLengthReq.classList.add("invalid");
        passLengthReq.classList.remove("valid");
        plength = false;
    }

    let pattern = /\d/;

    if (pattern.test(password.value))
    {
        if (password.value)
        {
            passNumReq.innerText = "PASSWORD NUMBER REQUIREMENT MET";
            passNumReq.classList.remove("invalid");
            passNumReq.classList.add("valid");
            pnum = true;
        }
        else
        {
            passNumReq.innerText = "";
            pnum = false;
        }
    }
    else
    {
        passNumReq.innerText = "PASSWORD MISSING NUMBER REQUIREMENT";
        passNumReq.classList.add("invalid");
        passNumReq.classList.remove("valid");
        pnum = false;
    }

    if (pmatch && plength && pnum)
    {
        createButton.removeAttribute("disabled");
    }
    else
    {
        createButton.setAttribute("disabled", "disabled");
    }

}






