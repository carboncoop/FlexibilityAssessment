@extends('layout')

@section('title', "Privacy policy" )

@section('style')
<style>

    .card-header a{
        background: #d6d4ce;
        border:none;
        font-size:20px;
        text-align:left;
    }

    .card-header a:hover{
        background:none;
        color:black
    }

    .card-body{
        margin-left:50px
    }

</style>
@endsection


@section('content')

<h1>Privacy policy</h1>

<p><b>Using a flexible electricity scheme will involve some data transfer between 
        yourself and a third party</b>. Any group looking to set up an energy aggregation
    service will need to handle users’ data appropriately. </p>
<p>One reason for this project is that we think a cooperative, community-based aggregator
    will be more trustworthy with the data of its energy users than large technology 
    companies. That’s why we want to be very clear with how we are managing data, and
    what users’ rights are, from the get-go. </p>
<p>The tabs below provide information about your rights, and how we use data on this 
    site.</p>


<div role="tablist">

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion2 variant="info">Your Rights </b-btn>
        </b-card-header>
        <b-collapse id="accordion2" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>The Flexibility Assessment tool has been developed with the aim to use and 
                    promote high standards of data privacy and security in the delivery.</p>
                <p>You have a set of rights in relation to personal information we hold about you 
                    under the Data Protection Act 2018. You can find out more about this on the 
                    website of the <a href="https://ico.org.uk/your-data-matters/">Information Commissioners Office</a>.</p>
            </b-card-body>
        </b-collapse>
    </b-card>

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion3 variant="info">How we handle your Energy Audit Data</b-btn>
        </b-card-header>
        <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>This service collects information about you, your home and how you use energy in it. 
                    This information is collected for the purpose of providing you with a flexibility 
                    energy assessment. We retain a copy of your assessment for a period of 5 years 
                    after it is produced in case you lose your copy and need to retrieve it.</p>
                <p>This data is also anonymised and aggregated by the Community Organisation that 
                    carried out your assessment. The purpose of the aggregated data is to better 
                    understand the flexibility potential of an area.</p>
                <p>We do not use the data collected and processed for any other purpose unless 
                    you expressly permit it.</p>
            </b-card-body>
        </b-collapse>
    </b-card>

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion4 variant="info">Use of Cookies on this Website</b-btn>
        </b-card-header>
        <b-collapse id="accordion4" accordion="my-accordion" role="tabpanel">
            <b-card-body>
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
            </b-card-body>
        </b-collapse>
    </b-card>
</div>

@endsection