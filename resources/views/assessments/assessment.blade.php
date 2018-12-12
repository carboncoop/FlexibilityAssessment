@extends('layout')

@section('title', $assessment['name'] )

@section('content')
<div id='app'>
    <assessment v-bind:assessment='{{$assessment}}'></assessment>
</div>
@endsection