$(document).ready(function () {
    

  var show_id = $.cookie("show_id");
//alert(show_id);


$.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: { 
            action : "ViewShow",
            show_id  : show_id
        },
        error: function(xhr, status, error) {
  var err = eval("(" + xhr.responseText + ")");
  alert(err.Message);
},
        success : function(result){
           // console.log(result);
           $("#showing").html(result);
           $("iframe").addClass("ytshowTrailer");
           
   }

});

$("body").delegate("a.company_link", "click", function(event){
            var company_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 30;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("company_id", company_id, {expires: date});
            
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
	


$("body").delegate("a.cast_link", "click", function(event){
            var actor_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 30;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("actor_id", actor_id, {expires: date});
            
        });

});


var WIShow = {};

WIShow.delete = function(id){

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "deleteShows",
        id   : id
      },
      success  : function(data){

        var res = JSON.parse(data);

        if (res.status == "success") {
          WIShows.showEditShows();

        }
      }
    });
}

WIShow.company = function(company_id){

	$.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: { 
            action : "company_Info",
            company_id  : company_id
        },
        error: function(xhr, status, error) {
  var err = eval("(" + xhr.responseText + ")");
  alert(err.Message);
},
        success : function(result){
        	$("#company").html(result);
        }

});
}

WIShow.theatre = function(theatre_id){

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

WIShow.cast = function(cast_id){

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

WIShow.editShows = function(id){

  var name = $("#name-"+id).val()
  var line1 = $("#line1-"+id).val()
  var line2 = $("#line2-"+id).val()
  var city = $("#city-"+id).val()
  var region = $("#region-"+id).val()
  var postcode = $("#postcode-"+id).val()
  var country = $("#countries"+id).val()
  var bio = $("textarea#bio-"+id).val()
  var img =$(".ShowsImg").attr('value');

  if (img == ""){
    var img = null;
  }

    if (line1 == ""){
    var line1 = null;
  }

  if (line2 == ""){
    var line2 = null;
  }

  if (city == ""){
    var city = null;
  }

  if (region == ""){
    var region = null;
  }

  if (postcode == ""){
    var postcode = null;
  }


  if (country =="") {
    var country = null;
  }

  if (bio =="") {
    var bio = null;
  }

       $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "editShows",
        id     : id,
        name   : name,
        bio    : bio,
        line1  : line1,
        line2  : line2,
        city  : city,
        region  : region,
        postcode  : postcode,
        country  : country,
        img    : img
      },
      success  : function(data){
        WIShows.showEditShows();
      }
    });

}