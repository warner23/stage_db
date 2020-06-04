     <div>
                <div class="alert alert-danger hide" id="snap" >
                    <strong><?php echo WILang::get('next') ?></strong> 
                    <?php echo WILang::get('requirements_error') ?>
                </div>

                    <h3>Adding People</h3>
                    <hr>
                    <p>Add anyone involved with the play (actor, crew, director, etc).</p>

                    <p>Click save, then click add new person, until add people are added, the click next</p>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                      <button onclick="WIShowInstaller.newPerson()">Add Person</button>
                    <ul class="list-group" id="person">
                          <li class="ui-state-default ui-corner-all newshowperson">
                            <form class="form-people">
                          <article class="post_container" id="PersonPost">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="name" class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                          <div class="showpersonnel">Name
        <input type="text" name="personsName" id="personsName" class="personsName" placeholder="person's Name"></div>
      </label>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <figure class="post-image" id="show_Image">            
          <div id="dragandrophandler" class="dragandrophandler">Drag & Drop Files Here</div>
        <div class="showpersonnel">Photo<div class="img-preview" id="preview"></div></div>
        <div class="upload-msg" id="status"></div>
      </figure>
    </div>
        <input type="hidden" name="supload" id="supload" class="supload" value="person">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
    <div class="showpersonnel">Biography
    <textarea type="text" class="bio" name="bio" id="bio" placeholder="Biography"></textarea>
  </div></div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <div class="showpersonnel">D.O.B
    <input type="text" name="dob" class="dob" id="datepicker" placeholder="Date of birth"></div>

    </div></div></article>
  </form>
                       </li>
                    </ul>
                   </div>
                   <div id="SavePerson"><button onclick="WIShowInstaller.InstallPeople()">Save</button></div>

                    <a href="javascript:;" class="btn btn-as pull-right" onclick="WIShowInstaller.stepTwo()" type="button" id="required">
                        <?php echo WILang::get('next') ?>
                        <i class="fa fa-arrow-right"></i>
                    </a>
                    <div class="clearfix"></div>
                </div>

              

<script type="text/javascript">
  $(document).ready(function(){

$( function() {
    jQuery.datepicker.setDefaults({dateFormat:"yy-mm-dd"});
    $( "#datepicker" ).datepicker({changeMonth: true, changeYear: true});
  } );

  $("#datepicker").change(function() {
    var date = $(this).datepicker("getDate");
    $("#datepicker").attr('value', date);
});



  var obj = $("#dragandrophandler");
  var dir = $(".supload").attr("value");
  var ele_id = $(".img-preview").attr("id");

obj.on("dragenter", function (e) 
{
    e.stopPropagation();
    e.preventDefault();
    $(this).css("border", "2px solid #0B85A1");
});
obj.on("dragover", function (e) 
{
     e.stopPropagation();
     e.preventDefault();
});
obj.on("drop", function (e)
{
 
     $(this).css("border", "2px dotted #0B85A1");
     e.preventDefault();
     var files = e.originalEvent.dataTransfer.files;
     //We need to send dropped files to Server
     showCreationhandleFileUpload(files,obj, dir, ele_id);
});
$(document).on("dragenter", function (e) 
{
    e.stopPropagation();
    e.preventDefault();
});
$(document).on("dragover", function (e)
{
e.stopPropagation();
  e.preventDefault();
  obj.css("border", "2px dotted #0B85A1");
});
$(document).on("drop", function (e) 
{
    e.stopPropagation();
    e.preventDefault();
});

});
</script>
