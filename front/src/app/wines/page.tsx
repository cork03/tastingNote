import React from "react";

interface Wine {
    producer: {};
    id: number
    name: string;
    wineType: {};
    country: {}
}

const  Wines = () =>  {
  const initialWines = [{producer: {}, name: "ラターシュ",}];
  return (
      <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
        <section>
          <h2 className="text-2xl font-bold text-center mb-6">ワイン</h2>
          <div>
            <div className="mb-8 flex flex-row justify-center items-center gap-x-4 mx-auto">
              <input
                  type="text"
                  placeholder="ワインを検索"
                  className="w-full max-w-md p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
              />
            </div>
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
              {initialWines.map((wine) => {
                return (
                    <div
                        className="border rounded shadow p-4 text-center"
                    >
                      <img
                          src="/images/wine.jpg"
                          alt="生産者画像"
                          className="mx-auto mb-4"
                      />
                      <h3 className="text-lg font-semibold mb-2">ラターｼｭ</h3>
                      <p className="text-sm text-gray-600">DRC</p>
                      <p className="text-sm text-gray-600"></p>
                    </div>
                );
              })}
            </div>
          </div>
        </section>
      </main>
  );
}

export default Wines;