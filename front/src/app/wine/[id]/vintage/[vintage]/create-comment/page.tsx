import React from "react";
import CreateComment from "@/components/wine/[id]/vintage/[vintage]/create-comment/CreateComment";
import {WineVintageFullInfo} from "@/types/wine";

const CreateCommentPage = async ({params}: { params: { id: number, vintage: number } }) => {
    const {id, vintage} = await params;
    const data = await fetch(`${process.env.API_URL}/wine/${id}/vintage/${vintage}`);
    const initialWineVintage: WineVintageFullInfo = await data.json();
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <div className="text-center mb-8">
                <h2 className="text-3xl font-extrabold text-gray-800 mb-4">
                    テイスティングコメント作成
                </h2>
            </div>
            <CreateComment wineVintageId={initialWineVintage.id} id={id} vintage={vintage}/>
        </main>
    );
}

export default CreateCommentPage;