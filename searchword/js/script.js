'use strict';
let searchWords =
    [
        [],
        [],
        [],
        [],
        [],
        [],
        []
    ];
let userWord = [];
let clicked = 0;
let keyWords = [];
let hiddenWords = [];
let foundHiddenWords = [];
let totalWordsFound = 0;
let recentlyCleared = false;
let fire = 0;
let allFoundUserWords = [];

document.querySelector('.clear').addEventListener('click', clearAll);


newGame();

//console.log(searchWords[1][3]);
function newGame()
{
    for (let i = 0; i < 7; i++)
    {
        for (let j = 0; j < 7; j++)
        {
            //console.log('i = ' + i);
            let position = "";
            switch (i)
            {
                case 0: position = 'a' + (j + 1); break;
                case 1: position = 'b' + (j + 1); break;
                case 2: position = 'c' + (j + 1); break;
                case 3: position = 'd' + (j + 1); break;
                case 4: position = 'e' + (j + 1); break;
                case 5: position = 'f' + (j + 1); break;
                case 6: position = 'g' + (j + 1); break;
            }
            //console.log(typeof position, position);
            searchWords[i][j] = document.getElementById(position);
            //console.log(searchWords[i][j]);
            searchWords[i][j].textContent = randomLetter();

            // position += '#' + position;

            document.getElementById(position).addEventListener('click', letterDisplay);
            document.getElementById(position).addEventListener('mouseover', scaleUp);
            document.getElementById(position).addEventListener('mouseout', scaleDown);
        }
    }
    userWord = [];
    keyWords = [];
}


function scaleUp(item)
{
    item.target.style.transform = 'scale(1.75)';
}
function scaleDown(item)
{
    item.target.style.transform = 'scale(1)';
}

//........................CLICK FUNCTION.......................................
function letterDisplay(pos)
{
    //console.log('clicked ' + clicked);
    let wordP = pos.target.id;
    //console.log(wordP);
    fire++;

    if (fire < 7)
    {
        clicked++;
    }

    if (clicked <= 6)
    {
        //console.log(pos.getElementById);

        pos.target.removeEventListener('click', letterDisplay);
        pos.target.removeEventListener('mouseover', scaleUp);
        pos.target.removeEventListener('mouseout', scaleDown);

        pos.target.style.color = 'red';
        pos.target.style.textShadow = '1px 1px 0 white';
        pos.target.style.transform = 'scale(1.75)';


        let letterP = '.letter' + (clicked);
        document.querySelector(letterP).textContent = pos.target.textContent;

        userWord.push(wordP);

        //console.log(userWord.length);
        if (userWord.length >= 4)
        {
            checkWords();
        }


        // if (recentlyCleared)
        // {
        //     clicked = 0;
        //     recentlyCleared = false;
        // }
        console.log("incremented : " + clicked);
        // if (recentlyCleared == false)
        // {
        //     clicked++;
        // }

    }



    console.log(">>I FIRED << :" + fire + "TIMES")
}

function randomLetter()
{
    return String.fromCharCode(Math.trunc(Math.random() * (90 - (65 - 1)) + 65));
}

function randomGame()
{
    return Math.trunc((Math.random() * 3) + 1);
}

//.......................................CLEAR FUNCTION...........................................
function clearAll()
{
    //reseting the color and click of all the letters
    userWord = [];

    for (let i = 0; i < 7; i++)
    {
        for (let j = 0; j < 7; j++)
        {
            searchWords[i][j].addEventListener('click', letterDisplay);
            searchWords[i][j].style.color = 'white';
            searchWords[i][j].style.transform = 'scale(1)';
            searchWords[i][j].style.textShadow = 'none';
        }

        //console.log(searchWords[i][j].id + " " + foundHiddenWords[j]);
    }
    for (let i = 0; i < foundHiddenWords.length; i++)
    {
        for (let j = 0; j < searchWords.length; j++)
        {
            for (let k = 0; k < searchWords[j].length; k++)
            {
                // console.log(searchWords[j][k].id + " " + foundHiddenWords[i]);
                if (searchWords[j][k].id == foundHiddenWords[i])
                {
                    console.log(searchWords[j][k].id + " " + foundHiddenWords[i]);
                    searchWords[j][k].style.color = 'purple';
                    //searchWords[j][k].removeEventListener('click', letterDisplay);
                    searchWords[j][k].style.textShadow = '1px 1px 0 white';
                    searchWords[j][k].style.transform = 'scale(1.75)';
                }
            }
        }
    }


    for (let i = 0; i < 7; i++)
    {
        let letterP = '.letter' + (i + 1);
        //console.log(letterP);
        document.querySelector(letterP).textContent = '-';
    }

    clicked = 0;
    fire = 0;
}

