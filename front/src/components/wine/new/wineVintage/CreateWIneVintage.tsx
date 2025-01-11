"use client"

import React, {useEffect, useState} from "react";
import {Producer, Wine, WineType} from "@/app/wine/new/page";


const CreateWineVintage = () => {
    return (
        <section className="border-t pt-8">
            <form className="mx-auto space-y-4" >
                {/* 名前 */}
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        ワイン名
                    </label>
                    <input
                        type="text"
                        name="name"
                        placeholder="ワイン名を入力"
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
                        ワイン種別
                    </label>
                    <select
                        name="wineTypeId"
                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                    >
                        <option value={0}>
                            種別を選択してください
                        </option>
                    </select>
                </div>

                {/* ボタン */}
                <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
                    <button
                        type="submit"
                        className="bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                    >
                        作成
                    </button>
                    <button
                        className="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                    >
                        戻る
                    </button>
                </div>
            </form>
        </section>
    )
}

export default CreateWineVintage;