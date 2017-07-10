@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Feladatok</div>

                    <div class="panel-body">
                        <div class="form-group">
                            <form method="GET" accept-charset="utf-8">
                                <div class="input-group">
                                    <input type="search" class="form-control" name="search" placeholder="kereső..."
                                           id="search">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><span
                                                    class="glyphicon glyphicon-search"></span></button>
                                    </span>
                                </div>
                            </form>
                        </div>

                        <hr>

                        <div class="form-group">
                            <button id="new-task-btn" class="btn btn-primary form-control"><span
                                        class="glyphicon glyphicon-plus"></span> Új feladat
                                hozzáadása</span>
                            </button>
                        </div>

                        @include('task.partials._add-form')
                        <div id="task-container">
                            @if(count($tasks) > 0)
                                <ul class="list-group" id="tasks">

                                    @foreach($tasks as $task)
                                        <li class="list-group-item" id="{{ $task->id }}">

                                            @include('task.partials._modify-form')

                                            <div class="info">
                                                <div><span class="task-name">{{ $task->name }}</span>

                                                    <div class="pull-right">
                                                        {{ $task->created_at->diffForHumans() }}
                                                    </div>
                                                </div>

                                                @if($task->description)
                                                    <div><span class="task-description">{{ $task->description
                                                    }}</span></div>
                                                @endif
                                            </div>

                                            {{--<div>--}}
                                            {{--@if($task->finished)--}}
                                            {{--<span class="glyphicon glyphicon-ok text-success"></span>--}}
                                            {{--@endif--}}
                                            {{--</div>--}}

                                            @include('task.partials._action-buttons')

                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="alert alert-danger">Nincs megjelenítendő feladat!</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
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
    </script>
@stop
