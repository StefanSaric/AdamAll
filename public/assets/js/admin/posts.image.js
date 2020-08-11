$(document).on('click', '.removeImage', function() {
    //ovde dobijas id te slike (id="remove_1") 1 - je id slike u materijalima
    var id = $(this).attr('id').split("_").pop();
    if(id != "") {
        var array = JSON.parse($("#removematerials").val());
        array.push(id);
        $("#removematerials").val("["+array+"]");
    }
    //div u kom je slika
    $("#imagediv_" + id).remove();
});
