import Link from "next/link";
import GrayCard from "@/components/utils/view/grayCard";
import {Wine} from "@/types/domain/wine";

interface Props {
    wine: Wine;
}

const WineDetail = ({wine}: Props) => {
    return (
        <Link href={'/wine/${wine.id}/vintage/create'} className="text-center">
            <GrayCard>
                <img
                    src="/images/wine.jpg"
                    alt="生産者画像"
                    className="mx-auto mb-4"
                />
                <h3 className="text-lg font-semibold mb-2">{wine.name}</h3>
                <p className="text-sm text-gray-600">{wine.wineType.label}ワイン</p>
            </GrayCard>
        </Link>
    )
}

export default WineDetail;