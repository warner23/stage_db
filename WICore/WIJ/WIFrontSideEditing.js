$(document).ready(function(){
  WIFrontSideEditing.haveshows();

$("#datepicker").change(function() {
    var date = $(this).datepicker("getDate");
    $("#datepicker").attr('value', date);
});

$("#datepicker1").change(function() {
    var date1 = $(this).datepicker("getDate");
    $("#datepicker1").attr('value', date);
});

});

var WIFrontSideEditing = {};

var rowCount=0;
WIFrontSideEditing.type = function(){

	if ($(".admin_post").hasClass('block')) {
		$(".admin_post").removeClass('block')
						.addClass('hidden');
	}else{
		$(".admin_post").removeClass('hidden')
						.addClass('block');
	}

}

WIFrontSideEditing.cancelPost = function(element){
  $("#"+element).remove();
}


WIFrontSideEditing.select_theatre = function(){
    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action :"select_theatre",
        category : 1
      },
      success  : function(data){
        $("#select_theatre").html(data);
      }
    })
  }

WIFrontSideEditing.select_company = function(){
    $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action :"select_company",
        category : 1
      },
      success  : function(data){
        $("#select_company").html(data);
      }
    })
  }



WIFrontSideEditing.PostTheatre = function(){
  var user = $("#theatreUploader").html();
  var name = $("#theatre_name").val();
  var fline = $("#fline").val();
  var sline = $("#sline").val();
  var city = $("#city").val();
  var postcode = $("#postcode").val();
  var textArea = $('textarea#description');
  var desc = textArea.val();
  var Image = $("#theatreUpload").attr('value');
$.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "postTheatre",
        name : name,
        desc : desc,
        fline    : fline,
        sline    : sline,
        city    : city,
        postcode    : postcode,
        user    : user,
        Image : Image
      },
      success  : function(data){
        res = JSON.parse(data);
        if (res.status == "success") {
          $("#status").html(res.msg).fadeOut(6000);
           $("#theatrePost").remove();
        WIFrontSideEditing.haveshows();
        //$("#get_resources").html(data);
        }else if (res.status == "error"){
          $("#status").css('display', 'block');
          $("#status").html(res.msg).fadeOut(6000);
        }
       
      }
    })
}


WIFrontSideEditing.PostCompany = function(){
  var user = $("#companyUploader").html();
  var name = $("#companyName").val();
  var address = $("#address").val();
  var textArea = $('textarea#bio');
    var bio = textArea.val();
  var Image = $("#theatreUpload").attr('value');
$.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "postCompany",
        name : name,
        address : address,
        bio    : bio,
        user    : user,
        Image : Image
      },
      success  : function(data){
        res = JSON.parse(data);
        if (res.status == "success") {
          $("#status").html(res.msg).fadeOut(6000);
           $("#companyPost").remove();
        WIFrontSideEditing.haveshows();
        //$("#get_resources").html(data);
        }else if (res.status == "error"){
          $("#status").css('display', 'block');
          $("#status").html(res.msg).fadeOut(6000);
        }
       
      }
    })
}


WIFrontSideEditing.PostShow = function(){
  var user = $("#showUser").html();
  var name = $("#show_name").val();
  var theatre = $("#theatre").val();
  var company = $("#company").val();
  var start_date = $("#datepicker").val();
  var end_date = $("#datepicker1").val();
  var textArea = $('textarea#description');
  var desc = textArea.val();
  var Image = $("#theatreUpload").attr('value');

  var values = $("input.casting");
    var cast = $.map(values, function(element) {
       return element.value;
    });
    //console.log(cast);

$.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "postShow",
        name : name,
        desc : desc,
        theatre    : theatre,
        company    : company,
        start_date    : start_date,
        end_date    : end_date,
        user    : user,
        Image : Image,
        cast  : cast
      },
      success  : function(data){
        res = JSON.parse(data);
        if (res.status == "success") {
          $("#status").html(res.msg).fadeOut(6000);
           $("#showPost").remove();
        WIFrontSideEditing.haveshows();
        //$("#get_resources").html(data);
        }else if (res.status == "error"){
          $("#status").css('display', 'block');
          $("#status").html(res.msg).fadeOut(6000);
        }
       
      }
    })
}

