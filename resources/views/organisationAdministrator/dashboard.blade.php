@extends('layout')


@section('style')

<style scoped>

   
</style>

@endsection


@section('content')

    <div id='organisation-home'>

        <h1>Your organisation's dashboard</h1>

        <p>From here you can manage your organisation users, access assessments, reports, statistics, etc.</p>

        
        <div id="navigation-buttons">
            <a href="#"><button>Edit organisation details (ToDo)</button></a>

            <a href="organisation-administrator/users"><button>Manage users</button></a>

            <a href="assessment"><button>Assessments</button></a> 

            <a href=""><button>Aggregation (ToDo)</button></a> 

        </div>

    </div>

@endsection
