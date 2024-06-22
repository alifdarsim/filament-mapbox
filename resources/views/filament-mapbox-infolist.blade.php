
<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">

    <div
        @if (\Filament\Support\Facades\FilamentView::hasSpaMode())
            ax-load="visible"
        @else
            ax-load
        @endif
        wire:ignore
        x-data="mapComponent({
            mapEl: $refs.map,
            token: '{{config('mapbox.access_token')}}',
            style: '{{$getStyle()}}',
            center: {{ json_encode($getCenter()) }},
            zoom: {{ $getZoom() }},
            bearing: {{ $getBearing() }},
            pitch: {{ $getPitch() }},
            antialias: {{ $getAntialias() === true ? 'true' : 'false' }},
            addNavigationControl: {{ $getAddNavigationControl() === true ? 'true' : 'false' }},
            addFullscreenControl: {{ $getAddFullscreenControl() === true ? 'true' : 'false' }},
            data: {{json_encode($getState())}},
            lightPreset: '{{$getLightPreset()}}',
            markerUrl: '{{$getMarkerUrl()}}',
            dataType: '{{$getDataType()}}',
            isGeoJson: {{ $getIsGeoJson() === true ? 'true' : 'false' }}
        })"
        x-init="initMap();"
    >
        <div x-ref="map"
             class="rounded-lg h-full"
             style="height: {{$getHeight()}}"/>
    </div>


</x-dynamic-component>

<script>

    var mapbox, bounds;

    function pointType(markerUrl, geoJson) {
        mapbox.loadImage(markerUrl, (error, image) => {
            if (error) throw error;

            mapbox.addImage('custom-marker', image);

            mapbox.addSource('points', {
                type: 'geojson',
                data: geoJson
            });

            mapbox.addLayer({
                id: 'points',
                type: 'symbol',
                source: 'points',
                layout: {
                    'icon-image': 'custom-marker',
                    'icon-allow-overlap': true,
                    'icon-size': 1,
                    'icon-anchor': 'center',
                    'text-field': ['get', 'name'],
                    'text-offset': [0, -3.4],
                    'text-anchor': 'bottom',
                    'text-size': 12,
                    'text-allow-overlap': true,
                    'text-font': ['Arial Unicode MS Bold'],
                }
            });
        });
    }

    function lineType(geoJson) {
        mapbox.addSource('route', {
            type: 'geojson',
            data: geoJson
        });
        mapbox.addLayer({
            'id': 'route',
            'type': 'line',
            'source': 'route',
            'layout': {
                'line-join': 'round',
                'line-cap': 'round'
            },
            'paint': {
                'line-color': '#ff4d4d',
                'line-width': 4
            }
        });
    }

    function polygonType(geoJson){
        mapbox.addSource('box', {
            type: 'geojson',
            data: geoJson
        });
        // Add a new layer to visualize the polygon.
        mapbox.addLayer({
            'id': 'box',
            'type': 'fill',
            'source': 'box', // reference the data source
            'layout': {},
            'paint': {
                'fill-color': '#0080ff', // blue color fill
                'fill-opacity': 0.5
            }
        });
        // Add a black outline around the polygon.
        mapbox.addLayer({
            'id': 'outline',
            'type': 'line',
            'source': 'box',
            'layout': {},
            'paint': {
                'line-color': '#000',
                'line-width': 3
            }
        });
    }

    function setBound(geoJson) {
        bounds = new mapboxgl.LngLatBounds();
        if (geoJson.type === 'Feature') {
            geoJson.geometry.coordinates.forEach(function (coordinate) {
                bounds.extend(coordinate);
            });
        }
        else {
            geoJson.features.forEach(function(feature) {
                bounds.extend(feature.geometry.coordinates);
            });
        }
    }

    function convertToGeoJson(data, dataType) {
        if (dataType === 'point') {
            return {
                type: 'FeatureCollection',
                features: data.map(item => ({
                    type: 'Feature',
                    geometry: {
                        type: 'Point',
                        coordinates: [item.longitude, item.latitude]
                    },
                    properties: {
                        id: item.id,
                        name: item.name,
                    }
                }))
            };
        } else if (dataType === 'line') {
            return {
                type: 'Feature',
                geometry: {
                    type: 'LineString',
                    coordinates: data.map(item => [item.longitude, item.latitude])
                }
            };
        } else if (dataType === 'polygon') {
            return {
                type: 'Feature',
                geometry: {
                    type: 'Polygon',
                    coordinates: [data.map(item => [item.longitude, item.latitude])]
                }
            };
        }
    }

    function mapComponent(
        {
            token,
            style,
            mapEl,
            center,
            zoom,
            bearing,
            pitch,
            antialias,
            addNavigationControl,
            addFullscreenControl,
            data,
            lightPreset,
            markerUrl,
            dataType,
            isGeoJson
        }
    ) {
        return {
            initMap() {
                mapboxgl.accessToken = token;

                const geoJson = isGeoJson ? data : convertToGeoJson(data, dataType);

                setBound(geoJson);

                mapbox = new mapboxgl.Map({
                    style: style,
                    center: center ?? bounds.getCenter(),
                    zoom: zoom,
                    bearing: bearing,
                    pitch: pitch,
                    container: mapEl,
                    antialias: antialias
                });

                if (center === null) {
                    mapbox.fitBounds(bounds, {
                        padding: 50,
                        animate: false,
                    });
                }

                addNavigationControl && mapbox.addControl(new mapboxgl.NavigationControl());
                addFullscreenControl && mapbox.addControl(new mapboxgl.FullscreenControl());

                // Initialize the source and layer
                mapbox.on('load', function() {
                    try{
                        if (lightPreset !== '') mapbox.setConfigProperty('basemap', 'lightPreset', lightPreset);
                    }catch (e) {
                        console.warn('Filament-Mapbox: Light preset is not supported for this style')
                    }

                    if (dataType === 'point') pointType(markerUrl, geoJson);
                    else if (dataType === 'line') lineType(geoJson);
                    else if (dataType === 'polygon') polygonType(geoJson);
                    else (console.warn('Filament-Mapbox: Data type is not supported'))
                });
            },

        }
    }

</script>
