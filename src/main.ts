
let popup: HTMLElement;

export function check(correct: Boolean){
    if (popup && popup.classList.contains("show")) popup.classList.toggle("show")
    if (correct){
        popup = document.getElementById("succes")!;
    } else{
        popup = document.getElementById("failure")!;
    }
    popup.classList.toggle("show");
}
