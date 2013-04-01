var Shop = Backbone.Model.extend({
	
});
var ShopList = Backbone.Collection.extend({
	model: Shop,
	localStorage: new Backbone.LocalStorage("ShopListCollection")
});
var ShopView = Backbone.View.extend({
	tagName: "ul",
	className: "shops",
	initialize: function(){
		this.render();
	},
	render: function(){
		var context = {shops: [{name:'ljk'},{name:"123"}]};
		var template = Handlebars.compile($("#shop-template").html());
		$("#shops-list").html(template(context));

	}
});