WIFrontSideEditing.PostSlider = function(){
	    var day = $(".day").html();
  var month = $(".month").html();
  var user = $("#slideruser").html();
  var cat_id =  $("#cat").attr('cat_id');
  var post_title = $("#post_title").val();
  var textArea = $('textarea#blog_post');
  var blog_post = textArea.val();
  var type     = $("#blog_slider").val();
  var Image0 = $("#media0").attr('value');
  var Image1 = $("#media1").attr('value');
  var Image2 = $("#media2").attr('value');
  var caption     = $("#caption0").val();
  var caption1     = $("#caption1").val();
  var caption2     = $("#caption2").val();
$.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "postslider",
        day : day,
        month  : month,
        post_title : post_title,
        blog_post : blog_post,
        type    : type,
        cat_id  : cat_id,
        user    : user,
        Image0 : Image0,
        Image1 : Image1,
        Image2 : Image2,
        caption : caption,
        caption1 : caption1,
        caption2 : caption2,

      },
      success  : function(data){
        $("#blogPostSlider").remove();
        WIFrontSideEditing.havePosts();
        //$("#get_resources").html(data);
      }
    })

}

WIFrontSideEditing.PostNoMedia = function(){
  var cat_id =  $("#cat").attr('cat_id');
	var day = $(".day").html();
	var month = $(".month").html();
  var user = $("#user").html();
	var post_title = $("#post_title").val();
  var textArea = $('textarea#blog_post');
	var blog_post = textArea.val();
	var type     = $("#noMedia").val();
$.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "nomodepost",
        search : 1,
        day : day,
        month  : month,
        post_title : post_title,
        blog_post : blog_post,
        type    : type,
        user    : user,
        cat_id : cat_id
      },
      success  : function(data){
        $("#noMediaPost").remove();
        WIFrontSideEditing.havePosts();
        //$("#get_resources").html(data);
      }
    })

}

WIFrontSideEditing.PostImage = function(){

    var day = $(".day").html();
  var month = $(".month").html();
  var user = $("#imguser").html();
  var cat_id =  $("#cat").attr('cat_id');
  var post_title = $("#post_title").val();
  var textArea = $('textarea#blog_post');
  var blog_post = textArea.val();
  var type     = $("#blog_image").val();
  var Image = $("#media").attr('value');
$.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "postimage",
        day : day,
        month  : month,
        post_title : post_title,
        blog_post : blog_post,
        type    : type,
        cat_id  : cat_id,
        user    : user,
        Image : Image
      },
      success  : function(data){
        $("#blogPostImage").remove();
        WIFrontSideEditing.havePosts();
        //$("#get_resources").html(data);
      }
    })
}

WIFrontSideEditing.PostAudio = function(){

    var day = $(".day").html();
  var month = $(".month").html();
  var user = $("#audiouser").html();
  var cat_id =  $("#cat").attr('cat_id');
  var post_title = $("#post_title").val();
  var textArea = $('textarea#blog_post');
  var blog_post = textArea.val();
  var type     = $("#audio").val();
  var audio = $("#media").attr('value');
$.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "postaudio",
        day : day,
        month  : month,
        post_title : post_title,
        blog_post : blog_post,
        type    : type,
        cat_id  : cat_id,
        user    : user,
        audio : audio
      },
      success  : function(data){
        $("#blogPostAudio").remove();
        WIFrontSideEditing.havePosts();
        //$("#get_resources").html(data);
      }
    })
}

WIFrontSideEditing.PostVideo = function(){
var cat_id =  $("#cat").attr('cat_id');
    var day = $(".day").html();
  var month = $(".month").html();
  var user = $("#viduser").html();
  var post_title = $("#post_title").val();
  var textArea = $('textarea#blog_post');
  var blog_post = textArea.val();
  var type     = $("#blog_video").val();
  var video = $("#media").attr('value');

$.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "PostVideo",
        search : 1,
        day : day,
        month  : month,
        post_title : post_title,
        blog_post : blog_post,
        type    : type,
        user    : user,
        cat_id    : cat_id,
        video : video
      },
      success  : function(data){
        $("#blogPostVideo").remove();
        WIFrontSideEditing.havePosts();
        //$("#get_resources").html(data);
      }
    })
}

