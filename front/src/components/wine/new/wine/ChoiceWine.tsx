"use client"

import {Producer, Wine} from "@/app/wine/new/page";
import React, {useState} from "react";
import ProducerDetail from "@/components/wine/new/producer/ProducerDetail";
import CreateProducer from "@/components/wine/new/producer/CreateProducer";
import WineDetail from "@/components/wine/new/wine/WineDetail";
import Wines from "@/components/wine/new/wine/Wines";

interface Props {
    wines: Wine[]
    setViewType: React.Dispatch<React.SetStateAction<number>>;
}

const ChoiceWine = ({wines, setViewType}: Props) => {
    return (
        <section>
            {/* タイトル */}
            <h2 className="text-2xl font-bold text-center mb-6">ワイン</h2>
            <Wines wines={wines} setViewType={setViewType}/>
            {/*/!* 生産者作成フォーム *!/*/}
            {/*<CreateProducer reGetProducers={reGetProducers}/>*/}
        </section>
    )
}

export default ChoiceWine;