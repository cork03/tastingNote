import GrayCard from "@/components/utils/view/grayCard";
import {ProducerWine} from "@/api/types/producer";
import NormalImage from "@/components/utils/view/normalImage";

interface Props {
    wine: ProducerWine;
    onClick: () => void;
}

const WineDetail = ({wine, onClick}: Props) => {

    return (
        <div onClick={onClick} className={"cursor-pointer text-center"}>
            <GrayCard>
                <h3 className="text-lg font-semibold mb-2">{wine.name}</h3>
                <p className="text-sm text-gray-600">{wine.wineType.name}ワイン</p>
                <NormalImage src={wine.imagePath ?? "/images/wine.jpg"}/>
            </GrayCard>
        </div>
    )
}

export default WineDetail;