@extends('layouts.main')

@section('content')

<!-- Bootstrap Boilerplate... -->
<div class="panel-body">
    <h1 class="title">Add new Task</h1>
    <!-- Display Validation Errors -->
    @include('templates.errors')

    <!-- New Task Form -->
    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Task Name -->
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Task</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control">
            </div>
        </div>

        <!-- Task Proprity -->
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Priority</label>
            <div class="col-sm-6">
                <input type="text" name="priority" id="task-priority" class="form-control">
            </div>
        </div>

        <!-- Task Limit -->
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Limit</label>
            <div class="col-sm-6">
                <input type="text" name="limit" id="task-limit" class="form-control">
            </div>
        </div>

        <!-- Task Category -->
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Category</label>
            <div class="col-sm-6">
                <select name="category" id="task-category" class="form-control">
                    @foreach ($tasks['cat'] as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Add Task Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Task
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Current Tasks -->
@if (count($tasks) > 0)
<div class="panel my-panel panel-default">
    <div class="panel-heading">
        Current Tasks
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">

            <!-- Table Headings -->
            <thead>
                <th>Name</th>
                <th>Priority</th>
                <th>Limit</th>
                <th>Category</th>
                <th>&nbsp;</th>
            </thead>

            <!-- Table Body -->
            <tbody>
                @foreach ($tasks['list'] as $task)
                <tr id="{{ $task->id }}">
                    <!-- Task Name -->
                    <td class="table-text">
                        <div>{{ $task->name }}</div>
                    </td>

                    <!-- Task Priority -->
                    <td class="table-text">
                        <div>{{ $task->priority }}</div>
                    </td>

                    <!-- Task Limit -->
                    <td class="table-text">
                        <div>{{ (empty($task->limit)) ? '-' : $task->limit }}</div>
                    </td>

                    <!-- Task Category -->
                    <td class="table-text">
                        <div>{{ $task->categories->name }}</div>
                    </td>

                    <!-- Delete Button -->
                    <td>
                        <form action="{{ url('task/'.$task->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection