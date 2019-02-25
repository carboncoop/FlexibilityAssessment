@extends('layout')

@section('title', "How could my organisation benefit from 'flexibility'?" )

@section('content')
    <h1>How could my organisation benefit from 'flexibility'?</h1>

    <h2>ECAS: Our Community Aggregator</h2>
    <p>Power companies want to work with big chunks of flexibility in use of electricity to make it worth their effort. So far, most Flexibility Agreements are with big businesses and factories. As they start to work with householders, they want to make the contracts through 'aggregators'. Aggregators are organisations that bring lots of little energy users together and make a deal on their behalf./</p>
    <p>So far it's mainly energy suppliers and heating appliance companies that are looking to become aggregators. We would like to set up ECAS as a cooperative, open-source aggregator, that lets community groups across the UK come together into a force large enough to deal directly with the power companies and grid operators. </p>

    <div role="tablist">

        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion2 variant="info">Who is involved?</b-btn>
            </b-card-header>
            <b-collapse id="accordion2" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <div id='who-is-involved'>
                        <a href="https://carbon.coop/" target="blank"><img class="carboncoop" src="{{asset('img/carboncoop-logo.png')}}" /></a>
                        <a href="http://www.communityenergyscotland.org.uk/" target="blank"><img class="community-energy-scotland" src="{{asset('img/community-energy-scotland-logo.png')}}" /></a>
                        <a href="http://southseeds.org/" target="blank"><img class="south-seeds-logo" src="{{asset('img/south-seeds-logo.png')}}" /></a>
                    </div>
                </b-card-body>
            </b-collapse>
        </b-card>


        <h2>Community groups have an advantage</h2>
        <p>Many of the new grid problems are very area-specific, meaning that aggregators will need to recruit a big group of people in a small area. UK-wide, commercial aggregators will struggle to recruit large numbers of people in small areas using traditional marketing and advertising campaigns. </p>
        <p>It is local community groups, with local knowledge and local contacts, who are best placed to mobilise the numbers at this scale. </p>
        <p>Also, community organisations are energy consumers as well and could look at options for signing up for offering flexibility too – including options for putting any energy your community centre might be able to generate or store. </p>

        <h2>Why should community groups bother?</h2>
        <p>We believe in the democratisation of our energy system and that infrastructure (such as an aggregation platform) should be locally owned and locally accountable. The value of local flexibility should stay within the community and with householders rather than benefiting the shareholders of large companies. Our energy use data should be in the hands of people we trust. </p>
        <p>The transformation of our energy system is a vital part of creating a more sustainable society and combatting climate change. It is also a moment of change, risk, and opportunity. We believe that the best way to ensure that these changes promote real social and environmental justice is by taking part in, and taking ownership over, the transformation. </p>

        <h2>Community groups and their members could benefit in the following ways from taking part in Flexibility Agreements:</h2>
        <p><b>Strengthen community groups:</b> taking part in aggregating local flexibility could earn your community organisation a modest income, and the paid staff time that your group would gain through facilitating Flexibility aggregation could help support your other work and strengthen your presence in the community .</p>
        <p><b>Help combat local fuel poverty:</b> the new income from Flexibility could help electrically heated householders offset their monthly bills.</p>
        <p><b>Support wider community energy projects:</b> Flexibility Agreements can be a first step towards a larger community energy project, or complement existing projects. For example, the smart controllers could also be used to set up direct local energy supply from a community owned generator.</p>

        <h2>Do you want to sign up to be a local test 'aggregator' organisation? </h2>
        <p>As for individual households, community groups cannot actually sign up to be a local aggregator organisation for real yet, but we are looking for community groups willing to test a potential future system as part of this project. </p>
        @if (Route::has('register'))
        <p><a href="{{ route('register') }}">Register your organisation here</a> and get access to the platform</p>
        <p>If you want more information than is available below, before signing up, please contact <a href="mailto:Gillian.wilson@communityenergyscotland.org.uk"> Community Energy Scotland</a></p>
        @else
        <p>Registration for new organisations is closed but if you want to show your interest, please get in contact with <a href="mailto:Gillian.wilson@communityenergyscotland.org.uk"> Community Energy Scotland</a></p>
        @endif

        <h2>Resources for Community organisations</h2>
        <p>Find useful resources <a href="resources-for-community-organisations">here</a></p>

        <h2>What do we have to do as an aggregator on this research project? </h2>
        <p>To get ready for the potential future ECAS project, we want to learn much more about what flexibility might be available through households, what would attract households to sign up for offering flexibility and what would discourage them from getting involved. We also want to test what kind of information a community organisation would need or want, to help them understand whether it would be worthwhile getting involved in being a local aggregator organisation and what it would involve. This demonstration project aims to work with South Seeds to carry out this research. </p>

        <h2>We are asking the Community Organisation to be the front face of this research project and you would have the following roles: </h2>
        <ul>
            <li>Helping plan local community engagement, with Community Energy Scotland input</li>
            <li>Planning for and recruiting at least 20 participants</li>
            <li>Hosting an information session for potential participants, with CES input, to explain the changes that are coming in the energy system and briefing participants on what the demonstration project is trying to do and how they would get involved</li>
            <li>Carrying out home visits, including a home energy audit and an interview for the project, with each participant household, followed up by a phone call to get feedback on the report</li>
            <li>Providing feedback on the support and information the project provides to your organisation in delivering its role and whether it is clear enough and how it could be improved for future delivery of such an ECAS system</li>
        </ul>

        <h2>Finding participants to sign up for this demonstrator </h2>
        <p style='color:red'>(description of the types of participants we are looking for to be inserted here - BENNY - separate document to be drafted and agreed)</p>

        <h2>Registering the participants' details</h2>
        <p style='color:red'>Please enter participants' here (link to the questions and data collection fields section of the platform) to register the details of each participant household </p>

        <h2>Carrying out the interviews</h2>
        <p>Please use the following process for preparing for and carrying out the interview with each participant household: </p>
        <ul>
            <li>Pre-visit information: Send an email to each participant, providing this link (<a href="{{url('/')}}">{{url('/')}}</a>) and inviting them to read it before the home visit and interview. Also, brief them about the content of the interview (<span style="color: red">hyperlink to guidance for Community organisation for the interview – to be written</span>) and arrange a suitable date. If you think it is more appropriate to send a leaflet with this information instead, please do that.</li>
            <li>Carry out the home visit and do the following:</li>
            <ul>
                <li>Carry out the home energy audit (<span style="color: red">South Seeds will already have guidance for their Energy Officers re doing a home energy audit – so to supplement this….)</span></li>
                <li>Explain the purpose of the visit again, including the ECAS demonstrator and this interview – in case they have not read the flyer, go through the flyer information at the start of the flexibility element of the interview </li>
                <li>Carry out the flexibility interview questions, using this link (<span style="color: red">link to the webplatform to record the participants' answers to the interview questions for the project).<b>CARLOS comment: this is not possible because these questions are part of the household assessment so we cannot provide a link. The Energy Officer will have to create the assessment before and then proceed with the interview</b></span></span> Questions <span style="color: red">x to y</span> will be done during the home visit while questions <span style="color: red">a to b</span> will be left for the follow up telephone call.  </li>
            </ul>
            </li>
        </ul>

        <h2>Creating the report from the interview and sending it to the participants</h2>
        <p>To be able to provide the householder with a copy of their interview record and the results of the flexibility offer, you can access and print off a report from their interview <a href="{{url('/assessment')}}">here</a>.</p>
        <p>This will then need to be given to the participant household to read, in advance of a follow up telephone call. </p>

        <h2>Carrying out the follow up telephone calls</h2>
        <p>Questions <span style="color: red">a to b</span> would then be asked over the phone, to secure their response to this final element of the survey. Please enter the results here as above (<span style="color: red">link to the webplatform to record the participants' answers to the interview questions for the project). <b>CARLOS comment: this is not possible because these questions are part of the household assessment so we cannot provide a link. This mean the Energy Officer will have to find the assessment before doing the phone itnerview</b></span></p>

        <h2>Accessing other types of flexibility reports on the platforms</h2>
        <p>As an aggregation organisation you will also need to be able to see how the flexibility being offered by individual households (as indicated by their individual reports above) adds up or 'aggregates' into larger amounts of flexibility for offering to the grid management companies.  You can access a range of 'aggregation reports' here (<span style="color: red">link to the aggregation reports with instructions on what kinds of reports they could have / how to use the report function – to be written by Carbon Coop? )</span></p>

    </div>

@endsection