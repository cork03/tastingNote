"use client"

import React from "react";
import Section from "@/components/utils/view/section";
import {GrapeVariety, WineVintage} from "@/types/domain/wine";
import {redirect} from "next/navigation";
import {postWineVintage} from "@/repository/wineVintageRepository";
import Form from "@/components/wine/[id]/vintage/create/form";

interface Props {
    wineId: number;
    grapeVarieties: GrapeVariety[];
}

const CreateWineVintage = ({wineId, grapeVarieties}: Props) => {
    const handle = async (e: React.FormEvent<HTMLFormElement>, wineVintage: WineVintage, base64Image: string | null) => {
        e.preventDefault();
        try {
            await postWineVintage(wineVintage, base64Image);
        } catch (e) {
            console.error(e);
            return;
        }
        redirect("/wines");
    }

    const backHandle = (e: React.FormEvent<HTMLButtonElement>) => {
        e.preventDefault();
        redirect("/wine/create");
    }

    return (
        <Section>
            <Form wineId={wineId} grapeVarieties={grapeVarieties} handle={handle} backHandle={backHandle}/>
        </Section>
    );
};

export default CreateWineVintage;