"use client"

import React from "react";
import {getAlcoholContentChoices, getBlendPercentageChoices, getVintageChoices} from "@/utils/utils";
import {BlindTastingAnswer} from "@/types/domain/blindTasting";
import {Country, GrapeVariety} from "@/types/wine";
import {WineVariety} from "@/types/domain/wine";

interface Props {
    blindTastingAnswer: BlindTastingAnswer
    setBlindTastingAnswer: React.Dispatch<React.SetStateAction<BlindTastingAnswer>>
    grapeVarieties: GrapeVariety[];
    countries: Country[]
}

const BlindTastingAnswerPage = ({blindTastingAnswer, setBlindTastingAnswer, grapeVarieties, countries}: Props) => {
    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
        setBlindTastingAnswer({...blindTastingAnswer, [e.target.name]: e.target.value});
    }
    const handleSelectChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        setBlindTastingAnswer({...blindTastingAnswer, [e.target.name]: Number(e.target.value)});
    }

    const handleCountryChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        setBlindTastingAnswer({...blindTastingAnswer, country: countries.filter(country => country.id === parseInt(e.target.value))[0]});
    }
    const handleWineBlendChange = (index: number, key: keyof WineVariety, value: any) => {
        const newWineBlend = blindTastingAnswer.wineBlend;
        newWineBlend[index] = {...newWineBlend[index], [key]: value};
        setBlindTastingAnswer({...blindTastingAnswer, wineBlend: newWineBlend});
    }
    return (
        <div className="space-y-6">
            <div className="text-center mb-8">
                <h2 className="text-3xl font-extrabold text-gray-800 mb-4">
                    回答
                </h2>
            </div>
            <div className="border rounded-lg shadow-lg p-6 bg-gray-100">
                <div className="space-y-6">
                    <div className="flex flex-col">
                        <label className="text-lg font-medium text-gray-800 mb-2">国</label>
                        <select
                            onChange={handleCountryChange}
                            name="id"
                            value={blindTastingAnswer.country.id ?? 0}
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
                        {blindTastingAnswer.wineBlend.map((wineVariety, index) => {
                            return (
                                <div key={index} className="mb-4">
                                    <label className="block text-sm font-medium text-gray-700 mb-1">
                                        第{index + 1}品種
                                    </label>
                                    <div className="flex items-center space-x-4">
                                        <select
                                            name="grapeVarietyId"
                                            value={wineVariety.grapeVarietyId}
                                            onChange={(e) => {
                                                    handleWineBlendChange(index, "grapeVarietyId", parseInt(e.target.value))
                                                    const targetName = grapeVarieties.filter(grapeVariety => grapeVariety.id === parseInt(e.target.value))[0].name;
                                                    handleWineBlendChange(index, "name", targetName);
                                                }
                                            }
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
                                            name="percentage"
                                            value={wineVariety.percentage}
                                            onChange={(e) => handleWineBlendChange(index, "percentage", parseInt(e.target.value))}
                                            className="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                                        >
                                            {getBlendPercentageChoices().map((percentageChoice) => (
                                                <option key={percentageChoice} value={percentageChoice}>
                                                    {percentageChoice}%
                                                </option>
                                            ))}
                                        </select>
                                        <button
                                            type="button"
                                            onClick={() => {
                                                const newWineBlend = blindTastingAnswer.wineBlend.filter((_, i) => i !== index);
                                                setBlindTastingAnswer({...blindTastingAnswer, wineBlend: newWineBlend});
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
                                    setBlindTastingAnswer({
                                        ...blindTastingAnswer,
                                        wineBlend: [...blindTastingAnswer.wineBlend, {"grapeVarietyId": 0, "name": "", "percentage": 50}]
                                    })
                                }}
                                className="bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                            >
                                次の品種を追加
                            </button>
                        </div>
                    </div>
                    <div className="flex flex-col">
                        <label className="text-lg font-medium text-gray-800 mb-2">ヴィンテージ</label>
                        <select
                            name="vintage"
                            onChange={handleSelectChange}
                            value={blindTastingAnswer.vintage}
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
                            type="number"
                            onChange={handleChange}
                            value={blindTastingAnswer.price}
                            name="price"
                            placeholder="例：2000"
                            className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                        />
                    </div>
                    <div className="flex flex-col">
                        <label className="text-lg font-medium text-gray-800 mb-2">アルコール度数</label>
                        <select
                            onChange={handleSelectChange}
                            value={blindTastingAnswer.alcoholContent}
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
                            name={"anotherComment"}
                            onChange={handleChange}
                            value={blindTastingAnswer.anotherComment || ""}
                            placeholder="マロラクティック発酵、アメリカンオーク"
                            rows={4}
                            className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                        ></textarea>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default BlindTastingAnswerPage;