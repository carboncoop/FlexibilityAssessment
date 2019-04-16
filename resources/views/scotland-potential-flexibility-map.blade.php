@extends('layout')

@section('title', "Where is the Flexibility?" )


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

    .info {
        padding: 6px 8px;
        font: 14px/16px Arial, Helvetica, sans-serif;
        background: white;
        background: rgba(255,255,255,0.8);
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
        border-radius: 5px;
    }
    .info h4 {
        margin: 0 0 5px;
        color: #777;
    }		
    .legend {
        line-height: 20px;
        color: #555;
    }
    .legend i {
        width: 18px;
        height: 18px;
        float: left;
        margin-right: 8px;
        opacity: 0.7;
    }
    .red{
        color: red;
    }
    #mapid{
        z-index:1;
        margin:auto
    }

    table#south-seeds-postcodes-flexibility{
        max-width:400px;
        text-align:center;
        margin: 25px auto 40px
    }
</style>

<!-- Leaflet's - Make sure CSS is loded first-->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
      integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
      crossorigin=""/>

@endsection






@section('script-above')
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
        integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
        crossorigin="">
</script>

<!-- Flexibility assessment model -->
<script src="{{asset('js/flexibility_model/data.js')}}"></script>
<!--<script src="{{asset('js/flexibility_model/flex_model.js')}}"  type="module"></script>-->

@endsection




