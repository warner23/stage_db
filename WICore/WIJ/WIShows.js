$(document).ready(function () {

WIShows.ShowTrailers();

$( "#Shows_search" ).keypress(function() {
  var search = $("#Shows_search").val();
  if (search != "") {
    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "SearchShows",
        search   : search
      },
      success  : function(data){
          $("#searchresultscontainer").html(data);
          $("#searchresultscontainer").css("display", "block")
        }
      });
  }
});

$(".search").mousedown(function(event) {
  $("#searchresultscontainer").css("display", "block")
});


$(document).click(function(event) { 
    if(!$(event.target).closest('.search').length) {
        if($('#searchresultscontainer').is(":visible")) {
            $('#searchresultscontainer').hide();
        }
    }        
});

    $('a.show_link').mousedown(function(event) {
    switch (event.which) {
        case 1:
            var show_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 60;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("show_id", show_id, {expires: date});
            break;
        case 2:
            var show_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 60;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("show_id", show_id, {expires: date});
            break;
        case 3:
            var show_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 60;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("show_id", show_id, {expires: date});
            break;
        default:
           var show_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 60;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("show_id", show_id, {expires: date});
    }
});

    $("body").delegate("a.show_link", "click", function(event){
            var show_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 60;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("show_id", show_id, {expires: date});
            
        });


     $('a.theatre_link').mousedown(function(event) {
    switch (event.which) {
        case 1:
            var theatre_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 60;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("theatre_id", theatre_id, {expires: date});
            break;
        case 2:
            var theatre_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 60;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("theatre_id", theatre_id, {expires: date});
            break;
        case 3:
            var theatre_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 60;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("theatre_id", theatre_id, {expires: date});
            break;
        default:
           var theatre_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 60;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("theatre_id", theatre_id, {expires: date});
    }
});

    $("body").delegate("a.theatre_link", "click", function(event){
            var theatre_id     = this.id;
            //alert(product_id);
            //$.cookie.set("product_id", "product_id");

             var date = new Date();
 var minutes = 60;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("theatre_id", theatre_id, {expires: date});
            
        });



    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});

	
});

var WIShows = {};

WIShows.Search = function(){
  var search = $("#Shows_search").val();
  if (search != "") {
    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "SearchShows",
        search   : search
      },
      success  : function(data){
          $("#searchresultscontainer").html(data);
        }
      });
  }
}

WIShows.ShowTrailers = function(){

    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "ShowTrailers"
      },
      success  : function(data){

          $("#showShows").html(data);
        }
      });
}

WIShows.ExitSearch = function(){
WIShows.ShowTrailers();
}

WIShows.uploadCsv = function(){
  
}

WIShows.NextShows = function(page){

        $(".loading-div").removeClass('closed'); //remove closed element
        $(".loading-div").addClass('open'); //show loading element
        //var page = $(this).attr("data-page"); //get page number from link

             $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "NextShowsPage",
            page : page
        },
        success: function(result)
        {
            $("#shows").html(result);
              $(".loading-div").removeClass('open'); //remove closed element
        $(".loading-div").addClass('closed'); //show loading element
        }
       
    });
}