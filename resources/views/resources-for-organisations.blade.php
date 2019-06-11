@extends('layout')

@section('title', "Resources for organisations" )

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
        some information below, mainly relating to our ongoing Flexible Power Community trial. 
		We also recommend that interested groups get in touch with 
        us or others who have experience.</p>

    <div role="tablist">
        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion8 variant="info">What is the role for a local community group in this research project? </b-btn>
            </b-card-header>
            <b-collapse id="accordion8" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>To get ready for a future Flexible Power Community, we want to learn much more about what flexibility might be available through households, what would attract households to sign up for offering flexibility and what would discourage them from getting involved. </p>
					<p>We also want to test what kind of information a community organisation will want, to help them decide whether to get involved in being a local aggregator organisation and understand what that would involve. This demonstration project aims to work with South Seeds to carry out this research. </p>
                </b-card-body>
            </b-collapse>
        </b-card>

        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion9 variant="info">What will the community group do as part of this research?</b-btn>
            </b-card-header>
            <b-collapse id="accordion9" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>We are asking Southseeds, as the trial community organisation, to be the front face of this research project when communicating with householdrs in Glasgow. The includes the following roles: </p>
                    <ul>
                        <li>Help plan local community engagement, with Community Energy Scotland (CES) input</li>
                        <li>Plan for and recruiting at least 20 participants</li>
                        <li>Host an information session for potential participants, with CES input, to: (a) explain the changes that are coming in the energy system, and (b) Briefparticipants on the demonstration project and how they would get involved</li>
                        <li>Carry out home visits, including a home energy audit and an interview with each participating household </li> 
						<li>Send a report to each household following their home visit, and followed this up with a phone call to get feedback on the report</li>
                        <li>Provide feedback on the support and information that the project provides to your organisation in delivering its role, including whether this support is clear enough and how it could be improved for future delivery of such an ECAS system</li>
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
					<p>This website provides a simple data collection form for registering participants' details: </p>
					<ul>
						<li>Log into the website (using the link on the top right) </li>
						<li>Click 'New' to create a new assessment, or click on an existing particuipant's assessment from the list displayed </li>
						<li>Enter details in teh relevant boxes of the form </li>
					</ul>
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
                <b-btn block href="#" v-b-toggle.accordion13 variant="info">Creating the report and sending it to participants</b-btn>
            </b-card-header>
            <b-collapse id="accordion13" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>To be able to provide the householder with a copy of their interview record and the results of the flexibility offer, you can access and print off a report from their interview in the "Report" section of the assessment. At the bottom of the report you will also find a unique link that can be forwarded to the householder.</p>
                    <p>To export the report, click on the printable link provided at the bottom of the report and use the "Save as PDF" functionality of your browser. </p>
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
                    <p>First find and review the householders' report on this website. Then call the householder and ask the questions in the "Feedback" section. Fill the householders' responses into the relevant parts of the form.</p>
                </b-card-body>
            </b-collapse>
        </b-card>

        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion15 variant="info">Accessing a summary of the aggregated flexibility available in your community</b-btn>
            </b-card-header>
            <b-collapse id="accordion15" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>As an aggregation organisation you will want to be able to see how the flexibility being offered by individual households (as indicated by their individual reports) adds up or 'aggregates' into a total amount of flexibility available for contracting with a power company.</p>
                    <p>You can access an 'aggregation report' from the organisation's 
                        dashboard by clicking the "Aggregation" tab. From there you can filter the list of assessments and/or tick the check boxes to choose which assessments use for the report.</p>
                    <p>The information shown in an aggregation report is:</p>
                    <ul>
                        <li>Total number of assessments</li>
                        <li>Total flexible power available (kW)</li>
                        <li>Total load that could be shifted annualy (kWh/year estimate)</li>
                        <li>Summary data and estimated total annual income from each of the 3 flexibility schemes (Secure, Dynamic and Restore). 
                            More information about these schemes can be found in the 
                            household report</li>
                        <li>Advanced: You could estimate the income provided by a different, bespoke, flexibility scheme by tweaking the factors that the model uses</li>
                    </ul>
                    <div style="text-align:center">
                        <img style="margin: auto" src="{{url('/img/Flexibility Tool - Aggregation report.jpg')}}" />
                    </div>
                </b-card-body>
            </b-collapse>
        </b-card>
    </div>

NOTE --- NEW CONTENT IS NOW ON THE WEBITE AND WILL NEED ADDING!!!! (ENERGY OFFICER MANUAL AND ORGANISATION USER MANUAL)  !!!!!!

</div>
@endsection