<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">

    @php($markers = json_encode($getState()))

    <div
        @if (\Filament\Support\Facades\FilamentView::hasSpaMode())
            ax-load="visible"
        @else
            ax-load
        @endif
        wire:ignore
        x-data="mapComponent({
            mapEl: $refs.map,
            style: '{{$getStyle()}}',
            center: {{ json_encode($getCenter()) }},
            zoom: {{ $getZoom() }},
            bearing: {{ $getBearing() }},
            pitch: {{ $getPitch() }},
            antialias: {{ $getAntialias() === true ? 'true' : 'false' }},
            addControl: {{ $getAddControl() === true ? 'true' : 'false' }},
        })"
        x-init="initMap();"
    >
        <div x-ref="map"
             class="rounded-xl h-full"
             style="height: {{$getHeight()}}"/>
    </div>


</x-dynamic-component>

<script>
    function mapComponent(
        {
            style,
            mapEl,
            center,
            zoom,
            bearing,
            pitch,
            antialias,
            addControl
        }
    ) {
        return {
            initMap() {
                mapboxgl.accessToken = '{{config('mapbox.access_token')}}';

                var mapbox = new mapboxgl.Map({
                    style: style,
                    center: center,
                    zoom: zoom,
                    bearing: bearing,
                    pitch: pitch,
                    container: mapEl,
                    antialias: antialias
                });

                addControl && mapbox.addControl(new mapboxgl.NavigationControl());

            }
        }
    }

</script>
