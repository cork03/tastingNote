import React from "react";
import {Country, GrapeVariety, WineWithProducer} from "@/types/wine";
import Link from "next/link";
import {getAlcoholContentChoices, getVintageChoices} from "@/utils/utils";

const BlindTastingPage = async () => {
    const countriesData = await fetch(`${process.env.API_URL}/countries`);
    const countries: Country[] = await countriesData.json();
    const grapeVarietiesData = await fetch(`${process.env.API_URL}/grape_varieties`);
    const grapeVarieties: GrapeVariety[] = await grapeVarietiesData.json();
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <div className="text-center mb-8">
                <h2 className="text-3xl font-extrabold text-gray-800 mb-4">
                    Blind Tasting
                </h2>
            </div>
            <section className="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                <form className="mx-auto space-y-8">
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
                                        placeholder="ガーネット色"
                                        rows={4}
                                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                                    ></textarea>
                                </div>
                                <div className="flex flex-col">
                                    <label className="text-lg font-medium text-gray-800 mb-2">香り</label>
                                    <textarea
                                        placeholder="黒系も赤系もある中庸な香り"
                                        rows={4}
                                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                                    ></textarea>
                                </div>
                                <div className="flex flex-col">
                                    <label className="text-lg font-medium text-gray-800 mb-2">味わい</label>
                                    <textarea
                                        placeholder="酸味が強く、タンニンは穏やか"
                                        rows={4}
                                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                                    ></textarea>
                                </div>
                                <div className="flex flex-col">
                                    <label className="text-lg font-medium text-gray-800 mb-2">その他コメント</label>
                                    <textarea
                                        placeholder="新樽比率の高いピノノワールに似ている"
                                        rows={4}
                                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="space-y-6">
                        <div className="text-center mb-8">
                            <h2 className="text-3xl font-extrabold text-gray-800 mb-4">
                                解答
                            </h2>
                        </div>
                        <div className="border rounded-lg shadow-lg p-6 bg-gray-100">
                            <div className="space-y-6">
                                <div className="flex flex-col">
                                    <label className="text-lg font-medium text-gray-800 mb-2">国</label>
                                    <select
                                        name="countryId"
                                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                                    >
                                        <option value={0}>
                                            生産国を選択してください
                                        </option>
                                        {countries.map((country) => {
                                            return <option key={country.id} value={country.id}>{country.name}</option>
                                        })}
                                    </select>
                                </div>
                                <div className="flex flex-col">
                                    <label className="text-lg font-medium text-gray-800 mb-2">葡萄品種</label>
                                    <select
                                        name="grapeVarietyId"
                                        className="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                                    >
                                        <option value={0}>種別を選択してください</option>
                                        {grapeVarieties.map((grapeVariety) => (
                                            <option key={grapeVariety.id} value={grapeVariety.id}>
                                                {grapeVariety.name}
                                            </option>
                                        ))}
                                    </select>
                                </div>
                                <div className="flex flex-col">
                                    <label className="text-lg font-medium text-gray-800 mb-2">ヴィンテージ</label>
                                    <select
                                        name="vintage"
                                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                                    >
                                        <option value={0}>
                                            種別を選択してください
                                        </option>
                                        {getVintageChoices().map((vintage) => {
                                            return (
                                                <option key={vintage} value={vintage}>
                                                    {vintage}年
                                                </option>
                                            )
                                        })}
                                    </select>
                                </div>
                                <div className="flex flex-col">
                                    <label className="text-lg font-medium text-gray-800 mb-2">価格</label>
                                    <input
                                        type="text"
                                        name="price"
                                        placeholder="例：2000"
                                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                                    />
                                </div>
                                <div className="flex flex-col">
                                    <label className="text-lg font-medium text-gray-800 mb-2">アルコール度数</label>
                                    <select
                                        name="alcoholContent"
                                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                                    >
                                        <option value={0}>
                                            種別を選択してください
                                        </option>
                                        {getAlcoholContentChoices().map((alcoholContent) => {
                                            return (
                                                <option key={alcoholContent} value={alcoholContent}>
                                                    {alcoholContent}%
                                                </option>
                                            )
                                        })}
                                    </select>
                                </div>
                                <div className="flex flex-col">
                                    <label className="text-lg font-medium text-gray-800 mb-2">その他コメント</label>
                                    <textarea
                                        placeholder="マロラクティック発酵、アメリカンオーク"
                                        rows={4}
                                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>

        </main>
    );
}

export default BlindTastingPage;