"use client"

import {Producer, Wine} from "@/app/wine/new/page";
import React, {useState} from "react";
import Wines from "@/components/wine/new/wine/Wines";
import CreateWine from "@/components/wine/new/wine/CreateWIne";
import {ViewType} from "@/components/wine/new/CreateNewTasting";

interface Props {
    wines: Wine[]
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    selectedProducer: Producer | null;
    setWines: React.Dispatch<React.SetStateAction<Wine[]>>;
}

const ChoiceWine = ({wines, setViewType, selectedProducer, setWines}: Props) => {
    const [isViewMode, setIsViewMode] = useState(true);
    return (
        <section>
            {/* タイトル */}
            <h2 className="text-2xl font-bold text-center mb-6">ワイン</h2>
            {isViewMode && <Wines wines={wines} setViewType={setViewType} setIsViewMode={setIsViewMode}/>}
            {!isViewMode && <CreateWine setIsViewMode={setIsViewMode} selectedProducer={selectedProducer} setWines={setWines}/>}
        </section>
    )
}

export default ChoiceWine;