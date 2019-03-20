@extends('layouts.app')

@section('content')
    <p>Questionnaire</p>
    @if(count($questions) > 1)
        @foreach($questions as $quest)
            <div class="well">
                <h3>{{$quest->question}}</h3>
            <small>{{$quest->questionType}}</small>
        @endforeach
    @endif
@endsection