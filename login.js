$(document).ready(function(){
	$("#submit").click(function(){
		
		var uname = $("#username").val();
		var pwd = $("#password").val();
	
		$.post('etsyLogin.php', $("etsy-login").serialize())
			.done(function(data) {
			 	console.log("done");
			 	
				// $("#homeUsername").text(uname);
				// $.mobile.navigate("logged-in-home");
			})
			.fail(function(data){
				console.log("fail");
				$("#errormsg").text("I'm sorry, we cannot log you in at this time. Please try again later. Thanks!");
			});
	})
});