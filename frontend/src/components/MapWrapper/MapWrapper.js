import React, {Component} from 'react';
import L from 'leaflet';
import {MapContainer, TileLayer, Polyline} from 'react-leaflet';
import './MapWrapper.css';
import icon from 'leaflet/dist/images/marker-icon.png';
import iconShadow from 'leaflet/dist/images/marker-shadow.png';
import MarkerItem from "./MarkerItem";
import PolylineItem from "./PolylineItem";
import * as path from "path";

let DefaultIcon = L.icon({
    iconUrl: icon,
    shadowUrl: iconShadow,
});

L.Marker.prototype.options.icon = DefaultIcon;

class MapWrapper extends Component {

    state = {
        bell: {
            lat: 51.505,
            lng: -0.09,
        },
        zoom: 13,
    };

    render() {

        const position = [this.state.bell.lat, this.state.bell.lng];

        const connectionColors = [
            '#0094e3', '#245CA6', '#731953', '#73142D', '#BF2441'
        ];

        const markerColors = ['marker-blue-1', 'marker-blue-2', 'marker-violet-1', 'marker-violet-2', 'marker-red'];

        return (
            <div className="py-6 w-9/12 flex-shrink mx-6 map__wrapper">
                <MapContainer
                    className="markercluster-map container h-full block rounded shadow-sm"
                    center={[0, 0]}
                    zoom={1}
                    maxZoom={18}
                >
                    <TileLayer
                        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                        attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                    />


                    {/*{this.props.path.map((value, id) =>*/}
                    {/*    (route.onMap === true ? (route.markers.map((marker, index) => (*/}
                    {/*        <MarkerItem route={route.markers} id={index}*/}
                    {/*                    color={markerColors[routeId]} {...marker}/>))) : null)*/}
                    {/*)}*/}

                    {/*{this.props.sampleRoutes.map((route, routeId) =>*/}
                    {/*    (route.onMap === true ? (route.markers.map((marker, index) => <PolylineItem*/}
                    {/*        color={connectionColors[routeId]} coords={route.markers} id={index}/>)) : null)*/}
                    {/*)}*/}

                </MapContainer>
            </div>
        );
    }
}

export default MapWrapper;