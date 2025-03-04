"use client"

import React from "react";
import Section from "@/components/utils/view/section";
import GrayCard from "@/components/utils/view/grayCard";
import InputField from "@/components/utils/form/Vertical/inputField";
import NormalButton from "@/components/utils/view/button/NormalButton";
import GrayButton from "@/components/utils/view/button/GrayButton";
import ButtonsDiv from "@/components/utils/view/button/ButtonsDiv";
import {Appellation} from "@/types/domain/appellation";
import AppellationSelectField from "@/components/utils/form/Vertical/appellationSelectField";
import {WineDetail, WineType} from "@/api/queryService/types/wine";
import {Country} from "@/api/queryService/types/country";
import CountrySelectField from "@/components/utils/form/Vertical/countrySelectField";
import WineTypeSelectField from "@/components/utils/form/Vertical/wineTypeSelectField";
import {redirect} from "next/navigation";
import {updateWine} from "@/api/repository/wineRepository";
import {UpdateWineBody} from "@/api/repository/types/wine";

interface Props {
    wineDetail: WineDetail;
    countries: Country[];
    wineTypes: WineType[];
    appellations: Appellation[]
}

interface Wine {
    id: number;
    name: string;
    producerId: number;
    country: Country;
    wineType: WineType;
    appellation: {
        id: number;
        appellationType: {
            id: number;
            name: string;
            country: {
                id: number;
                name: string;
            }
        };
        name: string;
        regulation: string;
    } | null;
}

const UpdateWine = ({wineDetail, countries, wineTypes, appellations}: Props) => {
    const [wine, setWine] = React.useState<Wine>({
        id: wineDetail.wine.id,
        name: wineDetail.wine.name,
        producerId: wineDetail.producer.id,
        country: {
            id: wineDetail.wine.country.id,
            name: wineDetail.wine.country.name
        },
        wineType: {
            id: wineDetail.wine.wineType.id,
            name: wineDetail.wine.wineType.name
        },
        appellation: wineDetail.wine.appellation
    });
    const [appellationsState, setAppellationsState] = React.useState<Appellation[]>(appellations);
    const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        try {
            await updateWine(
                wine.id,
                {
                    producerId: wine.producerId,
                    name: wine.name,
                    countryId: wine.country.id,
                    wineTypeId: wine.wineType.id,
                    appellationId: wine.appellation?.id ?? null
                } as UpdateWineBody
            );
        } catch (e) {
            console.error(e);
        }
        redirect(`/wine/${wine.id}`);
    }
    const selectCountryHandleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        setWine({...wine, country: {id: parseInt(e.target.value), name: ""}});
        setAppellationsState(appellations.filter((appellation) => appellation.appellationType.country.id === parseInt(e.target.value)));
    }
    const selectWineTypeHandleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        setWine({...wine, wineType: {id: parseInt(e.target.value), name: ""}});
    }
    const selectAppellationHandleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        setWine({
            ...wine,
            appellation: {
                id: parseInt(e.target.value),
                appellationType: {id: 0, name: "", country: {id: 0, name: ""}},
                name: "",
                regulation: ""
            }
        });
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
                        <AppellationSelectField label={"アペラシオン"} name={'id'} value={wine.appellation?.id ?? null}
                                                onChange={selectAppellationHandleChange}
                                                appellations={appellationsState}/>
                    </div>
                </GrayCard>
                <ButtonsDiv>
                    <NormalButton text={"更新"} type={"submit"}/>
                    <GrayButton text={"戻る"} onClick={(e: React.FormEvent<HTMLButtonElement>) => {
                        e.preventDefault();
                        redirect(`/wine/${wineDetail.wine.id}`);
                    }}/>
                </ButtonsDiv>
            </form>
        </Section>
    )
}

export default UpdateWine;