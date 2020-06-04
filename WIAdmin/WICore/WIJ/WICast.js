$(document).ready(function () {
    WICast.showEditCastingShows();

});

var WICast = {};

/*WICast.findShow = function(){

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "findShow"
      },
      success  : function(data){

          $("#showActors").html(data);
        }
      });
}*/


WICast.inDisplayfindPerson = function(id, show_id){
var ele_id = "findActor"
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "findinDisplayCastingActor",
        ele_id  : ele_id,
        id      : id,
        show_id : show_id

      },
      success  : function(data){
        $(".actor-"+id).removeClass('show').addClass('hide');
        $("#findcasting").html(data);
        $("#modal-findActor-selector").removeClass('off').addClass('on');
        
      }
    });
}

WICast.ExitSearch = function(){
  WICast.showEditPeople();
}

WICast.Search = function(){
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

WICast.delete = function(id){

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
          WICast.showEditPeople();
        }
      }
    });
}

WICast.close = function(ele_id){
  $("#modal-"+ele_id+"-details").removeClass('show').addClass('hide');
  WICast.showEditCastingShows();
}

WICast.Flip = function(){

 $(this).toggleClass("flip");
}


WICast.createCast = function(){
  var ele_id = "casting";
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


WICast.findShow = function(){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "findShow"
      },
      success  : function(data){
        $(".findingShow").removeClass('show').addClass('hide');
        $("#foundShow").removeClass('hide').addClass('show');
        $("#foundShow").html(data);
      }
    });
}

WICast.findActor = function(){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "findActor"
      },
      success  : function(data){
        $(".actor").removeClass('show').addClass('hide');
        $("#Actor").removeClass('hide').addClass('show');
        $("#Actor").html(data);
      }
    });
}

WICast.selectPerson = function(id){

      $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "selectCastPerson",
        id     : id
      },
      success  : function(data){
        $(".personel").addClass('hide');
        $("#Actor").removeClass('hide').addClass('show');
        $("#Actor").html(data);
      }
    });
}

WICast.selectedPerson = function(id){

      $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "selectCastedPerson",
        id     : id
      },
      success  : function(data){
        $(".personActor").addClass('hide');
        $("#Actor").removeClass('hide').addClass('show');
        $("#Actor").html(data);
      }
    });
}

WICast.selectedEditingCastingPerson = function(id, show_id, cast_id){

      $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "selectedEditingCastingPerson",
        id     : id,
        cast_id : cast_id,
        show_id : show_id
      },
      success  : function(data){
        $("#modal-findActor-selector").removeClass('show').addClass('hide');
        $(".edit_casting_"+cast_id).remove();
        $("#cast_"+cast_id).html(data);
      }
    });
}

WICast.addshowInfo = function(id){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "getShow_info",
        id     : id
      },
      success  : function(data){
        $("#showing").removeClass('show').addClass('hide');
        $("#foundShow").html(data);
      }
    });
}

WICast.addCastMemeber = function(){

  var show_id = $("#addCast-show-id").attr('value');
  var show_name = $("#addCast-show-name").attr('value');
  var charactor_name = $("#addShows-cast-charactor").val()
  var actor_id = $("#addCast-actors-id").attr('value');
  var img = $(".actorPic").attr('value');
  var role = $("#CastRole").val();


  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "addingCastingPerson",
        show_id    : show_id,
        show_name    : show_name,
        actor_id    : actor_id,
        charactor_name   : charactor_name,
        //actor    : actor,
        img    : img, 
        role  : role
      },
      success  : function(data){

        var res = JSON.parse(data);

        if (res.status == "success") {

          $(".actor").removeClass('hide').addClass('show');
          WICore.displaySuccessfulMessage($("#confirm"), res.msg);

          $('#Actor').remove();
          $("#AddCastingResults").html(res.display);

        }else if(res.status == "error"){
          WICore.displayaerrorsMessage($("#AddCastingResults"), res.msg);
        }
      }
    });

}


WICast.DeleteCharacter = function(id){

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
         WICast.showEditCastingShows();

        }
      }
    });
}




WICast.showEditCastingShows = function(){

    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "showEditCastingShows"
      },
      success  : function(data){
        $("#CastedShows").html(data);
      }
    });
}



WICast.Save = function(id, show_id, cast_id){

  var show_name = $("#show_Name_"+show_id).attr('value');
  var charactor_name = $("#charactor_name_"+id).val();
  var actor_id = $("#select_actor_"+id).attr('value');
  var img = $("#Cast_"+id).attr('value');
  var role = $("#CastRole").val();
  //alert(charactor_name);


  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "editCastingPerson",
        person_id   : id,
        show_id    : show_id,
        show_name    : show_name,
        actor_id    : actor_id,
        charactor_name   : charactor_name,
        cast_id    : cast_id,
        img    : img, 
        role  : role
      },
      success  : function(data){

        var res = JSON.parse(data);

        if (res.status == "success") {

          $(".edit_casting_"+cast_id).remove();
        $("#cast_"+cast_id).html(res.display);

          //$('#Actor').remove();
          //$("#AddCastingResults").html(res.display);

        }else if(res.status == "error"){
          WICore.displayaerrorsMessage($("#AddCastingResults"), res.msg);
        }
      }
    });

}

WICast.addCast = function(id){

  var cast_id = parseInt($("input.show_casting:last").attr('id'));
  cast_id++;

  $('<li class="col-md-12 casting"><img src="WIMedia/Img/person/$photo" class="img-responsive" id="Cast" value="$photo">'+
      '<div class="charactor_name" id-"charactor_name"><input id="'+cast_id+'" class="casting" name="cast_name" placeholder="Cast Name" value=""></div> '+
      '<div class="pb">Played By :</div><div class="playedBy" id="playedBy">$cast->playedBy($cast[`actor_id`])</div></li>'+
    '</li>').insertAfter('ul#show_casting>li:last');

}

WICast.saveEditCharacter = function(id){
  var charactor_name = $("#edit_charactor_name-"+id).val();

   $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "EditCharacter",
        id     : id,
        charactor_name : charactor_name
      },
      success  : function(data){
        var res = JSON.parse(data);

        if (res.status == "success") {
          
          WICast.showEditCastingShows();
        }
      }
    });

}