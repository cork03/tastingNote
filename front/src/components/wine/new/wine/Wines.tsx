import React from "react";
import WineDetail from "@/components/wine/new/wine/WineDetail";
import {ViewType} from "@/components/wine/new/CreateNewTasting";
import {Wine} from "@/types/wine";
import {Producer} from "@/types/producer";
import {redirect} from "next/navigation";

interface Props {
    wines: Wine[];
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    producer: Producer;
}

const Wines = ({wines, setViewType,  producer}: Props) => {
    return (
        <div>
            <div className="mb-8 flex flex-row justify-center items-center gap-x-4 mx-auto">
                <input
                    type="text"
                    placeholder="ワインを検索"
                    className="w-full max-w-md p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                />
                <button
                    type="submit"
                    className="bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                    onClick={() => {redirect(`/producer/${producer.id}/wine/create`)}}
                >
                    新しいワインを登録
                </button>
            </div>
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {wines.map((wine) => {
                    return <WineDetail key={wine.id} wine={wine}/>
                })}
            </div>
            <div className="text-center mt-4">
                <button
                    type="submit"
                    className="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700 focus:outline-none focus:ring focus:bg-gray-400"
                    onClick={() => setViewType(1)}
                >
                    戻る
                </button>
            </div>
        </div>
    )
}

export default Wines;