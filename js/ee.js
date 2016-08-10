var cat;
window.onload=function()
{
	document.getElementsByName("Email")[0].addEventListener("input",listen);
};
function listen()
{
	if(document.getElementsByName("Email")[0].value=="NYAN!")
	{
		document.getElementById("body-container").innerHTML+='<img id="cat" src="images/NOTsuspiciousGIF.gif" style="position:fixed; z-index:150;"/>';
		cat = document.getElementById("cat");
		start();
	}
}
function start()
{
	cat.style.height=(window.innerHeight/3)+"px";
	cat.style.width=(window.innerHeight/3*2.1875)+"px";
	cat.style.top=(window.innerHeight/3)+"px";
	update(window.innerWidth);
}
function update(right)
{
	if(right>=-window.innerHeight/3*2.1875-5)
	{
		cat.style.right=right+"px";
		setTimeout("update("+(right-5)+")",10);		
	}
	else
	{
		cat.parentNode.removeChild(cat);
		document.getElementsByName("Email")[0].addEventListener("input",listen);
	}
}