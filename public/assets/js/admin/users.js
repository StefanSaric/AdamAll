var id;

$(".editUser").click(function () {
    id = $(this).parent().parent().attr('id');
    $("input[name^=_method]").val("GET");
    $("#userForm").attr("action", window.location +  "/" + id + "/edit");
    $("#userButton").click();
});
