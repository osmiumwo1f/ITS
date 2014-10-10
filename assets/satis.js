var modal = document.getElementById("modal");
var shade = document.getElementById("shade");
var sgphid;

function show_modal(arg)
{
	modal.style.display = shade.style.display = 'block';
    return sgphid = arg;
}

function hide_modal()
{
	modal.style.display = shade.style.display = 'none';
}

function add_sti(a_id, a_ih)
{
    var sgph_div = document.getElementsByName("sgph");
    sgph_div[sgphid].removeChild(sgph_div[sgphid].childNodes[1]);
    var sgi = document.createElement("div");
    sgi.id = a_id;
    sgi.className = "sgi"
    sgi.setAttribute("name", "sgi");
    sgi.innerHTML = a_ih;
    sgph_div[sgphid].appendChild(sgi);
    sgi.appendChild(add_addBtn(sgi.className));
    var sgph = document.createElement("div");
    sgph.id = 1;
    sgph.className = "sgph";
    sgph.setAttribute("name", "sgph");
    var ctn = sgph_div[sgphid].parentNode;
    ctn.appendChild(sgph);
    sgph.appendChild(add_addBtn(sgph.className));
    set_sgph_id();
    hide_modal();
}

function set_sgph_id()
{
    var spgh_list = document.getElementsByName("sgph");
    for(i = 0;i < spgh_list.length ; i++)
    {
        spgh_list[i].id = i;
    }
}

function add_addBtn(parent)
{
    var btn = document.createElement("button");
    if(parent == "sgph")
    {
        btn.id = "";
        btn.innerHTML = "เพิ่มกลุ่ม";
        btn.setAttribute("onclick", "show_modal(this.parentNode.id)");
    }
    else if(parent == "sgi")
    {
        btn.id = "";
        btn.innerHTML = "เพิ่มหัวข้อ";
        btn.setAttribute("onclick", "show_modal(this.parentNode.id)");
    }
    return btn;
}

function del_node(parent)
{
    parent.removeChild(parent.childNodes[1]);
}

/*if(!('maxHeight' in document.body.style))
{
	function modalsize()
	{
		var top = document.documentElement.scrollTop;
		var winsize = document.documentElement.offsetHeight;
		var docsize = document.documentElement.scrollHeight;
		shade.style.height = Math.max(winsize, docsize)+'px';
		modal.style.top = top+Math.floor(winsize/3)+'px';
	};

	modal.style.position = shade.style.position = 'absolute';
	window.onscroll = window.onresize = modalsize;
	modalsize();
}*/
