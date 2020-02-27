$("#contactForm").validator().on("submit", function (event) {
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
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    var email = $("#email").val();
    var phonenumber = $("#phonenumber").val();
    let comment = $("#comment").val();
    var company = $("#company").val();

    $.ajax({
        type: "POST",
        url: "php/form-process.php",
        data: "firstname=" + firstname + "&lastname=" + lastname + "&email=" + email + "&phonenumber=" + phonenumber + "&comment=" + comment + "&company=" + company,
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
    submitMSG(true, "Thanks for reaching out to us. We'll be in contact shortly!")
}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
        $("#form-submit").attr("style", "display: none;");
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}