"use client"

import ChoiceProducer from "@/components/wine/new/producer/ChoiceProducer";
import ChoiceWine from "@/components/wine/new/wine/ChoiceWine";
import {useState} from "react";
import {Wine} from "@/types/wine";
import {Producer} from "@/types/producer";

interface Props {
    initialProducers: Producer[];
}

export type ViewType = 1 | 2 | 3;


const CreateNewTasting = ({initialProducers}: Props) => {
    const [wines, setWines] = useState<Wine[]>([]);
    const [selectedProducer, setSelectedProducer] = useState<Producer | null>(null);
    const [viewType, setViewType] = useState<ViewType>(1);
    return (
        <section>
            {viewType === 1 &&
                <ChoiceProducer
                    initialProducers={initialProducers}
                    setWines={setWines}
                    setViewType={setViewType}
                    setSelectedProducer={setSelectedProducer}
                />}
            {viewType === 2 &&
                <ChoiceWine
                    wines={wines}
                    setViewType={setViewType}
                    selectedProducer={selectedProducer}
                    setWines={setWines}
                />}
        </section>
    )
}

export default CreateNewTasting;