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