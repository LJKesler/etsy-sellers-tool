$(document).on("pageshow", "#home", function(){
	var username = localStorage.getItem("username");
	user.updateUserName(username);

	util.apiCall({apiUrl: '/oauth/scopes', user: username}, user.displayPermissions)
	
});

var user = {
	updateUserName : function(name){
		$("#username").text(name);
	},
	displayPermissions : function(result){
		alert(result);
	}
}
var util = {

	apiCall : function(data, callbackFn){
		$.get("./php/apiCall.php", data)
		.done(function(responseData){
			var result = $.parseJSON(responseData).reponse;
			callbackFn(result);
		})
		.fail(function(responseData){

		});
	}

}