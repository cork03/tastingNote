import React from "react";
import {WineVintageFullInfo} from "@/types/wine";
import WineCommentPage from "@/components/wine/[id]/vintage/[vintage]/WineComment";
import {TastingComment} from "@/types/domain/blindTasting";

const WineVintageDetailPage = async ({params}: { params: { id: number, vintage: number } }) => {
    const {id, vintage} = await params;
    const data = await fetch(`${process.env.API_URL}/wine/${id}/vintage/${vintage}`);
    const initialWineVintage: WineVintageFullInfo = await data.json();
    const commentData = await fetch(`${process.env.API_URL}/wine-vintage/${initialWineVintage.id}/wine-comments`);
    const initialTastingComments: TastingComment[] = await commentData.json();
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <div className="text-center mb-8">
                <h2 className="text-3xl font-extrabold text-gray-800 mb-4">
                    {initialWineVintage.wine.name}:{initialWineVintage.vintage}年
                </h2>
            </div>
            <section className="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                <div className="space-y-6">
                    <div className="space-y-6">
                        <div className="gap-6 justify-center">
                            <div className="border rounded-lg shadow-lg p-6 flex items-center bg-gray-100">
                                <img
                                    src={initialWineVintage.imagePath ?? '/images/wine.jpg'}
                                    alt="画像"
                                    className="h-128 object-cover rounded-lg border border-gray-300 shadow-md mr-6"
                                />
                                <div className="space-y-6">
                                    <div className="flex items-center">
                                        <label className="text-lg font-medium text-gray-800 w-40">生産地</label>
                                        <p className="text-lg text-gray-700 font-semibold">{initialWineVintage.wine.country.name}</p>
                                    </div>
                                    <div className="flex items-center">
                                        <label className="text-lg font-medium text-gray-800 w-40">生産者</label>
                                        <p className="text-lg text-gray-700 font-semibold">{initialWineVintage.producer.name}</p>
                                    </div>
                                    <div className="flex items-start">
                                        <label className="text-lg font-medium text-gray-800 w-40">葡萄品種</label>
                                        <p className="text-lg text-gray-700 font-semibold">
                                            {initialWineVintage.wineBlend.map((wineVariety, index) => {
                                                if (index === initialWineVintage.wineBlend.length - 1) {
                                                    return wineVariety.name + ':' + wineVariety.percentage + '%';
                                                }
                                                return wineVariety.name + ':' + wineVariety.percentage + '%, ';
                                            })}
                                        </p>
                                    </div>
                                    <div className="flex items-center">
                                        <label className="text-lg font-medium text-gray-800 w-40">アルコール度数</label>
                                        <p className="text-lg text-gray-700 font-semibold">{initialWineVintage.alcoholContent}%</p>
                                    </div>
                                    <div className="flex items-center">
                                        <label className="text-lg font-medium text-gray-800 w-40">熟成方法</label>
                                        <p className="text-lg text-gray-700 font-semibold">{initialWineVintage.agingMethod}</p>
                                    </div>
                                    <div className="flex items-center">
                                        <label className="text-lg font-medium text-gray-800 w-40">価格</label>
                                        <p className="text-lg text-gray-700 font-semibold">¥{initialWineVintage.price}</p>
                                    </div>
                                    {initialWineVintage.technicalComment && (
                                        <div className="flex items-start">
                                            <label
                                                className="text-lg font-medium text-gray-800 w-40">技術的コメント</label>
                                            <p className="text-lg text-gray-700 font-semibold">
                                                {initialWineVintage.technicalComment}
                                            </p>
                                        </div>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                    <WineCommentPage tastingComments={initialTastingComments} id={id} vintage={vintage}/>
                </div>
            </section>
        </main>
    );
};

export default WineVintageDetailPage;