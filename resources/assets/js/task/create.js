$(function () {
    $('#new-task-btn').click(function () {
        $("#add-form").toggle({opacity: '0'}, 'slow')
    });

    $('#add-btn').click(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/tasks',
            data: {
                name: $('#name').val(),
                description: $('#description').val()
            },
            success: function (task) {

                var taskContainer = $('#tasks');

                if (!taskContainer.length) {
                    var ul = '<ul class="list-group" id="tasks"></ul>'
                    $('#task-container').prepend(ul);
                }

                taskContainer.prepend(task);
            },
            error: function (error) {
                var nameError = JSON.parse(error.responseText).name[0];

                $('#name-error').text(nameError);
                $('#name-error-container').show().delay(3200).fadeOut(300);
            }
        });
    });
});