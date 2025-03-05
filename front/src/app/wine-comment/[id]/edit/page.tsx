import React from "react";
import CreateComment from "@/components/wine/[id]/vintage/[vintage]/create-comment/CreateComment";
import {WineVintageFullInfo} from "@/types/wine";
import EditComment from "@/components/wine-comment/[id]/edit/EditComment";
import {getCommentById} from "@/api/queryService/wineCommentQueryService";
import Main from "@/components/utils/view/main";
import Title from "@/components/utils/view/title";

const CreateCommentPage = async ({params}: { params: Promise<{ id: number }> }) => {
    const {id} = await params;
    const wineComment = await getCommentById(id);
    return (
        <Main>
            <Title title={"テイスティングコメントを編集"}/>
            <EditComment wineComment={wineComment}/>
        </Main>
    );
}

export default CreateCommentPage;