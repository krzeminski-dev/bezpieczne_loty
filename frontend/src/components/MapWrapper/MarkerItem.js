import React from 'react';
import {Marker, Popup} from 'react-leaflet';

const MarkerItem = ({x, y, country, number}) => (
    <Marker
        // position={[from[0], from[1]]}
        position={[x, y]}
    >
        <Popup>
        Nazwa kraju: {country} <br/>
        liczba zachorowań: {number}
        </Popup>
    </Marker>
);

export default MarkerItem;