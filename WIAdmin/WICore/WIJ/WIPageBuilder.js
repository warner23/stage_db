
$(document).ready(function(event)
{
 

             
});


var WIPageBuilder = {};

WIPageBuilder.sideeditColumn = function(classy, id, group, groupAction){
    //stageField-1, stageRow-1

    if ( $("."+group).hasClass("rowEditing")) {
    $("."+group).removeClass("rowEditing").addClass("rowEdit");
    $("."+group).css("display", "none");
    $(".rowEdit."+group).css("display", "none");
    $("."+classy).css("display", "block");
    $("."+groupAction).css("display", "block");
    $("."+id).removeClass("editing-rows")
    
    }else{
    $("."+group).removeClass("rowEdit").addClass("rowEditing");
    $("."+group).css("display", "block");
    $(".rowEditing."+group).css("display", "none");
    $("."+classy).css("display", "none");
    $("."+groupAction).css("display", "none");
    $("."+id).addClass("editing-rows");

    }
   

}

WIPageBuilder.editAttr = function(){

    if ( $(".panelCount").hasClass("fieldEditing")) {
    $(".panelCount").removeClass("fieldEditing").addClass("fieldEdit");
    $(".groupConfig").css("display", "none");
    $(".rowEdit.groupConfig").css("display", "none");
    $(".stageFields").css("display", "none");
    $(".midgroupActions").css("display", "block");
    $(".prev-group").css("display", "block");
    $(".next-group").css("display", "block");
    
    }else{
    $(".panelCount").removeClass("fieldEdit").addClass("fieldEditing");
    $(".groupConfig").css("display", "block");
    $(".rowEdit.groupConfig").css("display", "none");
    $(".stageFields").css("display", "block");
    $(".midgroupActions").css("display", "none");
    $(".prev-group").css("display", "none");
    $(".next-group").css("display", "none");

    }
}

WIPageBuilder.SideActions = function(){
    $(".stageRow").removeClass('stageRow:before');
    
}

WIPageBuilder.cloneRow = function(mod_name){
    
     if($("ul#droppable").hasClass('empty-stage')){
        var empty = "1";
     }else{
        var empty = "0";
     }

    id = "droppable";
     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "drop_call",
            mod_name : mod_name,
            mod_drop : mod_name,
            empty   : empty
        },
        success: function(result)
        {

        $(result).insertAfter( "ul#droppable>li:last" );

        }
    })
    
}

WIPageBuilder.clonecolumn = function(mod_name){
    if($("ul#droppable").hasClass('empty-stage')){
        var empty = "1";
     }else{
        var empty = "0";
     }
    id = "droppable";
     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "clonecolumn",
            mod_name : mod_name,
            empty : empty
        },
        success: function(result)
        {

        $(result).insertAfter( "ul.stageColumn" );
        $("#endActions").css("display", "block");

        }
    })
    
}


WIPageBuilder.Move = function(){

}


WIPageBuilder.Handle = function(){

}

WIPageBuilder.Removecol = function(id){
    $("li#"+id).remove();
}

WIPageBuilder.deleteRow = function(id){
    $("ul#"+id).remove();
}

WIPageBuilder.Rotate = function(){

    if($(".elementsE").hasClass('on') ) {
    $(".elementsE").removeClass('on').addClass('off');
    $(".elementsL").removeClass('off').addClass('on');
    $( "#html" ).removeClass('on').addClass('off');
    $( "#layout" ).removeClass('off').addClass('on');
    }
    if ($(".elementsC").hasClass('on') ) {
    $(".elementsC").removeClass('on').addClass('off');
    $(".elementsE").removeClass('off').addClass('on');
    $( "#common" ).removeClass('on').addClass('off');
    $( "#html" ).removeClass('off').addClass('on');
    }


    
}

WIPageBuilder.RotateX = function(){
    
        if ($(".elementsE").hasClass('on') ) {
    $(".elementsE").removeClass('on').addClass('off');
    $(".elementsC").removeClass('off').addClass('on');
    $( "#html" ).removeClass('on').addClass('off');
    $( "#common" ).removeClass('off').addClass('on');
    }

    if ($(".elementsL").hasClass('on') ) {
    $(".elementsL").removeClass('on').addClass('off');
    $(".elementsE").removeClass('off').addClass('on');
    $( "#layout" ).removeClass('on').addClass('off');
    $( "#html" ).removeClass('off').addClass('on');
    }

}



