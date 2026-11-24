let inputBirthDate = document.querySelector(".birthDatePicker").value; // Get value
const parentField = document.querySelector(".parentContainer");
const parentInfoText = document.querySelector("#parentInfoText");

function showParentfield() {
    parentField.classList.remove("hidden");
    parentField.classList.add("show");
    parentInfoText.classList.remove("hidden");
    parentInfoText.classList.add("show");
}

function hideParentfield() {
    parentField.classList.remove("show");
    parentField.classList.remove("show");
    parentInfoText.classList.add("hidden");
    parentInfoText.classList.add("hidden");
}

function calculateAge(birthDate) {
    const today = new Date();

    let years = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    const dayDiff = today.getDate() - birthDate.getDate();

    // If birthday has not occurred this year yet, subtract 1
    if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
        years--;
    }

    if (years < 16) {
        showParentfield();
    } else {
        hideParentfield();
    }
    return years;
}

calculateAge(inputBirthDate);
