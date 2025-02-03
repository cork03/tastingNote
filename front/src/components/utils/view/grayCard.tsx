import React from "react";

const GrayCard = ({
                      children,
                  }: Readonly<{
    children: React.ReactNode;
}>) => {
    return (
        <div className="border rounded-lg shadow-lg p-6 bg-gray-100">
            {children}
        </div>
    );
}

export default GrayCard;