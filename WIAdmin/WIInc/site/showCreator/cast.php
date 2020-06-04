                <h3>Cast</h3>

                
                <article class="post_container" id="ActorPost">
 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="cast">Cast
        <ul id="casting">
            <li>
                <input id="casting_name" class="casting_name" name="cast_name" placeholder="Cast Name"</li>
                <span onclick="WIShowInstaller.addCast();">
                    <i class="far fa-plus-square"></i>
                </span>
                <span class="btn" id="playCast" onclick="WIShowInstaller.findCast();">Find Actor</span>
                <span id="findCast" class="hide"></span>
            </li>
            </ul>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
      <div class="show-meta">                                    
    <ul>                 
    <li class="fa fa-user" id="actorUser"></li>                                     
</ul>                               
</div>
 </div>
        <input type="hidden" name="supload" id="supload" value="actor">
  

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <button class="btn" onclick="WIShowInstaller.AddingCast();">Save</button>
      </div>
                <button class="btn btn-as pull-right" onclick="WIShowInstaller.stepThree();" type="button">
                    <span class="show" id="next">
                        <?php echo WILang::get('next') ?> 
                        
                        <i class="fa fa-arrow-right" ></i>
                    </span>
                    <span class="hide" id="spin">
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                       <?php echo WILang::get('connecting') ?> 
                    </span>
                </button>
                <div class="clearfix"></div>
                </article>
