"use client"

import React from "react";
import {WineComment} from "@/types/domain/blindTasting";
import {createBlindTasting} from "@/repository/blindTastingRepository";

interface Props {
    wineComment: WineComment
    setWineComment: React.Dispatch<React.SetStateAction<WineComment>>
}

const WineCommentPage = ({wineComment, setWineComment}: Props) => {
    const handleChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
        setWineComment({...wineComment, [e.target.name]: e.target.value});
    }
    return (
        <div className="space-y-6">
            <div className="text-center mb-8">
                <h2 className="text-3xl font-extrabold text-gray-800 mb-4">
                    コメント
                </h2>
            </div>
            <div className="border rounded-lg shadow-lg p-6 bg-gray-100">
                <div className="space-y-6">
                    <div className="flex flex-col">
                        <label className="text-lg font-medium text-gray-800 mb-2">色調・外観</label>
                        <textarea
                            name={"appearance"}
                            value={wineComment.appearance}
                            placeholder="ガーネット色"
                            rows={4}
                            onChange={handleChange}
                            className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                        ></textarea>
                    </div>
                    <div className="flex flex-col">
                        <label className="text-lg font-medium text-gray-800 mb-2">香り</label>
                        <textarea
                            name={"aroma"}
                            value={wineComment.aroma}
                            placeholder="黒系も赤系もある中庸な香り"
                            rows={4}
                            onChange={handleChange}
                            className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                        ></textarea>
                    </div>
                    <div className="flex flex-col">
                        <label className="text-lg font-medium text-gray-800 mb-2">味わい</label>
                        <textarea
                            name={"taste"}
                            value={wineComment.taste}
                            placeholder="酸味が強く、タンニンは穏やか"
                            rows={4}
                            onChange={handleChange}
                            className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                        ></textarea>
                    </div>
                    <div className="flex flex-col">
                        <label className="text-lg font-medium text-gray-800 mb-2">その他コメント</label>
                        <textarea
                            name={"anotherComment"}
                            value={wineComment.anotherComment || ""}
                            placeholder="新樽比率の高いピノノワールに似ている"
                            rows={4}
                            onChange={handleChange}
                            className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                        ></textarea>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default WineCommentPage;