import React from "react";

const Grid = ({
                  children, number
              }: Readonly<{
    children: React.ReactNode;
    number?: number;
}>) => {
    return (
        <div className={`grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-${number ?? 3} gap-6`}>
            {children}
        </div>
    );
}

export default Grid;