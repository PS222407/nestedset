@extends('layouts.app')

@section('body')

    <a href="/categories/create">Create</a>
    <a href="/categories/move-up">up</a>
    <a href="/categories/move-down">down</a>
    {!! $htmltree !!}

@endsection
