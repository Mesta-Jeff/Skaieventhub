function getInputElement(e) { return document.getElementById("digit" + e + "-input") } function moveToNext(e, t) { t = t.which || t.keyCode; 1 === getInputElement(e).value.length && (6 !== e ? getInputElement(e + 1).focus() : (getInputElement(e).blur(), console.log("submit code"))), 8 === t && 1 !== e && getInputElement(e - 1).focus() };


function validateInput(event) {
    const input = event.target;
    const inputValue = input.value;
    const numericValue = inputValue.replace(/\D/g, '');
    const truncatedValue = numericValue.substring(0, 1);
    input.value = truncatedValue;
}
