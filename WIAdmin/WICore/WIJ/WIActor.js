$(document).ready(function () {
    
WIActor.showEditPeople();
WIActor.pics();


});

var WIActor = {};


WIActor.dropAndDragBulkUpload = function(selector, folder, id_selector, img_selector ){


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

WIActor.dropAndDragUpload = function(table, selector, folder, id_selector, img_selector ){


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


WIActor.ExitSearch = function(){
  WIActor.showEditPeople();
}

WIActor.Search = function(){
  var search = $("#people_search").val();
  if (search != "") {
    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "SearchPerson",
        search   : search
      },
      success  : function(data){

          $("#showActors").html(data);
        }
      });
  }
}

WIActor.delete = function(id){

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "deletePerson",
        id   : id
      },
      success  : function(data){

        var res = JSON.parse(data);

        if (res.status == "success") {
          WIActor.showEditPeople();

        }
      }
    });
}

WIActor.DeleteCharacter = function(id){

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "DeleteCharacter",
        id   : id
      },
      success  : function(data){

        var res = JSON.parse(data);

        if (res.status == "success") {
          WIActor.showEditPeople();

        }
      }
    });
}

WIActor.addPerson = function(){
  var ele_id = "actors";
  var name = $("#addPerson-name").val()
  var dob = $("#datepicker").val()
  var bcity = $("#addPerson-birthplace").val()
  var bio = $("textarea#addPerson-bio").val()
  var img =$("#preview-new").attr('value');

  if (img == ""){
    var img = null;
  }
  if (dob =="") {
     var dob = null;
  }

  if (bcity =="") {
    bcity = null;
  }

  if (bio =="") {
    bio = null;
  }

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "addPerson",
        name   : name,
        dob    : dob,
        bcity  :bcity,
        bio    : bio,
        img    : img
      },
      success  : function(data){

        var res = JSON.parse(data);

        if (res.status == "success") {
          $('#add-actor-form').trigger("reset");
          $('#preview-preview').remove();
          $("#uploadOptions").removeClass("off").addClass("on");
          $("#modal-"+ele_id+"-details").removeClass('show').addClass('hide')
          WIActor.showEditPeople();

        }else if(res.status == "error"){
          WICore.displayaerrorsMessage($("#AddPersonResults"), res.msg);
        }
      }
    });

}

WIActor.addActor = function(){
  var ele_id = "actors";
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

WIActor.close = function(ele_id){
  $("#modal-"+ele_id+"-details").removeClass('show').addClass('hide');
}

WIActor.showEditPeople = function(){

    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "showEditPeople"
      },
      success  : function(data){
        $("#showActors").html(data);
      }
    });
}

WIActor.Flip = function(){

 $(this).toggleClass("flip");
}

WIActor.editPerson = function(id){

    var name = $("#name-"+id).val();
    var bio = $("textarea#bio-"+id).val();
    var bcity = $("#bcity-"+id).val();
    var dob = $("#datepicker-"+id).val();
    img  = $("#preview-edit-"+id).attr('value');

       $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "editPerson",
        id     : id,
        name   : name,
        bio    : bio,
        bcity  : bcity,
        dob    : dob,
        img    : img
      },
      success  : function(data){
        WIActor.showEditPeople();
      }
    });

}

WIActor.pics = function(){

    var ele_id = $(".img-preview").attr("id");
    var selector = "person";

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "mediaPictures",
        selector : selector,
        ele_id  : ele_id
      },
      success  : function(data){
        $("#person-body").html(data);
      }
    });
}

WIActor.clearPerson = function(id){
  $("#edit-"+id).remove();

  var MediaManager = ('<div class="img-media" id="edit-'+id+'"></div>'+
             '<div class="well on" id="uploadOptions">'+
                      '<a href="javascript:void(0);" class="btn media_manager" onclick="WIMedia.MediaManager(`actor`,`edit-'+id+'`, `personImg`, `edit-'+id+'`, `person`)">Upload from WIMedia Library</a>'+
                      '<a href="javascript:void(0);" class="btn media_manager" onclick="WIMedia.dropAndDragUpload(`actors`, `wi_theatre_person`,`person`,`person`,`edit-'+id+'`)">upload from computer</a>'+
                    '</div>');
    $("#person_change_pic-"+id).append(MediaManager);
}

WIActor.nextPage = function(page){

        $(".loading-div").removeClass('closed'); //remove closed element
        $(".loading-div").addClass('open'); //show loading element
        //var page = $(this).attr("data-page"); //get page number from link

             $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "NextactorsPage",
            page : page
        },
        success: function(result)
        {
            $("#showActors").html(result);
              $(".loading-div").removeClass('open'); //remove closed element
        $(".loading-div").addClass('closed'); //show loading element
        }
       
    });
}