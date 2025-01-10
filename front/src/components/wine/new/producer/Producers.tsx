"use client"

import {Producer, Wine} from "@/app/wine/new/page";
import {useState} from "react";
import ProducerDetail from "@/components/wine/new/producer/ProducerDetail";
import CreateProducer from "@/components/wine/new/producer/CreateProducer";
import wines from "@/components/wine/new/wine/Wines";

interface Props {
    initialProducers: Producer[];
    bindWines: (wines: Wine[]) => void;
    changeViewType: (viewType: number) => void;
}

const Producers = ({initialProducers, bindWines, changeViewType}: Props) => {
    const [producers, setProducers] = useState<Producer[]>(initialProducers);
    const reGetProducers = (newProducers: Producer[]) => {
        setProducers(newProducers);
    }
    return (
        <section>
            {/* タイトル */}
            <h2 className="text-2xl font-bold text-center mb-6">生産者</h2>
            {/* 検索窓 */}
            <div className="mb-8">
                <input
                    type="text"
                    placeholder="生産者を検索"
                    className="w-full max-w-md mx-auto block p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                />
            </div>
            {/* 生産者一覧 */}
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {producers.map((producer) => {
                    return <ProducerDetail key={producer.id} producer={producer} bindWines={bindWines}
                                           changeViewType={changeViewType}/>
                })}
            </div>
            {/* 生産者作成フォーム */}
            <CreateProducer reGetProducers={reGetProducers}/>
        </section>
    )
}

export default Producers;