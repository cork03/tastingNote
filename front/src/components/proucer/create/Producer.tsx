"use client"

import React from "react";
import {Country} from "@/types/domain/country";
import {Producer} from "@/types/domain/producer";
import InputField from "@/components/utils/form/inputField";
import TextField from "@/components/utils/form/textField";
import CountrySelectField from "@/components/utils/form/countrySelectField";
import {postProducer} from "@/repository/producerRepository";
import {redirect} from "next/navigation";

interface Props {
    countries: Country[];
}

const ProducerPage = ({countries}: Props) => {
    const [producer, setProducer] = React.useState<Producer>({
        id: null,
        name: "",
        country: {id: 0, name: ""},
        description: "",
        url: null
    });
    const inputHandleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setProducer({...producer, [e.target.name]: e.target.value});
    }
    const textHandleChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
        setProducer({...producer, [e.target.name]: e.target.value});
    }
    const selectHandleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        setProducer({...producer, country: {id: parseInt(e.target.value), name: ""}});
    }
    const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        try {
            await postProducer(producer);
        } catch (e) {
            console.error(e);
            return;
        }
        redirect("/wine/create");
    }
    console.log(producer);
    return (
        <section className="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            <form onSubmit={handleSubmit}>
                <div className="space-y-6">
                    <div
                        className="border rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 bg-gray-100">
                        <InputField label={"生産者名"} name={"name"} value={producer.name} onChange={inputHandleChange}
                                    placeholder={"シャトー・オー・ブリオン"}/>
                        <CountrySelectField label={"国"} name={"countryId"} value={producer.country.id}
                                            onChange={selectHandleChange} countries={countries}/>
                        <TextField label={"説明"} name={"description"} value={producer.description}
                                   onChange={textHandleChange} placeholder={"メドック格付け1級のシャトー"}/>
                        <InputField label={"url"} name={"url"} value={producer.url ?? ""} onChange={inputHandleChange}
                                    placeholder={"https://example.com"}/>
                    </div>
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
        </section>
    )
}

export default ProducerPage;