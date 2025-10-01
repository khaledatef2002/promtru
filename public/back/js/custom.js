$('.auto-image-show input[type="file"]').on('change', function() {
    var file = this.files[0];
    var input = $(this)
    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            input.closest(".auto-image-show").find("img").attr('src', e.target.result);
        }

        reader.readAsDataURL(file);
    }
});

$("div.password-toggler i").click(function(){
    const input = $(this).parent().find("input");
    if(input.attr("type") == "password"){
        input.attr("type", "text");
        $(this).addClass("ri-eye-off-line")
        $(this).removeClass("ri-eye-line")
    }else{
        input.attr("type", "password");
        $(this).addClass("ri-eye-line")
        $(this).removeClass("ri-eye-off-line")
    }
})