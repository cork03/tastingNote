"use client"

import {Producer, Wine} from "@/app/wine/new/page";
import {useState} from "react";
import CreateProducer from "@/components/wine/new/producer/CreateProducer";
import Producers from "@/components/wine/new/producer/Producers";

interface Props {
    initialProducers: Producer[];
    bindWines: (wines: Wine[]) => void;
    changeViewType: (viewType: number) => void;
}

const ChoiceProducer = ({initialProducers, bindWines, changeViewType}: Props) => {
    const [producers, setProducers] = useState<Producer[]>(initialProducers);
    const [isViewMode, setIsViewMode] = useState<boolean>(true);
    return (
        <section>
            <h2 className="text-2xl font-bold text-center mb-6">生産者</h2>
            {isViewMode && <Producers producers={producers} bindWines={bindWines} changeViewType={changeViewType}
                                      setIsViewMode={setIsViewMode}/>}
            {!isViewMode && <CreateProducer setProducers={setProducers} setIsViewMode={setIsViewMode}/>}
        </section>
    )
}

export default ChoiceProducer;