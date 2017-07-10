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

    </div>

    @include('task.partials._action-buttons')

</li>