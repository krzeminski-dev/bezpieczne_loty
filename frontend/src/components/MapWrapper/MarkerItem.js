import React from "react";
import { Marker, Popup } from "react-leaflet";
import "./markerColors.css";

const MarkerItem = ({ coords }) => {
  return <Marker position={[coords[0], coords[1]]}></Marker>;
};

export default MarkerItem;
