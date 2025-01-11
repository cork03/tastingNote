import {Producer, Wine} from "@/app/wine/new/page";

interface Props {
    wine: Wine;
}

const WineDetail = ({wine}: Props) => {
    return (
        <div className="border rounded shadow p-4 text-center">
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