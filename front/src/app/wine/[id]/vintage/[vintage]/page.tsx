import React from "react";
import {WineVintageFullInfo} from "@/types/wine";
import WineCommentPage from "@/components/wine/[id]/vintage/[vintage]/WineComment";
import {TastingComment} from "@/types/domain/blindTasting";
import Title from "@/components/utils/view/title";
import Paragraph from "@/components/utils/view/side/paragraph";
import {getWineVarietiesTextOld} from "@/utils/utils";
import NormalButton from "@/components/utils/view/button/NormalButton";
import Link from "next/link";

const WineVintageDetailPage = async ({params}: { params: { id: number, vintage: number } }) => {
    const {id, vintage} = await params;
    const data = await fetch(`${process.env.API_URL}/wine/${id}/vintage/${vintage}`);
    const initialWineVintage: WineVintageFullInfo = await data.json();
    const commentData = await fetch(`${process.env.API_URL}/wine-vintage/${initialWineVintage.id}/wine-comments`);
    const initialTastingComments: TastingComment[] = await commentData.json();

    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <Title title={`${initialWineVintage.wine.name}:${initialWineVintage.vintage}年`}/>
            <section className="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                <div className="space-y-6">
                    <div className="gap-6 justify-center space-y-6">
                        <div className="border rounded-lg shadow-lg p-6 flex items-center bg-gray-100">
                            <img
                                src={initialWineVintage.imagePath ?? '/images/wine.jpg'}
                                alt="画像"
                                className="w-64 object-cover rounded-lg border border-gray-300 shadow-md mr-6"
                            />
                            <div className="space-y-6">
                                <Paragraph label={"生産地"} text={initialWineVintage.wine.country.name}/>
                                <Paragraph label={"生産者"} text={initialWineVintage.producer.name}/>
                                <Paragraph label={"葡萄品種"}
                                           text={getWineVarietiesTextOld(initialWineVintage.wineBlend)}/>
                                <Paragraph label={"アルコール度数"} text={initialWineVintage.alcoholContent + '%'}/>
                                <Paragraph label={"熟成方法"} text={initialWineVintage.agingMethod}/>
                                <Paragraph label={"価格"} text={'¥' + String(initialWineVintage.price)}/>
                                {initialWineVintage.technicalComment && (
                                    <Paragraph label={"技術的コメント"} text={initialWineVintage.technicalComment}/>
                                )}
                            </div>
                        </div>
                        <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
                            <Link href={`/wine-vintage/${initialWineVintage.id}/edit`}>
                                <NormalButton text={"ワイン情報を編集"}/>
                            </Link>
                        </div>
                    </div>
                    <WineCommentPage tastingComments={initialTastingComments} id={id} vintage={vintage}/>
                </div>
            </section>
        </main>
    );
};

export default WineVintageDetailPage;