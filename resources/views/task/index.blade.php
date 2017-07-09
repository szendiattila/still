@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Feladatok</div>

                    <div class="panel-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="kereső..." id="search">
                        </div>

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

                                            <div>
                                                @if($task->finished)
                                                    <span class="glyphicon glyphicon-ok text-success"></span>
                                                @endif
                                            </div>

                                            <div class="modify-task-btn"><span class="glyphicon
                                        glyphicon-edit
                                        text-primary"></span> módosítás
                                            </div>

                                            <div class="delete-btn" data-id="{{ $task->id }}"><span class="glyphicon
                                        glyphicon-remove
                                        text-danger"></span> törlés
                                            </div>

                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="alert alert-danger">Nincs megjelenítendő feladat!</span>
                            @endif

                            {!! $tasks->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
