import React from "react";
import {WineWithProducer} from "@/types/wine";
import Link from "next/link";

const Wines = async () => {
    const data = await fetch(`${process.env.API_URL}/wines`);
    const initialWines: WineWithProducer[] = await data.json();
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <section>
                <h2 className="text-2xl font-bold text-center mb-6">ワイン</h2>
                <div>
                    <div className="mb-8 flex flex-row justify-center items-center gap-x-4 mx-auto">
                        <input
                            type="text"
                            placeholder="ワインを検索"
                            className="w-full max-w-md p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                        />
                    </div>
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        {initialWines.map((wineWithProducer) => {
                            return (
                                <Link href={`/wine/${wineWithProducer.id}`} key={wineWithProducer.id}>
                                    <div className="border rounded shadow p-4 text-center">
                                        <h3 className="text-lg font-semibold mb-2">{wineWithProducer.name}</h3>
                                        <img
                                            src="/images/wine.jpg"
                                            alt="ワイン画像"
                                            className="mx-auto mb-4"
                                        />
                                        <label className="text-sm">生産者</label>
                                        <p className="text-sm text-gray-600">{wineWithProducer.producer.name}</p>
                                        <label className="text-sm">国</label>
                                        <p className="text-sm text-gray-600">{wineWithProducer.country.name}</p>
                                        <label className="text-sm">種類</label>
                                        <p className="text-sm text-gray-600">{wineWithProducer.wineType.label}</p>
                                    </div>
                                </Link>

                            );
                        })}
                    </div>
                </div>
            </section>
        </main>
    );
}

export default Wines;