WIFrontSideEditing.PostYouTube = function(){
  var cat_id =  $("#cat").attr('cat_id');
  var day = $(".day").html();
  var month = $(".month").html();
  var user = $("#ytuser").html();
  var ytlink = $("#youtube_link").val();
  var post_title = $("#post_title").val();
  var textArea = $('textarea#blog_post');
  var blog_post = textArea.val();
  var type     = $("#youtube").val();
$.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "youtube",
        search : 1,
        day : day,
        month  : month,
        post_title : post_title,
        ytlink   : ytlink,
        blog_post : blog_post,
        type    : type,
        user    : user,
        cat_id : cat_id
      },
      success  : function(data){
        $("#youtubeVid").remove();
        WIFrontSideEditing.havePosts();
        //$("#get_resources").html(data);
      }
    })

}

WIFrontSideEditing.slider = function(){
WIFrontSideEditing.select_theatre();
WIFrontSideEditing.userRole('slideruser');
	var nowDate		= new Date();
var nowDay		= ((nowDate.getDate().toString().length) == 1) ? '0'+(nowDate.getDate()) : (nowDate.getDate());
var nowMonth	= ((nowDate.getMonth().toString().length) == 1) ? '0'+(nowDate.getMonth()+1) : (nowDate.getMonth()+1);
var nowYear		= nowDate.getFullYear();
var formatDate	= nowDay + "." + nowMonth + "." + nowYear;

	var slider = ('<!-- .latest-posts start -->'+                         
'<article class="post_container" id="blogPostSlider">'+                             
'<div class="post-info">'+                                   
 '<div class="post-date">'+                                        
 '<span class="day">'+nowDay +'</span>'+                                        
 '<span class="month">'+nowMonth +'</span>'+                                  
  '</div> '+                                   
  '<div class="post-category">'+                                     
  '<i class="fa fa-picture-o"></i>'+                                    
  '</div>'+                                
  '</div><!-- .post-info end -->'+                               
   '<figure class="post-image"> '+                                 
   '<div class="slideshow-container">'+

'<div class="mySlides fade">'+
  '<div class="numbertext">1 / 3</div>'+
   '<div id="dragandrophandler0">Drag & Drop Files Here</div>'+
        '<div class="img-preview" id="img-preview0"></div>'+
  '<div class="text"><input type="text" id="caption0" placeholder="Caption Text"></div>'+
'</div>'+

'<div class="mySlides fade">'+
  '<div class="numbertext">2 / 3</div>'+
   '<div id="dragandrophandler1">Drag & Drop Files Here</div>'+
        '<div class="img-preview" id="img-preview1"></div>'+
  '<div class="text"><input type="text" id="caption1" placeholder="Caption Two"></div>'+
'</div>'+

'<div class="mySlides fade">'+
  '<div class="numbertext">3 / 3</div>'+
   '<div id="dragandrophandler2">Drag & Drop Files Here</div>'+
        '<div class="img-preview" id="img-preview2"></div>'+
  '<div class="text"><input type="text" id="caption2" placeholder="Caption Three"></div>'+
'</div>'+

'<a class="prev" onclick="plusSlides(-1)">&#10094;</a>'+
'<a class="next" onclick="plusSlides(1)">&#10095;</a>'+

'</div>'+
'<br>'+

'<div style="text-align:center">'+
  '<span class="dot" onclick="currentSlide(1)"></span>'+ 
  '<span class="dot" onclick="currentSlide(2)"></span>'+ 
  '<span class="dot" onclick="currentSlide(3)"></span> '+
'</div>        '+                       
   '</figure>'+                              
    '<div class="post-content">'+                                    
'<div id="select_theatre"></div>'+     
'<h4><input type="text" id="post_title" placeholder="Blog post with Slider" value=""></h4>'+     
  '<input type="hidden" name="blog_slider" id="blog_slider" value="blog_slider">'+                               

    '<div class="blog-meta">'+                                        
    '<ul>'+                                            
    '<li class="fa fa-user">'+                                                
    '<a href="javascript:void(0)" id="slideruser"></a>'+                                            
    '</li> '+                                          
     '<li class="post-tags fa fa-tags">'+                                               
      '<a href="javascript:void(0)">news, </a>'+                                                
      '<a href="javascript:void(0)">dois</a>'+                                            
      '</li> '+                                       
'</ul>'+                                    
'</div>'+                                    
'<p>'+   
'<textarea id="blog_post" placeholder="Add your blog post here"></textarea>'+                                                                      
'</p>'+                                    
'</div> '+                       
'</article><!-- .blog-post end --> '+
'<div class="submit"><a href="javascript:void(0)" onclick="WIFrontSideEditing.PostSlider()">Post</div>'+
'<script type="text/javascript">'+
'var slideIndex = 1;'+
'showSlides(slideIndex);'+

'function plusSlides(n) {'+
 ' showSlides(slideIndex += n);'+
'}'+

'function currentSlide(n) {'+
  'showSlides(slideIndex = n);'+
'}'+

'function showSlides(n) {'+
  'var i;'+
  'var slides = document.getElementsByClassName("mySlides");'+
  'var dots = document.getElementsByClassName("dot");'+
  'if (n > slides.length) {slideIndex = 1}    '+
  'if (n < 1) {slideIndex = slides.length}'+
  'for (i = 0; i < slides.length; i++) {'+
    '  slides[i].style.display = "none";'+  
  '}'+
  'for (i = 0; i < dots.length; i++) {'+
      'dots[i].className = dots[i].className.replace(" active", "");'+
  '}'+
  'slides[slideIndex-1].style.display = "block";  '+
  'dots[slideIndex-1].className += " active";'+
'}'+
'</script>'+
'<script type="text/javascript">'+
                                   '$(document).ready(function(){'+
  'var obj0 = $("#dragandrophandler0");'+
  'var obj1 = $("#dragandrophandler1");'+
  'var obj2 = $("#dragandrophandler2");'+
'obj0.on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
    '$(this).css("border", "2px solid #0B85A1");'+
'});'+
'obj0.on("dragover", function (e) '+
'{'+
     'e.stopPropagation();'+
     'e.preventDefault();'+
'});'+

'obj1.on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
    '$(this).css("border", "2px solid #0B85A1");'+
'});'+
'obj1.on("dragover", function (e) '+
'{'+
     'e.stopPropagation();'+
     'e.preventDefault();'+
'});'+

'obj2.on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
    '$(this).css("border", "2px solid #0B85A1");'+
'});'+
'obj2.on("dragover", function (e) '+
'{'+
     'e.stopPropagation();'+
     'e.preventDefault();'+
'});'+

'obj0.on("drop", function (e) '+
'{'+
 
     '$(this).css("border", "2px dotted #0B85A1");'+
     'e.preventDefault();'+
     'var files = e.originalEvent.dataTransfer.files;'+
     'var colID0 = "img-preview0";'+
     'var col0 = "dragandrophandler0";'+
     'var mediaId0 = "media0";'+

     //We need to send dropped files to Server
     'handleSliderFileUpload(files,obj0, colID0, col0, mediaId0);'+
'});'+

'obj1.on("drop", function (e) '+
'{'+
 
     '$(this).css("border", "2px dotted #0B85A1");'+
     'e.preventDefault();'+
     'var files = e.originalEvent.dataTransfer.files;'+
     'var colID1 = "img-preview1";'+
     'var col1 = "dragandrophandler1";'+
     'var mediaId1 = "media1";'+

     //We need to send dropped files to Server
     'handleSliderFileUpload(files,obj1, colID1, col1, mediaId1);'+
'});'+

'obj2.on("drop", function (e) '+
'{'+
 
     '$(this).css("border", "2px dotted #0B85A1");'+
     'e.preventDefault();'+
     'var files = e.originalEvent.dataTransfer.files;'+
     'var colID2 = "img-preview2";'+
     'var col2 = "dragandrophandler2";'+
     'var mediaId2 = "media2";'+

     //We need to send dropped files to Server
     'handleSliderFileUpload(files,obj2, colID2, col2, mediaId2);'+
'});'+
'$(document).on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+
'$(document).on("dragover", function (e) '+
'{'+
  'e.stopPropagation();'+
  'e.preventDefault();'+
  'obj0.css("border", "2px dotted #0B85A1");'+
'});'+

'$(document).on("dragover", function (e) '+
'{'+
  'e.stopPropagation();'+
  'e.preventDefault();'+
  'obj1.css("border", "2px dotted #0B85A1");'+
'});'+

'$(document).on("dragover", function (e) '+
'{'+
  'e.stopPropagation();'+
  'e.preventDefault();'+
  'obj2.css("border", "2px dotted #0B85A1");'+
'});'+
'$(document).on("drop", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+

'});'+
'</script>');
	$("#shows_style").append(slider);
}

