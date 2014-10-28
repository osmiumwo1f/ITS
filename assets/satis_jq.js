var id, sgphid, current_sgphid, cls, role;
$(document).ready(function(){
    $('div.content').on('click', 'button.add,button.edit', function(event){
        $('#modal').show();
        $('#shade').show();

        cls = $(event.target).attr('class');
        role = $(event.target).attr('data-btnrole');
        //console.log(cls+" "+role+" "+$(event.target).parents().siblings('div.sgi').attr('id'));
        get_si(role, $(event.target).parents().siblings('div.sgi').attr('id'));

        //siphc = $(event.target).parent().attr('class');
        id = $(event.target).parent().attr('id');
        sgphid = parseInt($(event.target).parents('div.sgph').attr('id'));
        //console.log(siphc+" "+sgphid);
    })

    $('button.close').click(close_modal);

    $('div.content').on('click', 'button.del', function(event){
        if($(event.target).attr('data-btnrole') == 'satis_group') {
        	$(event.target).parents('div.sgph').remove();
        	sort_sgph();
        }
        else if($(event.target).attr('data-btnrole') == 'satis_topics') {
        	$(event.target).parents('div.sti').remove();
        }
    })

    $('div.content').on('click', 'button.up', function(event){
        var i = $(event.target).parent().siblings('div');
        console.log(i.attr('class')+" "+i.length);
        if(i.length > 0){
            if(i.attr('class') == 'sti'){
                $(event.target).parent().detach().insertBefore(i);
            }
            else{
                i = $(event.target).parents('div.sgph').prev('div.sgph');
                if(i.length > 0){
                    $(event.target).parents('div.sgph').detach().insertBefore(i);
                }
            }
        }
        console.log(i.attr('class')+" "+i.length);
    })

    $('div.content').on('click', 'button.down', function(event){
        var i = $(event.target).parent().next('div');
        if(i.length > 0){
            if(i.attr('class') == 'sti'){
                $(event.target).parent().detach().insertAfter(i);
            }
            else{
                i = $(event.target).parents('div.sgph').next('div.sgph');
                if(i.length > 0){
                    $(event.target).parents('div.sgph').detach().insertAfter(i);
                }
            }
        }
        console.log(i.attr('class')+" "+i.length);
    })

    $('div#si_container').on('click', '.si', function(event){
        if(cls == 'add') {
        	if(role == 'satis_group') {
        		$('div#'+sgphid+'.sgph').append('<div id="'+event.target.id+'" class="sgi" data-scoretype="">'+event.target.innerHTML+'</div>');
        		$('div#'+sgphid+'.sgph').children('*[data-btnrole="satis_group"]').remove();
        		$('div#'+sgphid+'.sgph').children('div#'+event.target.id+'.sgi').append('<button class="up" data-btnrole="satis_group">ขึ้น</button><button class="down" data-btnrole="satis_group">ลง</button><button class="edit" data-btnrole="satis_group">เปลี่ยนกลุ่ม</button><button class="del" data-btnrole="satis_group">ลบกลุ่ม</button>');
        		$('div#'+sgphid+'.sgph').append('<div class="scph"></div>');
        		$('div#'+sgphid+'.sgph').children('div.scph').append('<button class="add" data-btnrole="score_type">เกณฑ์การให้คะแนน</button>');
        		$('div#'+sgphid+'.sgph').append('<div class="stph"></div>');
        		$('div#'+sgphid+'.sgph').children('div.stph').append('<button class="add" data-btnrole="satis_topics">เพิ่มหัวข้อ</button>');
        		$('div#'+sgphid+'.sgph').parent().append('<div class="sgph" id="0"><button class="add" data-btnrole="satis_group">เพิ่มกลุ่ม</button></div>');
        		sort_sgph();
        	}
        	else if(role == 'satis_topics') {
        		$('div#'+sgphid+'.sgph').children('div.stph').append('<div id="'+event.target.id+'" class="sti">'+event.target.innerHTML+'</div>');
        		$('div#'+sgphid+'.sgph').find('*[class="add"][data-btnrole="satis_topics"]').remove();
        		$('div#'+sgphid+'.sgph').find('div#'+event.target.id+'.sti').append('<button class="up" data-btnrole="satis_topics">ขึ้น</button><button class="down" data-btnrole="satis_topics">ลง</button><button class="edit" data-btnrole="satis_topics">เปลี่ยนหัวข้อ</button><button class="del" data-btnrole="satis_topics">ลบหัวข้อ</button>');
        		$('div#'+sgphid+'.sgph').children('div.stph').append('<button class="add" data-btnrole="satis_topics">เพิ่มหัวข้อ</button>');
        	}
        	else if(role == "score_type") {
        		$('div#'+sgphid+'.sgph').children('div.sgi').attr('data-scoretype', event.target.id);
        		$('div#'+sgphid+'.sgph').find('*[data-btnrole="score_type"]').remove();
        		$('div#'+sgphid+'.sgph').children('div.scph').append('<button class="edit" data-btnrole="score_type">เปลี่ยนเกณฑ์</button>');
        	}
        }
        else if(cls == 'edit') {
        	if(role == 'satis_group') {
        		if(event.target.id == $('div#'+sgphid+'.sgph').children('div.sgi').attr('id')) {
        			alert("เลือกกลุ่มเดิม");
        		}
        		else {
        			$('div#'+sgphid+'.sgph').children('div.sgi').attr('id', event.target.id);
        			$('div#'+sgphid+'.sgph').children('div.sgi').html(event.target.innerHTML+'<button class="up" data-btnrole="satis_group">ขึ้น</button><button class="down" data-btnrole="satis_group">ลง</button><button class="edit" data-btnrole="satis_group">เปลี่ยนกลุ่ม</button><button class="del" data-btnrole="satis_group">ลบกลุ่ม</button>');
        			$('div#'+sgphid+'.sgph').children('div.stph').find('*').remove();
        			$('div#'+sgphid+'.sgph').children('div.stph').append('<button class="add" data-btnrole="satis_topics">เพิ่มหัวข้อ</button>');
        		}
        	}
        	else if(role == 'satis_topics') {
        	    //console.log(siphc);
        		$('div#'+id+'.sti').html(event.target.innerHTML+'<button class="up" data-btnrole="satis_topics">ขึ้น</button><button class="down" data-btnrole="satis_topics">ลง</button><button class="edit" data-btnrole="satis_group">เปลี่ยนกลุ่ม</button><button class="del" data-btnrole="satis_group">ลบกลุ่ม</button>');
                $('div#'+id+'.sti').attr('id', event.target.id);
        	}
        	else if(role == "score_type") {
        		$('div#'+sgphid+'.sgph').children('div.sgi').attr('data-scoretype', event.target.id);
        		$('div#'+sgphid+'.sgph').find('*[data-btnrole="score_type"]').remove();
        		$('div#'+sgphid+'.sgph').children('div.scph').append('<button class="edit" data-btnrole="score_type">เปลี่ยนเกณฑ์</button>');
        	}
        }
        close_modal();
    })

    $('button.convert2json').click(function(){
        alert(FormatJSON(toTransform($('div.satis_form').children())));
        var json_obj = $.parseJSON(FormatJSON(toTransform($('div.satis_form').children())));
        itj(json_obj);
        json_str = JSON.stringify(json_obj);
        alert(json_str);
    });
});

