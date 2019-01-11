ls @extends('layout')

@section('title', "Scotland Flexibility Potential Map" )

@section('content')

<style>
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
        line-height: 18px;
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
</style>

<!-- Leaflet's - Make sure CSS is loded first-->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
      integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
      crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
        integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
        crossorigin="">
</script>

<!-- Flexibility assessment model -->
<script src="{{asset('js/flexibility_model/data.js')}}"></script>
<script src="{{asset('js/flexibility_model/flex_model.js')}}"></script>

<!-- HTML -->
<div>
    <div id='how-could-I-benefit-from-flexibility'>
        <h1>Scotland Flexibility Potential Map</h1>
        <p><span class="red">Intro text??</span></p>

        <div id="mapid" style="height: 800px;width: 800px;"></div>

    </div>
</div>

<!-- Draw map -->
<script>
            var geojson;
            grades = [0, 4, 8, 16, 32, 64, 128, 256]; // Flexibility ranges, used for coloring the postcodes in the map




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
            info.update = function (props) {
                this._div.innerHTML = (props ?
                        'Postcode Sector: ' + props.RMSect + '<br />EPC Estimated Domestic Flexibility = ' + (flex_model(props.flex_im_count, props.flex_im_score, props.flex_sh_count, props.flex_sh_score)).toFixed(0) + ' kW'
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
                return {
                    fillColor: getColor(flex_model(feature.properties.flex_im_count, feature.properties.flex_im_score, feature.properties.flex_sh_count, feature.properties.flex_sh_score)),
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