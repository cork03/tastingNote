import React from "react";
import {TastingComment} from "@/types/domain/blindTasting";
import Link from "next/link";
import {default as ParagraphSide} from "@/components/utils/view/side/paragraph";
import {getWineVarietiesTextDomain} from "@/utils/utils";
import NormalButton from "@/components/utils/view/button/NormalButton";
import Paragraph from "@/components/utils/view/vertical/paragraph";

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
                        <Link href={`/wine-comment/${tastingComment.wineComment.id}/edit`}>
                            <div
                                className="border rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 bg-gray-100 space-y-6">
                                <Paragraph label={"色調・外観"} text={tastingComment.wineComment.appearance}/>
                                <Paragraph label={"香り"} text={tastingComment.wineComment.aroma}/>
                                <Paragraph label={"味わい"} text={tastingComment.wineComment.taste}/>
                                {tastingComment.wineComment.anotherComment && (
                                    <Paragraph label={"その他コメント"}
                                               text={tastingComment.wineComment.anotherComment}/>
                                )}
                            </div>
                        </Link>
                        {tastingComment.blindTastingAnswer && (
                            <div
                                className="border rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 bg-gray-100">
                                <div className="flex flex-col">
                                    <div className="text-center">
                                        <h3 className="text-2xl font-extrabold text-gray-800 mb-4">ブラインドテイスティングの回答</h3>
                                    </div>
                                    <div className="space-y-6">
                                        <ParagraphSide label={"生産地"}
                                                       text={tastingComment.blindTastingAnswer.country.name}/>
                                        <ParagraphSide label={"葡萄品種"}
                                                       text={getWineVarietiesTextDomain(tastingComment.blindTastingAnswer.wineBlend)}/>
                                        <ParagraphSide label={"ヴィンテージ"}
                                                       text={tastingComment.blindTastingAnswer.vintage + '年'}/>
                                        <ParagraphSide label={"価格"}
                                                       text={'¥' + tastingComment.blindTastingAnswer.price}/>
                                        <ParagraphSide label={"アルコール度数"}
                                                       text={tastingComment.blindTastingAnswer.alcoholContent + '%'}/>
                                        {tastingComment.blindTastingAnswer.anotherComment && (
                                            <ParagraphSide label={"その他コメント"}
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