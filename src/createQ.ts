import * as fs from 'fs'
import * as path from 'node:path'

async function main(){
    const fileContent = fs.readFileSync("questions.json")
    const json = await JSON.parse(fileContent.toString('utf8'));
    for (const question in json){
        if (!fs.existsSync(`src/${question}`)){
            fs.mkdirSync(`src/${question}`);
            fs.appendFileSync(`src/${question}/index.html`, getHtml(Number.parseInt(question.charAt(1))))
        }
    }
}

type question = {
    Q:string
    Answer: string[]
    correct: number
    hint: string
} 
function getHtml(n:number) :string{
    return `
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="./../style.css">
    <meta charset="UTF-8" />
    <title> QR-code-treasure-hunt </title>
</head>
<body>
    <div class="box" id="box">
    <h1 class="question" id="question"></h1>
        <div class="buttonBox" id="buttonBox"></div>
    <div class="popup">
        <span class="popuptext" id="succes">HINT</span>
        <span class="popuptext" id="failure">TRY AGAIN</span>
    </div>

    </div>
    <script type="module">
        import {hasPrev, check } from "./../main.ts";
        hasPrev(${n});
        document.getElementById("succes").onclick = () => document.getElementById("succes")?.classList.toggle("show");
        document.getElementById("failure").onclick = () => document.getElementById("failure")?.classList.toggle("show");
        
    </script>
</body> 
`;
}


main()