var current_date=new Date();
window.onload = function()
{
	DrawCalendar( current_date.getDay(), current_date.getDate(), current_date.getMonth(), current_date.getFullYear() );
	document.getElementById("calendar_back").onclick=function(){ChangeMonth(-1)};
	document.getElementById("calendar_next").onclick=function(){ChangeMonth(1)};
	
}

Date.prototype.monthDays= function(){
    var d= new Date(this.getFullYear(), this.getMonth()+1, 0);
    return d.getDate();
}

function ChangeMonth(way)
{
	if(current_date.getMonth()<0&&way==-1)
	{
		current_date.setFullYear(current_date.getFullYear()-1);
		current_date.setMonth(11);
	}
	else if(current_date.getMonth()>11&&way==1)
	{
		current_date.setFullYear(current_date.getFullYear()+1);
		current_date.setMonth(1);
	}
	else
		current_date.setMonth(current_date.getMonth()+way);
	DrawCalendar( current_date.getDay(), current_date.getDate(), current_date.getMonth(), current_date.getFullYear() );
}

function DrawCalendar(week_day, day, month, year)
{
	var table = []; 
	while(table.push([]) < 6);
	
	var first = new Date(year,month,1);
	var firstDay=first.getDay();
	
	if(firstDay==0)
		firstDay=7;
	firstDay--;
	
	var days = 1;
	
	var prev = new Date(year,month-1).monthDays();
	
	for(var j = 0 ; j < 7 ; j++)
	{
		if(firstDay>j)
			table[0][j]=prev-firstDay+1+j;
		else
		{
			table[0][j]=days;
			days++;
		}
	}
	for(var i = 1 ; i < 6 ; i++)
	{
		for(var j = 0 ; j < 7 ; j++)
		{
			table[i][j]=days;
			days++;
			if(first.monthDays()<days)
				days=1;
		}
	}
	FillHTML(year,month,table);
}

function StrMonth(month)
{
	if(month==0)
		return "styczeń";
	else if(month==1)
		return "luty";
	else if(month==2)
		return "marzec";
	else if(month==3)
		return "kwiecień";
	else if(month==4)
		return "maj";
	else if(month==5)
		return "czerwiec";
	else if(month==6)
		return "lipiec";
	else if(month==7)
		return "sierpień";
	else if(month==8)
		return "wrzesień";
	else if(month==9)
		return "październik";
	else if(month==10)
		return "listopad";
	else if(month==11)
		return "grudzień";
}

function IsEvent(year, month, day, cell, school)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
	else
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			if(xmlhttp.responseText)
			{
				cell.style.backgroundColor="#c02020";
				cell.onclick=function()
				{
					document.getElementById("whatEvent").innerHTML=xmlhttp.responseText;
				};	
			}
		}
	};
	xmlhttp.open("GET", "../php/calendar_is_event.php?day="+day+"&month="+month+"&year="+year+"&school="+school+"&t="+Math.random(), true);
	xmlhttp.send();
}

function FillHTML(year,month,table)
{
	var school = document.getElementById("which_school").innerHTML;
	document.getElementById("calendar_year").innerHTML = year;
	document.getElementById("calendar_month").innerHTML = StrMonth(month);
	var current_color="#808080";
	for(var i = 0 ; i < 6 ; i++)
	{
		for(var j = 0 ; j < 7 ; j++)
		{
			var cell=document.getElementById("calendar_row_"+i).cells[j];
			cell.style.backgroundColor="";
			cell.onclick=null;
			if(table[i][j]==1)
			{
				if(current_color=="#808080")
					current_color="#ffffff";
				else
					current_color="#808080";
			}
			if(current_color=="#ffffff")
				IsEvent(year,month,table[i][j],cell,school);
			cell.innerText=table[i][j];
			cell.style.color=current_color;
			
		}
	}
}