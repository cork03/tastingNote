import {ViewType} from "@/components/wine/new/CreateNewTasting";
import {Wine} from "@/types/wine";

interface Props {
    wine: Wine;
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    setSelectedWine: React.Dispatch<React.SetStateAction<Wine | null>>;
}

const WineDetail = ({wine, setViewType, setSelectedWine}: Props) => {
    return (
        <div
            className="border rounded shadow p-4 text-center"
            onClick={() => {
                setViewType(3)
                setSelectedWine(wine)}}
        >
            <img
                src="/images/wine.jpg"
                alt="生産者画像"
                className="mx-auto mb-4"
            />
            <h3 className="text-lg font-semibold mb-2">{wine.name}</h3>
            <p className="text-sm text-gray-600">{wine.wineType.label}ワイン</p>
        </div>
    )
}

export default WineDetail;