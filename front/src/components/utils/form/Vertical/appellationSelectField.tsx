"use client"

import React from "react";
import {Country} from "@/types/domain/country";
import {WineType} from "@/types/domain/wine";
import {Appellation} from "@/types/domain/appellation";
import {redirect} from "next/navigation";
import NormalButton from "@/components/utils/view/button/NormalButton";

interface Props {
    label: string;
    name: string;
    value: number | null;
    onChange: (e: React.ChangeEvent<HTMLSelectElement>) => void;
    appellations: Appellation[];
}

const AppellationSelectField = (
    {
        label,
        name,
        value,
        onChange,
        appellations
    }: Props) => {
    return (
        <div className="flex flex-col mb-4">
            <label className="text-lg font-medium text-gray-800 mb-2">{label}</label>
            <div className="flex items-center gap-4">
                <select
                    name={name}
                    value={value ?? 0}
                    onChange={onChange}
                    className="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                >
                    <option value={0}>
                        {`${label}を選択してください`}
                    </option>
                    {appellations.map((appellation) => {
                        // @ts-ignore
                        return <option key={appellation.id} value={appellation.id}>
                            {`${appellation.appellationType.name} ${appellation.name}`}
                        </option>
                    })}
                </select>
                <NormalButton text={"新しいアペラシオンを追加"} onClick={() => {
                    redirect("/appellation/create")
                }}/>
            </div>
        </div>
    );
}

export default AppellationSelectField;