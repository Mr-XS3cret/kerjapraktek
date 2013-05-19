function changeclass(theid,name){
	document.getElementById(theid).className=name;	
}

function loginmember(){
	user=document.getElementById("inputusername").value;
	pass=document.getElementById("inputpassword").value;
	document.getElementById("loginbutton").value='';
	document.getElementById("loginbutton").className='loggingon';
	Request.open("GET", "login.php?user="+user+"&pass="+pass, true)
	Request.onreadystatechange = function(){
		if(Request.readyState == 4){
			var login = Request.responseText;
			if(login==1){ 
				document.getElementById("loginbutton").className='submitbutton';
				document.getElementById("loginbutton").value='Login';
				alert("Login Salah!");
			}
			else{
				alert("Berhasil Login. Selamat datang "+user);
				window.location='?page=read&id=sp'; 
			}
		}
	}
	Request.send(null);
}



function showMenu(num){
	
	maxMenu = document.getElementById("nummenu").innerHTML;
	for(i=1;i<=maxMenu;i++){
		document.getElementById("menu"+i).style.display='none';
		document.getElementById("link"+i).innerHTML=i;
		document.getElementById("link"+i).style.display='none';
		document.getElementById("prev"+i).style.display='none';
		document.getElementById("next"+i).style.display='none';
	}
	document.getElementById("menu"+num).style.display='';
	document.getElementById("link"+num).innerHTML='['+num+']';
	document.getElementById("link"+num).style.display='';
	
	if(num!=maxMenu){
		document.getElementById("link"+(parseInt(num)+1)).style.display='';
	}
	if(num!=1){
		document.getElementById("link"+(parseInt(num)-1)).style.display='';
	}
	if(num==1){
		document.getElementById("link"+(parseInt(num)+2)).style.display='';
		document.getElementById("prev"+(parseInt(num))).style.display='';
		document.getElementById("next"+(parseInt(num))).style.display='';
	}
	if(num==maxMenu){
		document.getElementById("link"+(parseInt(num)-2)).style.display='';
		document.getElementById("prev"+(parseInt(num))).style.display='';
		document.getElementById("next"+(parseInt(num))).style.display='';
	}
	if(num!=1 && num!=maxMenu){
		document.getElementById("prev"+(parseInt(num))).style.display='';
		document.getElementById("next"+(parseInt(num))).style.display='';
	}
}

function createRequest(){
	var oAJAX = false;
	try {
		oAJAX = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			oAJAX = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e2) {
			oAJAX = false;
		}
	}
	if (!oAJAX && typeof XMLHttpRequest != 'undefined') {
		oAJAX = new XMLHttpRequest();
	}
	if (!oAJAX){
		alert("Error saat membuat XMLHttpRequest!");
	}
	return oAJAX;
}
	
Request = createRequest();


function login(){
	document.getElementById("login").style.display='none';
	document.getElementById("loader").style.display='';
	user = document.getElementById("username").value;
	pass = document.getElementById("password").value;	
	Request.open("GET", "manager/login.php?login=1&username="+user+"&password="+pass, true);	
	Request.onreadystatechange = function(){
		if(Request.readyState == 4){
			var login = Request.responseText;				
			if(login==0){ 
				alert("Login invalid !!");
				document.getElementById("login").style.display='';
				document.getElementById("loader").style.display='none';
			}
			else{
				alert(login);
				window.location='manager/'; 			
			}
		}
	}
	Request.send(null);
}

function showprod(img,lang){
	Request.open("GET", "listreagen.php?setlang="+lang+"&price="+img, true);	
	Request.onreadystatechange = function(){
		if(Request.readyState == 4){
			var output = Request.responseText;				
			document.getElementById("scroll").innerHTML=output;
		}
	}
	Request.send(null);
}