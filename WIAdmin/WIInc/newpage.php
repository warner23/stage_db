  <style type="text/css">


    .drop{
          text-align: -webkit-center;
    }    

    .page{
      border: 2px solid;
    }

#page_selector {
    height: 57px;
    /* align-content: center; */
    margin: 8px 157px;
}

#module {
    min-height: 60px;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.side_mod{
  float:right;
}
  </style>  

  <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        New Page
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">New Page</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                <div class="row">
                    <div class="container">
                        <div class="col-lg-12">
                            Page Name:<input type="text" name="newpage" id="page_title">
                        </div>

                        <div class="col-lg-4">
                              <label>Add Page to Main Menu</label>
                             <label class="switch">
                              <input type="checkbox" id="addToMenu" value="0">
                              <div class="slider round" onclick="WIPages.menuChange()"></div>
                            </label>
                            </div>

                        

                         <div class="col-lg-12">
                             <button id="newpage" class="btn btn-success">Save</button> 
                        </div>
                    </div>
                </div>
                  
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <script type="text/javascript" src="WICore/WIJ/WIPages.js"></script>
        