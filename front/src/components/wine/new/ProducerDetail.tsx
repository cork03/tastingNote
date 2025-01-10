import {Producer} from "@/app/wine/new/page";

const ProducerDetail = ({producer}: {producer: Producer}) => {
    return (
        <div className="border rounded shadow p-4 text-center">
            <img
                src="/images/domaine.webp"
                alt="生産者画像"
                className="mx-auto mb-4"
            />
            <h3 className="text-lg font-semibold mb-2">{producer.name}</h3>
            <p className="text-sm text-gray-600">
                こちらは生産者の説明文です。生産者の特徴や背景を簡単に説明します。
            </p>
        </div>
    )
}

export default ProducerDetail;