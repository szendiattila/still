<li class="list-group-item" id="{{ $task->id }}">

    @include('task.partials._modify-form')

    <div class="info">
        <div>{{ $task->name }}
            <div class="pull-right">
                {{ $task->created_at->diffForHumans() }}
            </div>
        </div>

        @if($task->description)
            <div>{{ $task->description }}</div>
        @endif

        <div>
            @if($task->finished)
                <span class="glyphicon glyphicon-ok text-success"></span>
            @endif
        </div>
    </div>

    <div class="modify-task-btn">
        <span class="glyphicon glyphicon-edit text-primary"></span> módosítás
    </div>

    <div class="delete-btn" data-id="{{ $task->id }}">
        <span class="glyphicon glyphicon-remove text-danger"></span> törlés
    </div>

</li>