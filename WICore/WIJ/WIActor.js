$(document).ready(function () {
    

  var actor_id = $.cookie("actor_id");


$.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: { 
            action : "actor",
            actor_id  : actor_id
        },
        error: function(xhr, status, error) {
  var err = eval("(" + xhr.responseText + ")");
  alert(err.Message);
},
        success : function(result){
           // console.log(result);
           $("#actor").html(result);
           
   }

});
$("body").delegate("a.show_link", "click", function(event){
            var show_link     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 30;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("show_link", show_link, {expires: date});
            
        });

$("body").delegate("a.company_link", "click", function(event){
            var copmany_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 30;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("theatre_id", theatre_id, {expires: date});
            
        });
	
});

var WIActor = {};

WIActor.show = function(actor_id){

	$.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: { 
            action : "actor_Info",
            actor_id  : actor_id
        },
        error: function(xhr, status, error) {
  var err = eval("(" + xhr.responseText + ")");
  alert(err.Message);
},
        success : function(result){
        	$("#shows").html(result);
        }

});
}



