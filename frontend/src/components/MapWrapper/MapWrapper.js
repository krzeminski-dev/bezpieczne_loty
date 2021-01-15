import React, {Component} from 'react';
import L from 'leaflet';
import {MapContainer, TileLayer, Polyline} from 'react-leaflet';
import './MapWrapper.css';
import icon from 'leaflet/dist/images/marker-icon.png';
import iconShadow from 'leaflet/dist/images/marker-shadow.png';
import MarkerItem from "./MarkerItem";
import PolylineItem from "./PolylineItem";

let DefaultIcon = L.icon({
    iconUrl: icon,
    shadowUrl: iconShadow,
});

L.Marker.prototype.options.icon = DefaultIcon;

class MapWrapper extends Component{

    state = {
        bell: {
            lat: 51.505,
            lng: -0.09,
        },
        zoom: 13,
      };

    render(){
       const position = [this.state.bell.lat, this.state.bell.lng];

        return(
            <div className="py-6 w-9/12 flex-shrink mx-6 map__wrapper">
                <MapContainer 
                className="markercluster-map container h-full block rounded shadow-sm"
                center={[0,0]}
                zoom={1}
                maxZoom={18}
                >
                    <TileLayer
                    url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                    />
                    {/* @todo: connection between markers */}
                        {/* almost done */}
                            

                    {this.props.route.map(item => (
                        <MarkerItem {...item}/>
                    ))}


                    {this.props.route.map((connection, index) => (
                        <PolylineItem coords={this.props.route} id={index}/>
                    ))}
                        
                          
                  


                </MapContainer>
            </div>
        );
    }
}

export default MapWrapper;