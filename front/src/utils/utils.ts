import {WineVariety as WineVarietyOld} from "@/types/wine";
import {WineVariety as WineVarietyDomain} from "@/types/domain/wine";
import {WineVariety} from "@/api/queryService/types/wine";

export const getVintageChoices = () => {
    let vintageChoices = [];
    const start = 1900;
    const end = new Date().getFullYear();
    for (let i = start; i <= end; i++) {
        vintageChoices.push(i);
    }
    return vintageChoices
}

export const getBlendPercentageChoices = (): number[] => {
    let blendPercentageChoices = [];
    const start = 1;
    const end = 100;
    for (let i = start; i <= end; i++) {
        blendPercentageChoices.push(i);
    }
    return blendPercentageChoices;
}

export const getAlcoholContentChoices = () => {
    let alcoholContentChoices = [];
    const start = 3;
    const end = 20;
    for (let i = start; i <= end; i += 0.5) {
        alcoholContentChoices.push(i);
    }
    return alcoholContentChoices;
}

export const resizeImage = (file: File, maxWidth: number, maxHeight: number): Promise<Blob> => {
    return new Promise((resolve, reject) => {
        const img = new Image();
        img.src = URL.createObjectURL(file);
        img.onload = () => {
            const canvas = document.createElement("canvas");
            let width = img.width;
            let height = img.height;

            // アスペクト比を維持しつつサイズ調整
            if (width > maxWidth || height > maxHeight) {
                const ratio = Math.min(maxWidth / width, maxHeight / height);
                width *= ratio;
                height *= ratio;
            }

            canvas.width = width;
            canvas.height = height;

            const ctx = canvas.getContext("2d");
            if (!ctx) return reject(new Error("Canvas context is null"));
            ctx.drawImage(img, 0, 0, width, height);

            canvas.toBlob((blob) => {
                if (blob) resolve(blob);
                else reject(new Error("Image compression failed"));
            }, "image/jpeg", 0.8); // JPEGフォーマットで画質80%に設定
        };
        img.onerror = reject;
    });
};

export const getWineVarietiesTextOld = (wineBlend: WineVarietyOld[]): string => {
    let wineVarietiesText = '';
    wineBlend.forEach((wineVariety, index) => {
        if (index === wineBlend.length - 1) {
            wineVarietiesText += wineVariety.name + ':' + wineVariety.percentage + '%';
            return;
        }
        wineVarietiesText += wineVariety.name + ':' + wineVariety.percentage + '%, ';
    });
    return wineVarietiesText;
}

export const getWineVarietiesText = (wineBlend: WineVariety[]): string => {
    let wineVarietiesText = '';
    wineBlend.forEach((wineVariety, index) => {
        if (index === wineBlend.length - 1) {
            wineVarietiesText += wineVariety.name + ':' + wineVariety.percentage + '%';
            return;
        }
        wineVarietiesText += wineVariety.name + ':' + wineVariety.percentage + '%, ';
    });
    return wineVarietiesText;
}


export const getWineVarietiesTextDomain = (wineBlend: WineVarietyDomain[]): string => {
    let wineVarietiesText = '';
    wineBlend.forEach((wineVariety, index) => {
        if (index === wineBlend.length - 1) {
            wineVarietiesText += wineVariety.name + ':' + wineVariety.percentage + '%';
            return;
        }
        wineVarietiesText += wineVariety.name + ':' + wineVariety.percentage + '%, ';
    });
    return wineVarietiesText;
}