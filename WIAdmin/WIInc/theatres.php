<link rel="stylesheet" type="text/css" href="WIInc/css/features.css">
 <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Theatre
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Theatre</li>
                    </ol>
                </section>
  

                <!-- Main content -->
                <section class="content">


                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button id="addActor" class="btn btn-primary" onclick="WITheatres.addTheatre();">Add</button>

                    <button id="exit_search" class="btn btn-primary" onclick="WITheatres.ExitSearch();">Exit Search</button>
                    <button id="exit_search" class="btn btn-primary" onclick="WITheatres.dropAndDragUpload(`wi_theatres`, `theatres`, `theatres`,`csv`,`upload_Image`)">Upload CSV</button>
                    <button id="bulkUpload" class="btn btn-primary" onclick="WITheatres.dropAndDragBulkUpload(`theatres`, `theatres`,`bulkTheatreUpload`,`new`)">Bulk Image Uploader</button>
                     <div class="search">
<input type="text" class="form-control input-sm" maxlength="64" placeholder="Search" id="Theatre_search" />
 <button type="submit" class="btn_search btn-primary btn-sm" onclick="WITheatres.Search();">Search</button>
</div>
                  </div>


                  </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="showTheatres">
              
                  </div>
                  <div id="modal"></div>
                  <div id="mediaCenter"></div>
                  <div id="mediaupload"></div>
                  <div id="InstallFeatures"></div>

    </div>
                     </section>
                     </aside>
                     <script type="text/javascript" src="WICore/WIJ/WICore.js"></script>

          <script type="text/javascript" src="WICore/WIJ/WITheatres.js"></script>
          <script type="text/javascript" src="WICore/WIJ/WIMedia.js"></script>
          <script type="text/javascript" src="WICore/WIJ/WIFeatures.js"></script>
          <script type="text/javascript" src="WICore/WIJ/WIMediaCenter.js"></script>

         <!--  

          <script type="text/javascript">
            $(document).ready(function(){

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
          </script> -->