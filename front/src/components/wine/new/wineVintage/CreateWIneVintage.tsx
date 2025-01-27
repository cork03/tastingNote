"use client"

import React, {useEffect, useState} from "react";
import {ViewType} from "@/components/wine/new/CreateNewTasting";
import {GrapeVariety, Wine} from "@/types/wine";
import {getAlcoholContentChoices, getBlendPercentChoices, getVintageChoices} from "@/utils/utils";

interface Props {
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    selectedWine: Wine | null;
}

interface WineVariety {
    "grapeVarietyId": number,
    "percent": number,
}

interface WineVintage {
    "wineId": number,
    "vintage": number,
    "price": string,
    "agingMethod": string,
    "alcoholContent": number,
    "wineBlend": WineVariety[],
    "technicalComment": string,
}


const CreateWineVintage = ({setViewType, selectedWine}: Props) => {
    const [wineVintage, setWineVintage] = useState<WineVintage>({
        wineId: selectedWine ? selectedWine.id : 0,
        vintage: 2020,
        price: "",
        agingMethod: "",
        alcoholContent: 12,
        wineBlend: [{"grapeVarietyId": 0, "percent": 50}],
        technicalComment: ""
    });
    const [grapeVarieties, setGrapeVarieties] = useState<GrapeVariety[]>([]);
    useEffect(() => {
        const getGrapeVarieties = async () => {
            const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/grape_varieties`);
            if (!response.ok) {
                throw new Error('Failed to get wine types');
            }
            setGrapeVarieties(await response.json());
        }
        getGrapeVarieties();
    }, []);

    const createWineVintage = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault()
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/wine_vintage`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({"wineVintage": wineVintage})
        });
        if (!response.ok) {
            throw new Error('Failed to create wine vintage');
        }
        setViewType(2);
    }

    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
        setWineVintage({...wineVintage, [e.target.name]: e.target.value});
    }
    const handleSelectChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        setWineVintage({...wineVintage, [e.target.name]: Number(e.target.value)});
    }
    const handleWineBlendChange = (index: number, key: keyof WineVariety, value: any) => {
        const newWineBlend = wineVintage.wineBlend;
        newWineBlend[index] = {...newWineBlend[index], [key]: value};
        setWineVintage({...wineVintage, wineBlend: newWineBlend});
    }
    return (
        <section className="border-t pt-8">
            <form className="mx-auto space-y-4" onSubmit={createWineVintage}>
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        ヴィンテージ
                    </label>
                    <select
                        name="vintage"
                        value={wineVintage.vintage}
                        onChange={handleSelectChange}
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
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        価格
                    </label>
                    <input
                        type="text"
                        name="price"
                        value={wineVintage.price}
                        onChange={handleChange}
                        placeholder="例：2000"
                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                    />
                </div>

                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        熟成方法
                    </label>
                    <textarea
                        placeholder="例：フレンチオークの大樽で12ヶ月。新樽比率50%"
                        rows={4}
                        name={"agingMethod"}
                        value={wineVintage.agingMethod}
                        onChange={handleChange}
                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                    ></textarea>
                </div>
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        アルコール度数
                    </label>
                    <select
                        name="alcoholContent"
                        value={wineVintage.alcoholContent}
                        onChange={handleSelectChange}
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

                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        ブドウ品種
                    </label>
                    {wineVintage.wineBlend.map((wineVariety, index) => {
                        return (
                            <div key={index} className="mb-4">
                                <label className="block text-sm font-medium text-gray-700 mb-1">
                                    第{index + 1}品種
                                </label>
                                <div className="flex items-center space-x-4">
                                    <select
                                        name="grapeVarietyId"
                                        value={wineVariety.grapeVarietyId}
                                        onChange={(e) => handleWineBlendChange(index, "grapeVarietyId", parseInt(e.target.value))}
                                        className="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                                    >
                                        <option value={0}>種別を選択してください</option>
                                        {grapeVarieties.map((grapeVariety) => (
                                            <option key={grapeVariety.id} value={grapeVariety.id}>
                                                {grapeVariety.name}
                                            </option>
                                        ))}
                                    </select>
                                    <select
                                        name="percent"
                                        value={wineVariety.percent}
                                        onChange={(e) => handleWineBlendChange(index, "percent", parseInt(e.target.value))}
                                        className="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                                    >
                                        {getBlendPercentChoices().map((percentChoice) => (
                                            <option key={percentChoice} value={percentChoice}>
                                                {percentChoice}%
                                            </option>
                                        ))}
                                    </select>
                                    <button
                                        type="button"
                                        onClick={() => {
                                            const newWineBlend = wineVintage.wineBlend.filter((_, i) => i !== index);
                                            setWineVintage({...wineVintage, wineBlend: newWineBlend});
                                        }}
                                        className="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                                    >
                                        削除
                                    </button>
                                </div>
                            </div>
                        )
                    })}
                    <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
                        <button
                            type="button"
                            onClick={() => {
                                setWineVintage({
                                    ...wineVintage,
                                    wineBlend: [...wineVintage.wineBlend, {"grapeVarietyId": 0, "percent": 50}]
                                })
                            }}
                            className="bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                        >
                            次の品種を追加
                        </button>
                    </div>
                </div>

                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        その他製造に関するコメント
                    </label>
                    <textarea
                        name="technicalComment"
                        value={wineVintage.technicalComment}
                        onChange={handleChange}
                        placeholder="例；マロラクティック発酵,全房発酵"
                        rows={4}
                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                    ></textarea>
                </div>

                {/* ボタン */}
                <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
                    <button
                        type="submit"
                        className="bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                    >
                        作成
                    </button>
                    <button
                        className="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                        onClick={() => setViewType(2)}
                    >
                        戻る
                    </button>
                </div>
            </form>
        </section>
    )
}

export default CreateWineVintage;