import React from "react";
import {Producer} from "@/types/domain/producer";
import ProducerDetail from "@/components/producers/ProducerDetail";

const ProducerCreatePage = async () => {
    const data = await fetch(`${process.env.API_URL}/producers`);
    const producers: Producer[] = await data.json();
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <div className="text-center mb-8">
                <h2 className="text-3xl font-extrabold text-gray-800 mb-4">生産者</h2>
            </div>
            <section className="mx-auto bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                <div className="space-y-6">
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-center">
                        {producers.map((producer) => {
                            return <ProducerDetail producer={producer} key={producer.id}/>
                        })}
                    </div>
                </div>
            </section>
        </main>
    );
};

export default ProducerCreatePage;