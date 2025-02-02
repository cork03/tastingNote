import React from "react";
import {Country, GrapeVariety} from "@/types/wine";
import CreateBlindTasting from "@/components/blind-tasting/CreateBlindTasting";

const BlindTastingPage = async () => {
    const countriesData = await fetch(`${process.env.API_URL}/countries`);
    const countries: Country[] = await countriesData.json();
    const grapeVarietiesData = await fetch(`${process.env.API_URL}/grape-varieties`);
    const grapeVarieties: GrapeVariety[] = await grapeVarietiesData.json();
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <div className="text-center mb-8">
                <h2 className="text-3xl font-extrabold text-gray-800 mb-4">
                    Blind Tasting
                </h2>
            </div>
            <CreateBlindTasting grapeVarieties={grapeVarieties} countries={countries}/>
        </main>
    );
}

export default BlindTastingPage;