<!-- HTML -->
@section('content')
<div>
    <div id='how-could-I-benefit-from-flexibility'>

        <h1>Where is the Flexibility?</h1>
        <br />

        <p><b>The flexibility is in your home,</b> it is the electricity supply and 
            your ability to use this supply at times to different peak demand.</p>
        <p>The most promising opportunities for future flexibility are electric vehicles,
            heat pumps, and battery storage technology. However currently this technology
            is only available in a few homes. Right now, immersion heaters and electric
            storage heaters have the most potential. </p>
        <p>The map shows where there are concentrations of homes with immersion heater 
            and electric storage heaters, these are the areas where an aggregated 
            flexibility scheme could work best.</p>

        <div role="tablist">            
            <b-card no-body class="mb-1">
                <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-btn block href="#" v-b-toggle.accordion2 variant="info">Testing the concept on Glasgow's southside</b-btn>
                </b-card-header>
                <b-collapse id="accordion2" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <p>South Seeds is a community-led organisation which is based on Glasgow’s 
                            southside. It covers the South central area dominated by tenements and 
                            blocks of flats. This is most of the G42 postcode and part of the G41 
                            postcode. Based on reported Scottish EPC data for domestic properties 
                            the area contains an estimated total of 2607kW (2.6MW) of flexible capacity 
                            which is equivalent to turning a 150m wind turbine on/off on demand· 
                            After running the model we estimate that this potential flexibility 
                            could generate around £42K.</p>

                        <p>The below table gives an estimate of total available flexibility from 
                            storage heaters and immersion heaters in some of the postcode sectors 
                            South Seeds covers(using simple assumptions about typical average loads 
                            and potential availability and utilisation of these loads). </p>

                        <p>If you are interested in how this was calculated, it was assumed that 
                            the available flexibility from a storage 
                            heater is correlated with the EPC performance of a given property. These 
                            numbers are only indicative and should only be taken as being meaningful 
                            in the aggregate. In reality the flexibility available from a particular 
                            installation depends on many factors including patterns of utilisation 
                            and the detailed specifications of the equipment which cannot be evaluated 
                            without a site visit and assessment (or continuous monitoring). The EPC 
                            dataset is a large but potentially distorted sample of all domestic premises 
                            and some information is recorded erroneously or expires as changes are 
                            made to housing stock.</p>


                        <p>These numbers highlight the large amounts of potential 
                            flexibility which is currently unharnessed in homes in Scotland (and 
                            elsewhere). </p>

                        <table class='table' id='south-seeds-postcodes-flexibility'>
                            <tr><td>Postcode Sector</td><td>Immersion Heater (kW)</td><td>Storage Heater (kW)</td></tr>
                            <tr><td>G41 1</td><td>85</td><td>65</td></tr>
                            <tr><td>G41 2</td><td>106</td><td>28</td></tr>
                            <tr><td>G41 3</td><td>356</td><td>241</td></tr>
                            <tr><td>G41 4</td><td>32</td><td>21</td></tr>
                            <tr><td>G41 5</td><td>260</td><td>214</td></tr>
                            <tr><td>G42 0</td><td>150</td><td>129</td></tr>
                            <tr><td>G42 7</td><td>145</td><td>32</td></tr>
                            <tr><td>G42 8</td><td>197</td><td>64</td></tr>
                            <tr><td>G42 9</td><td>276</td><td>206</td></tr>
                            <tr sytle='font-weight:bold'><td>Total</td><td>1607</td><td>1000</td></tr>
                        </table>
                    </b-card-body>
                </b-collapse>
            </b-card>

            <b-card no-body class="mb-1">
                <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-btn block href="#" v-b-toggle.accordion3 variant="info">How was this map made?</b-btn>
                </b-card-header>
                <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <p>Using Scottish domestic Energy Performance Certificate 
                            (EPC) data, we have produced an interactive map of the 
                            potential flexibility across the whole of Scotland.</p>
                        <p>Flexibility schemes will need to find and work with households 
                            who have energy use that they can flex. Most electricity 
                            use within households is not ‘flexible’, because there
                            is no easy way to change the time that energy is used. 
                            The most promising ‘flexible’ devices are electric storage
                            heaters and immersion elements. These are flexible because 
                            they can charge up at any time and store the heat for
                            later.</p>
                        <p>This map uses EPC data (which record the type of heating 
                            in each house surveyed) to estimate the total amount of
                            electric storage and immersion heating load installed 
                            in households for each postcode region. Deeper red colours 
                            (and higher numbers), represent more electric heating 
                            in an area. Lighter colours and lower number represent 
                            less electric heating.</p>
                    </b-card-body>
                </b-collapse>
            </b-card>

            <b-card no-body class="mb-1">
                <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-btn block href="#" v-b-toggle.accordion4 variant="info">How to use this map?</b-btn>
                </b-card-header>
                <b-collapse id="accordion4" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <p>If you are a community group interested in aggregating 
                            Flexible Power, you will want to know how many potential 
                            Flexible loads exist in households near you. If there 
                            aren’t many, it might be difficult for you to get a project 
                            off the ground, while if every household has a large 
                            flexible load, it will be much easier for you!</p>
                        <p>Electric Storage heating and immersion elements are the
                            most important flexible loads at the moment, and this 
                            map will give you an idea of which parts of Scotland 
                            have the most electrical heating in them. </p>
                        <p>Deeper red colours (and higher numbers), represent more 
                            electric heating in an area. Lighter colours and lower
                            number represent less electric heating: so if your area
                            is particularly dark red, that’s good news! </p>
                        <p>This map could also help direct outreach work: If you 
                            are out recruiting households to participate in Flexible
                            Power, you might want to concentrate your efforts on the
                            darker red parts of your area, as these will include more 
                            households with electric heating.</p>
                    </b-card-body>
                </b-collapse>
            </b-card>
        </div>

        <div id="mapid" style="height: 800px;width: 800px;margin-top:35px"></div>

    </div>
</div>
@endsection





