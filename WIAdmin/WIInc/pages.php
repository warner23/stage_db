 <style type="text/css">
    li{
        list-style: none;
    }

    .wrap{
    width: 44%;
    height: 44px;
    margin-left: 288px;

    }

    .pgs{
            width: 50%;
    margin-left: 297px;
    }

    .close {
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 10px #000;
    filter: alpha(opacity=20);
    opacity: .5;
}
</style>
 <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Pages
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Pages</li>
                    </ol>
                </section>

                

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="col-lg-8 col-md-3 col-xs-3 col-sm-3">
                    <button class="btn" onclick="window.location.href='WINewPage.php'">New Page</button>
                    </div>
                    
                      <div class="row">
                        <div class="col-lg-3 col-xs-6 col-xl-12">
                            <!-- input box's box -->
                          <div class="col-lg-8 col-md-3 col-xs-3 col-sm-8">
                              <ul class="wrapper">
                                  <li class="col-lg-4 col-md-3 col-xs-3 col-sm-5">Name</li>
                                  <li class="col-lg-2 col-md-3 col-xs-3 col-sm-4">Edit</li>
                                  <li class="col-lg-4 col-md-3 col-xs-3 col-sm-3">Delete</li>
                              </ul>
                          </div>
                          <div id="pageListing"></div>
                           
                        </div><!-- ./col -->
                     </div>
                     </section>
                     </aside>
<script type="text/javascript" src="WICore/WIJ/WIPages.js"></script>

 <div class="modal" id="modal-delete" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="modal-username">
                    Page Deletion
                  </h4>
                </div>
                <div class="modal-body" id="details-body">
                   
                     
                </div>
                <div align="center" class="ajax-loading"><img class="hide" src="WIMedia/Img/ajax_loader.gif" /></div>
                <div class="modal-footer">
                    
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
