"use client"

import React from "react";
import {TastingComment} from "@/types/domain/blindTasting";
import Link from "next/link";

interface Props {
    id: number
    vintage: number
    tastingComments: TastingComment[]
}

const WineCommentPage = ({id, vintage, tastingComments}: Props) => {
    return (
        <div className="space-y-6">
            <div className="text-center mb-8">
                <h2 className="text-3xl font-extrabold text-gray-800 mb-4">
                    テイスティングコメント
                </h2>
            </div>
            {tastingComments.map((tastingComment) => {
                return (
                    <div className="space-y-6" key={tastingComment.wineComment.id}>
                        <div
                            className="border rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 bg-gray-100">
                            <div className="flex flex-col mb-4">
                                <label className="text-lg font-medium text-gray-800 mb-2">色調・外観</label>
                                <p className="text-lg text-gray-700 font-semibold">{tastingComment.wineComment.appearance}</p>
                            </div>
                            <div className="flex flex-col mb-4">
                                <label className="text-lg font-medium text-gray-800 mb-2">香り</label>
                                <p className="text-lg text-gray-700 font-semibold">{tastingComment.wineComment.aroma}</p>
                            </div>
                            <div className="flex flex-col mb-4">
                                <label className="text-lg font-medium text-gray-800 mb-2">味わい</label>
                                <p className="text-lg text-gray-700 font-semibold">{tastingComment.wineComment.taste}</p>
                            </div>
                            {tastingComment.wineComment.anotherComment && (
                                <div className="flex flex-col">
                                    <label className="text-lg font-medium text-gray-800 mb-2">その他コメント</label>
                                    <p className="text-lg text-gray-700 font-semibold">{tastingComment.wineComment.anotherComment}</p>
                                </div>
                            )}
                        </div>
                        <div
                            className="border rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 bg-gray-100">
                            {tastingComment.blindTastingAnswer && (
                                <div className="flex flex-col">
                                    <div className="text-center">
                                        <h3 className="text-2xl font-extrabold text-gray-800 mb-4">ブラインドテイスティングの回答</h3>
                                    </div>
                                    <div className="space-y-6">
                                        <div className="flex items-center">
                                            <label className="text-lg font-medium text-gray-800 w-40">生産地</label>
                                            <p className="text-lg text-gray-700 font-semibold">{tastingComment.blindTastingAnswer.country.name}</p>
                                        </div>
                                        <div className="flex items-center">
                                            <label className="text-lg font-medium text-gray-800 w-40">葡萄品種</label>
                                            <p className="text-lg text-gray-700 font-semibold">{tastingComment.blindTastingAnswer.wineBlend.map((wineVariety, index) => {
                                                // @ts-ignore
                                                if (index === tastingComment.blindTastingAnswer.wineBlend.length - 1) {
                                                    return wineVariety.name + ':' + wineVariety.percentage + '%';
                                                }
                                                return wineVariety.name + ':' + wineVariety.percentage + '%, ';
                                            })}</p>
                                        </div>
                                        <div className="flex items-center">
                                            <label className="text-lg font-medium text-gray-800 w-40">ヴィンテージ</label>
                                            <p className="text-lg text-gray-700 font-semibold">{tastingComment.blindTastingAnswer.vintage}年</p>
                                        </div>
                                        <div className="flex items-center">
                                            <label className="text-lg font-medium text-gray-800 w-40">価格</label>
                                            <p className="text-lg text-gray-700 font-semibold">¥{tastingComment.blindTastingAnswer.price}</p>
                                        </div>
                                        <div className="flex items-center">
                                            <label className="text-lg font-medium text-gray-800 w-40">アルコール度数</label>
                                            <p className="text-lg text-gray-700 font-semibold">{tastingComment.blindTastingAnswer.alcoholContent}%</p>
                                        </div>
                                        {tastingComment.blindTastingAnswer.anotherComment && (
                                            <div className="flex items-center">
                                                <label
                                                    className="text-lg font-medium text-gray-800 w-40">その他コメント</label>
                                                <p className="text-lg text-gray-700 font-semibold">{tastingComment.blindTastingAnswer.anotherComment}</p>
                                            </div>
                                        )}
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                );
            })}
            <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
            <Link href={`/wine/${id}/vintage/${vintage}/create-comment`}>
                <button
                        type="button"
                        className="bg-gray-700 text-white py-2 px-4 rounded-lg hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400 transition-all duration-300"
                    >
                        コメントを追加する
                    </button>
                </Link>
            </div>
        </div>

    )
}

export default WineCommentPage;