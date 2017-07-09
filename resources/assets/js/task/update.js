$(function () {
    $(document).on('click', '.modify-task-btn', function () {

        info = $(this).parent().find('.info');
        info.toggle();

        form = $(this).parent().find('.modify-form');
        form.toggle();

    });


    $(document).on('click', '.modify-btn', function () {
        var name = form.find('.name').val();
        var description = form.find('.description').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/tasks/' + form.closest('li').attr('id'),
            data: {
                _method: 'patch',
                name: name,
                description: description
            },
            success: function (task) {
                info.find('.task-name').empty().text(task.name);
                info.find('.task-description').empty().text(task.description);
                info.toggle();
                form.toggle();
            },
            error: function(error){
                var nameError = JSON.parse(error.responseText).name[0];

                form.find('.name-error').text(nameError);
                form.find('.name-error-container').show().delay(3200).fadeOut(300);
            }
        });
    });

});