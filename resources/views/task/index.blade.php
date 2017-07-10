@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Feladatok
                        <span class="pull-right" id="toggle-visibility">
                            Elkészültek {{ Cookie::get('is-hidden') == null ? 'elrejtése' : 'mutatása' }}
                        </span>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <form method="GET" accept-charset="utf-8">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a href="{{ url('/tasks') }}" class="btn btn-primary" title="alaphelyzetbe állítás" type="submit">
                                            <span class="glyphicon glyphicon-home"></span>
                                        </a>
                                    </span>
                                    <input type="search" class="form-control" name="search" placeholder="kereső..."
                                           id="search">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
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
