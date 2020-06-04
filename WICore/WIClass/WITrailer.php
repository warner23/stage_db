<?php

/**
* 
*/
class WITrailer
{
    
    function __construct() 
    {
         $this->WIdb = WIdb::getInstance();

    }

   
    public function ShowTrailer()
    {

         $result = $this->WIdb->select("SELECT * FROM `wi_theatre_trailers` ORDER BY RAND()");

            foreach ($result as $trailer) {
                            echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="showTrailers" >

                        <div class="services">
                        <figure class="post-video">                                    
                           ' . $trailer['src'] . '      
                             </figure>
                           
                        </div>
                    </div>';
            }
    }

   
}



?>
