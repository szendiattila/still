$(function(){
    $('#toggle-visibility').click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'get',
            url: '/tasks/toggle-visibility',
            success: function () {
                window.location.reload(true);
            }
        });
    });
});