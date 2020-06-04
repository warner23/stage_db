$(document).ready(function(event)
{
  WIShowInstaller.actorRole('actorUser');
  WIShowInstaller.userRole('actorEditUser');


});

var WIShowInstaller = {}

WIShowInstaller.AddingCast = function(){
  var id = $("#naming").attr('id');
  var character = $(".casting_name").val();
   var actor_name = $("span#naming").val();
   var role = $("#CastRole").val();

   $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "addingCastPerson",
        id     : id,
        character : character,
        actor_name : actor_name,
        role  : role
      },
      success  : function(data){
        $("#playCast").addClass('hide');
        $("#findCast").removeClass('hide').addClass('show');
        $("#findCast").html(data);
      }
    });
}
WIShowInstaller.selectPerson = function(id){

      $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "selectPerson",
        id     : id
      },
      success  : function(data){
        $("#playCast").addClass('hide');
        $("#findCast").removeClass('hide').addClass('show');
        $("#findCast").html(data);
      }
    });
}

WIShowInstaller.findCast = function(){

    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "findCast"
      },
      success  : function(data){
        $("#playCast").addClass('hide');
        $("#findCast").removeClass('hide').addClass('show');
        $("#findCast").html(data);
      }
    });
}

WIShowInstaller.userRole = function(colID){

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "userRole"
      },
      success  : function(data){

        $("#"+colID).html(data);
      }
    })
}


WIShowInstaller.actorRole = function(colID){

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "actorRole"
      },
      success  : function(data){

        $("#"+colID).html(data);
      }
    })
}

WIShowInstaller.addCast = function(){

  /*var $cast = ('<li><input id="1" name="cast_name" placeholder="Cast Name"</li>');
  $("#casting").append(cast);*/
  var cast_id = parseInt($("input.casting:last").attr('id'));
  cast_id++;

  $('<li><input id="'+cast_id+'" class="casting" name="cast_name" placeholder="Cast Name"</li>').insertAfter('ul#casting>li:last');

}

WIShowInstaller.newPerson = function(){
/*
var personName = $(".personsName:last").attr('id');
var personsName_Id = personName.replace(/personsName-/g, "");
  personsName_Id++;

var personImg = $(".img-preview:last").attr('id');
var str_id_preview = personImg.replace(/preview-/g, "");
  str_id_preview++;

var datePicker = $(".dob:last").attr('id');
var dobEle = datePicker.replace(/datepicker-/g, "");
dobEle++;*/
 $('<li class="ui-state-default ui-corner-all showperson">'+
  '<form class="form-people">'+
                          '<article class="post_container" id="PersonPost">'+
                          '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
                        '<label for="name" class="col-lg-8 col-md-8 col-sm-8 col-xs-8">'+
                        '<div class="showpersonnel">Name'+
    '<input type="text" name="personsName" id="personsName" class="personsName" placeholder="person\'s Name">'+
      '</div></label>'+
                '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">'+
        '<figure class="post-image" id="show_Image">'+
          '<div id="dragandrophandler" class="dragandrophandler">Drag & Drop Files Here '+  
           '<script type="text/javascript">'+
                '$(document).ready(function(){'+
                '$( function() {'+
    'jQuery.datepicker.setDefaults({dateFormat:"yy-mm-dd"});'+
    '$( "#datepicker").datepicker({changeMonth: true, changeYear: true});'+
  '} );'+

   '$("#datepicker").change(function() {'+
    'var date = $(this).datepicker("getDate");'+
    '$("#datepicker").attr("value", date);'+
'});'+

  'var obj = $("#dragandrophandler");'+
  'var dir = $(".supload").attr("value");'+
  'var ele_id = $(".img-preview:last").attr("id");'+
'obj.on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
    '$(this).css("border", "2px solid #0B85A1");'+
'});'+
'obj.on("dragover", function (e) '+
'{'+
     'e.stopPropagation();'+
     'e.preventDefault();'+
'});'+
'obj.on("drop", function (e)'+
'{'+
 
     '$(this).css("border", "2px dotted #0B85A1");'+
     'e.preventDefault();'+
     'var files = e.originalEvent.dataTransfer.files;'+
     //We need to send dropped files to Server
     'showCreationhandleFileUpload(files,obj, dir, ele_id);'+
'});'+
'$(document).on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+
'$(document).on("dragover", function (e)'+
'{'+
'e.stopPropagation();'+
  'e.preventDefault();'+
  'obj.css("border", "2px dotted #0B85A1");'+
'});'+
'$(document).on("drop", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+

'});'+
'</script>'+
'</div>'+
        '<div class="showpersonnel">Photo<div class="img-preview" id="preview"></div></div>'+
        '<div class="upload-msg" id="status"></div>'+
      '</figure>'+
    '</div>'+
        '<input type="hidden" name="supload" id="supload" value="person">'+
  '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">'+
  '<div class="showpersonnel">Biography'+
    '<textarea type="text" name="bio" class="bio" placeholder="Biography"></textarea>'+
  '</div></div>'+
    '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">'+
    '<div class="showpersonnel">D.O.B'+
    '<input type="text" name="dob" class="dob" id="datepicker" placeholder="Date of birth"></div>'+

    '</div></div>'+
    '</article></form>'+
    '</li>').insertAfter('ul#person>li:last');
    
}

