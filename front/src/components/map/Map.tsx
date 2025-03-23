'use client'
import React, {useCallback} from "react";
import dynamic from "next/dynamic";

import {icon} from "leaflet"

const ICON = icon({
    iconUrl: "/marker-icon.png",
    iconSize: [25, 41],
})
import markerIcon from "leaflet/dist/images/marker-icon.png";

const MapContainer = dynamic(
    () => import('react-leaflet').then(mod => mod.MapContainer),
    {ssr: false}
);
const TileLayer = dynamic(
    () => import('react-leaflet').then(mod => mod.TileLayer),
    {ssr: false}
);
const Marker = dynamic(
    () => import('react-leaflet').then(mod => mod.Marker),
    {ssr: false}
);
const Popup = dynamic(
    () => import('react-leaflet').then(mod => mod.Popup),
    {ssr: false}
);

const Map = () => {
    const [view, setView] = React.useState(false);
    const changeView = useCallback(() => {
        setView((view) => !view);
    }, []);
    return (
        <MapContainer
            center={[41.9335, 12.5858]}
            zoom={7}
            scrollWheelZoom={false}
            style={{height: "100vh", width: "100%"}}
        >
            <TileLayer
                attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            />
            <Marker position={[41.9335, 12.5858]} icon={ICON}>
                <Popup>
                    {
                        view ?
                            <div onClick={changeView}>
                                <p>ワイン名</p>
                            </div>
                            :
                            <div onClick={changeView}>
                                <h2>ワイン名</h2>
                                <p>生産者</p>
                            </div>
                    }
                </Popup>
            </Marker>
        </MapContainer>
    )
}

export default Map;