"use client"

import React from "react";
import {Country} from "@/types/domain/country";
import {getAlcoholContentChoices, getVintageChoices} from "@/utils/utils";

interface Props {
    label: string;
    name: string;
    value: number;
    onChange: (e: React.ChangeEvent<HTMLSelectElement>) => void;
}

const AlcoholContentSelectField = (
    {
        label,
        name,
        value,
        onChange,
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
                {getAlcoholContentChoices().map((percent) => {
                    return <option key={percent} value={percent}>{percent}%</option>
                })}
            </select>
        </div>
    );
}

export default AlcoholContentSelectField;