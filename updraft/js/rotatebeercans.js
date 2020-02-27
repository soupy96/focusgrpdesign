$(document).ready(function(){
    var degrees = 0;
    $( ".crossRotate" ).click(function() {
        degrees += -90;
        console.log(degrees);
        $(this).css("transform","rotate("+degrees+"deg)");
    });
});