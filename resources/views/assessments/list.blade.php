@extends('layout')

@section('title','List')

@section('content')
    <div id='list'>
        <h1>Assessments</h1>
        <assessments-table v-bind:assessments="{{ $assessments }}"></assessments-table>
    </div>
@endsection