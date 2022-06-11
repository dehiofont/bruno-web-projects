//BOMB-DIFFUSE GAME - BRUNO FONTANETTI

//BEHOLD MY COLLECTION OF TOO MANY VARIABLES
let wordBox = document.getElementById("letter-boxes");
let wordArray = [];
let word = "dog";
let difficulty = document.getElementById("difficulty-selector");
let attempts = 10;
let incorrectGuesses = 0;
let playerAttempts = document.getElementById("player-attempts");
let incorrectLetters = document.getElementById("incorrect-letters");
let alphabet ="abcdefghijklmnopqrstuvwxyz  ";
let alphabetSelect = [];
let inputContainer = document.getElementById("input-container");
let newGameButton = document.getElementById("new-game");
let displayImg = document.getElementById("display-img");
let timeDisplay = document.getElementById("timer");
let timeContainer = document.getElementById("timer-continer");
let audioCorrect = new Audio("correct.wav");
let audioIncorrect = new Audio("incorrect.wav");
let audioExplosion = new Audio("explosion.wav");
let audioWin = new Audio("win.wav");
let audioClick = new Audio("click.wav");
let definition = document.getElementById("definition");
let defContainer = document.getElementById("definition-container");
let buttonReveal = document.getElementById("reveal-def");
let apiDefintion ="";

//API CALL START
fetchText();
//AUDIO VOLUME ADJUSTMENT
audioIncorrect.volume = 0.1;
audioExplosion.volume = 0.2;
audioWin.volume = 0.2;
//SETTING UP CLICK FUNCTIONS FOR BUTTONS
newGameButton.addEventListener("click", fetchText);
newGameButton.onclick = function(){audioClick.play()};
buttonReveal.addEventListener("click",showDefinition); 

