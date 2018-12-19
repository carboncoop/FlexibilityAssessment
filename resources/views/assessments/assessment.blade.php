@extends('layout')

@section('title', $assessment['name'] )

@section('content')
<div id='app'>
    <assessment v-bind:initial-assessment='{{$assessment}}'></assessment>
</div>
@endsection