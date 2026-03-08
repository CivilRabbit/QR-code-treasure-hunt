// the popup element in currently showing
let popup: HTMLElement;

//the json containing the questions
const questions = await (await fetch("../../questions.json")).json();

/** Checks whether a question was correctly answered. If Correclty answerd a hint to the question is given. 
 * Else it urges you to try again
 * 
 * @param correct a voolean indicating whether this is the correct button
 * @param current the current stop in the hunt
 */

export function check(correct: Boolean, current: number){
    if (popup && popup.classList.contains("show")) popup.classList.toggle("show")
    if (correct){
        popup = document.getElementById("succes")!;
        popup.innerText = questions["Q"+current].hint
        document.cookie += document.cookie.length === current ? "progress=" + current + "; path=/" : "";
    } else{
        popup = document.getElementById("failure")!;
    }
    popup.classList.toggle("show");
}

/** checks whether the previous answer was solved correctly and builds the html accordingly
 *  @param current the current stop in the hunt
 */ 
export function hasPrev(current: number){
    if (document.cookie.length >= current){
        console.log(current)
        let tempQuestion = questions["Q"+current];
        const questionBox = document.getElementById("question")!;
        questionBox.innerText = tempQuestion.Q;
        let counter = 0;
        const buttonBox = document.getElementById("buttonBox")!;
        for (const answer of tempQuestion.Answers){
            const btn = document.createElement("button") as HTMLButtonElement;
            btn.classList= "niceButton";
            const correct = tempQuestion.correct === counter++;
            btn.onclick =  () => check(correct, current)
            btn.innerText = answer;
            buttonBox.appendChild(btn);
        }
    }
    else{
        alert("This is not the qr-code you are looking for ;)")
        const questionBox = document.getElementById("question")!;
        questionBox.innerText = "This is not the qr-code you are looking for ;)"
    }

}
