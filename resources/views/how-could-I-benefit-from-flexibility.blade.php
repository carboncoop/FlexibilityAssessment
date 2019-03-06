@extends('layout')

@section('title', "How could I benefit from 'flexibility?'" )

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

    <div id='how-could-I-benefit-from-flexibility'>
        <h1>How could I benefit from 'flexibility'?</h1>
        <p><b>The changes in the grid, are beginning to be felt in people's homes:</b></p>
        <ul>
            <li><b>Smart meters are being rolled out.</b> The Government says that every house will have one by 2020, unless they have requested an opt-out. </li>
            <li><b>If you have a smart meter, prices for electricity could be different at different times of day and you could decide to use more of the electricity you need, when it is cheapest.</b> Smart Meters give you much more information about your energy use, and are designed for a new range of electricity tariffs which are beginning to be developed, where the price depends on when you use energy (called 'time of use' tariffs).</li>
            <li><b>Smart appliances are starting to come out, for example,</b> many new electric heaters, cars, and washing machines let you remotely control them. Smart home controllers can communicate with and coordinate these smart devices and this makes them available for offering flexibility</li>
            <li>Some people have large loads to charge at home such as electric wheel chairs, electric bike batteries or even in some cases electric cars.</li>
        </ul>                

        <div role="tablist">
            
            <b-card no-body class="mb-1">
                <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-btn block href="#" v-b-toggle.accordion2 variant="info">Can I sign up for offering flexibility now? </b-btn>
                </b-card-header>
                <b-collapse id="accordion2" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <p>Aggregation of household flexibility is not happening yet but it is coming and we want to help you and others understand it and get ready for it. So we are looking for people interested in taking part in a research 'demonstration' – not the real thing. </p>
                        <p>See below about how to sign up for this test project – we will not actually change anything in your house and nothing will actually be switched off, we are mainly wanting to ask you about whether you would be interested in taking part in the future and what would encourage you or discourage you from taking part. </p>
                    </b-card-body>
                </b-collapse>
            </b-card>

            <b-card no-body class="mb-1">
                <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-btn block href="#" v-b-toggle.accordion3 variant="info">How could a Flexibility Agreement work for an individual household in the future if we set up ECAS?</b-btn>
                </b-card-header>
                <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <p>To sign up to a flexibility agreement in the future, you would have to have electric devices in your home that can be switched on and off, and that were compatible with the smart control system being used. These devices might be an electric car with its battery, smart electric heaters or heat pumps but even an immersion heater for your hot water might work quite well. You would also have a smart meter. </p>
                        <p>If you had the right devices the next step would be to talk to your local community group about Flexibility Agreements. They would arrange for someone to visit your house, check that you have the devices suitable for flexibility and find out what level of flexibility you are happy to sign up for. Then, once the smart controller was put in to control things remotely, it would run pretty much by itself, according to the amount of flexibility you have agreed to offer. </p>
                        <p>You could choose to get a text or email when anything was switched, letting you know what happened and giving you a chance to override it. Once every few months you would get a statement showing how many times things were switched, and you would receive payments for your flexibility.</p>
                    </b-card-body>
                </b-collapse>
            </b-card>

            <b-card no-body class="mb-1">
                <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-btn block href="#" v-b-toggle.accordion4 variant="info">What about taking part in this research 'demonstration' project?</b-btn>
                </b-card-header>
                <b-collapse id="accordion4" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <p>For our research, we're working with South Seeds in Glasgow and we want to see how flexibility could work in the southside of Glasgow in future. </p>
                        <p>As part of this South Seeds are recruiting a group of householders to go through a home visit and survey to give feedback on our ideas and information. </p>
                    </b-card-body>
                </b-collapse>
            </b-card>

            <b-card no-body class="mb-1">
                <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-btn block href="#" v-b-toggle.accordion5 variant="info">How can I sign up to take part in this research project</b-btn>
                </b-card-header>
                <b-collapse id="accordion5" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <p>South Seeds are looking for about 20 households to take part in our project. This would involve you doing the following:</p>
                        <ul>
                            <li>South Seeds are hosting an event on 4 March (between 3 and 5pm) at Pollokshields Community Centre where local people can find out more. If you can’t make that there may be another chance to participate in an event, get in touch with South seeds to find out, 0141 636 3959.</li>
                            <li>Attending an information session (probably in February 2019) about the project and about how we will work with you – this will give you more detailed information about the changes in the energy system and about the project</li>
                            <li>Having a home visit by a South Seeds Energy Officer, who will offer you a home energy audit and do a short interview (about 30 minutes) about what appliances you have in your home, whether they are suitable for flexibility and also ask you questions about how clear our information is on this webpage and about the project </li>
                            <li>Having a short telephone follow up call after the home visit, to give your feedback on the report we will provide you with, about the flexibility options that might be relevant to your household</li>
                        </ul>
                    </b-card-body>
                </b-collapse>
            </b-card>

            <b-card no-body class="mb-1">
                <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-btn block href="#" v-b-toggle.accordion6 variant="info">What would I get for taking part?</b-btn>
                </b-card-header>
                <b-collapse id="accordion6" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <p>You would get a payment in total of £100 for taking part (paid in several instalments depending on completing the various steps above). You would also get the chance to learn more about the changes and how flexibility will work in practice.</p>
                        <p>South Seeds would really value this chance to get feedback on this idea from local people, which will help South Seeds think about how such a project might work in the future.  </p>
                        <p>If you are interested in being a participant – please contact <a href="mailto:flexibility@southseeds.org"> South Seeds</a> to sign up. If you want more information before signing up please ring 0141 636 3959</p>
                    </b-card-body>
                </b-collapse>
            </b-card>

        </div>

    </div>
@endsection