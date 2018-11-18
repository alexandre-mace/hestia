$(function () {
    $(".site-type").click(function() {
        const input = $('input[name="choice"]');
        $('input[name="site_type[choice]"]').val($(this).data("rel"));
        $( "form" ).submit();
    });
});
