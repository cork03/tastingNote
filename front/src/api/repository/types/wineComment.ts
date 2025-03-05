export interface UpdateWineCommentBody {
    wineVintageId: number;
    appearance: string;
    aroma: string;
    taste: string;
    anotherComment: string | null;
}