WIFrontSideEditing.video = function(){
WIFrontSideEditing.select_theatre();
WIFrontSideEditing.userRole('viduser');
	var nowDate		= new Date();
var nowDay		= ((nowDate.getDate().toString().length) == 1) ? '0'+(nowDate.getDate()) : (nowDate.getDate());
var nowMonth	= ((nowDate.getMonth().toString().length) == 1) ? '0'+(nowDate.getMonth()+1) : (nowDate.getMonth()+1);
var nowYear		= nowDate.getFullYear();
var formatDate	= nowDay + "." + nowMonth + "." + nowYear;

	var video = ('<!-- .latest-posts start -->'+                            
                              '<article class="post_container" id="blogPostVideo"> '+                             
                              '<div class="post-info">'+                                    
                              '<div class="post-date">'+                                        
                              '<span class="day">'+nowDay+'</span>'+                                        
                              '<span class="month">'+nowMonth+'</span> '+                                   
                              '</div>'+                                    
                              '<div class="post-category">'+                                     
                              '<i class="fa fa-picture-o"></i> '+                                   
                              '</div>'+                                
                              '</div><!-- .post-info end --> '+                               
                              '<figure class="post-video" id="Post_Vid">'+                 
                              '<div id="dragandrophandler">Drag & Drop Files Here</div>'+
        '<div class="vid-preview"></div>'+
        '<div class="upload-msg"></div></figure>'+                              
                               '<div class="post-content">'+  
                               '<div id="select_theatre"></div>'+                                   
                               '<h4><input type="text" id="post_title" placeholder="Blog post without media content"></h4>'+ 
                                '<input type="hidden" name="blog_video" id="blog_video" value="blog_video">'+                               
                               '<div class="blog-meta">'+                                        
                               '<ul> '+                                           
                               '<li class="fa fa-user">'+                                                
                               '<a href="javascript:void(0)" id="viduser"></a>'+                                           
                                '</li>'+                                           
                                 '<li class="post-tags fa fa-tags">'+                                               
                                  '<a href="javascript:void(0)">news, </a>'+                                                
                                  '<a href="javascript:void(0)">dois</a>'+                                           
                                   '</li>'+                                        
                                   '</ul>'+                                    
                                   '</div>'+                                    
                                   '<textarea id="blog_post" placeholder="blog post with video" rows="4"></textarea>'+                                                                    
               '<div class="submit btn btn-primary"><a href="javascript:void(0)" onclick="WIFrontSideEditing.PostVideo()">Post</div>'+                        
                                   '</article><!-- .blog-post end -->'+
                                   '<script type="text/javascript">'+
                                   '$(document).ready(function(){'+
  'var obj = $("#dragandrophandler");'+
'obj.on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
    '$(this).css("border", "2px solid #0B85A1");'+
'});'+
'obj.on("dragover", function (e) '+
'{'+
     'e.stopPropagation();'+
     'e.preventDefault();'+
'});'+
'obj.on("drop", function (e) '+
'{'+
 
     '$(this).css("border", "2px dotted #0B85A1");'+
     'e.preventDefault();'+
     'var files = e.originalEvent.dataTransfer.files;'+
     //We need to send dropped files to Server
     'handleFileUpload(files,obj);'+
'});'+
'$(document).on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+
'$(document).on("dragover", function (e) '+
'{'+
  'e.stopPropagation();'+
  'e.preventDefault();'+
  'obj.css("border", "2px dotted #0B85A1");'+
'});'+
'$(document).on("drop", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+

'});'+
'</script>');
	$("#shows_style").append(video);

}


