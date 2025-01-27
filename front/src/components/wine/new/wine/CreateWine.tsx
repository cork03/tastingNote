"use client"

import React, {useEffect, useState} from "react";
import {Wine, WineType} from "@/types/wine";
import {Producer} from "@/types/producer";

type Props = {
    setIsViewMode: React.Dispatch<React.SetStateAction<boolean>>
    selectedProducer: Producer | null
    setWines: React.Dispatch<React.SetStateAction<Wine[]>>
};

interface WineData {
    name: string;
    wineTypeId: number;
    producerId: number | null;
    countryId: number;
}

interface Country {
    id: number;
    name: string;
}

const CreateWine = ({setIsViewMode, selectedProducer, setWines}: Props) => {
    const [wineData, setWineData] = useState<WineData>({
        name: '',
        wineTypeId: 0,
        producerId: selectedProducer ? selectedProducer.id : null,
        countryId: 0
    });
    const [wineTypes, setWineTypes] = useState<WineType[]>([]);
    const [countries, setCountries] = useState<Country[]>([]);
    const getWineTypes = async () => {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/wine-types`);
        if (!response.ok) {
            throw new Error('Failed to get wine types');
        }
        const wineTypes: WineType[] = await response.json();
        setWineTypes(wineTypes);
    }
    const getCountries = async () => {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/countries`);
        if (!response.ok) {
            throw new Error('Failed to get countries');
        }
        const countries: Country[] = await response.json();
        setCountries(countries);
    }

    useEffect(() => {
        getWineTypes();
        getCountries();
    }, [])

    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setWineData({...wineData, [e.target.name]: e.target.value});
    }

    const handleSelectChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        setWineData({...wineData, [e.target.name]: parseInt(e.target.value)});
    }
    const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        const url = process.env.NEXT_PUBLIC_API_URL;
        const response = await fetch(`${url}/wine`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({"wine": wineData})
        })
        if (!response.ok) {
            throw new Error('Failed to create producer');
        }
        // フォームをリセット
        setWineData({name: '', wineTypeId: 0, producerId: selectedProducer ? selectedProducer.id : null, countryId: 0});
        // ワイン一覧を再取得
        const winesResponse = await fetch(`${url}/producer/${selectedProducer?.id}/wines`);
        if (!winesResponse.ok) {
            throw new Error('Failed to get producers');
        }
        setWines(await winesResponse.json())
        setIsViewMode(true);
    }
    return (
        <section className="border-t pt-8">
            <form className="mx-auto space-y-4" onSubmit={handleSubmit}>
                {/* 名前 */}
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        ワイン名
                    </label>
                    <input
                        type="text"
                        name="name"
                        value={wineData.name}
                        onChange={handleChange}
                        placeholder="ワイン名を入力"
                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                    />
                </div>

                {/* 画像URL */}
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        画像URL
                    </label>
                    <input
                        type="text"
                        placeholder="画像のURLを入力"
                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                    />
                </div>

                {/* 説明 */}
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        ワイン種別
                    </label>
                    <select
                        name="wineTypeId"
                        value={wineData.wineTypeId}
                        onChange={handleSelectChange}
                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                    >
                        <option value={0}>
                            種別を選択してください
                        </option>
                        {wineTypes.map((wineType) => {
                            return <option key={wineType.id} value={wineType.id}>{wineType.label}</option>
                        })}
                    </select>
                </div>

                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        生産国
                    </label>
                    <select
                        name="countryId"
                        value={wineData.countryId}
                        onChange={handleSelectChange}
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
                        onClick={() => setIsViewMode(true)}
                    >
                        戻る
                    </button>
                </div>
            </form>
        </section>
    )
}

export default CreateWine;