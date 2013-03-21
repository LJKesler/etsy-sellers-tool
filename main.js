$().ready(function(){

	user.updateUserName('abc');

});

var user = {
	updateUserName : function(name){
		$("#username").text(name);
	}
}