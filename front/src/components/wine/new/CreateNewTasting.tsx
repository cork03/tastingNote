"use client"

import {Producer, Wine} from "@/app/wine/new/page";
import ChoiceProducer from "@/components/wine/new/producer/ChoiceProducer";
import ChoiceWine from "@/components/wine/new/wine/ChoiceWine";
import {useState} from "react";

interface Props {
    initialProducers: Producer[];
}


const CreateNewTasting = ({initialProducers}: Props) => {
    const [wines, setWines] = useState<Wine[]>([]);
    const [viewType, setViewType] = useState<number>(1);
    return (
        <section>
            {viewType === 1 &&
                <ChoiceProducer initialProducers={initialProducers} setWines={setWines} setViewType={setViewType}/>}
            {viewType === 2 && <ChoiceWine wines={wines} setViewType={setViewType}/>}
        </section>
    )
}

export default CreateNewTasting;