WIFrontSideEditing.actor = function(){
WIFrontSideEditing.select_theatre();
WIFrontSideEditing.userRole('actorEditUser');
WIFrontSideEditing.actorRole('actorUser')


	var actor = ('<article class="post_container" id="ActorPost">'+
    '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
                        '<label for="name" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
        '<input type="text" name="actor_name" id="actorName" placeholder="Actor\'s Name">'+
      '</label>'+
                '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">'+
      '<div class="show-meta"> '+                                      
    '<ul>'+                  
    '<li class="fa fa-user" id="actorUser"></li> '+
    '<li class="fa fa-user" type="hidden" id="actorEditUser"></li> '+                                         
                                     
'</ul>'+                                
'</div>'+
  '<figure class="post-image" id="show_Image">'+               
          '<div id="dragandrophandler">Drag & Drop Files Here</div>'+
        '<div class="img-preview" id="preview"></div>'+
        '<div class="upload-msg" id="status"></div></figure></div>'+
        '<input type="hidden" name="supload" id="supload" value="actor">'+
  '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><input type="text" name="bio" id="bio" placeholder="Biography"></div>'+

        '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
          '<div id="shows"></div>'+

          '<div class="submit btn btn-primary">'+
       '<a href="javascript:void(0)" onclick="WIFrontSideEditing.PostShow()">Post</a>'+
       '</div>'+
      '<div class="submit btn btn-primary">'+
          '<a href="javascript:void(0)" onclick="WIFrontSideEditing.cancelPost(`ActorPost`)">Cancel</a>'+

 '</div>'+
      '</div>'+

    '</div>'+
                                   '<script type="text/javascript">'+
                                   '$(document).ready(function(){'+
  'var obj = $("#dragandrophandler");'+
  '  var dir = $("#supload").attr("value");'+
'obj.on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
    '$(this).css("border", "2px solid #0B85A1");'+
'});'+
'obj.on("dragover", function (e) '+
'{'+
     'e.stopPropagation();'+
     'e.preventDefault();'+
'});'+
'obj.on("drop", function (e) '+
'{'+
 
     '$(this).css("border", "2px dotted #0B85A1");'+
     'e.preventDefault();'+
     'var files = e.originalEvent.dataTransfer.files;'+
     //We need to send dropped files to Server
     'handleFileUpload(files,obj, dir);'+
'});'+
'$(document).on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+
'$(document).on("dragover", function (e) '+
'{'+
  'e.stopPropagation();'+
  'e.preventDefault();'+
  'obj.css("border", "2px dotted #0B85A1");'+
'});'+
'$(document).on("drop", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+

'});'+
'</script>');
	$("#shows_style").append(actor);
}