//API CALL TO GET RANDOM WORD
async function fetchText() {
    let response = await fetch('https://random-word-api.herokuapp.com/word');
    if (response.status === 200) {
        let data = await response.text();
        data = data.replace(/[\[\]"]+/g,'');
        // handle data
        console.log("rando word api worked :" + data);
        if(data.length > 9){
            fetchText();
        }
        else{
            fetchDefinition(data);
        }        
    }
}

//API CALL TO GET THE DEFINITION OF THE RANDOM WORD
async function fetchDefinition(apiWord) {
    let response = await fetch("https://api.dictionaryapi.dev/api/v2/entries/en/" + apiWord);
    let apiObject ="";
    if (response.status === 200) {
        let data = await response.text();
        apiObject = JSON.parse(data);
        console.log("definition api worked :" + apiObject);
    }
    boardSetup(apiWord, apiObject);
}

//SETTING UP THE BOARD BY SETTING EVERYTHING TO DEFAULT
function boardSetup(apiWord, apiObject){
    definition.innerText = "Could not find definition.";
    console.log(apiObject);
    if(apiObject){
        apiDefintion = apiObject[0].meanings[0].definitions[0].definition;
        definition.innerText = apiDefintion;
    }
    resetDefinition();
    word = apiWord;
    while (inputContainer.firstChild) {
        inputContainer.removeChild(inputContainer.firstChild);
    }
    while (wordBox.firstChild) {
        wordBox.removeChild(wordBox.firstChild);
    }
    setDifficulty();
    playerAttempts.innerText = attempts;
    setupKeyboard();
    letterRevealSetup();
    incorrectGuesses = 0;
    displayImg.src = "bomb.png";
    timeDisplay.innerText = "";
    setTimerDisplay();
    timeContainer.style.visibility = "visible";
    displayImg.style.height = "150%";
}

function setDifficulty(){
    
    switch(difficulty.value){
        case "easy" :
            attempts = 10;
            break;
        case "moderate" :
            attempts = 6;
            break;
        case "hard" :
            attempts = 3;
            break;
        default:
            attempts = 10;
    }
}

function showDefinition(){
    buttonReveal.style.display = "none"
    defContainer.style.display = "block"
}

function resetDefinition(){
    buttonReveal.style.display = "inline"
    defContainer.style.display = "none"
}

function letterRevealSetup(){
    for(let i=0;i<word.length;i++)
    {
        //CREATING CONTAINER FOR LETTER
        let newLetterBox = document.createElement("div");
        newLetterBox.classList.add("letter-input");    
        newLetterBox.id = "letter" + i;
        let newLetter = document.createElement("p");
        newLetter.id = "correct-letter" + i;
        newLetter.classList.add("correct-letter");
        //ADDING NEW ELEMENTS TO NEW DIV
        newLetterBox.appendChild(newLetter);
        wordBox.appendChild(newLetterBox);        
        wordArray[i] = newLetterBox;
    }
}

//CONFIRM BUTTON LOGIC
function sortingPlayerGuess(playerGuess){    
    let playerInput = playerGuess.firstChild.innerText;
    let letterMatched = false;
    //COMPARING USER INPUT TO SECRET WORD
    for(let i=0;i<word.length;i++)
    {       
        if(word[i].toUpperCase() === playerInput.toUpperCase()){
            correctLetter(i, playerInput);
            letterMatched = true; 
        }                
    }
    if(!letterMatched)
    {
        incorrectLetter(playerGuess);
    }
    clearLetterBox(playerGuess);
}

function correctLetter(letterNum, playerInput){
    audioCorrect.play();
    let correctInput = document.getElementById("correct-letter" + letterNum);
    correctInput.innerText = playerInput;
    let guessedWord = "";
    for(let i=0; i<word.length;i++)
    {
        guessedWord += document.getElementById("correct-letter" + i).innerText;
    }
    console.log(guessedWord + " and " + word);
    if(guessedWord === word.toUpperCase())
    {
        endOfGameScenario(true);
    }
}

function incorrectLetter(playerGuess){
    audioIncorrect.play();
    console.log("incorrect guess :" + playerGuess);
    incorrectGuesses++;
    playerAttempts.innerText = attempts - incorrectGuesses;
    setTimerDisplay();
    if(incorrectGuesses >= attempts)
    {
        endOfGameScenario(false);
    }
}

function endOfGameScenario(winScenario){
    let endText = "";
    showDefinition()
    for(let i=0;i<alphabet.length;i++){
        clearLetterBox(inputContainer.children[i]);
    }
    if(winScenario){
        console.log("you win");
        endText = "++++++++++++++++++++++++++++";
        audioWin.play();
    }
    else{
        console.log("you lose");
        endText = "----------------------------";
        displayImg.src = "explosion.png";
        displayImg.style.height = "100%";
        audioExplosion.play();
        timeContainer.style.visibility = "hidden";
        for(let i=0;i<word.length;i++){
            wordBox.children[i].children[0].innerText = word[i];
        }
    }
    setEndDisplay(endText);
}

function setEndDisplay(endText){
    defContainer.style.visibility = "visible";
    for(let i=0;i<endText.length;i++){
        let winDisplay = document.createElement("p");
        winDisplay.classList.add("letter-select-display");
        winDisplay.innerText = endText[i];
        inputContainer.children[i].appendChild(winDisplay);
    }
}

function clearLetterBox(box){
        let blankSelectionBox = document.createElement("div");
        blankSelectionBox.classList.add("selection-box");
        box.replaceWith(blankSelectionBox);
}

function setupKeyboard(){
    for(let i=0;i<28;i++)
    {
        let newContainer = document.createElement("div");
        newContainer.classList.add("selection-box");
        newContainer.id = "selection-box" + i;
        newContainer.addEventListener("mouseenter", function(){this.classList.toggle("letter-hover");});
        newContainer.addEventListener("mouseleave", function(){this.classList.toggle("letter-hover");});
        newContainer.addEventListener("mousedown", function(){this.classList.toggle("letter-click");});
        newContainer.addEventListener("mouseup", function(){
            sortingPlayerGuess(this);
        });
        let newAlphaSelect = document.createElement("p");
        newAlphaSelect.classList.add("letter-select-display");
        newAlphaSelect.innerText = alphabet[i];
        newContainer.appendChild(newAlphaSelect);
        inputContainer.appendChild(newContainer);

        if(i>=26)
        {
            clearLetterBox(inputContainer.children[i]);
        }
    }
}

function setTimerDisplay(){
    if(playerAttempts.innerText < 10){
        timeDisplay.innerText = "0" + playerAttempts.innerText;
    }
    else{
        timeDisplay.innerText = playerAttempts.innerText;
    }
}