
 <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Shows
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Shows</li>
                    </ol>
                </section>

                

                <!-- Main content -->
                <section class="content">

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button id="addActor" class="btn btn-primary" onclick="WIShows.addShows();">Add</button>

                    <button id="exit_search" class="btn btn-primary" onclick="WIShows.ExitSearch();">Exit Search</button>
                    <button id="exit_search" class="btn btn-primary" onclick="WIShows.dropAndDragUpload(`wi_shows`, `shows`, `shows`,`csv`,`new`)">Upload CSV</button>
                     <div class="search">
<input type="text" class="form-control input-sm" maxlength="64" placeholder="Search" id="Shows_search" />
 <button type="submit" class="btn_search btn-primary btn-sm" onclick="WIShows.Search();">Search</button>
</div>
                  </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="showShows">

            
                  </div>


    </div>
                     </section>
                     </aside>




      