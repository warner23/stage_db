                <h3><?php echo WILang::get('database') ?></h3>
                <hr>

<!--                 <validator name="validation">
                    <div class="alert alert-danger">
                        <ul>
                            <li >errorMessage</li>
                            <li >Database Host is required.</li>
                            <li >Database Username is required.</li>
                            <li >Database Password is required.</li>
                            <li >Database Name is required.</li>
                        </ul>
                         </validator>
                    </div> -->
                    <div class="form-group">
                        <label for="host"><?php echo WILang::get('host') ?></label><span class="required">*</span>
                        <input type="text" class="form-control" id="host">
                        <small><?php echo WILang::get('db_info') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="username"><?php echo WILang::get('username') ?></label><span class="required">*</span>
                        <input type="text" class="form-control" id="username">
                        <small><?php echo WILang::get('db_user') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="password"><?php echo WILang::get('pw') ?></label><span class="required">*</span>
                        <input type="password" class="form-control" id="password">
                        <small><?php echo WILang::get('pw_info') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="database"><?php echo WILang::get('db_name') ?></label><span class="required">*</span>
                        <input type="text" class="form-control" id="db_name">
                        <small><?php echo WILang::get('db_info_tab') ?></small>
                    </div>
               

                <button class="btn btn-as pull-right" onclick="WIShowInstaller.DB();" type="button">
                    <span class="show" id="next">
                        <?php echo WILang::get('next') ?>
                        <i class="fa fa-arrow-right" ></i>
                    </span>
                    <span class="hide" id="spin">
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                        <?php echo WILang::get('connecting') ?>
                    </span>
                   
                </button>
                 <span class="show" id="mess">
                        <i class="fa"></i>
                    </span>
                <div class="clearfix"></div>