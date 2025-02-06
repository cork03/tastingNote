"use client"

import React from "react";
import ProducerDetail from "@/components/wine/new/producer/ProducerDetail";
import {ViewType} from "@/components/wine/new/CreateNewTasting";
import {Wine} from "@/types/wine";
import {Producer} from "@/types/producer";
import Grid from "@/components/utils/view/grid";

type Props = {
    producers: Producer[];
    setWines: React.Dispatch<React.SetStateAction<Wine[]>>;
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    setSelectedProducer: React.Dispatch<React.SetStateAction<Producer>>;
};

const Producers = ({producers, setWines, setViewType, setSelectedProducer}: Props) => {
    return (
        <Grid>
            {producers.map((producer) => {
                return <ProducerDetail key={producer.id} producer={producer} setWines={setWines}
                                       setViewType={setViewType} setSelectedProducer={setSelectedProducer}/>
            })}
        </Grid>
    )
}

export default Producers;