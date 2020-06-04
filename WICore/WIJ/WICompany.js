$(document).ready(function () {
    

  var company_id = $.cookie("company_id");


$.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: { 
            action : "company",
            company_id  : company_id
        },
        error: function(xhr, status, error) {
  var err = eval("(" + xhr.responseText + ")");
  alert(err.Message);
},
        success : function(result){
           // console.log(result);
           
    var jsonData = JSON.parse(result);
    console.log(jsonData);
    //alert(jsonData); 
   
    var company_id       = jsonData["id"];
    name       = jsonData["name"];
     address     = jsonData["address"];
     theatre_id   = jsonData["theatre_id"];
     country   = jsonData["country"];
     description    = jsonData["description"];
     start_date        = jsonData["start_date"];
     end_date        = jsonData["end_date"];
     img         = jsonData["photo"];
    //alert(name);

    	WICompany.show(company_id);
    	//WICompany.theatre(theatre_id);
    	//WICompany.cast(cast_id);
         $('#company_name').html(name);
        $('#start_date').html(start_date); 
        $('#end_date').html(end_date);
       $('#description').html(description); 
    //   $('#id').attr("id", id);
    //   $('#image').attr("src", img);

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

$("body").delegate("a.theatre_link", "click", function(event){
            var theatre_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 30;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("theatre_id", theatre_id, {expires: date});
            
        });
	
});

var WICompany = {};

WICompany.show = function(company_id){

	$.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: { 
            action : "company_shows",
            company_id  : company_id
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

WICompany.theatre = function(theatre_id){

	$.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: { 
            action : "theatre_Info",
            theatre_id  : theatre_id
        },
        error: function(xhr, status, error) {
  var err = eval("(" + xhr.responseText + ")");
  alert(err.Message);
},
        success : function(result){
        	$("#theatre").html(result);
        }

});
}

WICompany.cast = function(cast_id){

	$.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: { 
            action : "cast_Info",
            cast_id  : cast_id
        },
        error: function(xhr, status, error) {
  var err = eval("(" + xhr.responseText + ")");
  alert(err.Message);
},
        success : function(result){
        	$("#cast").html(result);
        }

});
}

