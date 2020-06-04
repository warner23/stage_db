$(document).ready(function(event)
{
    WIDashboard.info_box();
    WIDashboard.todoList();
    WIDashboard.Notificationscount();
    WIDashboard.MessagesCount();
    WIDashboard.registeredUsercount();
    WIDashboard.TasksCount();
    
   


     //executes code below when user click on pagination links
    $("#todolist").on( "click", ".pagination a", function (e){
        e.preventDefault();
        $(".loading-div").removeClass('closed'); //remove closed element
        $(".loading-div").addClass('open'); //show loading element
        var page = $(this).attr("data-page"); //get page number from link

             $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "NextPagetodolist",
            todo   : 1,
            page : page
        },
        success: function(result)
        {
            $("#todolist").html(result);
              $(".loading-div").removeClass('open'); //remove closed element
        $(".loading-div").addClass('closed'); //show loading element
        }
       
        
    });

         });


    $("a.pagination").on( "click", "a.pagination", function (e){
        e.preventDefault();
        $(".loading-div").removeClass('closed'); //remove closed element
        $(".loading-div").addClass('open'); //show loading element
        var page = $(this).attr("data-page"); //get page number from link

             $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "NextPagenotifications",
            page : page
        },
        success: function(result)
        {
            $("#Notifications").html(result);
              $(".loading-div").removeClass('open'); //remove closed element
        $(".loading-div").addClass('closed'); //show loading element
        }
       
        
    });

         });
});


var WIDashboard = {};

 
WIDashboard.todoList = function(){

    $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "todoList"
                    },
        success: function(result)
        {


                $("#todolist").html(result);
            
        }
    });

}

WIDashboard.completed = function(id){

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "todoListcomplete",
            id      : id
                    },
        success: function(result)
        {
            
        }
    });
}


WIDashboard.showAddTodoModal = function () {
    //jQuery.noConflict();
    $("#modal-todo-add").removeClass("off")
    $("#modal-todo-add").addClass("on")

};


WIDashboard.Closed = function(){
    $("#modal-todo-add").removeClass("on")
    $("#modal-todo-add").addClass("off")
}


WIDashboard.AddTodo = function(){
    var todoItem = $("#add_todoList_Item").val();
        $(".ajax-loading").removeClass("off")
    $(".ajax-loading").addClass("on")
         $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "todoListAdd",
            todoItem : todoItem
                    },
        success: function(result)
        {
             $(".ajax-loading").removeClass("on")
    $(".ajax-loading").addClass("off")
    WIDashboard.Closed();
            WIDashboard.todoList();
        }
    });
}


WIDashboard.DeleteTodo = function(id){


         $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "todoListDelete",
            id : id
                    },
        success: function(result)
        {
            WIDashboard.todoList();
        }
    });
}

WIDashboard.Notifications = function(){

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "Notifications"
                    },
        success: function(result)
        {
             $("#Notifications").html(result)
        }
    });
}

WIDashboard.Notificationscount = function(){

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "NotificationsCount"
                    },
        success: function(result)
        {
             $("#not_badge").html(result)
        }
    });
}


WIDashboard.Notifications = function(){

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "Notifications"
                    },
        success: function(result)
        {
             $("#Notifications").html(result)
        }
    });
}

WIDashboard.WINotifications = function(){

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "NotificationsList"
                    },
        success: function(result)
        {
             $("#WINotifications").html(result)
        }
    });
}

WIDashboard.registeredUsercount = function(){

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "registeredUsercount"
                    },
        success: function(result)
        {
             $("#regUser").html(result)
        }
    });
}

WIDashboard.messages = function(){

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "getMessages"
                    },
        success: function(result)
        {
             $("#cmessages").html(result)
        }
    });
}


WIDashboard.MessagesCount = function(){

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "MessagesCount"
                    },
        success: function(result)
        {
             $("#mess_badge").html(result)
        }
    });
}

WIDashboard.tasks = function(){

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "tasks"
                    },
        success: function(result)
        {
             $("#tasks").html(result)
        }
    });
}

WIDashboard.TasksCount = function(){

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "TasksCount"
                    },
        success: function(result)
        {
             $("#task_badge").html(result)
        }
    });
}

WIDashboard.info_box = function(){

     $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "GET",
        data: {
            action : "info_box"
                    },
        success: function(result)
        {
             $("#small-box").html(result)
        }
    });
}

WIDashboard.NextNotification = function(page){
     $(".loading-div").removeClass('closed'); //remove closed element
        $(".loading-div").addClass('open'); //show loading element
        //var page = $(this).attr("data-page"); //get page number from link

             $.ajax({
        url: "WICore/WIClass/WIAjax.php",
        type: "POST",
        data: {
            action : "NextNotification",
            page : page
        },
        success: function(result)
        {
            $("#WINotifications").html(result);
              $(".loading-div").removeClass('open'); //remove closed element
        $(".loading-div").addClass('closed'); //show loading element
        }
       
    });
}
