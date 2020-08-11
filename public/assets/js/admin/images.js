$(document).on('click', '.removeImageDiv', function() {
    // ovde dobijas id te slike (id="remove_1") 1 - je id slike u materijalima
    var id = $(this).attr('id').split("_").pop();
    if(id != "") {
        var array = JSON.parse($("#removematerials").val());
        array.push(id);
        $("#removematerials").val("["+array+"]");
    }
    //div u kom je slika
    $("#image_" + id).remove();
    sortImages();
});
var dropIndex;
$(document).ready(function () {
    $("#image-list").sortable({
        update: function(event, ui) {
            dropIndex = ui.item.index();
            sortImages();
        }
    });
});

function sortImages() {
    var imageIdsArray = [];
    $('#image-list li').each(function (index) {
        var id = $(this).attr('id');
        var split_id = id.split("_");
        imageIdsArray.push(split_id[1]);
    });
    $("#sortImages").val("["+imageIdsArray+"]");
}
