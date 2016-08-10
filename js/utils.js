//Poniższe 2 funkcje pochodzą z adresu http://www.w3schools.com/js/js_cookies.asp

//Ustawia ciasteczko o nazwie cname, treści cvalue na czas exdays dni.
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

//Zwraca wartość ciasteczka o podanej nazwie.
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

function closeCookieMessage(boxHandle)
{
    document.getElementById("cookieMessage").style.display='none';
    setCookie("cookieAgree", "true", 30);
}

function validateEmail(email)
{
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
    {
        return false;
    }
    return true;
}
function validatePassword(pass)
{
    if(pass.length < 8)
        return false;
    return true;
}
function validatePassword2(pass, pass2)
{
    if(pass == pass2)
        return true;
    return false;
}
function validateName(name)
{
    if(name.length < 3)
        return false;
    return true;
}
function validateSurname(surname)
{
    if(surname.length < 3)
        return false;
    return true;
}
function validatePhone(phone)
{
    if(phone.length == 0)
        return true;
    var result = /[0-9\+\-\(\) ]{8,20}/.exec(phone);
    if(result == null)
        return false;
    if(result.index != 0)
        return false;
    return true;
}
function validateType(type)
{
    if(type == 0)
        return false;
    return true;   
}