function checkWords()
{
    let match = false;
    let foundWord = '';
    let foundMatch = false;


    for (let i = 0; i < 7; i++)
    {

        if (userWord.length == keyWords[i].length)
        {
            //console.log('userword : ' + userWord);
            //console.log('keywords : ' + keyWords[i]);
            for (let j = 0; j < userWord.length; j++)
            {
                //console.log('user: ' + userWord[j]);
                //console.log('key : ' + keyWords[i][j]);
                if (userWord[j] != keyWords[i][j])
                {

                    match = false;
                    console.log("false");
                }
                else
                {
                    match = true;
                    //console.log("true");
                }
            }
        }

        if (match)
        {
            for (let m = 0; m < userWord.length; m++)
            {
                foundHiddenWords.push(userWord[m]);
            }
            //console.log("found words : " + foundHiddenWords);

            //console.log("match started");
            for (let k = 0; k < keyWords[i].length; k++)
            {
                foundWord += document.getElementById(keyWords[i][k]).textContent;
            }
            //console.log(foundWord);
            for (let l = 0; l < hiddenWords.length - 1; l++)
            {
                if (foundWord == hiddenWords[i])
                {
                    hiddenWords[i] = hiddenWords[i].strike();
                    setHiddenWords();
                }
            }


            for (let z = 0; z < allFoundUserWords.length; z++)
            {
                if (foundWord == allFoundUserWords[z])
                {
                    foundMatch = true;
                }
            }
            if (foundMatch == false)
            {
                allFoundUserWords.push(foundWord);
                totalWordsFound++;
                console.log("NEW WORD FOUND! TOTAL WORDS FOUND : " + totalWordsFound + " " + allFoundUserWords);
            }

            userWord = [];
            clearAll();

            if (totalWordsFound == 7)
            {
                victory();
            }

            break;
        }
        else if (match == false && userWord.length >= 7)
        {
            alert("SELECTION IS NOT A HIDDEN WORD");
            clearAll();
            break;
        }
    }
}




game(0);
setHiddenWords();

function setHiddenWords()
{
    for (let i = 0; i < 7; i++)
    {
        let wordP = '.w' + (i + 1);
        document.querySelector(wordP).textContent = hiddenWords[i];

    }
}


function game(type)
{
    switch (type)
    {
        case 0:
            hiddenWords = ['CHERRY', 'ORANGE', 'APPLE', 'GRAPE', 'MANGO', 'KIWI', 'PEAR'];

            searchWords[0][0].textContent = 'Y';
            searchWords[0][1].textContent = 'R';
            searchWords[0][2].textContent = 'R';
            searchWords[0][3].textContent = 'E';
            searchWords[0][4].textContent = 'H';
            searchWords[0][5].textContent = 'C';

            let word1 = [searchWords[0][5].id, searchWords[0][4].id, searchWords[0][3].id, searchWords[0][2].id, searchWords[0][1].id, searchWords[0][0].id];
            keyWords.push(word1);

            searchWords[3][0].textContent = 'O';
            searchWords[3][1].textContent = 'R';
            searchWords[3][2].textContent = 'A';
            searchWords[3][3].textContent = 'N';
            searchWords[3][4].textContent = 'G';
            searchWords[3][5].textContent = 'E';

            let word2 = [searchWords[3][0].id, searchWords[3][1].id, searchWords[3][2].id, searchWords[3][3].id, searchWords[3][4].id, searchWords[3][5].id];
            keyWords.push(word2);

            searchWords[2][2].textContent = 'A';
            searchWords[2][3].textContent = 'P';
            searchWords[2][4].textContent = 'P';
            searchWords[2][5].textContent = 'L';
            searchWords[2][6].textContent = 'E';
            let word3 = [searchWords[2][2].id, searchWords[2][3].id, searchWords[2][4].id, searchWords[2][5].id, searchWords[2][6].id];
            keyWords.push(word3);

            searchWords[4][4].textContent = 'G';
            searchWords[4][3].textContent = 'R';
            searchWords[4][2].textContent = 'A';
            searchWords[4][1].textContent = 'P';
            searchWords[4][0].textContent = 'E';
            let word4 = [searchWords[4][4].id, searchWords[4][3].id, searchWords[4][2].id, searchWords[4][1].id, searchWords[4][0].id];
            keyWords.push(word4);

            searchWords[1][1].textContent = 'M';
            searchWords[2][2].textContent = 'A';
            searchWords[3][3].textContent = 'N';
            searchWords[4][4].textContent = 'G';
            searchWords[5][5].textContent = 'O';
            let word5 = [searchWords[1][1].id, searchWords[2][2].id, searchWords[3][3].id, searchWords[4][4].id, searchWords[5][5].id];
            keyWords.push(word5);

            searchWords[6][3].textContent = 'K';
            searchWords[6][2].textContent = 'I';
            searchWords[6][1].textContent = 'W';
            searchWords[6][0].textContent = 'I';
            let word6 = [searchWords[6][3].id, searchWords[6][2].id, searchWords[6][1].id, searchWords[6][0].id];
            keyWords.push(word6);

            searchWords[3][6].textContent = 'P';
            searchWords[2][6].textContent = 'E';
            searchWords[1][6].textContent = 'A';
            searchWords[0][6].textContent = 'R';
            let word7 = [searchWords[3][6].id, searchWords[2][6].id, searchWords[1][6].id, searchWords[0][6].id];
            keyWords.push(word7);



            break;
        case 1:

            break;

        case 2:

            break;
    }

}

function victory()
{
    for (let i = 0; i < 6; i++)
    {
        for (let j = 0; j < 6; j++)
        {
            searchWords[i][j].removeEventListener('click', letterDisplay);
        }        //console.log(searchWords[i][j].id + " " + foundHiddenWords[j]);
    }

    let victoryClasses = document.querySelectorAll('.victory');
    victoryClasses[0].style.visibility = "visible";
    victoryClasses[1].style.visibility = "visible";
}

