// the popup element in currently showing
let popup;


/** Checks whether a question was correctly answered. If Correclty answerd a hint to the question is given.
 * Else it urges you to try again
 *
 * @param correct a voolean indicating whether this is the correct button
 * @param current the current stop in the hunt
 */
function check(correct, current, hint="") {
    if (popup && popup.classList.contains("show")){
        popup.classList.remove("show");
    }

    if (correct) {
        popup = document.getElementById("success");
        popup.innerText = "Hint for next question: " + hint;
        document.cookie = "progress=" + (parseInt(current) + 1) + "; path=/";
    } else {
        popup = document.getElementById("failure");
        popup.innerText = "Not the correct answer. Maybe ask someone for help:)";
        
    }
    
    popup.classList.add("show");
}


document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".niceButton").forEach(btn => {
        btn.addEventListener("click", function () {
            const correct = this.dataset.correct === "1";
            const current = this.dataset.current;
            const hint    = this.dataset.hint || ""
            check(correct, current, hint);
        });
    });
});



document.addEventListener("submit", function(e){
    const form = document.getElementById("form");
    e.preventDefault();

    const input = document.getElementById("textBox");
    const value = input.value.trim();

    const correct = value === form.dataset.correct;

    check(correct, form.dataset.current, form.dataset.hint || "");
    input.value = "";
});