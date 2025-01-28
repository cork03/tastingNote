"use client"

import React from "react";
import {WineComment} from "@/types/domain/blindTasting";
import Link from "next/link";

interface Props {
    id: number
    vintage: number
    wineComments: WineComment[]
}

const WineCommentPage = ({id, vintage, wineComments}: Props) => {
    return (
        <div className="space-y-6">
            <div className="text-center mb-8">
                <h2 className="text-3xl font-extrabold text-gray-800 mb-4">
                    テイスティングコメント
                </h2>
            </div>
            <div className="border rounded-lg shadow-lg p-6 bg-gray-100">
                {wineComments.map((wineComment) => {
                    return (
                        <div className="space-y-6">
                            <div className="flex flex-col">
                                <label className="text-lg font-medium text-gray-800 mb-2">色調・外観</label>
                                <p className="text-lg text-gray-700 font-semibold">{wineComment.appearance}</p>
                            </div>
                            <div className="flex flex-col">
                                <label className="text-lg font-medium text-gray-800 mb-2">香り</label>
                                <p className="text-lg text-gray-700 font-semibold">{wineComment.aroma}</p>
                            </div>
                            <div className="flex flex-col">
                                <label className="text-lg font-medium text-gray-800 mb-2">味わい</label>
                                <p className="text-lg text-gray-700 font-semibold">{wineComment.taste}</p>
                            </div>
                            {
                                wineComment.anotherComment && (
                                    <div className="flex flex-col">
                                        <label className="text-lg font-medium text-gray-800 mb-2">その他コメント</label>
                                        <p className="text-lg text-gray-700 font-semibold">{wineComment.anotherComment}</p>
                                    </div>
                                )
                            }
                        </div>
                    )
                })}
            </div>
            <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
                <Link href={`/wine/${id}/vintage/${vintage}/create_comment`}>
                    <button
                        type="button"
                        className="bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                    >
                        コメントを追加する
                    </button>
                </Link>

            </div>
        </div>
    )
}

export default WineCommentPage;