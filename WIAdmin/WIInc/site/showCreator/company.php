                <h3><?php echo WILang::get('install') ?></h3>
                <hr>

                    <p><?php echo WILang::get('install_ready') ?></p>
                    <p>
                       <?php echo WILang::get('privde_info') ?> <br>
                       <?php echo WILang::get('few_sec') ?>
                    </p>
                    
                    <div id="results_install"></div>

                    <button class="btn btn-as pull-right" onclick="WIShowInstaller.install();">
                        <span class="show" id="install">
                               <i class="fa fa-play"></i>
                            <?php echo WILang::get('insta') ?>
                        </span>
                            <span class="hide" id="installing">
                            <i class="fa fa-circle-o-notch fa-spin"></i>
                            <?php echo WILang::get('I') ?>
                        </span>
                    </button>
                <div class="clearfix"></div>