"use client"

import React from "react";
import {WineType} from "@/api/queryService/types/wine";

interface Props {
    label: string;
    name: string;
    value: number;
    onChange: (e: React.ChangeEvent<HTMLSelectElement>) => void;
    wineTypes: WineType[];
}

const WineTypeSelectFieldOld = (
    {
        label,
        name,
        value,
        onChange,
        wineTypes
    }: Props) => {
    return (
        <div className="flex flex-col mb-4">
            <label className="text-lg font-medium text-gray-800 mb-2">{label}</label>
            <select
                name={name}
                value={value}
                onChange={onChange}
                className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
            >
                <option value={0}>
                    {`${label}を選択してください`}
                </option>
                {wineTypes.map((wineType) => {
                    return <option key={wineType.id} value={wineType.id}>{wineType.name}</option>
                })}
            </select>
        </div>
    );
}

export default WineTypeSelectFieldOld;