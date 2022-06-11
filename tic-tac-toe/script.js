let gameStatus = document.getElementById("final-status");
let cpuLastTurn = 0;
let letterBoxes = [];
let letters = [];
let newGameButton = document.getElementById("start-game");
let mark = "";
let cpuScore = "0";
let playerScore = "0";
let cpuScoreDisplay = document.getElementById("cpu-score");
let playerScoreDisplay = document.getElementById("player-score");
let gameEnded = false;
let cpuConsecutive = 0;
let playerConsecutive = 0;
let lettersDown = [];
let cpuRandoPick;
let cpuNextMove;
let playerLastPick;
let selectedBox;

newGameButton.addEventListener("click",gameSetup);
gameSetup();

function gameSetup(){
    cpuRandoPick, cpuNextMove, playerLastPick, cpuConsecutive, playerConsecutive, cpuLastTurn = 0;
    gameEnded = false;
    gameStatus.style.visibility = "hidden";
    
    for(let i=0; i<9;i++){
        letterBoxes[i] = document.querySelectorAll(".box-display")[i];
        letters[i] = document.querySelectorAll(".box-display")[i].children[0];
        letters[i].innerText = "";
        letterBoxes[i].addEventListener("click",playerAction);
    }
}
function playerAction(){
    selectedBox = this;
    playerLastPick = parseInt(selectedBox.parentElement.id);
    markBox("X");
    if(!gameEnded){
        cpuTurn();
    }
}
function markBox(letter){
    selectedBox.children[0].innerText = letter;
    selectedBox.parentElement.classList.remove("box");
    selectedBox.removeEventListener("click",playerAction);
    gameStatusCheck();
}
function cpuTurn(){
    if(cpuLastTurn == 0){
        if(!letterBoxes[4].children[0].innerText){
            selectedBox = letterBoxes[4];
        }
        else{
            selectedBox = cpuPickRandom();
        }
        cpuLastTurn++;        
    }
    else if(cpuLastTurn == 1){
        cpuDefenseStrat();
    }
    markBox("O");
}
function cpuPickRandom(){
    let randoNum;
    
    do{
        randoNum = generateRandomNum();
    }while(letterBoxes[randoNum].children[0].innerText);
    cpuRandoPick = randoNum;
    return letterBoxes[randoNum];
}
function cpuDefenseStrat(){
    let boardArray = generateBoardArray();
    let currentMove;
    //COLUMN CHECK
    switch (playerLastPick){
        case 0:
        case 3:
        case 6:
            
            if(boardArray[playerLastPick + 1] == "X" && !boardArray[playerLastPick + 2]){
                currentMove = playerLastPick + 2;
            }
            break;
        case 1:
        case 4:
        case 7:
            if(boardArray[playerLastPick + 1] == "X" && !boardArray[playerLastPick - 1]){
                currentMove = playerLastPick - 1;
            }
            else if(boardArray[playerLastPick - 1] == "X" && !boardArray[playerLastPick + 1]){
                currentMove = playerLastPick + 1;
            }
            break;
        case 2:
        case 5:
        case 8:
            if(boardArray[playerLastPick - 1] == "X" && !boardArray[playerLastPick - 2]){
                currentMove = playerLastPick - 2;
            }
    }
    // ROW CHECK
    if(currentMove == undefined){
        switch(playerLastPick){
            case 0:
            case 1:
            case 2:
                if(boardArray[playerLastPick + 3] && !boardArray[playerLastPick + 6]){
                    currentMove = playerLastPick + 6;
                }
                break;
            case 3:
            case 4:
            case 5:
                if(boardArray[playerLastPick + 3] && !boardArray[playerLastPick - 3]){
                    currentMove = playerLastPick - 3;
                }
                else if(boardArray[playerLastPick - 3] && !boardArray[playerLastPick + 3]){
                    currentMove = playerLastPick + 3;
                }
                break;
            case 6:
            case 7:
            case 8:
                if(boardArray[playerLastPick - 3] && !boardArray[playerLastPick - 6]){
                    currentMove = playerLastPick - 6;
                }
        }
    }
    // CROSS CHECK
    if(currentMove == undefined){
        switch(playerLastPick){
            case 0:
                if(boardArray[playerLastPick + 4] == "X" && !boardArray[playerLastPick + 8]){
                    currentMove = playerLastPick + 8;
                }
                break;
            case 2:
                if(boardArray[playerLastPick + 2] == "X" && !boardArray[playerLastPick + 4]){
                    currentMove = playerLastPick + 4;
                }
                break;
            case 4:
                if(boardArray[playerLastPick - 2] == "X" && !boardArray[playerLastPick + 2]){
                    currentMove = playerLastPick + 2;
                }
                else if(boardArray[playerLastPick + 2] == "X" && !boardArray[playerLastPick - 2]){
                    currentMove = playerLastPick - 2;
                }
                break;
            case 6:
                if(boardArray[playerLastPick - 2] == "X" && !boardArray[playerLastPick - 4]){
                    currentMove = playerLastPick - 4;
                }
                break;
            case 8:
                if(boardArray[playerLastPick - 4] == "X" && !boardArray[playerLastPick - 8]){
                    currentMove = playerLastPick - 8;
                }
        }
    }
    if(currentMove == undefined){
        selectedBox = cpuPickRandom();
    }
    else{
        selectedBox = letterBoxes[currentMove];
    }

}
// function cpuAttackStrat(){
//     let currentMove;
//     for(let i=0; i<9;i++){
//         letters[i] = document.querySelectorAll(".box-display")[i].children[0].innerText;
//     }
//     switch(cpuRandoPick)
//     {
//         case 0:
//         case 3:
//         case 6:
//             if(!letters[cpuRandoPick + 1] && !letters[cpuRandoPick + 2]){
//                 currentMove = cpuRandoPick + 1;
//                 cpuNextMove = cpuRandoPick + 2;
//             }
//             break;
//         case 1:
//         case 4:
//         case 7:
//             if(!letters[cpuRandoPick - 1] && !letters[cpuRandoPick + 1]){
//                 currentMove = cpuRandoPick - 1;
//                 cpuNextMove = cpuRandoPick + 1;
//             }
//             break;
//     }
// }
function generateRandomNum(){
    return Math.floor(Math.random() * 9);
}
function generateBoardArray(){
    let boardArray = [];
    for(let i=0; i<9;i++){
        boardArray[i] = document.querySelectorAll(".box-display")[i].children[0].innerText;
    }
    return boardArray;
}
function gameStatusCheck(){
    if(!gameEnded)
    {
        let draw = true;
        for(let i=0; i<9;i++){
            letters[i] = document.querySelectorAll(".box-display")[i].children[0].innerText;
            if(!letters[i]){
                draw = false;
            }
        }
        checkCross();
        checkDown();
        checkHorizontal();
        if(draw && !gameEnded){
            endGame("draw");
        }
    }   
}
function checkCross(){
    let crossCheck = 0;
    let crossAdd = 4;
    for(let i=0; i<6;i++){
        if(letters[crossCheck] == "X"){
            playerConsecutive++;
        }
        else if(letters[crossCheck] == "O"){
            cpuConsecutive++;
        }
        if(i == 2 || i == 5){
            searchCombo();
        }        
        crossCheck += crossAdd;
        if(i == 2){
            crossCheck = 2;
            crossAdd = 2;
        }
    }
    resetCombo();
}
function checkDown(){
    let downCheck = 0;
    for(let i=0; i<9;i++){
        if(letters[downCheck] == "X"){
            playerConsecutive++;
        }
        else if(letters[downCheck] == "O"){
            cpuConsecutive++;
        }
        if(i == 2 || i == 5 || i==8){
            searchCombo();
        }
        downCheck += 3;
        if(i == 2){
            downCheck = 1;
        }
        if(i == 5){
            downCheck = 2;
        }
    }
    resetCombo();
}
function checkHorizontal(){
    for(let i=0; i<9;i++){
        if(letters[i] == "X"){
            playerConsecutive++;
        }
        else if(letters[i] == "O"){
            cpuConsecutive++;
        }
        if(i == 2 || i == 5 || i==8){
            searchCombo();
        }
    }
    resetCombo();
}
function searchCombo(){
    if(cpuConsecutive == 3 && !gameEnded){
        endGame("cpu");
    }
    else if(playerConsecutive == 3 && !gameEnded){
        endGame("player");
    }
    else{
        resetCombo();
    }
}
function resetCombo(){
    cpuConsecutive = 0;
    playerConsecutive = 0;
}
function endGame(success){
    for(let i = 0; i<9;i++){
        if(!letterBoxes[i].children[0].innerText){
            letterBoxes[i].parentElement.classList.remove("box");
            letterBoxes[i].removeEventListener("click",playerAction);
        }
    }
    let message = "DRAW";
    if(success == "player"){
        message = "YOU WIN!";
        playerScore++;
    }
    else if(success == "cpu"){
        cpuScore++;
        message = "YOU LOSE!";
    }
    else if(success == "draw"){
        message = "DRAW";
    }
    gameStatus.style.visibility = "visible";
    gameStatus.innerText = message;
    cpuScoreDisplay.innerText = cpuScore;
    playerScoreDisplay.innerText = playerScore;
    gameEnded = true;
}



