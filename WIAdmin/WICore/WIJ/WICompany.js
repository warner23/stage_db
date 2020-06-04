$(document).ready(function () {
    
WICompany.showEditCompany();
WICompany.pics();

});

var WICompany = {};

WICompany.ExitSearch = function(){
  WICompany.showEditCompany();
}

WICompany.Search = function(){
  var search = $("#company_search").val();
  if (search != "") {
    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "SearchCompany",
        search   : search
      },
      success  : function(data){

          $("#showCompanies").html(data);
        }
      });
  }
}

WICompany.delete = function(id){

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "deleteCompany",
        id   : id
      },
      success  : function(data){

        var res = JSON.parse(data);

        if (res.status == "success") {
          WICompany.showEditCompany();

        }
      }
    });
}

WICompany.addCompanyInfo = function(){
  var name = $("#addCompany-name").val()
  var address = $("#addCompany-address").val()
  var country = $("#countries").val()
  var bio = $("textarea#addCompany-bio").val()
  var img =$(".companyImg").attr('value');

  if (img == ""){
    var img = null;
  }
  if (address =="") {
     var address = null;
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
        action : "createCompany",
        name   : name,
        address : address,
        country  :country,
        bio    : bio,
        img    : img
      },
      success  : function(data){

        var res = JSON.parse(data);

        if (res.status == "success") {
          WICompany.close('company');
          WICompany.showEditCompany();

        }else if(res.status == "error"){
          WICore.displayaerrorsMessage($("#AddCompanyResults"), res.msg);
        }
      }
    });

}

WICompany.addCompany = function(){
  var ele_id = "company";
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

WICompany.close = function(ele_id){
  $("#modal-"+ele_id+"-details").removeClass('show').addClass('hide');
}

WICompany.showEditCompany = function(){

    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "showEditCompany"
      },
      success  : function(data){
        $("#showCompanies").html(data);
      }
    });
}

WICompany.Flip = function(){

 $(this).toggleClass("flip");
}

WICompany.editCompany = function(id){

    var name = $("#name-"+id).val();
    var bio = $("textarea#bio-"+id).val();
    var address = $(".address-"+id).val();
    var country = $("#countries"+id).val()
    var img  = $(".companyImg").attr('value');

       $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "editCompany",
        id     : id,
        name   : name,
        bio    : bio,
        address  : address,
        img    : img
      },
      success  : function(data){
        WICompany.showEditCompany();
      }
    });

}

WICompany.pics = function(){

    var ele_id = $(".img-preview").attr("id");
    var selector = "company";

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "mediaPictures",
        selector : selector,
        ele_id  : ele_id
      },
      success  : function(data){
        $("#company-body").html(data);
      }
    });
}


WICompany.clearCompany = function(id){
  $("#edit-"+id).remove();

  var MediaManager = ('<div class="img-media" id="edit-'+id+'"></div>'+
             '<div class="well on" id="uploadOptions">'+
                      '<a href="javascript:void(0);" class="btn" onclick="WIMedia.MediaManager(`company`,`edit-'+id+'`, `companyImg`, `edit-'+id+'`, `company`)">Upload from WIMedia Library</a>'+
                      '<a href="javascript:void(0);" class="btn" onclick="WIMedia.dropAndDragUpload(`company`, `wi_theatre_company`,`company`,`company`,`edit-'+id+'`)">upload from computer</a>'+
                    '</div>');
    $("#company_change_pic-"+id).append(MediaManager);
}

WICompany.dropAndDragBulkUpload = function(selector, folder, id_selector, img_selector ){


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

WICompany.dropAndDragUpload = function(table, selector, folder, id_selector, img_selector ){


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