$().ready(function(){
	var username = localStorage.getItem("username");
	user.updateUserName(username);

});

var user = {
	updateUserName : function(name){
		$("#username").text(name);
	}
}