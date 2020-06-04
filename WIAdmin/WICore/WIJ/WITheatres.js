$(document).ready(function(event)
{
  WITheatres.showEditTheatre();


});

var WITheatres = {};


WITheatres.ExitSearch = function(){
  WITheatres.showEditTheatre();
}

WITheatres.Search = function(){
  var search = $("#Theatre_search").val();
  if (search != "") {
    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "SearchTheatre",
        search   : search
      },
      success  : function(data){

          $("#showTheatres").html(data);
        }
      });
  }
}

WITheatres.delete = function(id){

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "deleteTheatre",
        id   : id
      },
      success  : function(data){

        var res = JSON.parse(data);

        if (res.status == "success") {
          WITheatres.showEditTheatre();

        }
      }
    });
}

WITheatres.dropAndDragUpload = function(table, selector, folder, id_selector, img_selector ){


    $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "uploadCSV",
            table : table,
            ele_id : selector,
            folder  : folder,
            id_selector : id_selector,
            img_selector : img_selector
                    },
        success: function(result)
        {

          $("#mediaupload").html(result);
          $("#modal-"+selector+"-upload").removeClass("off").addClass("on");
         
        }
    });

};

WITheatres.InstallCSV = function(csv, table)
{
var ele_id = "theatres";
      $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "installCSV",
            csv : csv,
            table : table
                    },
        success: function(result)
        {
          $("#modal-"+ele_id+"-upload").removeClass(`on`).addClass(`off`);
          WITheatres.showEditTheatre();
        }
    });
}

WITheatres.addTheatreInfo = function(){
  var name = $("#addTheatre-name").val()
  var line1 = $("#line_one").val()
  var line2 = $("#line_two").val()
  var city = $("#city").val()
  var region = $("#region").val()
  var postcode = $("#postcode").val()
  var country = $("#countries").val()
  var bio = $("textarea#addTheatre-bio").val()
  var img =$(".theatreImg").attr('value');

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
        action : "createTheatre",
        name   : name,
        line1 : line1,
        line2 : line2,
        city : city,
        region : region,
        country  :country,
        bio    : bio,
        img    : img
      },
      success  : function(data){

        var res = JSON.parse(data);

        if (res.status == "success") {
          WITheatres.close('theatres');
          WITheatres.showEditTheatre();

        }else if(res.status == "error"){
          WICore.displayaerrorsMessage($("#AddTheatreResults"), res.msg);
        }
      }
    });

}

WITheatres.addTheatre = function(){
   var ele_id = "theatres";
  var preview_id = "new";
  var preview_class = "img-responsive-new";
      $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "newPersonModal",
        ele_id : ele_id,
        preview_class : preview_class,
        preview_id : preview_id
      },
      success  : function(data){
        $("#modal").html(data);
        $("#modal-"+ele_id+"-details").removeClass('hide').addClass('show')
      }
    });
}

WITheatres.close = function(ele_id){
  $("#modal-"+ele_id+"-details").removeClass('show').addClass('hide');
}

WITheatres.showEditTheatre = function(){

    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "showEditTheatre"
      },
      success  : function(data){
        $("#showTheatres").html(data);
      }
    });
}


WITheatres.editTheatre = function(id){

  var name = $("#name-"+id).val()
  var line1 = $("#line1-"+id).val()
  var line2 = $("#line2-"+id).val()
  var city = $("#city-"+id).val()
  var region = $("#region-"+id).val()
  var postcode = $("#postcode-"+id).val()
  var country = $("select#countries"+id).val()
  var bio = $("textarea#bio-"+id).val()
  var img =$(".theatreImg").attr('value');
  var da  = $("#wheelchair_access").attr('value');
  var dt  = $("#disabled_toliets").attr('value');
  var wc  = $("#toliets").attr('value');
  var bar  = $("#bar").attr('value');
  var hearing  = $("#loop_system").attr('value');
  var disabled_parking  = $("#disabled_parking").attr('value');
  var guide_dogs  = $("#guide_dogs").attr('value');
  var stairs  = $("#stairs").attr('value');



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
        action : "editTheatre",
        id     : id,
        name   : name,
        bio    : bio,
        line1  : line1,
        line2  : line2,
        city  : city,
        region  : region,
        postcode  : postcode,
        country  : country,
        img    : img,
        da     : da,
        dt     : dt,
        wc     : wc,
        bar   : bar,
        hearing : hearing,
        guide_dogs : guide_dogs,
        stairs   : stairs,
        disabled_parking : disabled_parking

      },
      success  : function(data){
        WITheatres.showEditTheatre();
      }
    });

}

WITheatres.pics = function(){

    var ele_id = $(".img-preview").attr("id");
    var selector = "theatres";

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "mediaPictures",
        selector : selector,
        ele_id  : ele_id
      },
      success  : function(data){
        $("#theatres-body").html(data);
      }
    });
}


WITheatres.clearTheatre = function(id){
  $("#edit-"+id).remove();

  var MediaManager = ('<div class="img-media" id="edit-'+id+'"></div>'+
             '<div class="well on" id="uploadOptions">'+
                      '<a href="javascript:void(0);" class="btn media_manager" onclick="WIMedia.MediaManager(`theatres`,`edit-'+id+'`, `theatreImg`, `edit-'+id+'`, `theatres`)">Upload from WIMedia Library</a>'+
                      '<a href="javascript:void(0);" class="btn media_manager" onclick="WIMedia.dropAndDragUpload(`theatres`, `wi_theatres`,`theatres`,`theatres`,`edit-'+id+'`)">upload from computer</a>'+
                    '</div>');
    $("#theatre_change_pic-"+id).append(MediaManager);
}

WITheatres.NextTheatre = function(page){

        $(".loading-div").removeClass('closed'); //remove closed element
        $(".loading-div").addClass('open'); //show loading element
        //var page = $(this).attr("data-page"); //get page number from link

             $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "NextTheatrePage",
            page : page
        },
        success: function(result)
        {
            $("#showTheatres").html(result);
              $(".loading-div").removeClass('open'); //remove closed element
        $(".loading-div").addClass('closed'); //show loading element
        }
       
    });
}


WITheatres.dropAndDragBulkUpload = function(selector, folder, id_selector, img_selector ){


    $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "BulkUpload",
            ele_id : selector,
            folder  : folder,
            id_selector : id_selector,
            img_selector : img_selector
                    },
        success: function(result)
        {
          $("#mediaupload").html(result);
          $("#modal-"+selector+"-upload").removeClass("off").addClass("on");
            
        }
    });

};