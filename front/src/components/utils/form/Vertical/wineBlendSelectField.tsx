"use client"

import React from "react";
import {Country} from "@/types/domain/country";
import {getBlendPercentageChoices, getVintageChoices} from "@/utils/utils";
import {GrapeVariety, WineVariety} from "@/types/domain/wine";

interface Props {
    wineBlend: WineVariety[];
    label: string;
    onChange: (index: number, key: keyof WineVariety, value: any) => void;
    deleteButton: (index: number) => void;
    addWineBlend: () => void;
    grapeVarieties: GrapeVariety[];
}

const wineBlendSelect = (
    {
        wineBlend,
        label,
        onChange,
        deleteButton,
        addWineBlend,
        grapeVarieties,
    }: Props) => {
    console.log(wineBlend);
    return (
        <div>
            <label className="text-lg font-medium text-gray-800 mb-2">{label}</label>
            {wineBlend.map((wineVariety, index) => {
                return (
                    <div key={index} className="flex flex-col mb-4">
                        <label className="text-lg font-medium text-gray-800 mb-2">
                            第{index + 1}品種
                        </label>
                        <div className="flex items-center space-x-4">
                            <select
                                name="id"
                                value={wineVariety.id}
                                onChange={(e) => onChange(index, "id", parseInt(e.target.value))}
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
                                onChange={(e) => onChange(index, "percentage", parseInt(e.target.value))}
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
                                onClick={() => {deleteButton(index)}}
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
                    onClick={() => {addWineBlend()}}
                    className="bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                >
                    次の品種を追加
                </button>
            </div>
        </div>
    );
}

export default wineBlendSelect;