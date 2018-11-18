$(function () {
    $(".site-type").click(function() {
        console.log($(this));
        const input = $('input[name="choice"]');
        $('input[name="site_type[choice]"]').val($(this).data("rel"));
        $( "form" ).submit();
    });
});
