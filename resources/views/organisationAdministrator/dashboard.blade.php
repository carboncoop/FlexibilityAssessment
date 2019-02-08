@extends('layout')

@section('title','Organisation Administrator dashboard')

@section('style')

<style scoped>

</style>

@endsection


@section('content')

<div id='organisation-dashboard'>

    <h1>Your organisation's dashboard</h1>

    <p>From here you can manage your organisation users, access assessments, reports, statistics, etc.</p>

    <b-card>
        <b-tabs>
            <b-tab title="Assessments" active>
                <br />
                <assessments-table v-bind:assessments="{{ $assessments }}" v-bind:administrator-view="true"></assessments-table>
            </b-tab>
            <b-tab title="Users" >
                <br />
                <organisation-users v-bind:users="{{ $organisation->users }}"></organisation-users>
            </b-tab>
            <b-tab title="Aggregation">
                <br>Disabled tab!
            </b-tab>
            <b-tab title="Org. Details">
                <br>
                <organisation-details v-bind:organisation="{{ $organisation }}"></organisation-details>
            </b-tab>
        </b-tabs>
    </b-card>

</div>

@endsection
