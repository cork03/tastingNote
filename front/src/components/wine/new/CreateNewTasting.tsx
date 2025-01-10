"use client"

import {Producer, Wine} from "@/app/wine/new/page";
import Producers from "@/components/wine/new/producer/Producers";
import Wines from "@/components/wine/new/wine/Wines";
import {useState} from "react";

interface Props {
    initialProducers: Producer[];
}


const CreateNewTasting = ({initialProducers}: Props) => {
    const [wines, setWines] = useState<Wine[]>([]);
    const [viewType, setViewType] = useState<number>(1);
    const bindWines = (wines: Wine[]) => {
        setWines(wines);
    }
    const changeViewType = (viewType: number) => {
        setViewType(viewType);
    }
    return (
        <section>
            {viewType === 1 &&
                <Producers initialProducers={initialProducers} bindWines={bindWines} changeViewType={changeViewType}/>}
            {viewType === 2 && <Wines wines={wines} changeViewType={changeViewType}/>}
        </section>
    )
}

export default CreateNewTasting;