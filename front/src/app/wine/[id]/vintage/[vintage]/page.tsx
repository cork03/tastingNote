import Link from "next/link";
import React from "react";
import {WineVintageFullInfo} from "@/types/wine";

const WineVintageDetailPage = async ({params}: { params: { id: string, vintage: number } }) => {
    const {id, vintage} = await params;
    const data = await fetch(`${process.env.API_URL}/wine/${id}/vintage/${vintage}`);
    const initialWineVintage: WineVintageFullInfo = await data.json();
    console.log(initialWineVintage);
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <section>
                <div className="text-center mb-8">
                    <h2 className="text-2xl font-bold mb-4">{initialWineVintage.wine.name}:{initialWineVintage.vintage}</h2>
                </div>
                <div>
                    <div className="gap-6 justify-center">
                        <div className="border rounded shadow p-4 flex items-center">
                            <img
                                src="/images/wine.jpg"
                                alt="画像"
                                className="w-256 h-256 object-cover rounded mr-4"
                            />
                            <div className="space-y-4">
                                <div className="flex items-center">
                                    <label className="text-xl w-64">生産地</label>
                                    <p className="text-xl text-gray-600">{initialWineVintage.wine.country.name}</p>
                                </div>
                                <div className="flex items-center">
                                    <label className="text-xl w-64">生産者</label>
                                    <p className="text-xl text-gray-600">{initialWineVintage.producer.name}</p>
                                </div>
                                <div className="flex items-center">
                                    <label className="text-xl w-64">葡萄品種</label>
                                    <p className="text-xl text-gray-600">{initialWineVintage.wineBlend.map((wineVariety, index) => {
                                        if (index === initialWineVintage.wineBlend.length - 1) {
                                            return wineVariety.name + ':' + wineVariety.percentage + '%';
                                        }
                                        return wineVariety.name + ':' + wineVariety.percentage + '%, ';
                                    })}</p>
                                </div>
                                <div className="flex items-center">
                                    <label className="text-xl w-64">アルコール度数</label>
                                    <p className="text-xl text-gray-600">{initialWineVintage.alcoholContent}</p>
                                </div>

                                <div className="flex items-center">
                                    <label className="text-xl w-64">熟成方法</label>
                                    <p className="text-xl text-gray-600">{initialWineVintage.agingMethod}</p>
                                </div>
                                <div className="flex items-center">
                                    <label className="text-xl w-64">価格</label>
                                    <p className="text-xl text-gray-600">{initialWineVintage.price}</p>
                                </div>
                                {initialWineVintage.technicalComment && (
                                    <div className="flex items-center">
                                        <label className="text-xl w-64">技術的コメント</label>
                                        <p className="text-xl text-gray-600">{initialWineVintage.technicalComment}</p>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </main>
    );
};

export default WineVintageDetailPage;