$(document).ready(function(event)
{
  WIShows.showEditShows();
 	//WIShows.showAll();  

});

var WIShows = {};


WIShows.dropAndDragBulkUpload = function(selector, folder, id_selector, img_selector ){


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


WIShows.dropAndDragUpload = function(selector, folder, id_selector, img_selector ){


    $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "uploadCSV",
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

WIShows.ExitSearch = function(){
  WIShows.showEditShows();
}

WIShows.ClearCompany = function(id){
  $("#chose_company_"+id).remove();
  var div = '<a href="javascript:void(0);" class="btn btn-primary show" id="findCompanies_'+id+'" onclick="WIShows.editFindCompany('+id+')">Find Company</a>'+
                          '<div id="company_find_edit_'+id+'" class="hide">'+
                          '</div>';

  $("#change_company_"+id).append(div);
}

WIShows.ClearTheatre = function(id){
  $("#chose_theatre_"+id).remove();
  var div = '<a href="javascript:void(0);" class="btn btn-primary show" id="editFindTheatre'+id+'" onclick="WIShows.editFindTheatre('+id+')">Find Theatre</a>'+
                          '<div id="theatre_find_edit_'+id+'" class="hide">'+
                          '</div>';

  $("#change_theatre_"+id).append(div);
}

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

          $("#showShows").html(data);
        }
      });
  }
}

WIShows.delete = function(id){

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


WIShows.deleteTrailer = function(id){

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "deleteTrailer",
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

WIShows.addShowsInfo = function(){
  var ele_id = "shows";
  var name = $("#addShows-name").val()
  var theatre_name = $("#addShows-theatre-name").val()
  var theatre_location = $("#addShows-theatre-location").val()
  var theatre_id = $("#addShows-theatre-id").attr('value')
  var company = $("#addShows-company-name").val()
  var company_id = $("#addShows-company-id").val()
  var start_date = $("#datepickersdate").val()
  var end_date = $("#datepickerfdate").val()
  var bio = $("textarea#addShows-bio").val()
  var img =$("#preview-new").attr('value');

    if(name && name != "") {
        WICore.displayaerrorsMessage($("#addShows-name"),"Name Field Cannot be Blank");
    }

    if(theatre_name && theatre_name != "") {
        WICore.displayaerrorsMessage($("#addShows-theatre-name"),"Theatre Field Cannot be Blank");
    }

    if(theatre_location && theatre_location != "") {
        WICore.displayaerrorsMessage($("#addShows-theatre-location"),"Theatre Field Cannot be Blank");
    }


    if(company && company != "") {
        WICore.displayaerrorsMessage($("#addShows-company-name"),"Theatre Field Cannot be Blank");
    }

   if(start_date && start_date != "") {
        WICore.displayaerrorsMessage($("#datepickersdate"),"Theatre Field Cannot be Blank");
    }

   if(end_date && end_date != "") {
        WICore.displayaerrorsMessage($("#datepickerfdate"),"Theatre Field Cannot be Blank");
    }

 if(bio && bio != "") {
        WICore.displayaerrorsMessage($("textarea#addShows-bio"),"Biology Field Cannot be Blank");
    }

     if(img && img != "") {
        WICore.displayaerrorsMessage($("#preview-new"),"All shows MUST have an image attached");
    }

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "createShows",
        name   : name,
        theatre_name : theatre_name,
        theatre_location : theatre_location,
        theatre_id : theatre_id,
        company : company,
        company_id  :company_id,
        start_date : start_date,
        end_date : end_date,
        bio    : bio,
        img    : img
      },
      success  : function(data){

        var res = JSON.parse(data);

        if (res.status == "success") {
          WIShows.close(ele_id);
          WIShows.showEditShows();

        }else if(res.status == "error"){
          WICore.displayaerrorsMessage($("#AddShowsResults"), res.msg);
        }
      }
    });

}

WIShows.addShows = function(){
   var ele_id = "shows";
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
        $("#modal-"+ele_id+"-details").removeClass('hide').addClass('show');
        WIShows.showEditShows();
      }
    });
}

WIShows.addTrailer = function(show_id, theatre_id){

ele_id = "trailer";
var src  = $("#addshow-trailer").val();
      $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "addTrailer",
        show_id : show_id,
        theatre_id : theatre_id,
        src : src
      },
      success  : function(data){
        $("#modal-"+ele_id+"-upload").removeClass('on').addClass('off')
        WIShows.showEditShows();
      }
    });
}

WIShows.close = function(ele_id){
  $("#modal-"+ele_id+"-details").removeClass('show').addClass('hide');
}

WIShows.showEditShows = function(){

    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "showEditShows"
      },
      success  : function(data){
        $("#showShows").html(data);
      }
    });
}


