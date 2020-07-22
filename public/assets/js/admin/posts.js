$(document).on('change', '#type_id', function() {
    var option = $(this).find('option:selected'); //ovom linijom se kupi izabran red iz padajuce liste
    var option_value = $(option).val(); //iz izabranog reda se uzima vrednost
    if(option_value == 4){
        $("#uploadPhotoFiles").hide();  //umesto "input_video" stavi id inputa za video
        $("#uploadVideoFiles").show();  //umesto "input_slika" stavi id inputa za slike
    } else  {
        $("#uploadPhotoFiles").show();
        $("#uploadVideoFiles").hide();
    }
});
