class Span {
    constructor(text) {
        this._text = text;
        this._newText = '';
    }

    set text(param) {
        this._text = param
    }

    get text() {
        return this._text
    }

    animation() {
        let elements = document.getElementsByClassName('split-character');
        let newContent = "";
        // on stock tous les objets du DOM ayant la classe "split-character" dans un tableau "elements"
        
        // pour chaque objet du DOM ayant la classe "split-character"
        for (let index = 0; index < elements.length; ++index) {
            // on initialise la variable qui va contenir le nouveau contenu en ouvrant le span qui contiendra le premier mot
            newContent += "<span>"
            // pour chaque caractère existant dans cet objet
            for (let character = 0; character < elements[index].innerText.length; character++) {
                // si c'est un caractère on le met dans un span
                if (elements[index].innerText[character] !== " ") {
                    // Pour que chaque lettre apparaisse après l'autre, on ajoute un délai de 35 millisecondes entre chacune d'elle.
                    newContent += "<span style='animation-delay: " + 0.060 * character + "s'>" + elements[index].innerText[character] + "</span>";
                }
                // si c'est un espace vide c'est la fin d'un mot, on ferme le span qui englobe ce mot et on ouvre le span du mot suivant (tout en gardant l'espace)
                else {
                    newContent += "</span> <span>";
                }
            }
            // on ferme le span du dernier mot
            newContent += "</span>"
            // on remplace le contenu actuel par notre nouveau contenu
            elements[index].innerHTML = newContent;
            // on réinitialise la variable newContent puisqu'elle va accueillir le contenu de l'objet suivant dans la boucle
            newContent = "";
        }
    }
}