WIFrontSideEditing.show = function(){
WIFrontSideEditing.select_theatre();
WIFrontSideEditing.select_company();
WIFrontSideEditing.userRole('showUser');
	var nowDate		= new Date();
var nowDay		= ((nowDate.getDate().toString().length) == 1) ? '0'+(nowDate.getDate()) : (nowDate.getDate());
var nowMonth	= ((nowDate.getMonth().toString().length) == 1) ? '0'+(nowDate.getMonth()+1) : (nowDate.getMonth()+1);
var nowYear		= nowDate.getFullYear();
var formatDate	= nowDay + "." + nowMonth + "." + nowYear;

	var show = ('<article class="post_container" id="showPost">'+  
  '<script>'+
  '$( function() {'+
    'jQuery.datepicker.setDefaults({dateFormat:"yy-mm-dd"});'+
    '$( "#datepicker" ).datepicker({changeMonth: true, changeYear: true});'+
    '$( "#datepicker1" ).datepicker({changeMonth: true, changeYear: true});'+
  '} );'+
  '</script>'+                           
                '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
                '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">'+
      '<div class="show-meta">'+                                        
    '<ul>'+                                            
    '<li class="fa fa-user" id="showUser">'+                                                
    '</li> '+                                          
                                     
'</ul>'+                                    
'</div>'+
      '<figure class="post-image" id="show_Image">'+                 
                              '<div id="dragandrophandler">Drag & Drop Files Here</div>'+
        '<div class="img-preview" id="preview"></div>'+
        '<div class="upload-msg" id="status"></div></figure></div>'+
        '<input type="hidden" name="supload" id="supload" value="show">'+
        '<label for="name" class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input id="show_name" placeholder="Show Name" style="width:100%;"></label>'+
              '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
              '<div class="icon">'+
                '<i class="icon-theatre"></i>'+
                '<span id="select_theatre"></span>'+
              '</div></div>'+
        '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
        '<div class="icon">'+
                '<i class="icon-company"></i>'+
                '<span id="select_company"></span>'+
              '</div>'+

        '<div class="icon">'+
        '<div class="icon">'+
                '<i class="icon-dates"></i>'+
                '<span id="start_date"><p>Date: <input type="text" id="datepicker"></p></span>-<span id="end_date"></p><p>Date: <input type="text" id="datepicker1"></p></span>'+
              '</div>'+
                            
                        '</div>'+
        '</div>'+
        '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
        '<label for="name" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><p><h2 id="about">What is this about</h2></p><textarea type="text" name="description" placeholder="Write a short description" id="description"></textarea>'+
        '</div>'+
      

      '</div>'+
      '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
              '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="cast">Cast<ul id="casting"><li><input id="1" class="casting" name="cast_name" placeholder="Cast Name"</li><span onclick="WIFrontSideEditing.addCast();"><i class="far fa-plus-square"></i></span></ul></div>'+
            '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" id="crew"></div>'+
     

       '<div class="submit btn btn-primary">'+
       '<a href="javascript:void(0)" onclick="WIFrontSideEditing.PostShow()">Post</a>'+
       '</div>'+
      '<div class="submit btn btn-primary">'+
          '<a href="javascript:void(0)" onclick="WIFrontSideEditing.cancelPost(`showPost`)">Cancel</a>'+

 '</div>'+
    '</div>'+                         
         '</article><!-- .blog-post end -->'+

         '<script type="text/javascript">'+
                                   '$(document).ready(function(){'+
  'var obj = $("#dragandrophandler");'+
  '  var dir = $("#supload").attr("value");'+
'obj.on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
    '$(this).css("border", "2px solid #0B85A1");'+
'});'+
'obj.on("dragover", function (e) '+
'{'+
     'e.stopPropagation();'+
     'e.preventDefault();'+
'});'+
'obj.on("drop", function (e) '+
'{'+
 
     '$(this).css("border", "2px dotted #0B85A1");'+
     'e.preventDefault();'+
     'var files = e.originalEvent.dataTransfer.files;'+
 
     //We need to send dropped files to Server
     'handleFileUpload(files,obj, dir);'+
'});'+
'$(document).on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+
'$(document).on("dragover", function (e) '+
'{'+
  'e.stopPropagation();'+
  'e.preventDefault();'+
  'obj.css("border", "2px dotted #0B85A1");'+
'});'+
'$(document).on("drop", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+

'});'+
'</script>');
	$("#shows_style").append(show);
}

