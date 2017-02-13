@extends('app')

@section('body')

    <div class="row">
        <form method="POST" action="/" class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
            {{csrf_field()}}
            @if(count($errors))
                <div class="alert alert-danger pull-right">{{$errors->first('error')}}</div>
            @endif
            <div class="input-group">
                <input placeholder="Add a new task..." class="form-control" name="task">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">add</button>
                            </span>
            </div>
        </form>
    </div>
    <br>

    <h3 class="text-warning text-xs-center">Tasks</h3>
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
            <ul class="list-group">
                @forelse($tasks as $id => $task)
                    <li class="list-group-item">
                        <div class="task-show">
                            @can('own_task', $task)
                                <form class="form-inline pull-right" method="POST" action="/{{$task->id}}">
                                    {{method_field('DELETE')}}
                                    {{csrf_field()}}
                                    <button type="button" class="text-primary btn-link task-update-btn">
                                        <span class="fa fa-edit"></span>
                                    </button>
                                    <button type="submit" class="text-danger btn-link">
                                        <span class="fa fa-times"></span>
                                    </button>
                                </form>
                            @endcan
                            <form id="form-{{$task->id}}" class="form form-inline" action="/{{$task->id}}" method="post">
                                <label class="c-input c-checkbox checkbox-inline">

                                        {{csrf_field()}}
                                        {{method_field('PUT')}}
                                        <input type="checkbox" name="completed" @if($task->completed) checked @endif onchange="$('#form-{{$task->id}}').submit()">
                                    <span class="c-indicator"></span>
                                </label>
                                @if($task->completed)
                                    <del>{{ $task->task}}</del>
                                @else
                                    {{ $task->task}}
                                @endif
                            </form>
                        </div>
                        @can('own_task', $task)
                            <div class="task-update">
                                <form method="POST" action="/{{$task->id}}}">
                                    {{csrf_field()}}
                                    {{method_field('PUT')}}
                                    <div class="input-group">
                                        <input placeholder="Update the task..." value="{{$task->task}}" class="form-control" name="task">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit">update</button>
                                    </span>
                                    </div>
                                </form>
                            </div>
                        @endcan
                    </li>
                    @empty
                    <li class="list-group-item">No tasks</li>
                @endforelse
            </ul>
        </div>
    </div>

    <br>

    <h3 class="text-warning text-xs-center">Deleted</h3>
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
            <ul class="list-group">
                @forelse($deleted as $id => $task)
                    <li class="list-group-item">
                        <label class="c-input c-checkbox">
                            <input type="checkbox"  @if($task->completed) checked @endif readonly>
                            <span class="c-indicator"></span>
                            {{ $task->task}}
                        </label>
                        @can('own_task', $task)
                            <form class="form-inline pull-right" method="POST" action="/{{$task->id}}">
                                {{method_field('PATCH')}}
                                {{csrf_field()}}
                                <button class="text-success btn-link" type="submit">
                                    <span class="fa fa-undo"></span>
                                </button>
                            </form>
                        @endcan
                    </li>
                    @empty
                        <li class="list-group-item">No tasks</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection