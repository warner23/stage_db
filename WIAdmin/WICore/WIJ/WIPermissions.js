$(document).ready(function(event)
{
        WIPermissions.permissions();
        WIPermissions.GroupPermissions();

});


var WIPermissions = {}

WIPermissions.change = function(id, column){
    event.preventDefault();

    // put button into the loading state

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "permission_change",
            id   : id,
            column : column
        },
        success: function(result)
        {
            
            var res = JSON.parse(result);
            //var res = $.parseJSON(result);
            console.log(res);
            if(res.status === "successful")
            {
            $("#"+column+"-"+id).attr("value", res.result);
                if (res.result > 0) {
                $("#"+column+"-"+id).removeClass(`no`);
                }else{
                     $("#"+column+"-"+id).addClass(`no`); 
             
                }
               WICore.displaySuccessfulMessage($("#presults"), res.msg);
            }

        }
    });
}

WIPermissions.CreateNewPermission = function(role_id, role){

    var permName = $("input#permissionName"+role_id).val(),
        group    = $("select#groups"+role_id).val();

         $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "createPermission",
            role_id   : role_id,
            role : role,
            permName : permName,
            group  : group
        },
        success: function(result)
        {
             var res = JSON.parse(result);
           if (res.status == "successful") {
            //$("#Presult").html(res.msg)
            WIPermissions.permissions();
        }
       }
    });


}

WIPermissions.createNewGroup = function(){

    var group = $("#permissionGroup").val();

         $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "groupPermission",
            group : group
        },
        success: function(result)
        {
            var res = JSON.parse(result);
           if (res.status == "successful") {
            $("#Presult").html(res.msg)
            WIPermissions.GroupPermissions();
           }
        }
    });


}

WIPermissions.permissions = function(){

         $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "permissions"
        },
        success: function(result)
        {
            //console.log(result);
            $("#permissions").html(result);
        }
    });


}

WIPermissions.GroupPermissions = function(){

         $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "groupPerms"
        },
        success: function(result)
        {
         $("#groupPerms").html(result)
        }
    });


}