WIFrontSideEditing.company = function(){
WIFrontSideEditing.userRole('companyUploader');

	var company = ('<article class="post_container" id="companyPost">'+                             
                '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
                '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">'+
      '<div class="company-meta">'+                                        
    '<ul>'+                                            
    '<li class="fa fa-user">'+                                                
    '<a href="javascript:void(0)" id="companyUploader"></a>'+                                            
    '</li> '+                                          
                                     
'</ul>'+                                    
'</div>'+
      '<figure class="post-image" id="company_Image">'+                 
                              '<div id="dragandrophandler">Drag & Drop Files Here</div>'+
        '<div class="img-preview" id="preview"></div>'+
        '<div class="upload-msg" id="status"></div></figure></div>'+
        '<input type="hidden" name="supload" id="supload" value="company">'+
      '<label for="name" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
      '<input type="text" name="company" id="companyName" placeholder="Company Name"></label>'+
        '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><textarea id="bio" placeholder="Company Biography"></textarea></div>'+
      

      '</div>'+
      '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
      '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" name="address" id="address" placeholder="Company address"></div>'+
      '</div>'+
   '<div class="submit btn btn-primary">'+
   '<a href="javascript:void(0)" onclick="WIFrontSideEditing.PostCompany()">Post</a>'+ 
   '</div>'+
      '<div class="submit btn btn-primary">'+
         '<a href="javascript:void(0)" onclick="WIFrontSideEditing.cancelPost(`company`)">Cancel</a>'+

       '</div>'+
                  
               '</article>'+
            '<script type="text/javascript">'+
                                   '$(document).ready(function(){'+
  'var obj = $("#dragandrophandler");'+
  '  var dir = $("#supload").attr("value");'+
'obj.on("dragenter", function (e) '+

'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
    '$(this).css("border", "2px solid #0B85A1");'+
'});'+
'obj.on("dragover", function (e) '+
'{'+
     'e.stopPropagation();'+
     'e.preventDefault();'+
'});'+
'obj.on("drop", function (e) '+
'{'+
 
     '$(this).css("border", "2px dotted #0B85A1");'+
     'e.preventDefault();'+
     'var files = e.originalEvent.dataTransfer.files;'+
 
     //We need to send dropped files to Server
     'handleFileUpload(files,obj, dir);'+
'});'+
'$(document).on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+
'$(document).on("dragover", function (e) '+
'{'+
  'e.stopPropagation();'+
  'e.preventDefault();'+
  'obj.css("border", "2px dotted #0B85A1");'+
'});'+
'$(document).on("drop", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+

'});'+
'</script>');
	$("#shows_style").append(company);
}

