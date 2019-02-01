@extends('layout')


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
                <br>I'm the second tab content
            </b-tab>
            <b-tab title="Aggregation">
                <br>Disabled tab!
            </b-tab>
            <b-tab title="Org. Details">
                <br>Disabled tab!
            </b-tab>
        </b-tabs>
    </b-card>

</div>

@endsection
