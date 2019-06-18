@extends('layout')

@section('title', "Benefits for Users" )

@section('style')

<style>

    .card-header a{
        background: #c1d8ff;
        weight:bold;
        border:none;
        font-size:20px;
        text-align:left;
    }

    header.card-header{
        background: #c1d8ff;
    }

    header.card-header:hover{
        background: white;
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

<div id='how-could-I-benefit-from-flexibility'>
    <h1>Benefits for Users</h1>
    <p>As we fight climate change, renewable electricity has become a key resource. But the more power stations we replace with solar panels and wind turbines, the more strain is put on the grid providing the electricity.</p>
    <p>This is because while we could choose when to fire up a power station, we can’t choose when the wind will blow or when the sun will shine.</p>
    <p>There’s a simple solution. Be more flexible in your power use. </p>
    <p>That means using smart controllers to sync the charge times of your heaters to when the sun is shining, the wind is blowing, and there is spare power in the grid. And by doing so, you can earn an income from the power companies as a thank you.</p>

    <div role="tablist">

        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion2 variant="info">What can I sign up to now? </b-btn>
            </b-card-header>
            <b-collapse id="accordion2" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>Household flexibility is not happening yet because power companies are still working out their systems for using it, and smart household loads and controllers are only just being designed. </p>
                    <p>But household felxibility agreements will be coming soon, which is why we want to help you and others understand what they are and how to get ready. So we are looking for people interested in taking part in a research 'demonstration' (not the real thing). See below about how to sign up. </p>
                    <p>The research would not involve changing anything in your house or actually switching things on or off - we just want to chat! We would explain how flexibility agreements could work, find out what electric loads you have that could be used flexibly, and ask you what would encourage you or discourage you from signing up to them. </p>
                </b-card-body>
            </b-collapse>
        </b-card>

        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion3 variant="info">How would a flexibility agreement work once Flexible Power Community is up and running?</b-btn>
            </b-card-header>
            <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>To sign up to a flexibility agreement in the future, you would have to have electric devices in your home that can be switched on and off, and that were compatible with the smart control system being used. These devices might be an electric car with its battery, electric storage heaters, or an electric heat pump. Even an electric immersion heater for your hot water might work. You would also probably need to have a smart meter. </p>
                    <p>The first step would be to talk to your local community group about a flexibility agreement. They would arrange for someone to visit your house, check that you have the devices suitable for flexibility and find out what level of flexibility you are happy to sign up for. Then, once the smart controller was put in to control things remotely, it would run pretty much by itself, according to the amount of flexibility you had agreed to offer. </p>
                    <p>You could choose to get a text or email when anything was switched, letting you know what happened and giving you a chance to override it. Once every few months you would get a statement showing how many times your flexible loads were switched, and you would receive payments for your flexibility.</p>
                </b-card-body>
            </b-collapse>
        </b-card>

        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion4 variant="info">What is this research 'demonstration' project?</b-btn>
            </b-card-header>
            <b-collapse id="accordion4" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>For our research, we're working with South Seeds in Glasgow to see how flexibility could work in the southside of Glasgow in future. </p>
                    <p>As part of this South Seeds are recruiting a group of householders to go through a home visit and survey to give feedback on our ideas and information. </p>
                </b-card-body>
            </b-collapse>
        </b-card>

        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion5 variant="info">How can I sign up to take part in the research project</b-btn>
            </b-card-header>
            <b-collapse id="accordion5" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>South Seeds are looking for about 20 households to take part in our project. This would involve you doing the following:</p>
                    <ul>
                        <li>Attending an information session about the project and how we will work with you – this will give you more detailed information about the changes in the energy system and about the project</li>
                        <li>Having a home visit by a South Seeds Energy Officer, who will offer you a home energy audit and do a short interview (about 30 minutes) about what appliances you have in your home, whether they are suitable for flexibility and also ask you questions about how clear our information is on this webpage and about the project </li>
                        <li>Having a short telephone follow up call after the home visit, to give your feedback on the report we will provide you with, about the flexibility options that might be relevant to your household</li>
                    </ul>
                </b-card-body>
            </b-collapse>
        </b-card>

        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion6 variant="info">What would I get for taking part in the research project?</b-btn>
            </b-card-header>
            <b-collapse id="accordion6" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>You would get a payment in total of £100 for taking part (paid in several instalments depending on completing the various steps above). You would also get the chance to learn more about our changing energy system and how flexibility will work in practice.</p>
                    <p>You will also have helped South Seeds to think about how such a project might work for them in the future, and helped the Flexible Power Community in setting itself up.  </p>
                    <p>If you are interested in being a participant please contact <a href="mailto:flexibility@southseeds.org"> South Seeds</a>. If you want more information before signing up please ring 0141 636 3959</p>
                </b-card-body>
            </b-collapse>
        </b-card>

    </div>

</div>
@endsection