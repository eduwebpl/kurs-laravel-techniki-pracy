@extends('layouts.master')
@section('title', 'Create New Post')

@section('content')
<div class="wrapper">
    <div class="rte">
        <h1>Create new post</h1>
    </div>

    <form method="POST" action="{{ route('admin.post.create') }}">
        @csrf

        <div class="form-fieldset">
            <input class="form-field" type="text" name="title" placeholder="Title">
        </div>
        <div class="form-fieldset">
            <div class="form-select">
                <select name="type">
                    <option value="" disabled selected>Choose Type</option>
                    <option value="text">Type: Text</option>
                    <option value="photo">Type: Photo</option>
                </select>
            </div>
        </div>
        <div class="form-fieldset">
            <label class="form-label">Date:</label>
            <input class="form-field" type="date" name="date">
        </div>
        <div class="form-fieldset">
            <label class="form-label">Premium:</label>
            <input type="checkbox" name="premium" value="1">
        </div>
        <div class="form-fieldset">
            <label class="form-label">Image:</label>
            <input type="file" name="image">
        </div>
        <div class="form-fieldset is-wide">
            <textarea class="form-textarea" name="content" placeholder="Content"></textarea>
        </div>
        <button class="button">Add post</button>
    </form>
</div>
@endsection