WIShowInstaller.stepOne = function(){
	$("#step_one").removeClass('show');
	$("#step_one").addClass('hide');
	$("#step_two").removeClass('hide');
	$("#step_two").addClass('show');
	$("#stepOne").removeClass('active');
	$("#stepOne").addClass('passActive');
	$("#stepTwo").removeClass('inactive');
	$("#stepTwo").addClass('active');


}


WIShowInstaller.stepTwo = function(){
   // WIShowInstaller.InstallPeople();
	$("#step_two").removeClass('show');
	$("#step_two").addClass('hide');
	$("#step_three").removeClass('hide');
	$("#step_three").addClass('show');
	$("#stepTwo").removeClass('active');
	$("#stepTwo").addClass('passActive');
	$("#stepThree").removeClass('inactive');
	$("#stepThree").addClass('active');


}

WIShowInstaller.stepThree = function(){
	$("#step_three").removeClass('show');
	$("#step_three").addClass('hide');
	$("#step_four").removeClass('hide');
	$("#step_four").addClass('show');
	$("#stepThree").removeClass('active');
	$("#stepThree").addClass('passActive');
	$("#stepFour").removeClass('inactive');
	$("#stepFour").addClass('active');


}

WIShowInstaller.stepFour = function(){
	$("#step_four").removeClass('show');
	$("#step_four").addClass('hide');
	$("#step_five").removeClass('hide');
	$("#step_five").addClass('show');
	$("#stepFour").removeClass('active');
	$("#stepFour").addClass('passActive');
	$("#stepFive").removeClass('inactive');
	$("#stepFive").addClass('active');


}

WIShowInstaller.stepFive = function(){
    $("#step_five").removeClass('show');
    $("#step_five").addClass('hide');
    $("#step_six").removeClass('hide');
    $("#step_six").addClass('show');
    $("#stepFive").removeClass('active');
    $("#stepFive").addClass('passActive');
    $("#stepSix").removeClass('inactive');
    $("#stepSix").addClass('active');


}

WIShowInstaller.stepSix = function(){
    $("#step_six").removeClass('show');
    $("#step_six").addClass('hide');
    $("#step_seven").removeClass('hide');
    $("#step_seven").addClass('show');
    $("#stepSix").removeClass('active');
    $("#stepSix").addClass('passActive');
    $("#stepSeven").removeClass('inactive');
    $("#stepSeven").addClass('active');
}

WIShowInstaller.stepSeven = function(){
    $("#step_seven").removeClass('show');
    $("#step_seven").addClass('hide');
    $("#step_eight").removeClass('hide');
    $("#step_eight").addClass('show');
    $("#stepSeven").removeClass('active');
    $("#stepSeven").addClass('passActive');
    $("#stepEight").removeClass('inactive');
    $("#stepEight").addClass('active');
}


WIShowInstaller.InstallPeople = function(){

 var name = $("#personsName").val();
    var textArea = $('textarea#bio');
    var bio = textArea.val();
    var dob = $("#dob").val();
    var img = $(".personImg").attr('value'); 

         $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "add_person",
            name   : name,
            bio  : bio,
            dob: dob,
            img : img

        },
        success: function(results)
        {
          var res = JSON.parse(results);
          if (res.status == "success") {

              WIShowInstaller.showInstalledPerson(res.person_id);
              $(".newshowperson").remove();

          }else{

          }
        }
    });

}

WIShowInstaller.showInstalledPerson = function(PersonId){
   $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "get_person",
            PersonId   : PersonId
        },
        success: function(results)
        {
          $("#person").html(results);
          $("#newshowperson").remove();
        }
    });
}



WIShowInstaller.install = function(){

         $("#install").removeClass('show');
     $("#install").addClass('hide');
    $("#installing").removeClass('hide');
    $("#installing").addClass('show');
    

    var site_name  = $("#website_name").val(),
    Domain  = $("#domain").val(),
    script  = $("#script").val(),
    session_secure = $("#secure_session").attr("value"),
    http = $("#session_http_only").attr("value"),
    session_regenerate = $("#session_regenerate").attr("value"),
    cookieonly = $("#cookieonly").attr("value"),
    login_fingerprint = $("#login_fingerprint").attr("value"),
    max_login_attempts = $("#max_login_attempts").val(),
    redirect_after_login = $("#redirect_after_login").val();
//    encryption_bcrypt = $("#encryption-bcrypt").val(),

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "install_settings",
            name   : site_name,
            dom  : Domain,
            script: script,
            session_secure : session_secure,
            http : http,
            session_regenerate: session_regenerate,
            cookieonly : cookieonly,
            login_fingerprint: login_fingerprint,
            max_login_attempts : max_login_attempts,
            redirect_after_login : redirect_after_login,
            encryption : encryption,
            cost : cost,
            mailer : mailer,
            db_host : db_host,
            db_name : db_name,
            db_password : db_password,
            db_username : db_username,
            bootstrap_version : bootstrap_version,
            salt : salt,
            admin_password : admin_pass,
            admin_username : admin_user,
            email_address : user_email
        },
        success: function(results)
        {
            var res = JSON.parse(results);
            if (res.status === "install_completed") {
                $("#install").removeClass('hide');
     $("#install").addClass('close');
    $("#installing").removeClass('show');
    $("#installing").addClass('hide');
                WIShowInstaller.stepFive();
            }else{
                $("#install").removeClass('hide');
     $("#install").addClass('close');
    $("#installing").removeClass('show');
    $("#installing").addClass('hide');
                $("#results_install").html(results)
            }
        }
    });
}

