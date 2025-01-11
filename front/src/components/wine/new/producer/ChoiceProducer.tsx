"use client"

import {Producer, Wine} from "@/app/wine/new/page";
import React, {useState} from "react";
import CreateProducer from "@/components/wine/new/producer/CreateProducer";
import Producers from "@/components/wine/new/producer/Producers";

interface Props {
    initialProducers: Producer[];
    setWines: React.Dispatch<React.SetStateAction<Wine[]>>;
    setViewType: React.Dispatch<React.SetStateAction<number>>;
    setSelectedProducer: React.Dispatch<React.SetStateAction<Producer | null>>;
}

const ChoiceProducer = ({initialProducers, setWines, setViewType, setSelectedProducer}: Props) => {
    const [producers, setProducers] = useState<Producer[]>(initialProducers);
    const [isViewMode, setIsViewMode] = useState<boolean>(true);
    return (
        <section>
            <h2 className="text-2xl font-bold text-center mb-6">生産者</h2>
            {isViewMode && <Producers producers={producers} setWines={setWines} setViewType={setViewType}
                                      setIsViewMode={setIsViewMode} setSelectedProducer = {setSelectedProducer}/>}
            {!isViewMode && <CreateProducer setProducers={setProducers} setIsViewMode={setIsViewMode}/>}
        </section>
    )
}

export default ChoiceProducer;