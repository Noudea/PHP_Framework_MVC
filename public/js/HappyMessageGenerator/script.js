const happyMessage = [
    "Hello how are you ?",
    "You are beautiful today",
    "Have a great day",
    "You are my sunshine",
    "The world smile at you",
    "Take a good breath, today will be a good day",
    "Life is short, Time is fast, No replay, No rewind, So enjoy every moment as it comes"
]


happyMessage.forEach(element => {
    for (let index = 0; index < happyMessage.length; index++) {
        const happyMessage = [index][element];
    }
});

/**
 * @param int min and max 
 * 
 * @return int un chiffre random entre min et max inclus
 */
function random(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

let $elementHtml = document.getElementById("hapMsgGenContainer");
const div = document.getElementById("messageContainer");
const text = document.createElement('p');
text.classList.add("split-character")
text.classList.add("happyMessageText")
changeText()
$elementHtml.addEventListener('click', changeText)
document.body.addEventListener('click',changeBackgroundColor)

function changeText () 
{
text.innerText = happyMessage[random(0, happyMessage.length - 1)]
div.appendChild(text);
const salut = new Span;
salut.animation();
}

function changeBackgroundColor()
{
    const color = 
    [
        "#fef2d8",
        "#feecd8",
        "#ffdbc5",
        "#ffd3c6",
        "#ffcec7",
        "#ffc7c6",
        "#ffc5d1",
        "#ffc6e6",
        "#ffc6f3",
        "#c6daff",
        "#c7d4ff",
        "#c6ccff",
        "#c7c6ff",
        "#d1c6ff",
        "#dfc6ff",
        "#e7c6ff",
        "#f3c6ff",
        "#fcc7ff",
        "#c6e4ff",
        '#c6e9ff',
        "#c6f8ff",
        "#c7fffe",
        "#c6fef1",
        "#c6ffdf",
        "#c5ffcf",
        "#cfffc5",
        "#e2ffc5",
        "#edffc5",
        "#f7ffc6",
        "#fffec6",
    ]

    document.body.style.backgroundColor = color[random(0,color.length-1)]
}



