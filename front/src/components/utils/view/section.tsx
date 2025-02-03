import React from "react";
const Section = ({
                   children,
               }: Readonly<{
    children: React.ReactNode;
}>) => {
    return (
        <section className=" space-y-6 mx-auto bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            {children}
        </section>
    );
}

export default Section;