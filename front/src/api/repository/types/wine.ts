export interface UpdateWineBody {
    producerId: number;
    name: string;
    wineTypeId: number;
    countryId: number;
    appellationId: number | null;
}