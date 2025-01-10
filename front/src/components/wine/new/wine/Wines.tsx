"use client"

import {Producer, Wine} from "@/app/wine/new/page";
import {useState} from "react";
import ProducerDetail from "@/components/wine/new/producer/ProducerDetail";
import CreateProducer from "@/components/wine/new/producer/CreateProducer";
import WineDetail from "@/components/wine/new/wine/WineDetail";

interface Props {
    wines: Wine[]
}

const Wines = ({wines}: Props) => {
    return (
        <section>
            {/* タイトル */}
            <h2 className="text-2xl font-bold text-center mb-6">ワイン</h2>
            {/* 検索窓 */}
            <div className="mb-8">
                <input
                    type="text"
                    placeholder="ワインを検索"
                    className="w-full max-w-md mx-auto block p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                />
            </div>
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {wines.map((wine) => {
                    return <WineDetail key={wine.id} wine={wine}/>
                })}
            </div>
            {/*/!* 生産者作成フォーム *!/*/}
            {/*<CreateProducer reGetProducers={reGetProducers}/>*/}
        </section>
    )
}

export default Wines;