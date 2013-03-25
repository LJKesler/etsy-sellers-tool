$(document).on( "pageshow", "#login", function( event ) {
	$("#submit").click(function(){
		
		var uname = $("#username").val();
		var pwd = $("#password").val();
		
		$.mobile.navigate("main.html");
		
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
				$("#errormsg").show();	
			}
		})
		.fail(function(){
			$("#errormsg").text("Sorry, we cannot register you in at this time. Please try again later. Thanks!");
		});
	});
});

$(document).on("pageshow", "#registration-step2", function(event){
	$("#authorize").click(function(){
		$.get('./php/registerStep2.php')
		.done(function(responseData){
			var result = $.parseJSON(responseData).response;
			window.location = result;
		})
		.fail(function(){

		});
	});
});
