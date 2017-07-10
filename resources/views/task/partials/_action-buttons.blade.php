<div class="modify-task-btn">
    <span class="glyphicon glyphicon-edit text-primary"></span> módosítás
</div>

<div class="delete-task-btn" data-id="{{ $task->id }}">
    <span class="glyphicon glyphicon-remove text-danger"></span>
    törlés
</div>

@if($task->finished)
    <div class="finish-task-btn" data-id="{{ $task->id }}">
        <span class="glyphicon glyphicon-check text-success"></span>
        elkészült
    </div>
@else
    <div class="finish-task-btn" data-id="{{ $task->id }}">
        <span class="glyphicon glyphicon-unchecked text-danger"></span>
        még nem készült el
    </div>
@endif