$(document).on('click', '.removeImageDiv', function() {
    // ovde dobijas id te slike (id="remove_1") 1 - je id slike u materijalima
    var id = $(this).attr('id').split("_").pop();
    if(id != "") {
        $("#removeimage").val("true");
    }
    //div u kom je slika
    $("#imagediv_"+id).remove();
});
