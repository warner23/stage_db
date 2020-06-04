$(document).ready(function () {
    WICrew.showEditCrewShows();

});

var WICrew = {};


WICrew.inDisplayfindPerson = function(id, show_id){
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

WICrew.ExitSearch = function(){
  WICrew.showEditPeople();
}

WICrew.Search = function(){
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

WICrew.delete = function(id){

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
          WICrew.showEditPeople();

        }
      }
    });
}

WICrew.close = function(ele_id){
  $("#modal-"+ele_id+"-details").removeClass('show').addClass('hide');
  WICrew.showEditCrewShows();
}

WICrew.Flip = function(){

 $(this).toggleClass("flip");
}


WICrew.createCrew = function(){
  var ele_id = "crew";
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


WICrew.findShow = function(){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "findCrewShow"
      },
      success  : function(data){
        $(".findingShow").removeClass('show').addClass('hide');
        $("#foundShow").removeClass('hide').addClass('show');
        $("#foundShow").html(data);
      }
    });
}

WICrew.findCrew = function(){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "findCrew"
      },
      success  : function(data){
        $(".actor").removeClass('show').addClass('hide');
        $("#Crew").removeClass('hide').addClass('show');
        $("#Crew").html(data);
      }
    });
}

WICrew.selectPerson = function(id){

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

WICrew.selectCrewPerson = function(id){

      $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "selectCrewPerson",
        id     : id
      },
      success  : function(data){
        $(".personel").addClass('hide');
        $("#Crew").removeClass('hide').addClass('show');
        $("#Crew").html(data);
      }
    });
}

WICrew.selectedPerson = function(id){

      $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "selectCrewPerson",
        id     : id
      },
      success  : function(data){
        $(".personCrew").addClass('hide');
        $("#Crew").removeClass('hide').addClass('show');
        $("#Crew").html(data);
      }
    });
}

WICrew.selectedEditingCastingPerson = function(id, show_id, cast_id){

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

WICrew.getCrewShow_info = function(id){
  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "getCrewShow_info",
        id     : id
      },
      success  : function(data){
        $("#showing").removeClass('show').addClass('hide');
        $("#foundShow").html(data);
      }
    });
}

WICrew.addCrewMemeber = function(){

  var show_id = $("#addCast-show-id").attr('value');
  var show_name = $("#addCast-show-name").attr('value');
  var charactor_name = $("#addShows-cast-charactor").val()
  var actor_id = $("#addCast-actors-id").attr('value');
  var img = $(".actorPic").attr('value');
  var role = $("#CrewRole").val();


  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "addingCrewPerson",
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

          $('#Crew').remove();
          $("#add-crew-form").reset();
          $("#AddCrewResults").html(res.display);
          $("#modal-"+ele_id+"-details").removeClass('show').addClass('hide')
        WICrew.showEditCrewShows();


        }else if(res.status == "error"){
          WICore.displayaerrorsMessage($("#AddCrewResults"), res.msg);
        }
      }
    });

}





WICrew.showEditCrewShows = function(){

    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "showEditCrewShows"
      },
      success  : function(data){
        $("#Showscrew").html(data);
      }
    });
}



WICrew.Save = function(id, show_id, cast_id){

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

WICrew.addCast = function(id){

  var cast_id = parseInt($("input.show_casting:last").attr('id'));
  cast_id++;

  $('<li class="col-md-12 casting"><img src="WIMedia/Img/person/$photo" class="img-responsive" id="Cast" value="$photo">'+
      '<div class="charactor_name" id-"charactor_name"><input id="'+cast_id+'" class="casting" name="cast_name" placeholder="Cast Name" value=""></div> '+
      '<div class="pb">Played By :</div><div class="playedBy" id="playedBy">$cast->playedBy($cast[`actor_id`])</div></li>'+
    '</li>').insertAfter('ul#show_casting>li:last');

}

WICrew.saveEditCharacter = function(id){
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
          
          WICrew.showEditCastingShows();
        }
      }
    });

}