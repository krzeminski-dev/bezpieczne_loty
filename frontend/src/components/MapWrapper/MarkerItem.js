import React from 'react';
import {Marker, Popup} from 'react-leaflet';
import icon from 'leaflet/dist/images/marker-icon.png';
import iconShadow from 'leaflet/dist/images/marker-shadow.png';
import L from 'leaflet';
import './markerColors.css';

const MarkerItem = ({x, y, country, number, color, id, route}) => {
    let customMarker;
    ((id === 0) || (id === route.length-1)) ? 
         customMarker = L.icon({ iconUrl: icon, className: 'main-marker', iconSize: [32,44]}) 
        : customMarker = L.icon({ iconUrl: icon, className: color});
    


    return(
        <Marker position={[x, y]} icon={customMarker}>
            <Popup>
            Nazwa kraju: {country} <br/>
            liczba zachorowań: {number}
           
            </Popup>
        </Marker>
        
        )
        
};
   


export default MarkerItem;