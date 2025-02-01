"use client"

import React from "react";
import ProducerDetail from "@/components/wine/new/producer/ProducerDetail";
import {ViewType} from "@/components/wine/new/CreateNewTasting";
import {Wine} from "@/types/wine";
import {Producer} from "@/types/producer";
import {redirect} from "next/navigation";

type Props = {
    producers: Producer[];
    setWines: React.Dispatch<React.SetStateAction<Wine[]>>;
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    setSelectedProducer: React.Dispatch<React.SetStateAction<Producer | null>>;
};

const Producers = ({producers, setWines, setViewType,setSelectedProducer}: Props) => {
    const goToCreateProducer = () => {
        redirect('/producer/create');
    }
    return (
        <div>
            <div className="mb-8 flex flex-row justify-center items-center gap-x-4 mx-auto">
                <input
                    type="text"
                    placeholder="生産者を検索"
                    className="w-full max-w-md p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                />
                <button
                    type="submit"
                    className="bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                    onClick={goToCreateProducer}
                >
                    新しい生産者を登録
                </button>
            </div>
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {producers.map((producer) => {
                    return <ProducerDetail key={producer.id} producer={producer} setWines={setWines}
                                           setViewType={setViewType} setSelectedProducer={setSelectedProducer}/>
                })}
            </div>
        </div>
    )
}

export default Producers;