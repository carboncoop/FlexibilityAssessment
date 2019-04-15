@extends('layout')

@section('title', "Resources for organisations" )

@section('style')

<style>
    .card a{
        background: #d6d4ce;
        border:none;
        font-size:20px;
        text-align:left;
        margin-left: 25px
    }

    .card a:hover{
        background:none;
        color:black
    }

    .card-body{
        margin-left:50px
    }
</style>

@endsection



@section('content')

<div id='resources-for-community-organisations'>
    <h1>Resources for organisations</h1>
    <p>Organisations with connections to members of the public, in areas with grid 
        constraints, may consider becoming an aggregator. </p>
    <p>This means that they would work with people who have suitable electricity 
        loads to support them to use their electricity more flexibility. Although 
        very few organisations have played this role so far, we expect that more 
        and more will do so in the future, as there is the potential for both the 
        user and the organisation to make money from such schemes. </p>
    <p>Very few resources exist yet for interested organisations; we have listed 
        some below but we also recommend that interested groups get in touch with 
        us or others who have experience.</p>
    <p style="color: red">ToDo</p>
</div>
@endsection