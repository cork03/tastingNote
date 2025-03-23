import React from "react";
import Main from "@/components/utils/view/main";
import Title from "@/components/utils/view/title";
import Map from "@/components/map/Map";

const MapPage = async () => {
    return (
        <Main>
            <Title title={"マップ"}/>
            <Map/>
        </Main>
    );
};

export default MapPage;