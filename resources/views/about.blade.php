@extends('layout')

@section('title', "About" )

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

<div id='more-about-the-project'>
    <h1>About</h1>

    <p>The way we make electricity is becoming more diverse, with much more coming 
        from renewable generators. The grid which connects generation with use, 
        by taking electricity across the country and eventually to our homes is changing 
        in response to this. However it is not changing fast enough and in places there 
        are grid constraints. </p>
    <p>The good news is that the grid could continue to carry more electricity if 
        users are more flexible about when they use electricity. This could mean installing new smart devices 
		or smart controllers for electric heaters and other devices. </p>
	<p>Smart controllers can sync heater charge times to make the most of renewable energy avaialable locally, 
		and avoid charging at 'peak' times when the network is under strain </p>
    <p>Flexible electricity use will probably become part of all our futures. It could even provide you with an income. 
		But the moment we don’t know exactly how this will work: that is why we are carrying out this project.</p>
	<p>The Flexible Power Community would be a shared, not-for-profit platform, enabling local community groups to be part of building the green, 
	flexible grid of the future. Through Flexible Power Community, community groups could support local residents to adopt flexible electricity use, 
	and make sure the value of this flexibility was kept local too. </p>

    <div role="tablist">

        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion3 variant="info">What are the coming changes in the energy system?</b-btn>
            </b-card-header>
            <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>At the moment our electricity system is based on big central power stations. Electricity is sent out from these stations around the country on large cables and then distributed through thinner cables to households and other consumers. </p>
					<p>But most of the new renewable energy being built (wind turbines, solar panels and hydro stations) is being installed either in more remote areas on the edges of the electricity grid or in smaller units (such as solar panels) in urban areas, where the grid cables are much smaller and can carry less electricity. </p>
                    <p>This means the small cables at the edges of the grid (like the ones down your road) are more important than ever before, and often have more energy flowing through them.</p>
                    <p>Because of this and with changes in government thinking, there is going to be more focus on managing electricity (both its supply and its use) at a local level. Meanwhile, new technology in computers and communications makes it possible to monitor and control energy supply and use (or 'demand') at this more local level in real time. </p>
                    <p>The government has also set targets for reducing carbon emissions from energy used for heating and for transport. In practice, this normally means converting cars and heaters from petrol, gas and oil to electric. Trasnport and Heating make up nearly three quarters of our energy use, so electrifying them will have a further impact on the grid, making flexibility event more important! </p>
                </b-card-body>
            </b-collapse>
        </b-card>


        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion4 variant="info">
                    <p>What does 'flexibility' mean when you are talking about the energy system?</p>
                </b-btn>
            </b-card-header>
            <b-collapse id="accordion4" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>It's very hard to store large amounts of electricity, so electricity use and generation across the grid have to balance each other out at all times. </p>
					<p>Managing the grid at a more local level means that the companies managing the grid ('Power companies') will try to make sure that energy is used by consumers when nearby wind turbines and solar panels are producing the most, not used when it is in short supply and has to shipped in from further away.  </p>
					<p>To achieve this, they want customers to be 'flexible' about what times of day they use electricity. This can be done by installing smart controllers or appliances which can automatically receive signals from the power companies and adjust when they use energy to make the best use of the local grid. </p>
					<p>Of course, the appliances still need to work for you as well! so the best appliances for smart control are ones that can storage energy at one point for use later: like electric cars and bikes (which have batteries in them), or electric storage heaters (which can heat up at one time of day, but keep the heat trapped inside until its needed later) </p>
                </b-card-body>
            </b-collapse>
        </b-card>


        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion5 variant="info">How do Flexibility Agreements work?</b-btn>
            </b-card-header>
            <b-collapse id="accordion5" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>Power companies are starting to use new technology to manage the new pressures created when renewables and electric vehicles are added to their grids. Through Flexibility Agreements, power companies are paying people to install smart controllers on their electric heaters, electric cars, or other electric devices which use a lot of energy or can store energy.  </p>
                    <p>The power company monitors important parts of their network 24/7 and, if a problem comes up (like too much energy being imported at a certain time), they will use the smart controllers in homes that have agreed to be 'flexible' to temporarily switch devices off. When they receive a request to switch off, the smart controllers will check if they can switch off for a while but still do what they need to for the householder (eg. charge the car by 7am). If so, they will will obey the request, but if not, they won't! </p>
					<p>The householder is paid for their help each time they allow their device to be switched off. </p>
                </b-card-body>
            </b-collapse>
        </b-card>


        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion6 variant="info">What are Aggregators, and why are they needed?</b-btn>
            </b-card-header>
            <b-collapse id="accordion6" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>Flexibility is only useful to the power company if there is enough of it to make a significant difference to the grid each time a problem comes up. Switching one household's appliances on or off will never be enough on its own. So the power company needs to work with lots of flexibile households at once, and would never contract directly with individual households for flexibility. </p>
					<p>Instead, the power company will contract with an intermediary organisation (called an 'Aggregator'), who agrees to bring lots of energy users together and make a single deal on their behalf. </p>
                </b-card-body>
            </b-collapse>
        </b-card>


        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion7 variant="info">What is the Flexible Power Community?</b-btn>
            </b-card-header>
            <b-collapse id="accordion7" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>Flexible Power Community is a community based project planning to set up a cooperatively owned aggregator. We plan to bring together community groups across the UK so that, together, we are big enough to deal with the power companies. </p>
					<p>Because we are non-profit and community based, we aim to set up Flexibility Agreements which benefit communities much more. This means allowing community groups, not technology companies, to take the lead in our energy transformation, and by doing so claim much more of the value of the flexibility agreement for the householder and local community. </p>
                    <p>This project aims to demonstrate how that might be set up in the future and to find out how best to work with community groups and householders to make it work well. </p>
                </b-card-body>
            </b-collapse>
        </b-card>

        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion2 variant="info">Who is involved in the Flexible Power Community?</b-btn>
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

    </div>

</div>
@endsection