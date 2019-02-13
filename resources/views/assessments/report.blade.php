@extends('layout')

@section('title', $assessment['name'] )

@section('content')
<assessment-report v-bind:initial-assessment='{{$assessment}}' report-url=''></assessment-report>
@endsection