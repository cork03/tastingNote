"use client"

import React from "react";
import Producers from "@/components/wine/new/producer/Producers";
import {ViewType} from "@/components/wine/new/CreateNewTasting";
import {Wine} from "@/types/wine";
import {Producer} from "@/types/producer";

interface Props {
    initialProducers: Producer[];
    setWines: React.Dispatch<React.SetStateAction<Wine[]>>;
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    setSelectedProducer: React.Dispatch<React.SetStateAction<Producer>>;
}

const ChoiceProducer = ({initialProducers, setWines, setViewType, setSelectedProducer}: Props) => {
    return (
        <section>
            <h2 className="text-2xl font-bold text-center mb-6">生産者</h2>
            <Producers producers={initialProducers} setWines={setWines} setViewType={setViewType}
                       setSelectedProducer={setSelectedProducer}/>
        </section>
    )
}

export default ChoiceProducer;