@extends('layouts.app')

@section('body')

    <form action="/categories/{{ $node->id }}" method="POST">
        @csrf
        @method("PUT")
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required value="{{ $node->name }}">
        <label for="parent">Parent:</label>
        <select name="parent" id="parent">
            <option value="null"></option>
            {!! $options !!}
        </select>
        <br>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        <button type="submit">Submit</button>
    </form>

@endsection
