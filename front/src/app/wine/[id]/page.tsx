import Link from "next/link";
import React from "react";
import {WineFullInfo} from "@/types/wine";


const WineDetailPage = async ({params}: {params: {id: number}}) => {
    const data = await fetch(`${process.env.API_URL}/wine/${params.id}`);
    const initialWineFullInfo: WineFullInfo = await data.json();
    console.log(initialWineFullInfo);
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <section>
                <div className="text-center mb-8">
                    <h2 className="text-2xl font-bold mb-4">{initialWineFullInfo.name}</h2>
                    <div className="space-y-2">
                        <p className="text-sm text-gray-600">{initialWineFullInfo.country.name}</p>
                        <p className="text-sm text-gray-600">{initialWineFullInfo.producer.name}</p>
                    </div>
                </div>
                <div>
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        {initialWineFullInfo.wineVintages.map((wineVintage) => {
                            return (
                                <Link
                                    href={`/wine/${initialWineFullInfo.id}/vintage/${wineVintage.vintage}`}
                                    key={wineVintage.id}
                                >
                                    <div
                                        className="border rounded shadow p-4 text-center flex flex-col justify-between h-full">
                                        <h3 className="text-lg font-semibold mb-2">{wineVintage.vintage}</h3>
                                        <img
                                            src="/images/wine.jpg"
                                            alt="画像"
                                            className="mx-auto mb-4"
                                        />
                                        <div className="mb-4">
                                            <label className="text-sm">価格</label>
                                            <p className="text-sm text-gray-600">{wineVintage.price}</p>
                                            <label className="text-sm">熟成方法</label>
                                            <p className="text-sm text-gray-600">{wineVintage.agingMethod}</p>
                                            <label className="text-sm">アルコール度数</label>
                                            <p className="text-sm text-gray-600">{wineVintage.alcoholContent}</p>
                                            {wineVintage.technicalComment ? (
                                                <>
                                                    <label className="text-sm">技術的コメント</label>
                                                    <p className="text-sm text-gray-600">{wineVintage.technicalComment}</p>
                                                </>
                                            ) : (
                                                <div className="h-6"></div>
                                            )}
                                        </div>
                                    </div>
                                </Link>
                            );
                        })}
                    </div>
                </div>
            </section>
        </main>
    );
};

export default WineDetailPage;