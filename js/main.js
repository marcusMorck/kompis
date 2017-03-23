$(document).ready(function(){
	$.ajax({
		url:"../includes/session.php",
		cache:false,
		success:function(data){
			if(data == "true"){
				$("#logout_button").show();
				$("#log_button").hide();
			}else{
				$("#logout_button").hide();
			}
		}
	});
	
	$("#banner").click(function(){
		window.location = "../index.html";				
	});
	$("#log_button").click(function(){
		window.location = "../html/login.html"
	});
	$("#reg_button").click(function(){
		window.location = "../html/reg.html";
	});
	$("#page_button").click(function(){
		window.location = "../html/my_page.php";
	});
	$("#home_button").click(function(){
		window.location = "../html/homework.php";
	});
	$("#baby_button").click(function(){
		window.location = "../html/babysitter.php";
	});
	$("#info_button").click(function(){
		window.location = "../html/info.html";
	});
	$("#cont_button").click(function(){
		window.location = "../html/contact.html";
	});
	$("#logout_button").click(function(){
		window.location = "../includes/logout.inc.php"
	});
	$("#forgot_pass_button").click(function(){
		console.log("Glömt Lösenord");
	});
	$("#change").click(function(){
		window.location = "../html/change.html";
	});
	$("#drop_down").change(function() {	
		var value = $(this).val();
		if(value == 1){ window.location = "index.html";     }
		if(value == 2){ window.location = "../html/reg.html"; 	    }
		if(value == 3){ window.location = "../html/my_page.php";   }
		if(value == 4){ window.location = "../html/homework.php";  }
		if(value == 5){ window.location = "../html/babysitter.php";}
		if(value == 6){ window.location = "../html/info.html";	    }
		if(value == 7){ window.location = "../html/contact.html";   } 
		if(value == 8){ window.location = "../html/change.html";    }
	});
	$("#hideTemplate").show();
	$("#hideChild").show();
});

function check(){
	var password = document.getElementById("pass").value;
	var password2 = document.getElementById("pass2").value;
	var mail = document.getElementById("mail").value;
	if(password != password2){
		alert("Lösenorden stämmer inte överrens!");
		return false;
	}
	if(!mail.includes("@")||!mail.includes(".")){
		alert("Något gick fel med din mejl");
		return false;
	}
	if(password.length < 8){
		alert("Inte tillräckligt långt lösenord!");
		return false;
	}
	if(password == password.toLowerCase()){
		alert("Du måste ha minst en storbokstav!");
		return false;
	}
	return true;
}

function babysitter_received(){
	$('#vakt').empty();
	$('#vakt').append($('<option>',{
		value: 1,
		text: 'Välj Barnvakt'
	}));
	var start = document.getElementById("start").value;
	start = start.replace("T", " ");
	var end = document.getElementById("end").value;
	end = end.replace("T", " ");
	if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
	}else{
		xmlhttp = new ActiveXObjext("Microsoft.XMLHTTP");
	}
		xmlhttp.onreadystatechange = function(){		
	if(this.readyState == 4 && this.status == 200){
		var select = document.getElementById("vakt");
		var result = this.responseText.split("\n");
		for(var i = 0; i < result.length; i++){
			if(result[i] != "") {
				var option = document.createElement("option");
				option.text = result[i];
				select.add(option);
				}
			}
		}
	};
	xmlhttp.open("GET", "../includes/showbabysitter.php?starttime=" + start + "&endtime=" + end, true);
	xmlhttp.send(); 
}

function tutor_received(){
	$('#vakt').empty();
	$('#vakt').append($('<option>',{
		value: 1,
		text: 'Välj Läxhjälp'
	}));
	var start = document.getElementById("start").value;
	start = start.replace("T", " ");
	var end = document.getElementById("end").value;
	end = end.replace("T", " ");
	if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}else{
		xmlhttp = new ActiveXObjext("Microsoft.XMLHTTP");
	}
	var json = { users: [ ]};
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			var select = document.getElementById("vakt");
			var result = this.responseText.split("\n");
			for(var i in result) {
				json.users[i] = result[i];
			}
			for(var i = 0; i < json.users.length; i++){
				if(json.users[i] != "") {
					var option = document.createElement("option");
					option.text = json.users[i];
					select.add(option);
				}
			}
		}
	};
	xmlhttp.open("GET", "../includes/showtutor.php?starttime=" + start + "&endtime=" + end, true);
	xmlhttp.send();
}