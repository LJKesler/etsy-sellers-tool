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
				$("#errormsg").text("I'm sorry, we cannot log you in at this time. Please try again later. Thanks!");
			});
	});

	$("#new_username").blur(function(){

		console.log("blur");
	});
});