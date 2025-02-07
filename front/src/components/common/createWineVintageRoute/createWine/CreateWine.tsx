"use client"

import React from "react";
import Section from "@/components/utils/view/section";
import GrayCard from "@/components/utils/view/grayCard";
import InputField from "@/components/utils/form/Vertical/inputField";
import {Wine, WineType} from "@/types/domain/wine";
import CountrySelectField from "@/components/utils/form/Vertical/countrySelectField";
import {Country} from "@/types/domain/country";
import WineTypeSelectField from "@/components/utils/form/Vertical/wineTypeSelectField";
import NormalButton from "@/components/utils/view/button/NormalButton";
import {createWine} from "@/repository/serverActions/wineRepository";
import {redirect} from "next/navigation";
import GrayButton from "@/components/utils/view/button/GrayButton";
import ButtonsDiv from "@/components/utils/view/button/ButtonsDiv";

interface Props {
    prefix: string;
    producerId: number;
    countries: Country[];
    wineTypes: WineType[];
}

const CreateWine = ({prefix, producerId, countries, wineTypes}: Props) => {
    const [wine, setWine] = React.useState<Wine>({
        id: null,
        name: "",
        producerId: producerId,
        country: {
            id: 0,
            name: ""
        },
        wineType: {
            id: 0,
            label: ""
        }
    });
    const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        try {
            await createWine(wine, prefix);
        } catch (e) {
            console.error(e);
        }
    }
    const selectCountryHandleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        setWine({...wine, country: {id: parseInt(e.target.value), name: ""}});
    }
    const selectWineTypeHandleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        setWine({...wine, wineType: {id: parseInt(e.target.value), label: ""}});
    }
    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setWine({...wine, [e.target.name]: e.target.value});
    }
    return (
        <Section>
            <form onSubmit={handleSubmit} className="space-y-6">
                <GrayCard>
                    <div className="space-y-6">
                        <InputField label={"ワイン名"} name={"name"} value={wine.name} onChange={handleInputChange}
                                    placeholder={"CH.HAUT BRION"}/>
                        <CountrySelectField label={"生産国"} name={"id"} value={wine.country.id}
                                            onChange={selectCountryHandleChange} countries={countries}/>
                        <WineTypeSelectField label={"ワイン種別"} name={"id"} value={wine.wineType.id}
                                             onChange={selectWineTypeHandleChange} wineTypes={wineTypes}/>
                    </div>
                </GrayCard>
                <ButtonsDiv>
                    <NormalButton text={"作成"} type={"submit"}/>
                    <GrayButton text={"戻る"} onClick={(e: React.FormEvent<HTMLButtonElement>) => {
                        e.preventDefault()
                        if (prefix) {
                            redirect(`${prefix}/add-wine-vintage`);
                        }
                        redirect(`/wine/create`);
                    }}/>
                </ButtonsDiv>
            </form>
        </Section>
    )
}

export default CreateWine;