
 <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Cast Creation
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Cast Creation</li>
                    </ol>
                </section>

                

                <!-- Main content -->
                <section class="content">

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button id="addActor" class="btn btn-primary" onclick="WICast.createCast();">Create Cast</button>
                    <button id="exit_search" class="btn btn-primary" onclick="WICast.ExitSearch();">Exit Search</button>
                    <button id="exit_search" class="btn btn-primary" onclick="WIShows.dropAndDragUpload(`wi_theatre_person`,`cast`, `cast`,`csv`,`new`)">Upload CSV</button>
                     <div class="search">
<input type="text" class="form-control input-sm" maxlength="64" placeholder="Search" id="people_search" />
 <button type="submit" class="btn_search btn-primary btn-sm" onclick="WICast.Search();">Search</button>
</div>
                  </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="showActors">
                      </div>

                      
                  </div>
                  <div id="CastedShows"></div>
                   <div id="modal"></div>
                   </div><div id="findcasting"></div>


    </div>
                     </section>
                     </aside>


          <script type="text/javascript" src="WICore/WIJ/WICore.js"></script>

          <script type="text/javascript" src="WICore/WIJ/WICast.js"></script>

         