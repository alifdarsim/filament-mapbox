// function mapComponent() {
//     return {
//
//     }
//
//     // mapboxgl.accessToken = '{{config('mapbox.access_token')}}';
//
//     var map = new mapboxgl.Map({
//         // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
//         style: 'mapbox://styles/mapbox/standard',
//         // center: json_encode($getCenter()),
//         // zoom: $getZoom() ,
//         // bearing: $getBearing(),
//         // pitch: $getPitch(),
//         container: 'map',
//         antialias: true
//     });
//
//     map.on('load', function () {
//
//         map.addSource('_marker', {
//             type: 'geojson',
//             data: {
//                 type: 'FeatureCollection',
//                 features: []
//             }
//         });
//
//         // Function to update the data source
//         function insertMarkers(data) {
//             const geoJsonData = getGeoJson(data);
//             map.getSource('_marker').setData(geoJsonData);
//
//             // Calculate the bounds
//             const bounds = new mapboxgl.LngLatBounds();
//             geoJsonData.features.forEach(feature => {
//                 bounds.extend(feature.geometry.coordinates);
//             });
//
//             // Fit the map to the bounds
//             if (geoJsonData.features.length) {
//                 map.fitBounds(bounds, {
//                     padding: 100 // Optional padding around the bounds
//                 });
//             }
//
//             // Add markers
//             // geoJsonData.features.forEach(feature => {
//             //     if ({{strlen($getCustomMarkerUrl()) == 0 ? 'true' : 'false'}}) {
//             //         Use default markers
//                     // new mapboxgl.Marker()
//                     //     .setLngLat(feature.geometry.coordinates)
//                     //     .addTo(map);
//                 // }
//             // });
//         }
//
//         // if ({{strlen($getCustomMarkerUrl()) != 0 ? 'true' : 'false'}}) mapLoadImage();
//         // insertMarkers({!! $markers !!});
//     });
//
// }
