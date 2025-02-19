'use client'

import {Appellation, AppellationType} from "@/types/domain/appellation";
import Section from "@/components/utils/view/section";
import GrayCard from "@/components/utils/view/grayCard";
import CountrySelectField from "@/components/utils/form/Vertical/countrySelectField";
import {Country} from "@/types/domain/country";
import React, {useState} from "react";
import AppellationTypeSelectField from "@/components/utils/form/Vertical/appellationTypeSelectField";
import TextField from "@/components/utils/form/Vertical/textField";
import InputField from "@/components/utils/form/Vertical/inputField";
import NormalButton from "@/components/utils/view/button/NormalButton";
import {createAppellation} from "@/repository/serverActions/appellationRepository";
import {redirect} from "next/navigation";

interface Props {
    appellationTypes: AppellationType[];
    countries: Country[];
}

export type AppellationSelectType = 1 | 2;

const AppellationCreate = ({appellationTypes, countries}: Props) => {
    const [appellationTypeState, setAppellationTypeState] = useState<AppellationType[]>(appellationTypes);
    const [appellation, setAppellation] = useState<Appellation>({
        id: null,
        name: "",
        appellationType: {
            id: 0,
            name: "",
            country: {
                id: 0,
                name: ""
            }
        },
        regulation: ""
    })
    const [appellationSelectType, setAppellationSelectType] = useState<AppellationSelectType>(1);
    const countrySelectHandleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        setAppellationTypeState(appellationTypes.filter(appellation => appellation.country.id === parseInt(e.target.value)));
        setAppellation({
            ...appellation,
            appellationType: {id: 0, name: "", country: {id: parseInt(e.target.value), name: ""}}
        });
    }

    const textOnChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
        setAppellation({...appellation, [e.target.name]: e.target.value});
    }

    const inputOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setAppellation({...appellation, [e.target.name]: e.target.value});
    }

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setAppellation({
            ...appellation,
            appellationType: {...appellation.appellationType, [e.target.name]: e.target.value}
        });
    }

    const newAppellationAddHandle = () => {
        setAppellationSelectType(2);
        setAppellation({
            ...appellation,
            appellationType: {id: null, name: "", country: {id: appellation.appellationType.country.id, name: ""}}
        });
    }

    const onSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        try {
            await createAppellation(appellation);
        } catch (e) {
            console.error(e);
        }
        redirect("/wine/create");
    }

    const appellationTypeSelectHandleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        const appellationType = appellationTypeState.find(appellationType => appellationType.id === parseInt(e.target.value));
        if (!appellationType) {
            throw new Error("appellationType is undefined");
        }
        setAppellation({...appellation, appellationType: appellationType});
    }
    console.log(appellation);
    return (
        <Section>
            <form onSubmit={onSubmit} className={"space-y-6"}>
                <GrayCard>
                    <CountrySelectField label={"国"} name={'id'} value={appellation.appellationType.country.id}
                                        onChange={countrySelectHandleChange} countries={countries}/>
                    {appellationSelectType === 1 &&
                        appellation.appellationType.id &&
                        <AppellationTypeSelectField
                            label={"アペラシオン種別"} name={"id"}
                            value={appellation.appellationType.id}
                            onChange={appellationTypeSelectHandleChange}
                            appellationTypes={appellationTypeState}
                            setAppellationSelectType={setAppellationSelectType}
                            newAppellationAddHandle={newAppellationAddHandle}
                        />
                    }
                    {appellationSelectType === 2 &&
                        <InputField label={"アペラシオンタイプ名"} name={"name"}
                                    value={appellation.appellationType.name}
                                    onChange={handleInputChange} placeholder={"例:DOCG"}/>
                    }
                    <InputField label={"名前"} name={"name"} value={appellation.name} onChange={inputOnChange}
                                placeholder={"例: Barolo"}/>
                    <TextField label={"規定"} name={"regulation"} value={appellation.regulation} onChange={textOnChange}
                               placeholder={"例: 最低でも48ヶ月の熟成"}/>
                </GrayCard>
                <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
                    <NormalButton text={"登録"} type={"submit"}/>
                </div>
            </form>
        </Section>
    );
}

export default AppellationCreate;