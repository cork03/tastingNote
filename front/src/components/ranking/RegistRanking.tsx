'use client'
import GrayCard from "@/components/utils/view/grayCard";
import {ProducerWine, WineVintage} from "@/types/domain/wine";
import React, {ChangeEvent} from "react";
import InputField from "@/components/utils/form/Vertical/inputField";
import NormalButton from "@/components/utils/view/button/NormalButton";
import {registerRanking} from "@/repository/serverActions/wineRankingRepository";
import {redirect} from "next/navigation";

interface Props {
    wineVintagesInfo: { 'wineVintage': WineVintage, 'wine': ProducerWine }[];
    registeredCount: number
}

const RegisterRanking = ({wineVintagesInfo, registeredCount}: Props) => {
    const [selectedWineVintageId, setSelectedWineVintageId] = React.useState<number>(0);
    const [selectedRank, setSelectedRank] = React.useState<number>(0);
    const handleRankChange = (e: ChangeEvent<HTMLSelectElement>) => {
        setSelectedRank(Number(e.target.value));
    }
    const handleWineVintageIdChange = (e: ChangeEvent<HTMLSelectElement>) => {
        setSelectedWineVintageId(Number(e.target.value));
    }

    const submitRegisterRanking = async (e: React.FormEvent<HTMLFormElement>) => {
        if (selectedRank === 0 || selectedWineVintageId === 0) {
            return;
        }
        try {
            await registerRanking(selectedRank, selectedWineVintageId);
        } catch (e) {
            console.error(e);
        }
        redirect("/ranking");
    }
    return (
        <form onSubmit={submitRegisterRanking}>
            <div className="mb-8 flex flex-row justify-center items-center gap-x-4 mx-auto">
                <select name={"rank"}
                        className="w-full max-w-xs p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                        onChange={handleRankChange}
                >
                    <option value={0}>順位を選択してください</option>
                    {Array.from({length: registeredCount + 1}, (_, i) => (
                        <option key={i + 1} value={i + 1}>
                            {i + 1}位
                        </option>
                    ))}
                </select>
                <select name={"wineVintageId"}
                        className="w-full max-w-md p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                        onChange={handleWineVintageIdChange}
                >
                    <option value={0}>ワインを選択してください</option>
                    {wineVintagesInfo.map((wineVintageInfo) => {
                        if (!wineVintageInfo.wineVintage.id) {
                            throw new Error("wineVintage.id is null");
                        }
                        return (
                            <option key={wineVintageInfo.wineVintage.id} value={wineVintageInfo.wineVintage.id}>
                                {wineVintageInfo.wine.name}:{wineVintageInfo.wineVintage.vintage}年
                            </option>
                        );
                    })}
                </select>
                <NormalButton text={"ランキングに登録"} type={'submit'}/>
            </div>
        </form>
    )
}

export default RegisterRanking;