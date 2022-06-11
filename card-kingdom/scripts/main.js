
const heroCard = new Card("hero", 2);

console.log(heroCard);

dragElement(document.querySelector(".card"));

function dragElement(elmnt) {
  let pos1 = 0,
    pos2 = 0,
    pos3 = 0,
    pos4 = 0;

  elmnt.onmousedown = dragMouseDown;

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = elmnt.offsetTop - pos2 + "px";
    elmnt.style.left = elmnt.offsetLeft - pos1 + "px";
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}

let expandButton = document.querySelector(".expand-button");
let expansion = document.querySelector(".card-expansion-2");
let pos = 0;
expandButton.onclick = toggleExpansion;

function toggleExpansion() {
  let id = null;
  clearInterval(id);
  if(expansion.style.left == "215px"){
    id = setInterval(collapseCard, 1);
  }
  else{
    id = setInterval(expandCard, 1);
  }
  function expandCard() {
    if (pos == 215) {
      clearInterval(id);
    } else {
      pos += 5;
      expansion.style.left = pos + "px";
    }
    // console.log(expandButton.left)
  }
  function collapseCard() {
    if (pos == 0) {
      clearInterval(id);
    } else {
      pos -= 5;
      expansion.style.left = pos + "px";
    }
  }
}