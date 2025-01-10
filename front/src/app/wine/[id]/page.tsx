const WineDetailPage = ({params}: {params: {id: string}}) => {
    return (
        <div>
            wine詳細: {params.id}
        </div>
    );
};

export default WineDetailPage;