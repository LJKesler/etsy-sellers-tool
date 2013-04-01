var userShops;

$(document).on("pageshow", "#home", function(){
	var username = localStorage.getItem("username");
	username = "ljkesler";
	$.ajax({
		url: "http://sandbox.openapi.etsy.com/v2/private/users/" + username +"/shops.js?api_key=myh388wa8wpx2ukcfrjnwi1d",
		dataType: "JSONP"
	})
	.done(function(result){
		var numberOfShops = result.count;
		userShops = new ShopList();
		if(numberOfShops >= 1){
			for(var i=0; i<result.results.length; i++){
				var entry = result.results[i];

				var shop = new Shop({
					name: "\"" + entry.shop_name + "\"",
					vacationMode:entry.is_vacation,
					shopId: entry.shop_id,
					activeListings: entry.listings_active_count
				});

				userShops.add(shop);
			}
		}
		var user = new User({name: username});
	})
	.fail(function(){
		/*Error Handling*/
	});	
});

$(document).on("pageshow", "#listings", function(){
	var shopView = new ShopView();
});

var util = {

	oauthApiCall : function(data, callbackFn){
		$.get("./php/apiCall.php", data)
		.done(function(responseData){
			var result = $.parseJSON(responseData);
			callbackFn(result.response);
		})
		.fail(function(responseData){

		});
	},
	createUser : function(username){
		return new User({name:username});
	}
}