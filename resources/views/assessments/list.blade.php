@extends('layout')

@section('title','List')

@section('content')
<div id='list'>
    <h1>Assessments</h1>
    <table>
        <th>Name</th><th>Description</th><th>Author</th><th>Modified</th><th></th>
        @foreach($assessments as $assessment)
        <tr>
            <td>{{$assessment->name}}</td>
            <td>{{$assessment->description}}</td>
            <td></td>
            <td>{{$assessment->updated_at}}</td>
            <td></td>
        </tr>
        @endforeach
    </table>
</div>

@endsection