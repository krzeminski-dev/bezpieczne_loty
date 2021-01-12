import React from 'react';
import {Marker} from 'react-leaflet';

const MarkerItem = ({from}) => (
    <Marker
        position={[from[0], from[1]]}
    >
    </Marker>
);

export default MarkerItem;