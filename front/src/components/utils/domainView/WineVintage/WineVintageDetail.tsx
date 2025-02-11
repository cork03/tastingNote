import GrayCard from "@/components/utils/view/grayCard";
import {Wine, WineVintage} from "@/types/domain/wine";
import React from "react";

interface Props {
    wineVintage: WineVintage;
    onClick: () => void;
}

const WineVintageDetail = ({wineVintage, onClick}: Props) => {
    return (
        <div onClick={onClick} className={"cursor-pointer text-center"}>
            <GrayCard>
                <h3 className="text-lg font-semibold mb-2">{wineVintage.vintage}</h3>
                <img
                    src={wineVintage.imagePath ?? "/images/wine.jpg"}
                    alt="画像"
                    className="mx-auto mb-4"
                />
                <div className="mb-4">
                    <label className="text-sm">価格</label>
                    <p className="text-sm text-gray-600">{wineVintage.price}</p>
                    <label className="text-sm">熟成方法</label>
                    <p className="text-sm text-gray-600">{wineVintage.agingMethod}</p>
                    <label className="text-sm">アルコール度数</label>
                    <p className="text-sm text-gray-600">{wineVintage.alcoholContent}</p>
                    {wineVintage.technicalComment ? (
                        <>
                            <label className="text-sm">技術的コメント</label>
                            <p className="text-sm text-gray-600">{wineVintage.technicalComment}</p>
                        </>
                    ) : (
                        <div className="h-6"></div>
                    )}
                </div>
            </GrayCard>
        </div>
    )
}

export default WineVintageDetail;