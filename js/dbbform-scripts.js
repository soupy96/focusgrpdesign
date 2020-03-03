jQuery("#contactForm").validator().on("submit", function (event) {
    console.log("1");
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        console.log("3");
        formError();
        submitMSG(false, "You might have forgotten something. Please try again.");
    } else {
        // everything looks good!
        event.preventDefault();
        console.log("2");
        submitForm();
    }
});


function submitForm(){
    // Initiate Variables With Form Content
    var name = $("#nf-field-16").val();
    var email = $("#nf-field-17").val();
    var phonenumber = $("#nf-field-25").val();
    var company = $("#nf-field-20").val();
    let comment = $("#nf-field-18").val();

    console.log("4");

    jQuery.ajax({
        type: "POST",
        url: "php/dbbform-process.php",
        data: "firstname=" + name + "&email=" + email + "&phonenumber=" + phonenumber + "&company=" + company + "&comment=" + comment,
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
    // $("#contactForm")[0].reset();
    submitMSG(true, "Thanks for reaching out to us. We'll be in contact shortly!");
    console.log("success");
}

function formError(){
    jQuery("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        jQuery(this).removeClass();
        console.log("error");
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
        jQuery("#form-submit").attr("style", "display: none;");
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    jQuery("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}