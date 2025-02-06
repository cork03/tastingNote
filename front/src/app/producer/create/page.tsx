import React from "react";
import {Country} from "@/types/domain/country";
import ProducerPage from "@/components/proucer/create/Producer";

const ProducerCreatePage = async () => {
    const data = await fetch(`${process.env.API_URL}/countries`);
    const countries: Country[] = await data.json();
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <div className="text-center mb-8">
                <h2 className="text-3xl font-extrabold text-gray-800 mb-4">生産者作成</h2>
            </div>
           <ProducerPage countries={countries}></ProducerPage>
        </main>
    );
};

export default ProducerCreatePage;