WIShows.editShows = function(id){

  var name = $("#name-"+id).val();
  var theatre = $("#addShows-theatre_"+id).val();
  var theatre_id = $("#addShows-theatre-id_"+id).attr('value');
  var company = $("#addeditShows_company_name_"+id).val();
  var company_id = $("#addShows_company_id_"+id).attr('value');
  var bio = $("textarea#bio-"+id).val();
  var img =$("#preview-edit-"+id+".showsImg").attr('value');
  var start_date = $("#datepickersdate_"+id).attr('value');
  var end_date = $("#datepickerfdate_"+id).attr('value');

  if (img == ""){
    var img = null;
  }

    if(name && name != "") {
        WICore.displayaerrorsMessage($("#name-"+id),"Name Field Cannot be Blank");
    }

    if(theatre && theatre != "") {
        WICore.displayaerrorsMessage($("#theatre-"+id),"Theatre Field Cannot be Blank");
    }

     /*   if(location && location != "") {
        WICore.displayaerrorsMessage($("#location-"+id),"Theatre Field Cannot be Blank");
    }*/

 if(bio && bio != "") {
        WICore.displayaerrorsMessage($("textarea#bio-"+id),"Biology Field Cannot be Blank");
    }

     if(img && img != "") {
        WICore.displayaerrorsMessage($(".ShowsImg"),"All shows MUST have an image attached");
    }

       $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "editShows",
        id     : id,
        name   : name,
        bio    : bio,
        theatre  : theatre,
        theatre_id  : theatre_id,
        company  : company,
        company_id  : company_id,
        start_date  : start_date,
        end_date  : end_date,
        img    : img
      },
      success  : function(data){
        WIShows.showEditShows();
      }
    });

}

WIShows.findTheatres = function(id){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "findTheatres",
        show_id : id
      },
      success  : function(data){
        $("#findTheatres").removeClass('show').addClass('hide');
        $("#theatres").removeClass('hide').addClass('show');
        $("#theatres").html(data);
      }
    });
}


WIShows.editFindTheatre = function(id){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "editFindTheatres",
        id     : id
      },
      success  : function(data){
        $("#editFindTheatre"+id).removeClass('show').addClass('hide');
        $("#theatre_find_edit_"+id).removeClass('hide').addClass('show');
        $("#theatre_find_edit_"+id).html(data);
      }
    });
}

WIShows.findCompany = function(){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "findCompany"
      },
      success  : function(data){
        $("#findCompanies").removeClass('show').addClass('hide');
        $("#company").removeClass('hide').addClass('show');
        $("#company").html(data);
      }
    });
}


WIShows.editFindCompany = function(id){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "editFindCompany",
        id     : id
      },
      success  : function(data){
        $("#findCompanies_"+id).remove();
        $("#company_find_edit_"+id).removeClass('hide').addClass('show');
        $("#company_find_edit_"+id).html(data);
      }
    });
}

WIShows.addTheatreLoc = function(id, edit_id){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "getTheatre_info",
        id     : id
      },
      success  : function(data){

        $("#theatres").html(data);
      }
    });
}

WIShows.editAddTheatreLoc = function(id, edit_id){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "editGetTheatre_info",
        id     : id,
        show_id : edit_id
      },
      success  : function(data){
        $("#theatre_find_edit_"+edit_id).remove();
        $("#edittheatres_"+edit_id).removeClass('hide').addClass('show');
        $("#change_theatre_"+edit_id).html(data);
      }
    });
}


WIShows.addCompanyInfo = function(id){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "getCompany_info",
        id     : id
      },
      success  : function(data){

        $("#company").html(data);
      }
    });
}

WIShows.addEditCompanyInfo = function(company_id, id){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "editGetCompany_info",
        company_id :company_id,
        id     : id
      },
      success  : function(data){
        $("#company_find_edit_"+id).remove()
        $("#change_company_"+id).html(data);
      }
    });
}

WIShows.createTrailer = function(show_id, theatre_id){
  var ele_id ="trailer";
 var table = "wi_theatre_trailers";
 var folder = "shows/trailers/";
 var id_selector = "show_trailer";
  var img_selector = "show_trailer";
   $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "createTrailer",
        ele_id : ele_id,
        table  : table,
        folder : folder,
        id_selector : id_selector,
        img_selector : img_selector,
        show_id : show_id,
        theatre_id : theatre_id
      },
      success  : function(data){

        $("#trailerupload").html(data);
        $("#modal-trailer-upload").removeClass('off').addClass('on');
      }
    });
}

WIShows.clearShow = function(id){
  $("#edit-"+id).remove();

  var MediaManager = ('<div class="img-media" id="edit-'+id+'"></div>'+
             '<div class="well on" id="uploadOptions">'+
                      '<a href="javascript:void(0);" class="btn media_manager" onclick="WIMedia.MediaManager(`shows`,`edit-'+id+'`, `showsImg`, `edit-'+id+'`, `shows`)">Upload from WIMedia Library</a>'+
                      '<a href="javascript:void(0);" class="btn media_manager" onclick="WIMedia.dropAndDragUpload(`shows`, `wi_shows`,`shows`,`shows`,`edit-'+id+'`)">upload from computer</a>'+
                    '</div>');
    $("#show_change_pic-"+id).append(MediaManager);
}