$(function(){
    $(document).on('click', '.delete-btn', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/tasks/' + $(this).attr('data-id'),
            data: {
                _method: 'delete',
            },
            success: function (task) {
                $('#' + task.id).remove();
            },
        });
    });
});
