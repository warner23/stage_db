
 <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Actors
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Actors</li>
                    </ol>
                </section>

                

                <!-- Main content -->
                <section class="content">

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button id="addActor" class="btn btn-primary" onclick="WIActor.addActor();">Add</button>

                    <button id="exit_search" class="btn btn-primary" onclick="WIActor.ExitSearch();">Exit Search</button>
                     <div class="search">
<input type="text" class="form-control input-sm" maxlength="64" placeholder="Search" id="people_search" />
 <button type="submit" class="btn_search btn-primary btn-sm" onclick="WIActor.Search();">Search</button>
</div>
                  </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="showActors">

              
                  </div>

    </div>
                     </section>
                     </aside>

<div class="modal hide" id="modal-actors-details">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header-actor">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="WIActor.close();">&times;</button>
                  <h4 class="modal-title" id="modal-actor">
                    Add Person
                  </h4>
                </div>
                <div class="modal-body" id="details-body">
                    <form class="form-horizontal" id="add-actor-form">


                       <div class="form-group">
                        <label class="control-label col-lg-3" for="addActor-image">
                           User Photo
                        </label>
                        <div class="controls col-lg-9">
                          <figure class="actor-image" id="Person_Image">               
                      <div id="dragandrophandler">Drag & Drop Files Here</div>
        <div class="img-preview" id="preview"></div>
        <div class="upload-msg" id="status"></div></figure>
        <input type="hidden" name="supload" id="supload" value="person">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-lg-3" for="addPerson-name">
                          Name
                        </label>
                        <div class="controls col-lg-9">
                          <input id="addPerson-name" name="addPerson-name" type="name" class="input-xlarge form-control" placeholder="Person's Name">
                        </div>
                      </div>

                      <div class="form-group">
                        
                          <label class="control-label col-lg-3" for="addPerson-name">
                          Date Of Birth
                        </label>
                        <div class="controls col-lg-9">
                  <input id="datepicker" name="addPerson-dob" type="text" class="input-xlarge form-control" placeholder="Date Of Birth"></div>
                </div>
                  

                      <div class="form-group">
                        <label class="control-label col-lg-3" for="addPerson-bio">
                          Biography
                        </label>
                        <div class="controls col-lg-9">
                          <textarea id="addPerson-bio" name="addPerson-bio" type="text" class="input-xlarge form-control" placeholder="Biography"></textarea>
                        </div>
                      </div>

                      <hr>
                      <div id="AddPersonResults"></div>
                     
                  </form>
                </div>
                <div align="center" class="ajax-loading"><img class="hide" src="WIMedia/Img/ajax_loader.gif" />
                </div>

                <div class="modal-footer-actor">
                    <a href="javascript:void(0);" class="btn btn-default" data-dismiss="modal" onclick="WIActor.close()" aria-hidden="true">
                      <?php echo WILang::get('cancel'); ?>
                    </a>
                    <a href="javascript:void(0);" id="btn-add-user" onclick="WIActor.addPerson();" class="btn btn-primary">
                      <?php echo WILang::get('add'); ?>
                    </a>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          <script type="text/javascript" src="WICore/WIJ/WICore.js"></script>

          <script type="text/javascript" src="WICore/WIJ/WIActor.js"></script>
          <script type="text/javascript" src="WICore/WIJ/WIMediaCenter.js"></script>

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
  dir = $("#supload").attr('value');
  var ele_id = $(".img-preview").attr("id");
obj.on('dragenter', function (e) 
{
    e.stopPropagation();
    e.preventDefault();
    $(this).css('border', '2px solid #0B85A1');
});
obj.on('dragover', function (e) 
{
     e.stopPropagation();
     e.preventDefault();
});
obj.on('drop', function (e) 
{
 
     $(this).css('border', '2px dotted #0B85A1');
     e.preventDefault();
     var files = e.originalEvent.dataTransfer.files;
 
     //We need to send dropped files to Server
     showCreationhandleFileUpload(files,obj, dir, ele_id);
});
$(document).on('dragenter', function (e) 
{
    e.stopPropagation();
    e.preventDefault();
});
$(document).on('dragover', function (e) 
{
  e.stopPropagation();
  e.preventDefault();
  obj.css('border', '2px dotted #0B85A1');
});
$(document).on('drop', function (e) 
{
    e.stopPropagation();
    e.preventDefault();
});

});
          </script>