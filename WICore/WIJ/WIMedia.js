//var WIMediaCenter = {};

function sendFileToServer(formData,status)
{
      var uploadURL ="WICore/WIClass/ImageUpload.php"; //Upload URL
    var extraData ={}; //Extra Data.
    var jqXHR=$.ajax({
            xhr: function() {
            var xhrobj = $.ajaxSettings.xhr();
            if (xhrobj.upload) {
                    xhrobj.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //Set progress
                        status.setProgress(percent);
                    }, false);
                }
            return xhrobj;
        },
    url: uploadURL,
    type: "POST",
    contentType:false,
    processData: false,
        cache: false,
        data: formData,
        success: function(data){
            status.setProgress(100);
 
            $("#status1").append("File upload Done<br>");         
        }
    }); 
 
    status.setAbort(jqXHR);
}


function sendFileToTheatreServer(formData,status)
{
      var uploadURL ="WIAdmin/WICore/WIClass/TheatreImageUpload.php"; //Upload URL
    var extraData ={}; //Extra Data.
    var jqXHR=$.ajax({
            xhr: function() {
            var xhrobj = $.ajaxSettings.xhr();
            if (xhrobj.upload) {
                    xhrobj.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //Set progress
                        status.setProgress(percent);
                    }, false);
                }
            return xhrobj;
        },
    url: uploadURL,
    type: "POST",
    contentType:false,
    processData: false,
        cache: false,
        data: formData,
        success: function(data){
            //console.log(data);
            info = JSON.parse(data);
            //alert(info.name);
            status.setProgress(100);
            $("#status").append("File upload Done<br>").fadeOut(7000);
            $("#dragandrophandler").remove()
            preview = ('<img src="'+info.name+'" class="img-responsive" id="theatreUpload" value="'+info.id+'">');
            $("#preview").append(preview);

        }
    }); 
 
    status.setAbort(jqXHR);
}
 



function sendFileToCompanyServer(formData,status)
{
      var uploadURL ="WIAdmin/WICore/WIClass/CompanyImageUpload.php"; //Upload URL
    var extraData ={}; //Extra Data.
    var jqXHR=$.ajax({
            xhr: function() {
            var xhrobj = $.ajaxSettings.xhr();
            if (xhrobj.upload) {
                    xhrobj.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //Set progress
                        status.setProgress(percent);
                    }, false);
                }
            return xhrobj;
        },
    url: uploadURL,
    type: "POST",
    contentType:false,
    processData: false,
        cache: false,
        data: formData,
        success: function(data){
            //console.log(data);
            info = JSON.parse(data);
            //alert(info.name);
            status.setProgress(100);
            $("#status").append("File upload Done<br>").fadeOut(7000);
            $("#dragandrophandler").remove()
            preview = ('<img src="'+info.name+'" class="img-responsive" id="theatreUpload" value="'+info.id+'">');
            $("#preview").append(preview);

        }
    }); 
 
    status.setAbort(jqXHR);
}


function sendFileToShowServer(formData,status)
{
      var uploadURL ="WIAdmin/WICore/WIClass/ShowImageUpload.php"; //Upload URL
    var extraData ={}; //Extra Data.
    var jqXHR=$.ajax({
            xhr: function() {
            var xhrobj = $.ajaxSettings.xhr();
            if (xhrobj.upload) {
                    xhrobj.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //Set progress
                        status.setProgress(percent);
                    }, false);
                }
            return xhrobj;
        },
    url: uploadURL,
    type: "POST",
    contentType:false,
    processData: false,
        cache: false,
        data: formData,
        success: function(data){
            //console.log(data);
            info = JSON.parse(data);
            //alert(info.name);
            status.setProgress(100);
            $("#status").append("File upload Done<br>").fadeOut(7000);
            $("#dragandrophandler").remove()
            preview = ('<img src="'+info.name+'" class="img-responsive" id="theatreUpload" value="'+info.id+'">');
            $("#preview").append(preview);

        }
    }); 
 
    status.setAbort(jqXHR);
}


function sendFileToActorServer(formData,status)
{
      var uploadURL ="WIAdmin/WICore/WIClass/ActorImageUpload.php"; //Upload URL
    var extraData ={}; //Extra Data.
    var jqXHR=$.ajax({
            xhr: function() {
            var xhrobj = $.ajaxSettings.xhr();
            if (xhrobj.upload) {
                    xhrobj.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //Set progress
                        status.setProgress(percent);
                    }, false);
                }
            return xhrobj;
        },
    url: uploadURL,
    type: "POST",
    contentType:false,
    processData: false,
        cache: false,
        data: formData,
        success: function(data){
            //console.log(data);
            info = JSON.parse(data);
            //alert(info.name);
            status.setProgress(100);
            $("#status").append("File upload Done<br>").fadeOut(7000);
            $("#dragandrophandler").remove()
            preview = ('<img src="'+info.name+'" class="img-responsive" id="theatreUpload" value="'+info.id+'">');
            $("#preview").append(preview);

        }
    }); 
 
    status.setAbort(jqXHR);
}


var rowCount=0;
function createStatusbar(obj)
{
     rowCount++;
     var row="odd";
     if(rowCount %2 ==0) row ="even";
     this.statusbar = $("<div class='statusbar "+row+"'></div>");
     this.filename = $("<div class='filename'></div>").appendTo(this.statusbar);
     this.size = $("<div class='filesize'></div>").appendTo(this.statusbar);
     this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
     this.abort = $("<div class='abort'>Abort</div>").appendTo(this.statusbar);
     obj.after(this.statusbar);
 
    this.setFileNameSize = function(name,size)
    {
        var sizeStr="";
        var sizeKB = size/1024;
        if(parseInt(sizeKB) > 1024)
        {
            var sizeMB = sizeKB/1024;
            sizeStr = sizeMB.toFixed(2)+" MB";
        }
        else
        {
            sizeStr = sizeKB.toFixed(2)+" KB";
        }
 
        this.filename.html(name);
        this.size.html(sizeStr);
    }
    this.setProgress = function(progress)
    {       
        var progressBarWidth =progress*this.progressBar.width()/ 100;  
        this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% ");
        if(parseInt(progress) >= 100)
        {
             var stat = $("#status1");
            this.abort.hide();
            this.statusbar.hide();
            stat.hide();

        }
    }
    this.setAbort = function(jqxhr)
    {
        var sb = this.statusbar;
        this.abort.click(function()
        {
            jqxhr.abort();
            sb.hide();
        });
    }
}
function handleFileUpload(files,obj, dir)
{
   for (var i = 0; i < files.length; i++) 
   {
        var fd = new FormData();
        fd.append('file', files[i]);
 
        var status = new createStatusbar(obj); //Using this we can set progress.
        status.setFileNameSize(files[i].name,files[i].size);
        if (dir === "theatres") {
            sendFileToTheatreServer(fd,status);
        }else if(dir === "company") {
             sendFileToCompanyServer(fd,status);
        }else if(dir === "show") {
             sendFileToShowServer(fd,status);
        }else if(dir === "actor") {
             sendFileToActorServer(fd,status);
        }
        //sendFileToServer(fd,status);
 
   }
}
