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

<p>Only organisations with really large flexible electricity loads can make flexibility deals directly 
    with power companies. Households and smaller flexible energy users aren't big enough to make a deal on their own, 
	so must band together and make a collective deal with a power company. The organisation which brings together 
    lots of little energy users to make a collective deal is known as an 'aggregator'. </p>
<p>Some organisations are already benefiting from working with power companies as 
    'aggregators' of flexible household electricity use. However most of these organisations 
    are technology companies and energy suppliers, with community based organisations 
    yet to really benefit.  </p>
<p>There is scope for community based organisations with good relationships with 
    householders to bring them together and aggregate their flexible use. In doing 
    so they can make money for the house holder and for the organisation, and help 
	drive the sustainable transition of our energy system.</p>

<div role="tablist">

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
            <b-btn block href="#" v-b-toggle.accordion3 variant="info">Could community groups have an advantage as aggregators?</b-btn>
        </b-card-header>
        <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>Many of the grid problems requiring flexibility are very local area specific, meaning that aggregators will need to be able to recruit a large group of flexible households in a small area. </p>
				<p>UK-wide commercial aggregators will struggle to recruit large numbers of people in very small areas using traditional marketing and advertising campaigns, but local community groups, with local knowledge and local contacts, are much better placed to mobilise the numbers at this scale. </p>
                <p>Also, community organisations which operate community buildings are energy consumers as well. Such groups can look at options for offering their own flexibility alongside taht of flexible local households; as well as developing community owned renewables, battery storage and electric vehicle charging. </p>

            </b-card-body>
        </b-collapse>
    </b-card>


    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion5 variant="info">What are the benefits for community groups and their members</b-btn>
        </b-card-header>
        <b-collapse id="accordion5" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>Community groups and their members could benefit in the following ways from taking the lead with flexibility agreements:</p>
                <ul>
                    <li><b>Strengthen your group:</b> taking responsibility for aggregating local flexibility could earn your community organisation a modest income, and the paid staff time that your group would gain could help support your other work and strengthen your presence in the community .</li>
                    <li><b>Combat local fuel poverty:</b> electrically heated households are the most likely to suffer from fuel poverty. They are also, by virtue of having such large electric heating loads, the best placed to offer flexibility to the grid and earn an income in return.</li>
                    <li><b>Support other community energy projects:</b> Flexibility agreements can be a first step towards a larger community energy project, or complement existing projects. For example, the smart controllers needed to offer flexibility could also be used to set up direct local energy supply from a community owned generator.</li>                
                </ul>
            </b-card-body>
        </b-collapse>
    </b-card>    

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
            <b-btn block href="#" v-b-toggle.accordion6 variant="info">How can I get involved?</b-btn>
        </b-card-header>
        <b-collapse id="accordion6" accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <p>This trial is still evolving: the Flexible Power Community is not yet ready to start partnering with community groups to offer flexibility to power companies, and power companies are not yet ready to buy that flexibility! but.... we are looking for community groups willing to test a potential future system as part of this project. </p>
                @if (Route::has('register'))
                <p><a href="{{ route('register') }}">Get in touch</a> to find out how we could collaborate, or register interest as an organisation</p>
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
                <p>Find useful resources <a href="resources-for-organisations">here</a></p>
            </b-card-body>
        </b-collapse>
    </b-card>

</div>

@endsection