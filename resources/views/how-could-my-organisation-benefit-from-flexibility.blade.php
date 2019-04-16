@extends('layout')

@section('title', "Benefits for organisations" )

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

</div>

@endsection