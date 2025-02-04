"use client"

import React from "react";
import {BlindTastingAnswer} from "@/types/domain/blindTasting";
import {resizeImage} from "@/utils/utils";

interface Props {
    label: string;
    name: string;
    value: string;
    setBase64Image: React.Dispatch<React.SetStateAction<string | null>>;
    placeholder: string;
}

const InputFileField = (
    {
        label,
        setBase64Image,
    }: Props) => {
    const handleChange = async (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0];
        if (!file) {
            return;
        }
        const reader = new FileReader();
        const resize = await resizeImage(file, 300, 400);
        reader.readAsDataURL(resize);
        reader.onload = () => {
            setBase64Image(reader.result as string);
        }
    }
    return (
        <div className="flex flex-col mb-4">
            <label className="text-lg font-medium text-gray-800 mb-2">{label}</label>
            <input type="file" className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400" onChange={handleChange}/>
        </div>
    );
}

export default InputFileField;