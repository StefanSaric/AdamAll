$(document).on('change', '#category_id', function() {
    var option = $(this).find('option:selected'); //ovom linijom se kupi izabran red iz padajuce liste
    var option_value = $(option).val(); //iz izabranog reda se uzima vrednost
    if (option_value == 2) {
        $("#uploadPhotoFiles").hide();  //umesto "input_video" stavi id inputa za video
        $("#uploadVideoFiles").hide();     //umesto "input_slika" stavi id inputa za slike
        $("#title").hide();
        $("#source").hide();
        $("#link").hide();
        $("#type_id").hide();
        $("#date").hide();
    }
    if(option_value == 1){
        $("#uploadPhotoFiles").show();  //umesto "input_video" stavi id inputa za video
        $("#uploadVideoFiles").show();     //umesto "input_slika" stavi id inputa za slike
        $("#title").show();
        $("#source").show();
        $("#link").show();
        $("#type_id").show();
        $("#date").show();
    }
});
