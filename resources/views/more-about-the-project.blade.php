@extends('layout')

@section('title', "How could I benefit from 'flexibility?'" )

@section('style')

<style>
    .card-header a{
        background: #d6d4ce;
        border:none;
        font-size:20px;
        text-align:left;
        margin-left: 25px
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
    <h1>More about the project</h1>
    <p>Explore the topics below to better understand this project.</p>

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
                <b-btn block href="#" v-b-toggle.accordion3 variant="info">What are the coming changes in the energy system?</b-btn>
            </b-card-header>
            <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>At the moment our electricity system is based on big central power stations. Electricity is sent out from these stations around the country on large cables and then distributed through thinner cables to households and other consumers. With more renewable energy being built, most of the renewable energy (wind turbines or hydro power) is being installed either in more remote areas on the edges of the electricity grid or in smaller units (such as solar panels) in urban areas, where the grid cables are much smaller and can carry less electricity. </p>
                    <p>This means the small cables at the edges of the grid (like the one down your road) are more important than ever before, and often have more energy flowing through them.</p>
                    <p>Because of this and with changes in government thinking, there is going to be more focus on managing electricity (both its supply and its use) at a local level. Meanwhile, new technology in computers and communications makes it possible to monitor and control energy supply and use (or 'demand') at this more local level in real time. </p>
                    <p>The government has also set targets for reducing carbon emissions from energy used for heating and for transport as these make up nearly three quarters of our energy use. For example, all new cars will have to be zero-carbon (i.e. not using fossil-fuels) from 2032 onwards in Scotland – so more people are already buying electric cars. </p>
                </b-card-body>
            </b-collapse>
        </b-card>


        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion4 variant="info">What do 'flexibility' and 'aggregation' mean when you are talking about the energy system?</b-btn>
            </b-card-header>
            <b-collapse id="accordion4" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>As electricity on the grid will need to be managed more carefully at a local level, the companies managing the grid ('Power companies') will want to make sure that energy is used by consumers when it is most available and not used when it is in short supply.  To achieve this, they will want customers to be 'flexible' about what times of day they use electricity to match when the energy is being generated. </p>
                </b-card-body>
            </b-collapse>
        </b-card>


        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion5 variant="info">Flexibility Agreements with customers</b-btn>
            </b-card-header>
            <b-collapse id="accordion5" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>Power companies are starting to use new technology to manage the new pressures created when renewables and electric vehicles are added to their grids. Through Flexibility Agreements, power companies are paying people to install smart controllers on their electric heaters, electric cars, or other electric devices which use a lot of energy or can store energy.  </p>
                    <p>The power company monitors problem parts of their network 24/7 and where someone has agreed to be 'flexible' they will use the smart controllers to temporarily switch devices off if they need to. When this happens though, the smart controllers won't switch off devices if it would stop them doing what they need to (eg. charge the car by 7am). The householder is paid for their help each time they allow their device to be switched off. </p>
                </b-card-body>
            </b-collapse>
        </b-card>


        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion6 variant="info">Aggregation</b-btn>
            </b-card-header>
            <b-collapse id="accordion6" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>This kind of flexibility is only useful when there is enough of it to make a significant difference. Switching one household's appliances on or off will never be enough on its own. So the power company is looking for ways in which it can get bigger 'bundles' of flexibility. Some companies (called 'Aggregators') offer this service to the power company – they bring lots of little energy users together and make a deal on their behalf. </p>
                </b-card-body>
            </b-collapse>
        </b-card>


        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <b-btn block href="#" v-b-toggle.accordion7 variant="info">What is the Energy Community Aggregation Service (ECAS)?</b-btn>
            </b-card-header>
            <b-collapse id="accordion7" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                    <p>ECAS is a community based project planning to set up a cooperatively owned aggregator. We plan to bring together community groups across the UK so that, together, we are big enough to deal with the power companies. We aim to set up Flexibility Agreements which benefit communities much more, by passing on much more of the value of the flexibility agreement to the householder and community organisation. </p>
                    <p>This project aims to demonstrate how that might be set up in the future and to find out how best to work with community groups and householders to make it work well</p>
                </b-card-body>
            </b-collapse>
        </b-card>

    </div>

</div>
@endsection