"use client"

import React from "react";

interface Props {
    label: string;
    name: string;
    value: string;
    onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
    placeholder: string;
}

const InputField = (
    {
        label,
        name,
        value,
        onChange,
        placeholder
    }: Props) => {
    return (
        <div className="flex flex-col mb-4">
            <label className="text-lg font-medium text-gray-800 mb-2">{label}</label>
            < input
                type="text"
                name={name}
                value={value}
                onChange={onChange}
                placeholder={placeholder}
                className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
            />
        </div>
    );
}

export default InputField;