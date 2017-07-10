$(function () {
    $(document).on('click', '.finish-task-btn', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var finishBtn = $(this);
        $.ajax({
            type: 'post',
            url: '/tasks/' + finishBtn.attr('data-id') + '/toggle',
            data: {
                _method: 'patch',
            },
            success: function (task) {
                if (task.finished === true) {
                    finishBtn.html('<span class="glyphicon glyphicon-check text-success"></span> elkészült');
                } else {
                    finishBtn.html('<span class="glyphicon glyphicon-unchecked text-danger"></span> még nem ' +
                        'készült el');
                }
            },
        });
    });
});