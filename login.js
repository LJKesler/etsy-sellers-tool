$().ready(function(){
	$("#submit").click(function(){
		
		var uname = $("#username").val();
		var pwd = $("#password").val();
		var data = $("#etsy-login").serialize();
	$.mobile.navigate("main.html");
		$.post('./php/etsyLogin.php', data, 'json')
			.done(function(responseData) {
				var response = $.parseJSON(responseData);
				var url = response.response
				window.location(url);
				
			})
			.fail(function(data){
				$("#errormsg").text("I'm sorry, we cannot log you in at this time. Please try again later. Thanks!");
			});
	});

	$("#register").click(function(){
		var data = $("#registration-form").serialize();
		$.post('./php/etsyLogin.php', data, 'json')
			.done(function(responseData) {
				var response = $.parseJSON(responseData);
				var url = response.response
				window.location(url);
			})
			.fail(function(data){
				$("#errormsg").text("I'm sorry, we cannot register you in at this time. Please try again later. Thanks!");
				$("#errormsg").show();
			});
	});

	$("#new_username").blur(function(){
		$("#errormsg").hide();
		$.get('./php/verifyUserAvailable.php', { name: '"' + this.value + '"'})
			.done(function(responseData){
				var result = $.parseJSON(responseData);
				result = $.parseJSON(result).response;

				if(result == "available"){
					$("#step2").show();

				}else{
					$("#errormsg").text("Oops! Somebody has already taken that username. ");
					$("#errormsg").show();	
				}
			})
			.fail(function(){
				$("#errormsg").text("I'm sorry, we cannot register you in at this time. Please try again later. Thanks!");
			});
	});
});