jQuery("#dbbcontactForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "You might have forgotten something. Please try again.");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});


function submitForm(){
    // Initiate Variables With Form Content
    var dbbname = jQuery("#dbbname").val();
    var dbbemail = jQuery("#dbbemail").val();
    var dbbphonenumber = jQuery("#dbbphonenumber").val();
    var dbbcompany = jQuery("#dbbcompany").val();
    var dbbcomment = jQuery("#dbbcomment").val();

    jQuery.ajax({
        type: "POST",
        url: "php/dbbform-process.php",
        data: "dbbname=" + dbbname + "&dbbemail=" + dbbemail + "&dbbphonenumber=" + dbbphonenumber + "&dbbcompany=" + dbbcompany + "&dbbcomment=" + dbbcomment,
        success : function(text){
            if (text == "success"){
                formSuccess();
            } else {
                formError();
                submitMSG(false,text);
            }
        }
    });
}

function formSuccess(){
    submitMSG(true, "Thanks for reaching out to us. We'll be in contact shortly!")
}

function formError(){
    jQuery("#dbbcontactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        jQuery(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
        jQuery("#dbbform-submit").attr("style", "display: none;");
    } else {
        var msgClasses = "h3 text-center nl-danger";
    }
    jQuery("#dbbmsgSubmit").removeClass().addClass(msgClasses).text(msg);
}