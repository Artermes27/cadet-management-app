export function checkAreAllValuesOne(obj) {
        for (let key in obj) {
        if (obj.hasOwnProperty(key) && obj[key] !== 1) {
            return false;
        }
    }
    return true;
}

export function returnFeedbackHTMl(obj) {
        let returnHTML = "";
    for (let key in obj) {
        if (obj.hasOwnProperty(key) && obj[key] !== "") {
            returnHTML = returnHTML + obj[key];
        }
    }
    return returnHTML;
}