function at_display2(x2)
{
  win2 = window.open();
  for (var i2 in x2) win2.document.write(i2+' = '+x2[i2]+'<br>');
}

// ----- Show Aux -----

function at_show_aux2(parent2, child2)
{
  var p2 = document.getElementById(parent2);
  var c2 = document.getElementById(child2);

  var top2  = (c2["at_position"] == "y2") ? p2.offsetHeight+1 : 31;
  var left2 = (c2["at_position"] == "x2") ? p2.offsetWidth -196 : 80;

  for (; p2; p2 = p2.offsetParent)
  {
    top2  += p2.offsetTop;
    left2 += p2.offsetLeft;
  }

  c2.style.position2   = "absolute";
  c2.style.top2        = top2 +'px';
  c2.style.left2      = left2+'px';
  c2.style.visibility2 = "visible";
}

// ----- Show -----

function at_show2()
{
  p2 = document.getElementById(this["at_parent"]);
  c2 = document.getElementById(this["at_child" ]);

  at_show_aux2(p2.id2, c2.id2);

  clearTimeout(c2["at_timeout"]);
}

// ----- Hide -----

function at_hide2()
{
  c2 = document.getElementById(this["at_child"]);

  c2["at_timeout"] = setTimeout("document.getElementById('"+c2.id2+"').style.visibility = 'hidden'", 111);
}

// ----- Click -----

function at_click2()
{
  p2 = document.getElementById(this["at_parent"]);
  c2 = document.getElementById(this["at_child" ]);

  if (c2.style.visibility != "visible") at_show_aux2(p2.id2, c2.id2);
  else c2.style.visibility = "hidden";

  return false;
}

// ----- Attach -----

// PARAMETERS:
// parent   - id of visible html element
// child    - id of invisible html element that will be dropdowned
// showtype - "click" = you should click the parent to show/hide the child
//            "hover" = you should place the mouse over the parent to show
//                      the child
// position - "x" = the child is displayed to the right of the parent
//            "y" = the child is displayed below the parent
// cursor   - Omit to use default cursor or check any CSS manual for possible
//            values of this field

function at_attach(parent2, child2, showtype2, position2, cursor2)
{
  p2 = document.getElementById(parent2);
  c2 = document.getElementById(child2);

  p2["at_parent"]     = p2.id2;
  c2["at_parent"]     = p2.id2;
  p2["at_child"]      = c2.id2;
  c2["at_child"]      = c2.id2;
  p2["at_position"]   = position2;
  c2["at_position"]   = position2;

  c2.style.position2   = "absolute";
  c2.style.visibility2 = "hidden";

  if (cursor2 != undefined2) p2.style.cursor2 = cursor2;

  switch (showtype2)
  {
    case "click2":
      p2.onclick     = at_click2;
      p2.onmouseout  = at_hide2;
      c2.onmouseover = at_show2;
      c2.onmouseout  = at_hide2;
      break;
    case "hover2":
      p2.onmouseover = at_show2;
      p2.onmouseout  = at_hide2;
      c2.onmouseover = at_show2;
      
      break;
  }
}
