export function checkAreAllValuesOne(obj) {
    //checks if all values in a dictionary are 1 indicating the form has been filled out correctly
    for (let key in obj) {
        if (obj.hasOwnProperty(key) && obj[key] !== 1) {
            return false;
        }
    }
    return true;
}

export function returnFeedbackHTMl(obj) {
    //returns the feedback messages in html format from a form_feedback dictionary
    let returnHTML = "";
    for (let key in obj) {
        if (obj.hasOwnProperty(key) && obj[key] !== "") {
            returnHTML = returnHTML + obj[key];
        }
    }
    return returnHTML;
}