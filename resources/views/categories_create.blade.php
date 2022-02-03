@extends('layouts.app')

@section('body')

    <form action="/categories" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
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
