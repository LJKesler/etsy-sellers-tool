$(document).on( "pageshow", "#login", function( event ) {
	$("#submit").click(function(){
		
		var data = $("#login-form").serialize();

		$.post("./php/login.php", data)
		.done(function(responseData){
			var result = $.parseJSON(responseData).response;
			if(result == "success"){
				localStorage.setItem("username", $("#username").val());
				window.location = "http://leighkesler.com/etsydev/main.html";
			}else{
				$("#errormsg").text("Sorry, we cannot log you in at this time. Please try again later. Thanks!");	
			}
		})
		.fail(function(responseData){
			$("#errormsg").text("Sorry, we cannot register you in at this time. Please try again later. Thanks!");
		});		
	});
});

$(document).on("pageshow","#registration",function(event){
	$("#signUp").click(function(){
		var data = $("#registration-form").serialize();

		$.get('./php/registerStep1.php', data)
		.done(function(responseData){
			var result = $.parseJSON(responseData).response;

			if(result == "success"){
				$.mobile.navigate("#registration-step2");
			}else{
				$("#errormsg").text("Oops! Somebody has already taken that username. ");
			}
		})
		.fail(function(){
			$("#errormsg").text("Sorry, we cannot register you in at this time. Please try again later. Thanks!");
		});
	});
});

$(document).on("pageshow", "#registration-step2", function(event){
	var data = $("#registration-form-step2").serialize();
	$("#authorize").click(function(){
		$.post('./php/registerStep2.php', data)
		.done(function(responseData){
			var result = $.parseJSON(responseData).response;
			window.location = result;
		})
		.fail(function(){

		});
	});
});
