@extends('layout')

@section('title', "Benefits for organisations" )

@section('style')
<style>

    .card-header a{
        background: #d6d4ce;
        border:none;
        font-size:20px;
        text-align:left;
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
<h1>Benefits for organisations</h1>

<p>Only organisations with really large flexible electricity loads can make deals 
    with power companies. Smaller energy users would have to band together and make
    a collective deal with an energy company. The organisation which brings together 
    lots of little energy users to make a collective deal with a power company is 
    known as an ‘aggregator’. </p>
<p>Some organisations are already benefiting from working with power companies to 
    ‘aggregate’ flexible electricity use and make money. However most of these organisations 
    are technology companies and energy suppliers, with community based organisations 
    yet to really benefit.  </p>
<p>There is scope for community based organisations with good relationships with 
    householders to bring them together and aggregate their flexible use. In doing 
    so make money for the house holder and for the organisation. This would be called 
    an Energy Community Aggregation Service (ECAS).</p>

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

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion3 variant="info">Community groups have an advantage</b-btn>
        </b-card-header>
        <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>Many of the new grid problems are very area-specific, meaning that aggregators will need to recruit a big group of people in a small area. UK-wide, commercial aggregators will struggle to recruit large numbers of people in small areas using traditional marketing and advertising campaigns. </p>
                <p>It is local community groups, with local knowledge and local contacts, who are best placed to mobilise the numbers at this scale. </p>
                <p>Also, community organisations are energy consumers as well and could look at options for signing up for offering flexibility too – including options for putting any energy your community centre might be able to generate or store. </p>

            </b-card-body>
        </b-collapse>
    </b-card>

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion4 variant="info">Why should community groups bother?</b-btn>
        </b-card-header>
        <b-collapse id="accordion4" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>We believe in the democratisation of our energy system and that infrastructure (such as an aggregation platform) should be locally owned and locally accountable. The value of local flexibility should stay within the community and with householders rather than benefiting the shareholders of large companies. Our energy use data should be in the hands of people we trust. </p>
                <p>The transformation of our energy system is a vital part of creating a more sustainable society and combatting climate change. It is also a moment of change, risk, and opportunity. We believe that the best way to ensure that these changes promote real social and environmental justice is by taking part in, and taking ownership over, the transformation. </p>
            </b-card-body>
        </b-collapse>
    </b-card>

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion5 variant="info">Benefits for community groups and their members</b-btn>
        </b-card-header>
        <b-collapse id="accordion5" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>Community groups and their members could benefit in the following ways from taking part in Flexibility Agreements</p>
                <ul>
                    <li><b>Strengthen community groups:</b> taking part in aggregating local flexibility could earn your community organisation a modest income, and the paid staff time that your group would gain through facilitating Flexibility aggregation could help support your other work and strengthen your presence in the community .</li>
                    <li><b>Help combat local fuel poverty:</b> the new income from Flexibility could help electrically heated householders offset their monthly bills.</li>
                    <li><b>Support wider community energy projects:</b> Flexibility Agreements can be a first step towards a larger community energy project, or complement existing projects. For example, the smart controllers could also be used to set up direct local energy supply from a community owned generator.</li>                
                </ul>
            </b-card-body>
        </b-collapse>
    </b-card>    

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion6 variant="info">Do you want to sign up to be a local test 'aggregator' organisation?</b-btn>
        </b-card-header>
        <b-collapse id="accordion6" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>As for individual households, community groups cannot actually sign up to be a local aggregator organisation for real yet, but we are looking for community groups willing to test a potential future system as part of this project. </p>
                @if (Route::has('register'))
                <p><a href="{{ route('register') }}">Register your organisation here</a> and get access to the platform</p>
                <p>If you want more information than is available below, before signing up, please contact <a href="mailto:Gillian.wilson@communityenergyscotland.org.uk"> Community Energy Scotland</a></p>
                @else
                <p>Registration for new organisations is closed but if you want to show your interest, please get in contact with <a href="mailto:Gillian.wilson@communityenergyscotland.org.uk"> Community Energy Scotland</a></p>
                @endif
            </b-card-body>
        </b-collapse>
    </b-card>


    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion7 variant="info">Resources for Community organisations</b-btn>
        </b-card-header>
        <b-collapse id="accordion7" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>Find useful resources <a href="resources-for-community-organisations">here</a></p>
            </b-card-body>
        </b-collapse>
    </b-card>

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion8 variant="info">What do we have to do as an aggregator on this research project? </b-btn>
        </b-card-header>
        <b-collapse id="accordion8" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>To get ready for the potential future ECAS project, we want to learn much more about what flexibility might be available through households, what would attract households to sign up for offering flexibility and what would discourage them from getting involved. We also want to test what kind of information a community organisation would need or want, to help them understand whether it would be worthwhile getting involved in being a local aggregator organisation and what it would involve. This demonstration project aims to work with South Seeds to carry out this research. </p>
            </b-card-body>
        </b-collapse>
    </b-card>

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion9 variant="info">The roles of the Community Organisation in this research project</b-btn>
        </b-card-header>
        <b-collapse id="accordion9" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>We are asking the Community Organisation to be the front face of this research project and you would have the following roles: </p>
                <ul>
                    <li>Helping plan local community engagement, with Community Energy Scotland input</li>
                    <li>Planning for and recruiting at least 20 participants</li>
                    <li>Hosting an information session for potential participants, with CES input, to explain the changes that are coming in the energy system and briefing participants on what the demonstration project is trying to do and how they would get involved</li>
                    <li>Carrying out home visits, including a home energy audit and an interview for the project, with each participant household, followed up by a phone call to get feedback on the report</li>
                    <li>Providing feedback on the support and information the project provides to your organisation in delivering its role and whether it is clear enough and how it could be improved for future delivery of such an ECAS system</li>
                </ul>
            </b-card-body>
        </b-collapse>
    </b-card>

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion10 variant="info">Finding participants to sign up for this demonstrator </b-btn>
        </b-card-header>
        <b-collapse id="accordion10" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p><b>South Seeds will recruit interested locals to participate in the project in the following ways:</b></p>
                <ul>
                    <li>25-40 info-session attendees will: Attend an information session on smart energy and flexibility </li>
                    <li>20 home visit receivers will: Receive a home energy audit and flexibility assessment from South Seeds, then review the report created and feedback on the process in an interview with the assessor</li>
                    <li>3-10 self-assessors may: Log onto the website, self-assess and view the report created, then fill out feedback about the process (through an online questionnaire, or a face to face interview?)</li>
                </ul>
                <b>Composition of Home Visit Receivers</b>
                <p>The number of interviews will not produce statistically valid data, but will be useful as a ‘focus group’ to gather qualitative information on the process we are designing for flexibility signup. </p>
                <p>Participants for the info-sessions (if actively recruited) should be chosen with a mind to securing the right mix for the Home Visit Receiver group. The table below outlines preferences for the Home Visit Receivers. </p>
                <table class="table">
                    <tr><th colspan="2">Preferred Composition of the 20 Home Visit Receivers</th></tr>
                    <tr><th>FACTOR</th><th>COMMENTS</th></tr>
                    <tr>
                        <td>Wealth/Class</td>
                        <td>
                            <ul>
                                <li>>50% should be from lower income households</li>
                                <li>Group will ideally contain a mixture of income brackets</li>
                            </ul></td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td>
                            <ul>
                                <li>The more age diversity, the better. </li>
                                <li>The group should not contain >75% from a single age bracket (eg. not all pensioners, all families, or all students!) </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Tenure</td>
                        <td>
                            <ul>
                                <li>50%+ from social housing (council, RSL)</li>
                                <li><33% owner-occupiers</li>
                                <li><20% private rented</li>
                                <li>Participation from a housing co-op or other alternative housing model would be a bonus!</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Heating Type</td>
                        <td>
                            <ul>
                                <li>>90% participants must rely on an electric immersion element or electric heating system as their primary source of hot water or space heating (just having a few plug-in electric heaters alongside gas central heating doesn’t count!)</li>
                                <li>75%+ should use storage heaters or other electric heating (eg. radiant electric heaters, a heat pump, or an inline electric boiler) for their primary source of space heating</li>
                                <li>Having at least one participant with an electric vehicle would be a great bonus!</li>
                            </ul>
                        </td>
                    </tr>
                </table>
                <p><b>Composition of Self-Assessors</b></p>
                <p>The composition of the self-assessors is not so important. Self-assessors will hopefully draw attention to themselves during the initial outreach and the info-session. They will represent the people who, on seeing a poster or social media advert, came along to an info-session out of interest and without having to be coaxed by South Seeds staff.</p>
                <p>The self-assessors will need to have a higher level of technical confidence than is required for the home visit receivers. Key characteristics will be:</p>
                <ul>
                    <li>Self-selecting to some extent (ie. people with interest and enthusiasm in the project)</li>
                    <li>Decent IT skills </li>
                    <li>Some knowledge about their heating system. </li>
                    <li>Must have electric space heating, an electric immersion element and/or an electric vehicle</li>
                </ul>
                <p>If at all possible…</p>
                <ul>
                    <li>At least one should come from a low income household</li>
                    <li>At least one should live in council or social housing</li>
                </ul>
            </b-card-body>
        </b-collapse>
    </b-card>

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion11 variant="info" style='color:red'>Registering the participants' details</b-btn>
        </b-card-header>
        <b-collapse id="accordion11" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>Please enter participants' here (link to the questions and data collection fields section of the platform) to register the details of each participant household </p>
                <p style="color:red">I am not very clear about how you want the process to be. As the tool works now the energy officer will create an assessment and that's when the details are inputted. Are you thinking about inputting those details at a different time than when the assessment happens? </p>

            </b-card-body>
        </b-collapse>
    </b-card>

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion12 variant="info" style="color: red">Carrying out the interviews</b-btn>
        </b-card-header>
        <b-collapse id="accordion12" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>Please use the following process for preparing for and carrying out the interview with each participant household: </p>
                <ul>
                    <li>Pre-visit information: Send an email to each participant, providing this link (<a href="{{url('/')}}">{{url('/')}}</a>) and inviting them to read it before the home visit and interview. Also, brief them about the content of the interview (<span style="color: red">hyperlink to guidance for Community organisation for the interview – to be written</span>) and arrange a suitable date. If you think it is more appropriate to send a leaflet with this information instead, please do that.</li>
                    <li>Carry out the home visit and do the following:</li>
                    <ul>
                        <li>Carry out the home energy audit</li>
                        <li>Explain the purpose of the visit again, including the ECAS demonstrator and this interview – in case they have not read the flyer, go through the flyer information at the start of the flexibility element of the interview </li>
                        <li>Log into the tool, create a new assessment and carry out the flexibility interview questions in the sections "Questionnaire" and "Assessment". The section "Report feedback" will be left for the follow up telephone call.  </li>
                    </ul>
                    </li>
                </ul>
            </b-card-body>
        </b-collapse>
    </b-card>

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion13 variant="info">Creating the report from the interview and sending it to the participants</b-btn>
        </b-card-header>
        <b-collapse id="accordion13" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>To be able to provide the householder with a copy of their interview record and the results of the flexibility offer, you can access and print off a report from their interview in the "Report" section of the assessment. At the bottom of the report you will also find a unique link that can be forwarded to the householder.</p>
                <p>This will then need to be given to the participant household to read, in advance of a follow up telephone call. </p>
            </b-card-body>
        </b-collapse>
    </b-card>

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion14 variant="info">Carrying out the follow up telephone calls</b-btn>
        </b-card-header>
        <b-collapse id="accordion14" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>The Energy Officer will first find the assessment. Questions in the "Report feedback" section would then be asked over the phone, to secure their response to this final element of the survey.</p>
            </b-card-body>
        </b-collapse>
    </b-card>

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion15 variant="info">Accessing other types of flexibility reports on the platform</b-btn>
        </b-card-header>
        <b-collapse id="accordion15" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>As an aggregation organisation you will also need to be able to see how the flexibility being offered by individual households (as indicated by their individual reports above) adds up or 'aggregates' into larger amounts of flexibility for offering to the grid management companies.</p>
                <p>You can access an 'aggregation report' from the organisation's 
                    dashboard clicking the "Aggregation" tab. From there you can 
                    filter the list of assessments and/or tick the check boxes to 
                    choose which assessments use for the report.</p>
                <p>The information shown in the report is:</p>
                <ul>
                    <li>Number of assessments in report</li>
                    <li>Flexible power available (kW)</li>
                    <li>Total load shifted (kWh/year)</li>
                    <li>A table indicating the total income that each one of the 
                        3 schemes (Secure, Dynamic and Restore) would generate. 
                        More information about these schemes can be found in the 
                        household report</li>
                    <li>You are also able to calculate the income for a bespoke 
                        scheme by tweaking the different factors that the model 
                        uses</li>
                </ul>
                <div style="text-align:center">
                    <img style="margin: auto" src="{{url('/img/Flexibility Tool - Aggregation report.jpg')}}" />
                </div>
            </b-card-body>
        </b-collapse>
    </b-card>

</div>

@endsection