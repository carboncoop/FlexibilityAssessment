@extends('layout')

@section('title', 'Home' )

@section('content')
<div id="app">
    <div id='home'>
        <h1>Energy Community Aggregation Service (ECAS) research project</h1>
        <h2>What is this project? </h2>
        <p>We are developing a project including a 'demonstration' or research web platform to help community groups and residents understand the coming changes in the energy system in Scotland and the UK. The project also helps to show how these changes might help community groups and residents to reduce fuel costs or earn an income from getting involved in the energy market. We want to test this platform to help us understand what information you (either as a community organisation representative or as a resident) would find helpful to understanding the changes and the likely opportunities </p>
        <h2>Who is involved?</h2>
        <div id='who-is-involved'>
            <a href="https://carbon.coop/" target="blank"><img class="carboncoop" src="{{asset('img/carboncoop-logo.png')}}" /></a>
            <a href="http://www.communityenergyscotland.org.uk/" target="blank"><img class="community-energy-scotland" src="{{asset('img/community-energy-scotland-logo.png')}}" /></a>
            <a href="http://southseeds.org/" target="blank"><img class="south-seeds-logo" src="{{asset('img/south-seeds-logo.png')}}" /></a>
        </div>

        <h2>What are the coming changes in the energy system?</h2>
        <p>At the moment our electricity system is based on big central power stations. Electricity is sent out from these stations around the country on large cables and then distributed through thinner cables to households and other consumers. With more renewable energy being built, most of the renewable energy (wind turbines or hydro power) is being installed either in more remote areas on the edges of the electricity grid or in smaller units (such as solar panels) in urban areas, where the grid cables are much smaller and can carry less electricity. </p>
        <p>This means the small cables at the edges of the grid (like the one down your road) are more important than ever before, and often have more energy flowing through them.</p>
        <p>Because of this and with changes in government thinking, there is going to be more focus on managing electricity (both its supply and its use) at a local level. Meanwhile, new technology in computers and communications makes it possible to monitor and control energy supply and use (or 'demand') at this more local level in real time. </p>
        <p>The government has also set targets for reducing carbon emissions from energy used for heating and for transport as these make up nearly three quarters of our energy use. For example, all new cars will have to be zero-carbon (i.e. not using fossil-fuels) from 2032 onwards in Scotland – so more people are already buying electric cars. </p>

        <h2>What do 'flexibility' and 'aggregation' mean when you are talking about the energy system?</h2>
        <p>As electricity on the grid will need to be managed more carefully at a local level, the companies managing the grid ('Power companies') will want to make sure that energy is used by consumers when it is most available and not used when it is in short supply.  To achieve this, they will want customers to be 'flexible' about what times of day they use electricity to match when the energy is being generated. </p>

        <h2>Flexibility Agreements with customers</h2>
        <p>Power companies are starting to use new technology to manage the new pressures created when renewables and electric vehicles are added to their grids. Through Flexibility Agreements, power companies are paying people to install smart controllers on their electric heaters, electric cars, or other electric devices which use a lot of energy or can store energy.  </p>
        <p></p>The power company monitors problem parts of their network 24/7 and where someone has agreed to be 'flexible' they will use the smart controllers to temporarily switch devices off if they need to. When this happens though, the smart controllers won't switch off devices if it would stop them doing what they need to (eg. charge the car by 7am). The householder is paid for their help each time they allow their device to be switched off. </p>

        <h2>Aggregation: </h2>
        <p>This kind of flexibility is only useful when there is enough of it to make a significant difference. Switching one household's appliances on or off will never be enough on its own. So the power company is looking for ways in which it can get bigger 'bundles' of flexibility. Some companies (called 'Aggregators') offer this service to the power company – they bring lots of little energy users together and make a deal on their behalf. </p>

        <h2>What is the Energy Community Aggregation Service (ECAS)?</h2>
        <p>ECAS is a community based project planning to set up a cooperatively owned aggregator. We plan to bring together community groups across the UK so that, together, we are big enough to deal with the power companies. We aim to set up Flexibility Agreements which benefit communities much more, by passing on much more of the value of the flexibility agreement to the householder and community organisation. </p>
        <p>This project aims to demonstrate how that might be set up in the future and to find out how best to work with community groups and householders to make it work well</p>
        <p><a href="how-could-I-benefit-from-flexibility">How could I benefit from 'flexibility'?</a></p>

        <h2>The changes in the grid, are beginning to be felt in people's homes:</h2>
        <ul>
            <li><b>Smart meters are being rolled out.</b> The Government says that every house will have one by 2020, unless they have requested an opt-out. </li>
            <li><b>If you have a smart meter, prices for electricity could be different at different times of day and you could decide to use more of the electricity you need, when it is cheapest.</b> Smart Meters give you much more information about your energy use, and are designed for a new range of electricity tariffs which are beginning to be developed, where the price depends on when you use energy (called 'time of use' tariffs).</li>
            <li><b>Smart appliances are starting to come out, for example,</b> many new electric heaters, cars, and washing machines let you remotely control them. Smart home controllers can communicate with and coordinate these smart devices and this makes them available for offering flexibility</li>
            <li>Some people have <b>bought electric vehicles</b> and are charging them either at home or through publicly available charge points saving money on fuel costs. </li>
        </ul>

        <h2>Can I sign up for offering flexibility now? </h2>
        <p>Aggregation of household flexibility is not happening yet but it is coming and we want to help you and others understand it and get ready for it. So we are looking for people interested in taking part in a research 'demonstration' – not the real thing. </p>
        <p>See below about how to sign up for this test project – we will not actually change anything in your house and nothing will actually be switched off, we are mainly wanting to ask you about whether you would be interested in taking part in the future and what would encourage you or discourage you from taking part. </p>

        <h2>How could a Flexibility Agreement work for an individual household in the future if we set up ECAS?</h2>
        <p>To sign up to a flexibility agreement in the future, you would have to have electric devices in your home that can be switched on and off, and that were compatible with the smart control system being used. These devices might be an electric car with its battery, smart electric heaters or heat pumps but even an immersion heater for your hot water might work quite well. You would also have a smart meter. </p>
        <p>If you had the right devices the next step would be to talk to your local community group about Flexibility Agreements. They would arrange for someone to visit your house, check that you have the devices suitable for flexibility and find out what level of flexibility you are happy to sign up for. Then, once the smart controller was put in to control things remotely, it would run pretty much by itself, according to the amount of flexibility you have agreed to offer. </p>
        <p>You could choose to get a text or email when anything was switched, letting you know what happened and giving you a chance to override it. Once every few months you would get a statement showing how many times things were switched, and you would receive payments for your flexibility.</p>

        <h2>What about taking part in this research 'demonstration' project?</h2>
        <p>For our research, we're working with South Seeds in Glasgow and we want to see how flexibility could work in the south side of Glasgow in future. </p>
        <p>As part of this South Seeds are recruiting a group of householders to go through a home visit and survey to give feedback on our ideas and information. </p>

        <h2>How can I sign up to take part in this research project</h2>
        <p>South Seeds are looking for about 20 households to take part in our project. This would involve you doing the following:</p>
        <ul>
            <li>Attending an information session (probably in February 2019) about the project and about how we will work with you – this will give you more detailed information about the changes in the energy system and about the project</li>
            <li>Having a home visit by a South Seeds Energy Officer, who will offer you a home energy audit and do a short interview (about 30 minutes) about what appliances you have in your home, whether they are suitable for flexibility and also ask you questions about how clear our information is on this webpage and about the project </li>
            <li>Having a short telephone follow up call after the home visit, to give your feedback on the report we will provide you with, about the flexibility options that might be relevant to your household</li>
        </ul>

        <h2>What would I get for taking part?</h2>
        <p>You would get a payment in total of £100 for taking part (paid in several instalments depending on completing the various steps above). You would also get the chance to learn more about the changes and how flexibility will work in practice.</p>
        <p>South Seeds would really value this chance to get feedback on this idea from local people, which will help South Seeds think about how such a project might work in the future.  </p>
        <p>If you are interested in being a participant – please contact South Seeds <span style="color:red">(hyperlink to an email to SS?)</span> to sign up. If you want more information before signing up please ring <span style="color:red">xxxxx </span></p>
        <p><a href="how-could-my-organisation-benefit-from-flexibility">How could my organisation benefit from 'flexibility'? </p>
        
        
    </div>
</div>
@endsection