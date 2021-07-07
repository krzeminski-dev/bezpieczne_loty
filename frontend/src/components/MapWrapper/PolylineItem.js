import React from "react";
import { Polyline } from "react-leaflet";

const PolylineItem = ({ route, id }) =>
  id !== route.length - 1 ? (
    <Polyline
      positions={[
        [route[id].latitude, route[id].longitude],
        [route[id + 1].latitude, route[id + 1].longitude],
      ]}
      color={"#0094e3"}
      weight={"2"}
      dashArray={"5, 5"}
    />
  ) : (
    <Polyline
      positions={[
        [route[id].latitude, route[id].longitude],
        [route[id].latitude, route[id].longitude],
      ]}
      color={"#0094e3"}
      weight={"2"}
      dashArray={"5, 5"}
    />
  );

export default PolylineItem;
