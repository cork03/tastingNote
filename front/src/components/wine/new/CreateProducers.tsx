"use client"

import React, {useState} from "react";

const CreateProducers = () => {
    const [producerData, setProducerData] = useState({name: ''});
    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setProducerData({...producerData, [e.target.name]: e.target.value});
    }
    const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        try {
            const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/producer`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(producerData)
            })
            if (!response.ok) {
                throw new Error('Failed to create producer');
            }
        } catch (error) {
            console.error(error);
        }
    }
    return (
        <section className="border-t pt-8">
            <h3 className="text-xl font-bold text-center mb-6">新しい生産者を作成</h3>
            <form className="mx-auto space-y-4" onSubmit={handleSubmit}>
                {/* 名前 */}
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        生産者名
                    </label>
                    <input
                        type="text"
                        name="name"
                        value={producerData.name}
                        onChange={handleChange}
                        placeholder="生産者名を入力"
                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                    />
                </div>

                {/* 画像URL */}
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        画像URL
                    </label>
                    <input
                        type="text"
                        placeholder="画像のURLを入力"
                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                    />
                </div>

                {/* 説明 */}
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        説明
                    </label>
                    <textarea
                        placeholder="生産者の説明を入力"
                        rows={4}
                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                    ></textarea>
                </div>

                {/* ボタン */}
                <div className="text-center">
                    <button
                        type="submit"
                        className="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-400"
                    >
                        作成
                    </button>
                </div>
            </form>
        </section>
    )
}

export default CreateProducers;