<!-- Draw map -->
@section('script-below')
<script type="module">

    import {flexibilityModel} from "{{asset('js/flexibility_model/flex_model.js')}}";
    // require("{{asset('js/flexibility_model/flex_model.js')}}");
    let flex_model = new flexibilityModel();

    var geojson;
    //let grades = [0, 4, 8, 16, 32, 64, 128, 256]; // Flexibility ranges, used for coloring the postcodes in the map
    let grades = [0, 32, 64, 128, 256, 512, 1024]; // Flexibility ranges, used for coloring the postcodes in the map




    /*******
    * Create map
    *********/
    var mymap = L.map('mapid').setView([55.86, -4.25], 13);




    /*******
    * Add info box (top right)
    *********/

    var info = L.control();

    info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
    this.update();
    return this._div;
    };



    // method that we will use to update the control based on feature properties passed
    let flexibility = {
    household: {},
    storageHeaters: {
    present: true,
    number: 1.5, // 1.5 storage heaters average per house thaat has storage heaters
    rating: 1.5      // kW average power of a storage heater
    },
    immersionHeater: {
    present: true,
    rating: 2, // average power of a immersion heater
    controlType: "Thermostat"
    }
    };
    info.update = function (props) {
    if (props) {
    flexibility.household.EPC = props.flex_sh_score / props.flex_sh_count;
    flex_model.run(flexibility);
    }
    this._div.innerHTML = (props ?
    'Postcode Sector: ' + props.RMSect + '<br />EPC Estimated Domestic Flexibility = '
    + (props.flex_sh_count * flexibility.powerAvailable.storageHeaters + props.flex_im_count * flexibility.powerAvailable.immersionHeater).toFixed(2) + ' kW'
    : 'Hover over a Postcode Sector');
    };

    info.addTo(mymap);




    /*******
    *Add legend
    *********/

    var legend = L.control({position: 'bottomright'});

    legend.onAdd = function (map) {

    var div = L.DomUtil.create('div', 'info legend'), labels = [];
    div.innerHTML = 'Flexibility (kW)<br />';
    // loop through our density intervals and generate a label with a colored square for each interval
    for (var i = 0; i < grades.length; i++) {
    div.innerHTML +=
    '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
    grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
    }

    return div;
    };

    legend.addTo(mymap);



    /*******
    * Add map layers
    *********/

    mymap.createPane('labels');
    mymap.getPane('labels').style.zIndex = 650;
    mymap.getPane('labels').style.pointerEvents = 'none';

    L.tileLayer("https://api.mapbox.com/styles/v1/{{config('app.mapbox_username')}}/cjqibx7p41mnt2rrrln5hv0qu/tiles/256/{z}/{x}/{y}@2x?access_token={accessToken}", {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    accessToken: "{{config('app.mapbox_accesstoken')}}",
    }).addTo(mymap);

    L.tileLayer("https://api.mapbox.com/styles/v1/{{config('app.mapbox_username')}}/cjqibza5rkptj2srkbiuj38c7/tiles/256/{z}/{x}/{y}@2x?access_token={accessToken}", {
    attribution: '©OpenStreetMap, ©MapBox',
    accessToken: "{{config('app.mapbox_accesstoken')}}",
    pane: 'labels'
    }).addTo(mymap);




    /*******
    * Fill up map
    *********/

    geojson = L.geoJSON(data, {style: style, onEachFeature: onEachFeature}).addTo(mymap);




    /*******
    * Functions
    *********/
    function getColor(d) {
    return d > grades[7] ? '#800026' :
    d > grades[6] ? '#BD0026' :
    d > grades[5] ? '#E31A1C' :
    d > grades[4] ? '#FC4E2A' :
    d > grades[3] ? '#FD8D3C' :
    d > grades[2] ? '#FEB24C' :
    d > grades[1] ? '#FED976' :
    '#FFEDA0';
    }

    function style(feature) {
    let flexibility = {
    household: {},
    storageHeaters: {
    present: true,
    number: 1.5, // 1.5 storage heaters average per house thaat has storage heaters
    rating: 1.5      // kW average power of a storage heater
    },
    immersionHeater: {
    present: true,
    rating: 2, // average power of a immersion heater
    controlType: "Thermostat"
    }
    };
    flexibility.household.EPC = feature.properties.flex_sh_score / feature.properties.flex_sh_count;
    flex_model.run(flexibility);
    return {
    fillColor: getColor(feature.properties.flex_sh_count * flexibility.powerAvailable.storageHeaters + feature.properties.flex_im_count * flexibility.powerAvailable.immersionHeater),
    weight: 2,
    opacity: 0.5,
    color: 'white',
    dashArray: '3',
    fillOpacity: 0.4
    };
    }

    function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
    weight: 5,
    color: '#666',
    dashArray: '',
    fillOpacity: 0.7
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
    layer.bringToFront();
    }

    info.update(layer.feature.properties);
    }

    function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
    }

    function zoomToFeature(e) {
    mymap.fitBounds(e.target.getBounds());
    }

    function onEachFeature(feature, layer) {
    layer.on({
    mouseover: highlightFeature,
    mouseout: resetHighlight,
    click: zoomToFeature
    });
    }

</script>

@endsection