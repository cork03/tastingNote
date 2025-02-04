"use client"

import React from "react";
import Section from "@/components/utils/view/section";
import GrayCard from "@/components/utils/view/grayCard";
import TextField from "@/components/utils/form/Vertical/textField";
import {GrapeVariety, WineVariety, WineVintage} from "@/types/domain/wine";
import InputField from "@/components/utils/form/Vertical/inputField";
import VintageSelectField from "@/components/utils/form/Vertical/vintageSelectField";
import AlcoholContentSelectField from "@/components/utils/form/Vertical/alcoholContentSelectField";
import WineBlendSelectField from "@/components/utils/form/Vertical/wineBlendSelectField";
import {redirect} from "next/navigation";
import {postProducer} from "@/repository/producerRepository";
import {postWineVintage} from "@/repository/wineVintageRepository";
import InputFileField from "@/components/utils/form/Vertical/inputFileField";

interface Props {
    wineId: number;
    grapeVarieties: GrapeVariety[];
}

const CreateWineVintage = ({wineId, grapeVarieties}: Props) => {
    const [wineVintage, setWineVintage] = React.useState<WineVintage>({
        id: null,
        wineId: wineId,
        vintage: 2020,
        price: 0,
        agingMethod: "",
        alcoholContent: 12,
        wineBlend: [{grapeVarietyId: 0, percentage: 50, name: ""}],
        technicalComment: ""
    });
    const [base64Image, setBase64Image] = React.useState<string | null>(null);
    const handleTextChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
        setWineVintage({...wineVintage, [e.target.name]: e.target.value});
    }

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setWineVintage({...wineVintage, [e.target.name]: e.target.value});
    }

    const handleSelectChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        setWineVintage({...wineVintage, [e.target.name]: Number(e.target.value)});
    }

    const handleWineBlendChange = (index: number, key: keyof WineVariety, value: any) => {
        const newWineBlend = wineVintage.wineBlend;
        newWineBlend[index] = {...newWineBlend[index], [key]: value};
        setWineVintage({...wineVintage, wineBlend: newWineBlend});
    }

    const deleteButton = (index: number) => {
        const newWineBlend = wineVintage.wineBlend.filter((_, i) => i !== index);
        setWineVintage({...wineVintage, wineBlend: newWineBlend});
    }

    const addWineBlend = () => {
        setWineVintage({
            ...wineVintage,
            wineBlend: [...wineVintage.wineBlend, {"grapeVarietyId": 0, name: "", "percentage": 50}]
        })
    }
    const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        try {
            await postWineVintage(wineVintage, base64Image);
        } catch (e) {
            console.error(e);
            return;
        }
        redirect("/wines");
    }
    return (
        <Section>
            <form onSubmit={handleSubmit}>
                <div className="space-y-6">
                    <GrayCard>
                        <VintageSelectField label={"ヴィンテージ"} name={"vintage"} value={wineVintage.vintage}
                                            onChange={handleSelectChange}/>
                        <WineBlendSelectField wineBlend={wineVintage.wineBlend} label={"ブドウ品種"}
                                              onChange={handleWineBlendChange} deleteButton={deleteButton}
                                              addWineBlend={addWineBlend} grapeVarieties={grapeVarieties}/>
                        <TextField label={"熟成方法"} name={"agingMethod"} value={wineVintage.agingMethod}
                                   onChange={handleTextChange}
                                   placeholder={"例：フレンチオークの大樽で12ヶ月。新樽比率50%"}/>
                        <AlcoholContentSelectField label={"アルコール度数"} name={"alcoholContent"}
                                                   value={wineVintage.alcoholContent} onChange={handleSelectChange}/>
                        <InputField label={"価格"} name={"price"} value={wineVintage.price} onChange={handleInputChange}
                                    placeholder={"5000"} type={"number"}/>
                        <TextField label={"その他製造に関するコメント"} name={"technicalComment"}
                                   value={wineVintage.technicalComment || ""} onChange={handleTextChange}
                                   placeholder={"例：マロラクティック発酵,全房発酵"}/>
                        <InputFileField label={"画像"} name={"image"} value={"image"} setBase64Image={setBase64Image} placeholder={"test"}/>
                    </GrayCard>
                    <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
                        <button
                            type="submit"
                            className="bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                        >
                            作成
                        </button>
                        <button
                            className="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                            onClick={(e: React.FormEvent<HTMLButtonElement>) => {
                                e.preventDefault()
                                redirect("/wine/create")
                            }}
                        >
                            戻る
                        </button>
                    </div>
                </div>
            </form>
        </Section>
    );
};

export default CreateWineVintage;