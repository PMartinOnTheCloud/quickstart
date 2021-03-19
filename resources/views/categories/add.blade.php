@extends('layouts.main')

@section('content')

<!-- Bootstrap Boilerplate... -->
<div class="panel-body">
    <h1 class="title">Add new Category</h1>
    <!-- Display Validation Errors -->
    @include('templates.errors')

    <!-- New Category Form -->
    <form action="{{ url('category') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Category Name -->
        <div class="form-group">
            <label for="category-name" class="col-sm-3 control-label">Category Name</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="category-name" class="form-control">
            </div>
        </div>

        <!-- Category Parent -->
        <div class="form-group">
            <label for="category-parent" class="col-sm-3 control-label">Category Parent</label>
            <div class="col-sm-6">
                <select name="category_parent" id="category-parent" class="form-control">
                    <option selected value="">-</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Add Category Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Category
                </button>
            </div>
        </div>
    </form>
</div>

@if (count($categories) > 0)
<div class="panel my-panel panel-default">
    <div class="panel-heading">
        Category List
    </div>

    <div class="panel-body">
    <table class="table table-striped task-table">

        <!-- Table Headings -->
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Category Parent</th>
            <th>&nbsp;</th>
        </thead>

        <!-- Table Body -->
        <tbody>
            @foreach ($categories as $category)
            <tr id="{{ $category->id }}">

                <td class="table-text">
                    <div>{{ $category->id }}</div>
                </td>

                <td class="table-text">
                    <div>{{ $category->name }}</div>
                </td>

                <td class="table-text">
                    <div>{{ ($category->parent) ? $category->category_parent->name : '-' }}</div>
                </td>

                <td>
                    {{-- <form action="{{ url('/category/detele/'.$category->id) }}" method="POST"> --}}
                    <form action="{{ url('/category/delete') }}" method="GET">
                        {{-- {{ csrf_field() }} --}}
                        {{-- {{ method_field('DELETE') }} --}}
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
@endif

@endsection