import React from 'react';
import {Polyline} from 'react-leaflet';

const PolylineItem = ({coords,id}) => ( //x2, y2
    (id !== coords.length-1) ? 
    (<Polyline 
        positions={[[coords[id].x, coords[id].y], [coords[id+1].x, coords[id+1].y]]} 
        color={'#0094e3'} 
        weight={'2'}
        dashArray={'5, 5'}/>)
    :
    (<Polyline 
        positions={[[coords[id].x, coords[id].y], [coords[id].x, coords[id].y]]} 
        color={'#0094e3'} 
        weight={'2'}
        dashArray={'5, 5'}/>)

);

export default PolylineItem;

//musze miec dostep do kolejnego indexu