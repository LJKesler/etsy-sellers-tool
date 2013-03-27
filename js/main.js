$(document).on("pageshow", "#home", function(){
	var username = localStorage.getItem("username");
	user.updateUserName(username);

	$.ajax({
		url: "http://sandbox.openapi.etsy.com/v2/private/users/__SELF__/shops.js?api_key=myh388wa8wpx2ukcfrjnwi1d",
		dataType: "JSONP"
	})
	.done(function(result){
		user.updateUserName(result.results[0].login_name);
	})
	.fail(function(){

	});
	
});

var user = {
	updateUserName : function(name){
		$("#username").text(name);
	},
	displayPermissions : function(result){
		
	}
}
var util = {

	oauthApiCall : function(data, callbackFn){
		$.get("./php/apiCall.php", data)
		.done(function(responseData){
			var result = $.parseJSON(responseData);
			callbackFn(result.response);
		})
		.fail(function(responseData){

		});
	}
}