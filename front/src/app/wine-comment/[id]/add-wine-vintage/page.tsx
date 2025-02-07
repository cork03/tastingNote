import CreateNewTasting from "@/components/wine/new/CreateNewTasting";
import Main from "@/components/utils/view/main";
import {Producer} from "@/types/domain/producer";
import ChoiceWineVintage from "@/components/wine-comment/[id]/add-wine-vintage/ChoiceWineVintage";

const WineCommentAddWineVintagePage = async ({params}: { params: { id: number } }) => {
    const {id} = await params
    const data = await fetch(`${process.env.API_URL}/producers`);
    const producers: Producer[] = await data.json();
    return (
        <Main>
            <ChoiceWineVintage prefix={`/wine-comment/${id}`} producers={producers}/>
        </Main>
    );
};

export default WineCommentAddWineVintagePage;