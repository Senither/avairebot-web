
const A = 5;
const B = 50;
const C = 100;

export function getLevelFromExperience(xp, modifier) {
    xp = Number(xp);
    modifier = Number(modifier);

    xp += getZeroExperienceForModifier(modifier);
    let x = (-B + Math.sqrt(Math.pow(B, 2) - ((4 * A) * ((C * (1 + modifier)) - Math.ceil(xp / (1 + modifier)))))) / (2 * A);

    return x < 0 ? 0 : Math.floor(x);
}

export function getExperienceFromLevel(level, modifier) {
    level = Number(level);
    modifier = Number(modifier);

    return Math.floor((A * Math.pow(level, 2) + (B * level) + (C * (1 + modifier))) * (1 + modifier));
}

export function getExperienceBetweenCurrentAndNextLevel(level, modifier) {
    level = Number(level);
    modifier = Number(modifier);

    return getExperienceFromLevel(level + 1, modifier) - getExperienceFromLevel(level, modifier);
}

export function getExperienceInCurrentLevel(level, experience, modifier) {
    level = Number(level);
    experience = Number(experience);
    modifier = Number(modifier);

    let zeroExperience = getZeroExperienceForModifier(modifier);
    let currentLevelXP = getExperienceFromLevel(level, modifier);

    return (experience - currentLevelXP) + zeroExperience;
}

export function getPercentageToNextLevel(level, experience, modifier) {
    level = Number(level);
    experience = Number(experience);
    modifier = Number(modifier);

    let zeroExperience = getZeroExperienceForModifier(modifier);
    let current = getExperienceFromLevel(level, modifier);
    let nextLevelXp = getExperienceFromLevel(level + 1, modifier);

    return ((experience - current + zeroExperience) / (nextLevelXp - current)) * 100;
}

function getZeroExperienceForModifier(modifier) {
    return getExperienceFromLevel(0, modifier) - 100;
}
