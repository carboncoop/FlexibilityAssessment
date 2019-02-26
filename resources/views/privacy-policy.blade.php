@extends('layout')

@section('title', "Privacy policy" )

@section('style')
<style>


</style>
@endsection


@section('content')

<h1>Privacy policy</h1>

<p>The Flexibility Assessment tool has been developed with the aim to use and 
    promote high standards of data privacy and security in the delivery.</p>

<p>You have a set of rights in relation to personal information we hold about you 
    under the Data Protection Act 2018. You can find out more about this on the 
    website of the <a href="https://ico.org.uk/your-data-matters/">Information Commissioners Office</a>.</p>

<p>This service collects information about you, your home and how you use energy in it. 
    This information is collected for the purpose of providing you with a flexibility 
    energy assessment. We retain a copy of your assessment for a period of 5 years 
    after it is produced in case you lose your copy and need to retrieve it.</p>

<p>This data is also anonymised and aggregated by the Community Organisation that 
    carried out your assessment. The purpose of the aggregated data is to better 
    understand the flexibility potential of an area.</p>

<p>We do not use the data collected and processed for any other purpose unless 
    you expressly permit it.</p>


<h2>Use of cookies</h2>

<p>Our website uses cookies.  At present these are all necessary for the functioning of the site.</p>

<table class="table" style="max-width:80%; margin: auto">
    <tbody>
        <tr><td><strong>Name</strong></td><td><strong>Purpose</strong></td><td><strong>Kind of data</strong></td><td><strong>Sessional or persistent?<br></strong></td></tr>
        <tr>
            <td>laravel_session</td>
            <td>Used to differentiate  the different users using the site– necessary 
                for various site functions.</td>
            <td>Unique token</td>
            <td>Sessional</td>
        </tr>
        <tr>
            <td>XSRF-TOKEn</td>
            <td>Keeps the user safe from Cross-Site Request Forgery (CSRF) atatcks</td>
            <td>Unique token</td>
            <td>Sessional</td>
        </tr>
        <tr>
            <td>laravel_token</td>
            <td>Used to authenticate API calls after user has logeed in.</td>
            <td>Unique token</td>
            <td>Sessional</td>
        </tr>
        <tr>
            <td>laravel_cookie_consent</td>
            <td>Used to save user's consent to the use of cookies.</td>
            <td>Unique token</td>
            <td>Persistent</td>
        </tr>
    </tbody>
</table>
@endsection