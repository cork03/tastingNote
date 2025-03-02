import React from "react";

interface Props {
    src: string | null;
}

const NormalImage = ({src}: Props) => {
    return <img
        src={src ?? "/images/wine.jpg"}
        alt="ワイン画像"
        className="w-128 object-cover rounded-lg border border-gray-300 shadow-md mx-auto"
    />;
}

export default NormalImage;