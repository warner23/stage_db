$(document).ready(function(event)
{
    WIPages.loadList();
    $("#newpage").click(function(){
        var NPN = $("#page_title").val();
        var Value = $("#addToMenu").attr('value');

         $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "new_page",
            page   : NPN,
            Value  : Value
        },
        success: function(result)
        {
  
            var res = JSON.parse(result);
            if (res.completed === "saved") {
                var page_id = res.page_id;
                //alert(page);
                    var date = new Date();
                     var minutes = 30;
               date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("page_id", page_id, {expires: date});
            
                window.location = "WIEditpage.php";
            }

            
        }
    });
    }) 




});


var WIPages = {}

WIPages.Page = function(){
	var page = $("#page").html();
    	//alert(page);

	 $.ajax({
    	url: "WICore/WIClass/WIAjax.php",
    	type: "POST",
    	data: {
    		action : "page_saver",
    		page   : page
    	},
    	success: function(result)
    	{
  
    		var res = JSON.parse(result);
    		if (res.completed === "saved") {

    			window.location = "WIEditpage.php";
    		}
            
    	}
    });

}

WIPages.Delete = function(id, name){


     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "page_delete",
            page_id   : id,
            name      : name
        },
        success: function(result)
        {
            var res = JSON.parse(result);
            if (res.status === "complete"){
                $("#div").remove();
            }
            $("#modal-delete").removeClass("on").addClass("off");
            WIPages.loadList();
            
        }
    });
}

WIPages.Open = function(id, name){

    $("#modal-delete").removeClass("off").addClass("on");

    var Element = $("#details-body");

    var Div = '<div id="div"><span>Are you sure you want to delete '+name+' page </span> <button class="btn btn-danger" onclick="WIPages.Delete(`'+id+'`, `'+name+'`);">Delete</button> <button class="btn" onclick="WIPages.Close();">Cancel</button></div>';

    Element.append(Div);



}

WIPages.Close = function(){

    $("#modal-delete").removeClass("on");
    $("#modal-delete").addClass("off");
    $("#div").remove();

}

WIPages.loadList = function(){

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "pageList"
        },
        success: function(result)
        {
           $("#pageListing").html(result);
            
        }
    });
}

WIPages.menuChange = function(){
    var Value = $("#addToMenu").attr('value');

    if (Value === "0") {
        $("#addToMenu").attr('value', "1");
    }else{
         $("#addToMenu").attr('value', "0");
    }

}

WIPages.href = function(page_id){
     var page_id     = page_id;
            //alert(page_id);
            //$.cookie.set("page_id", "page_id");

             var date = new Date();
 var minutes = 30;
 date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie("page_id", page_id, {expires: date});
            window.location.href = "WIEditpage.php";

}