function itj(tree){
    $.each(tree, function(i, v){
        if(v.tag == 'button'){
            delete v;
        }
        if(v.children){
            console.log(v.tag);
            itj(v.children);
        }
    })
}


function sort_sgph() {
	var e = $('div.sgph');
	for(i = 0; i < e.length; i++) {
		e[i].id = i;
	}
}

function close_modal() {
	$('#modal').hide();
	$('#shade').hide();
}

function get_si(type, id, list) {
	if(list === undefined) {
		list = false;
	}

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'http://localhost:8080/its/index.php/satis/ajax/',
		data: {'type': type, 'id': id, 'list': list
			}
			,
		success: function(resp) {
				$('div#si_container').html(resp);
	    }
	});
}
//This part of script came from http://json2html.com
//Convert obj or array to transform
function toTransform(obj) {

    var json;

    if( obj.length > 1 )
    {
        json = [];

        for(var i = 0; i < obj.length; i++)
            json[json.length++] = ObjToTransform(obj[i]);
    } else
        json = ObjToTransform(obj);

    return(json);
}

//Convert obj to transform
function ObjToTransform(obj)
{
    //Get the DOM element
    var el = $(obj).get(0);

    //Add the tag element
    var json = {'tag':el.nodeName.toLowerCase()};

    for (var attr, i=0, attrs=el.attributes, l=attrs.length; i<l; i++){
        attr = attrs[i];
        json[attr.nodeName] = attr.value;
    }

    var children = $(obj).children();

    if( children.length > 0 ) json['children'] = [];
    else json['html'] = $(obj).text();

    //Add the children
    for(var c = 0; c < children.length; c++)
        json['children'][json['children'].length++] = toTransform(children[c]);

    return(json);
}

//Format JSON (with indents)
function FormatJSON(oData, sIndent) {
    if (arguments.length < 2) {
        var sIndent = "";
    }
    var sIndentStyle = "  ";
    var sDataType = RealTypeOf(oData);

    // open object
    if (sDataType == "array") {
        if (oData.length == 0) {
            return "[]";
        }
        var sHTML = "[";
    } else {
        var iCount = 0;
        $.each(oData, function() {
            iCount++;
            return;
        });
        if (iCount == 0) { // object is empty
            return "{}";
        }
        var sHTML = "{";
    }

    // loop through items
    var iCount = 0;
    $.each(oData, function(sKey, vValue) {
        if (iCount > 0) {
            sHTML += ",";
        }
        if (sDataType == "array") {
            sHTML += ("\n" + sIndent + sIndentStyle);
        } else {
            sHTML += ("\"" + sKey + "\"" + ":");
        }

        // display relevant data type
        switch (RealTypeOf(vValue)) {
            case "array":
            case "object":
                sHTML += FormatJSON(vValue, (sIndent + sIndentStyle));
                break;
            case "boolean":
            case "number":
                sHTML += vValue.toString();
                break;
            case "null":
                sHTML += "null";
                break;
            case "string":
                sHTML += ("\"" + vValue + "\"");
                break;
            default:
                sHTML += ("TYPEOF: " + typeof(vValue));
        }

        // loop
        iCount++;
    });

    // close object
    if (sDataType == "array") {
        sHTML += ("\n" + sIndent + "]");
    } else {
        sHTML += ("}");
    }

    // return
    return sHTML;
}

//Get the type of the obj (can replace by jquery type)
function RealTypeOf(v) {
  if (typeof(v) == "object") {
    if (v === null) return "null";
    if (v.constructor == (new Array).constructor) return "array";
    if (v.constructor == (new Date).constructor) return "date";
    if (v.constructor == (new RegExp).constructor) return "regex";
    return "object";
  }
  return typeof(v);
}
//End of part