WIFrontSideEditing.theatre = function(){
WIFrontSideEditing.userRole('theatreUploader');


	var theatre = ('<article class="post_container" id="theatrePost"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
      '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">'+
      '<div class="theatre-meta">'+                                        
    '<ul>'+                                            
    '<li class="fa fa-user">'+                                                
    '<a href="javascript:void(0)" id="theatreUploader"></a>'+                                            
    '</li> '+                                          
                                     
'</ul>'+                                    
'</div>'+
      '<figure class="post-image" id="Theatre_Image">'+                 
                              '<div id="dragandrophandler">Drag & Drop Files Here</div>'+
        '<div class="img-preview" id="preview"></div>'+
        '<div class="upload-msg" id="status"></div></figure></div>'+
        '<input type="hidden" name="supload" id="supload" value="theatres">'+
      '<label for="name" class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input id="theatre_name" value="" placeholder="Theatre Name" style="width:100%;"></label>'+
       '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">'+
        '<div class="icon">'+
                '<i class="icon-address"></i>'+
                '<span><input id="fline" placeholder="First Line Of Theatre\'s address"></span>'+
                '<span><input id="sline" placeholder="Second Line Of Theatre\'s address"></span>'+
                '<span><input id="city" placeholder="Theatre\'s City"></span>'+
                '<span><input id="postcode" placeholder="Theatre\'s postcode"></span>'+
              '</div></div>'+

        '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><textArea id="description" placeholder="Theatre\'s description"></textArea></div>'+
      

      '</div>'+
      '<div class="submit btn btn-primary">'+
      '<a href="javascript:void(0)" onclick="WIFrontSideEditing.PostTheatre()">Post</a>'+
      '</div>'+
      '<div class="submit btn btn-primary">'+
      '<a href="javascript:void(0)" onclick="WIFrontSideEditing.cancelPost(`theatrePost`);">Cancel</a>'+
      '</div>'+

    '</div></div></article>'+
    '<script type="text/javascript">'+
                                   '$(document).ready(function(){'+
  'var obj = $("#dragandrophandler");'+
  '  var dir = $("#supload").attr("value");'+
'obj.on("dragenter", function (e) '+

'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
    '$(this).css("border", "2px solid #0B85A1");'+
'});'+
'obj.on("dragover", function (e) '+
'{'+
     'e.stopPropagation();'+
     'e.preventDefault();'+
'});'+
'obj.on("drop", function (e) '+
'{'+
 
     '$(this).css("border", "2px dotted #0B85A1");'+
     'e.preventDefault();'+
     'var files = e.originalEvent.dataTransfer.files;'+
 
     //We need to send dropped files to Server
     'handleFileUpload(files,obj, dir);'+
'});'+
'$(document).on("dragenter", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+
'$(document).on("dragover", function (e) '+
'{'+
  'e.stopPropagation();'+
  'e.preventDefault();'+
  'obj.css("border", "2px dotted #0B85A1");'+
'});'+
'$(document).on("drop", function (e) '+
'{'+
    'e.stopPropagation();'+
    'e.preventDefault();'+
'});'+

'});'+
'</script>');
         $("#shows_style").append(theatre);
}

WIFrontSideEditing.haveshows = function(){

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "haveshows",
        posts : 1
      },
      success  : function(data){

        $("#shows").html(data);
      }
    })
}

WIFrontSideEditing.userRole = function(colID){

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "userRole"
      },
      success  : function(data){

        $("#"+colID).html(data);
      }
    })
}


WIFrontSideEditing.actorRole = function(colID){

  $.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "actorRole"
      },
      success  : function(data){

        $("#"+colID).html(data);
      }
    })
}

WIFrontSideEditing.addCast = function(){

  /*var $cast = ('<li><input id="1" name="cast_name" placeholder="Cast Name"</li>');
  $("#casting").append(cast);*/
  var cast_id = parseInt($("input.casting:last").attr('id'));
  cast_id++;

  $('<li><input id="'+cast_id+'" class="casting" name="cast_name" placeholder="Cast Name"</li>').insertAfter('ul#casting>li:last');

}











