"use client"

import React from "react";
import {Country} from "@/types/domain/country";
import {AppellationType} from "@/types/domain/appellation";
import NormalButton from "@/components/utils/view/button/NormalButton";
import {AppellationSelectType} from "@/components/appellation/create/appelationCreate";

interface Props {
    label: string;
    name: string;
    value: number;
    onChange: (e: React.ChangeEvent<HTMLSelectElement>) => void;
    appellationTypes: AppellationType[];
    setAppellationSelectType: React.Dispatch<React.SetStateAction<AppellationSelectType>>;
    newAppellationAddHandle: () => void;
}

const AppellationTypeSelectField = (
    {
        label,
        name,
        value,
        onChange,
        appellationTypes,
        newAppellationAddHandle
    }: Props) => {
    return (
        <div className="flex flex-col mb-4">
            <label className="text-lg font-medium text-gray-800 mb-2">{label}</label>
            <div className="flex gap-4">
                <select
                    name={name}
                    value={value}
                    onChange={onChange}
                    className="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                >
                    <option value={0}>
                        {`${label}を選択してください`}
                    </option>
                    {appellationTypes.map((appellation) => {
                        if (!appellation.id) {
                            throw new Error("appellation.id is undefined");
                        }
                        return <option key={appellation.id} value={appellation.id}>{appellation.name}</option>
                    })}
                </select>
                <NormalButton text={"新しいアペラシオンタイプを追加"} onClick={newAppellationAddHandle}/>
            </div>
        </div>
    );
}

export default AppellationTypeSelectField;