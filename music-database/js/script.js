
//changeBand();

//alert("hi");


function changeShirtAttribute()
{
    let color = document.getElementById("colorselect").value;
    let style = document.getElementById("styleselect").value;

    if (color == "Color Selection")
    {
        color = "black";
    }
    if (style == "Style Selection")
    {
        style = "shirt_short";
    }

    //alert(color, style);

    if (style == 'tanktop')
    {
        document.getElementById("bandpic").classList.remove("bandbox");
        document.getElementById("bandpic").classList.add("bandboxtank");
        console.log('shifttrue');
    }
    else
    {
        document.getElementById("bandpic").classList.add("bandbox");
        document.getElementById("bandpic").classList.remove("bandboxtank");
        console.log('shiftfalse');
    }


    document.getElementById("s_stylecolor").src = "img/" + style + "/" + color + ".png";
    // document.getElementById("t_stylecolor").innerHTML = "img/" + style + "/" + color + ".png";
    console.log(color);
    console.log(style);
}

function changeBand()
{
    let band = document.getElementById("bandselect").value;

    console.log(band);

    if (band == "Band Selection")
    {
        band = "beatles";
    }

    //alert(band);


    document.getElementById("s_band").src = "img/band/" + band + ".png";
    // document.getElementById("t_band").innerHTML = "img/band/" + band + ".png";
}

function changeSize()
{
    let size = document.getElementById("sizeselect").value;

    if (size == "Size Selection")
    {
        size = "medium";
    }

    //document.getElementById("s_band").src = "img/size/" + size + ".png";
    document.getElementById("s_size").innerHTML = size.toUpperCase();
    document.getElementById("t_size").innerHTML = size.toUpperCase();
}




//bs, cs, ss, sts
// document.getElementById("shirttext").innerHTML = "img/" + style + "/" + color;
//document.getElementById("shirtimg").src = "img/" + style + "/" + color;

