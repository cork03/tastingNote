import React from "react";
import {TastingComment} from "@/types/domain/blindTasting";
import Link from "next/link";
import Paragraph from "@/components/utils/view/side/paragraph";
import {getWineVarietiesText, getWineVarietiesTextDomain} from "@/utils/utils";
import NormalButton from "@/components/utils/view/button/NormalButton";

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
                        {tastingComment.blindTastingAnswer && (
                            <div
                                className="border rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 bg-gray-100">
                                <div className="flex flex-col">
                                    <div className="text-center">
                                        <h3 className="text-2xl font-extrabold text-gray-800 mb-4">ブラインドテイスティングの回答</h3>
                                    </div>
                                    <div className="space-y-6">
                                        <Paragraph label={"生産地"}
                                                   text={tastingComment.blindTastingAnswer.country.name}/>
                                        <Paragraph label={"葡萄品種"}
                                                   text={getWineVarietiesTextDomain(tastingComment.blindTastingAnswer.wineBlend)}/>
                                        <Paragraph label={"ヴィンテージ"}
                                                   text={tastingComment.blindTastingAnswer.vintage + '年'}/>
                                        <Paragraph label={"価格"} text={'¥' + tastingComment.blindTastingAnswer.price}/>
                                        <Paragraph label={"アルコール度数"}
                                                   text={tastingComment.blindTastingAnswer.alcoholContent + '%'}/>
                                        {tastingComment.blindTastingAnswer.anotherComment && (
                                            <Paragraph label={"その他コメント"}
                                                       text={tastingComment.blindTastingAnswer.anotherComment}/>
                                        )}
                                    </div>
                                </div>
                            </div>
                        )}
                    </div>
                );
            })}
            <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
                <Link href={`/wine/${id}/vintage/${vintage}/create-comment`}>
                    <NormalButton text={"コメントを追加する"}/>
                </Link>
            </div>
        </div>

    )
}

export default WineCommentPage;