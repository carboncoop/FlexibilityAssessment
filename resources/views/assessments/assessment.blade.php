@extends('layout')

@section('title', $assessment['name'] )

@section('content')
    <assessment v-bind:initial-assessment='{{$assessment}}' report-url='{{$reportURL}}'></assessment>
@endsection