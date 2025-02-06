import CreateNewTasting from "@/components/wine/new/CreateNewTasting";
import Main from "@/components/utils/view/main";
import {Producer} from "@/types/domain/producer";

const WineNewPage = async () => {
    const data = await fetch(`${process.env.API_URL}/producers`);
    const producers: Producer[] = await data.json();
    return (
        <Main>
            <CreateNewTasting producers={producers}/>
        </Main>
    );
};

export default WineNewPage;