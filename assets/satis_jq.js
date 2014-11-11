var id, sgphid, current_sgphid, cls, role, tid, scoreType_str;
var usgi = [];
var usti = [];
var test_usgi = [1,2,3];
var test_usti = [1,2,3,4,5,6,7];
var json_usgi, json_usti, json_usci;
$(document).ready(function(){
	$('div.content').on('click', 'button.add,button.edit', function(event){
		$('#modal').show();
		$('#shade').show();

		cls = $(event.target).attr('class');
		role = $(event.target).attr('data-btnrole');
		//console.log(cls+" "+role+" "+$(event.target).parents().siblings('div.sgi').attr('id'));
		if(role == 'satis_group'){
			var usedList = usgi;
		}
		else if(role == 'satis_topics'){
			var usedList = usti;
		}
		get_si_list(role, $(event.target).parents().siblings('div.sgi').attr('id'), usedList);

		//siphc = $(event.target).parent().attr('class');
		id = $(event.target).parent().attr('id');
		sgphid = parseInt($(event.target).parents('div.sgph').attr('id'));
		//console.log(siphc+" "+sgphid);
	})

	$('div.content').on('click', 'button.close', close_modal);

	$('div.content').on('click', 'button.del', function(event){
		if($(event.target).attr('data-btnrole') == 'satis_group') {
			var sti = [];
			sti = $(event.target).parent().siblings('div.stph').children('div.sti').toArray();
			for(var i in sti){
				usti.splice(usti.indexOf(sti[i]['id'].toString()), 1);
			}
			usgi.splice(usgi.indexOf($(event.target).parent().attr('id').toString()), 1);
			$(event.target).parents('div.sgph').remove();
			sort_sgph();
			showUSI();

		}
		else if($(event.target).attr('data-btnrole') == 'satis_topics') {
			usti.splice(usti.indexOf($(event.target).parent().attr('id').toString()), 1);
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
				//$('div#'+sgphid+'.sgph').append('<div class="scph"></div>');
				$('div#'+sgphid+'.sgph').children('div#'+event.target.id+'.sgi').append('<button class="add" data-btnrole="score_type">เกณฑ์การให้คะแนน</button>');
				$('div#'+sgphid+'.sgph').append('<div class="stph"></div>');
				$('div#'+sgphid+'.sgph').children('div.stph').append('<button class="add" data-btnrole="satis_topics">เพิ่มหัวข้อ</button>');
				$('div#'+sgphid+'.sgph').parent().append('<div class="sgph" id="0"><button class="add" data-btnrole="satis_group">เพิ่มกลุ่ม</button></div>');
				usgi.push(event.target.id);
				sort_sgph();
			}
			else if(role == 'satis_topics') {
				$('div#'+sgphid+'.sgph').children('div.stph').append('<div id="'+event.target.id+'" class="sti">'+event.target.innerHTML+'</div>');
				$('div#'+sgphid+'.sgph').find('*[class="add"][data-btnrole="satis_topics"]').remove();
				$('div#'+sgphid+'.sgph').find('div#'+event.target.id+'.sti').append('<button class="up" data-btnrole="satis_topics">ขึ้น</button><button class="down" data-btnrole="satis_topics">ลง</button><button class="edit" data-btnrole="satis_topics">เปลี่ยนหัวข้อ</button><button class="del" data-btnrole="satis_topics">ลบหัวข้อ</button>');
				$('div#'+sgphid+'.sgph').children('div.stph').append('<button class="add" data-btnrole="satis_topics">เพิ่มหัวข้อ</button>');
				usti.push(event.target.id);
			}
			else if(role == "score_type") {
				$('div#'+sgphid+'.sgph').children('div.sgi').attr('data-scoretype', event.target.id);
				$('div#'+sgphid+'.sgph').find('*[data-btnrole="score_type"]').remove();
				$('div#'+sgphid+'.sgph').children('div#'+event.target.id+'.sgi').append('<button class="edit" data-btnrole="score_type">เปลี่ยนเกณฑ์</button>');
			}
		}
		else if(cls == 'edit') {
			if(role == 'satis_group') {
				if(event.target.id == $('div#'+sgphid+'.sgph').children('div.sgi').attr('id')) {
					alert("เลือกกลุ่มเดิม");
				}
				else {
					usgi.splice(usgi.indexOf($('div#'+sgphid+'.sgph').children('div.sgi').attr('id').toString()), 1, event.target.id);
					$('div#'+sgphid+'.sgph').children('div.sgi').attr('id', event.target.id);
					$('div#'+sgphid+'.sgph').children('div.sgi').html(event.target.innerHTML+'<button class="up" data-btnrole="satis_group">ขึ้น</button><button class="down" data-btnrole="satis_group">ลง</button><button class="edit" data-btnrole="satis_group">เปลี่ยนกลุ่ม</button><button class="del" data-btnrole="satis_group">ลบกลุ่ม</button>');
					$('div#'+sgphid+'.sgph').children('div.stph').find('*').remove();
					$('div#'+sgphid+'.sgph').children('div.stph').append('<button class="add" data-btnrole="satis_topics">เพิ่มหัวข้อ</button>');
				}
			}
			else if(role == 'satis_topics') {
				//console.log(siphc);
				usti.splice(usti.indexOf($('div#'+id+'.sti').attr('id').toString()), 1, event.target.id);
				$('div#'+id+'.sti').attr('id', event.target.id);
				$('div#'+id+'.sti').html(event.target.innerHTML+'<button class="up" data-btnrole="satis_topics">ขึ้น</button><button class="down" data-btnrole="satis_topics">ลง</button><button class="edit" data-btnrole="satis_group">เปลี่ยนกลุ่ม</button><button class="del" data-btnrole="satis_group">ลบกลุ่ม</button>');
			}
			else if(role == "score_type") {
				$('div#'+sgphid+'.sgph').children('div.sgi').attr('data-scoretype', event.target.id);
				$('div#'+sgphid+'.sgph').find('*[data-btnrole="score_type"]').remove();
				$('div#'+sgphid+'.sgph').children('div.scph').append('<button class="edit" data-btnrole="score_type">เปลี่ยนเกณฑ์</button>');
			}
		}
		close_modal();
		//usedItem();
		showUSI();
	})

	$('button.convert2json').click(function(){
		/*alert(FormatJSON(toTransform($('div.satis_form').children())));
		var json_obj = $.parseJSON(FormatJSON(toTransform($('div.satis_form').children())));
		jsonTraverser(json_obj);
		cleanup(json_obj);
		alert(JSON.stringify(json_obj));*/
		var json_str = '[{"tag":"div","id":"0","class":"sgph","children":[{"tag":"div","scoretype":"1","class":"sgi","id":"1"},{"tag":"div","class":"stph","children":[{"tag":"div","class":"sti","id":"1"},{"tag":"div","class":"sti","id":"3"},{"tag":"div","class":"sti","id":"2"}]}]},{"tag":"div","id":"1","class":"sgph","children":[{"tag":"div","scoretype":"1","class":"sgi","id":"2"},{"tag":"div","class":"stph","children":[{"tag":"div","class":"sti","id":"5"},{"tag":"div","class":"sti","id":"4"},{"tag":"div","class":"sti","id":"6"}]}]},{"tag":"div","id":"2","class":"sgph","children":[{"tag":"div","scoretype":"3","class":"sgi","id":"3"},{"tag":"div","class":"stph","children":[{"tag":"div","class":"sti","id":"7"}]}]}]';
		json_obj = $.parseJSON(json_str);
		//json_str = JSON.stringify(json_obj);
		//alert(json_str);
		$('#form_preview').html('<div id="form_housing" style="height:100%;overflow:scroll;width:100%"></div><button class="close">ปิด</button><button id="submit">ตกลง</button>');
		get_si('satis_group', test_usgi);
		get_si('satis_topics', test_usti);
		get_si('score_type', test_usgi);
		console.log(json_obj);
		console.log(json_usgi);
		console.log(json_usti);
		console.log(json_usci);
		formGenerator(json_obj);
		$('#form_preview').show();
		$('#shade').show();
	});
	$('button#submit').click(function(){
		$.ajax({
			url: 'http://localhost:8080/its/satis/get_si/',
			type: 'post',
			data: {},
			success: function (data) {
				data
			}
		});
	});
});

function showUSI(){
	console.log('usgi: '+usgi);
	console.log('usti: '+usti);
}

function jsonTraverser(tree){
	for(var i = tree.length-1; i >= 0; i--){
		if(tree[i].tag == 'button'){
			tree.splice(i,1);
			if(i>(tree.length-1)||i==0){
				continue;
			}
		}

		if(tree[i].hasOwnProperty('children')){
			if(tree[i].children.length > 0){
				jsonTraverser(tree[i].children);
			}
		}
	}
}

function cleanup(tree){
	for(var val in tree){
		if(tree[val].children.length == 0){
			delete tree[val].children
		}

		if(tree[val].tag == 'div' && tree[val].class == 'sgph' && !tree[val].hasOwnProperty('children')){
			tree.splice(val,1);
			//console.log(tree);
			//console.log(val+' '+tree.length);
		}

		if(val <= tree.length-1){
			if(tree[val].hasOwnProperty('children')){
				if(tree[val].children.length > 0){
					cleanup(tree[val].children);
				}
			}
		}
		else{
			continue;
		}
	}
}

function formGenerator(tree){
	for(var i in tree){
		if(tree[i].class == 'sgph'){
			tid = tree[i].id;
		}
		if(tree[i].class == 'sgi'){
			scoreType = tree[i].scoretype;
			/*for(var j in json_usti){
				if(json_usti[j].id == tree[i].id){
					item = json_usti[j];
				}
			}*/
			item = get_usi(json_usti, tree[i].id);
			console.log(item);
			scoreType = get_usi(json_usci, scoreType);
			if(scoreType.id == '1'){
				scoreType_str = '';
				for(var k = scoreType.start; k <= scoreType.end; k++){
					scoreType_str += '<td>'+k+'</td>';
				}
				$('div#form_housing').append('<p>'+item.id+':'+item.name+'</p>');
				$('div#form_housing').append('<table id="'+tid+'"><tr><td rowspan="2">หัวข้อ</td><td colspan="5">คะแนน</td></tr><tr>'+scoreType_str+'</tr></table>');
				console.log('add table');
			}
			else if (scoreType == '2'){

			}
			else{
				$('div#form_housing').append('<div id="'+tid+'"><p>'+item.id+':'+item.name+'<p></div>');
			}
		}
		else if(tree[i].class == 'sti'){
			/*for(var j in json_usti){
				if(json_usti[j].id == tree[i].id){
					item = json_usti[j];
				}
			}*/
			item = get_usi(json_usti, tree[i].id);
			console.log(i+item);
			if(scoreType.id == '1'){
				$('table#'+tid).append('<tr><td>'+item.id+': '+item.name+'</td>'+scoreType_str+'</td></tr>');
			}
			else if (scoreType == '2'){

			}
			else{
				$('div#form_housing').append('<p>'+item.id+item.name+'</p><textarea id="'+item.id+'" style="width:100%;"></textarea>');
			}
		}
		if(tree[i].children){
			formGenerator(tree[i].children);
		}
	}
}

function get_usi(usi, tree){
	for(var i in usi){
		if(usi[i].id == tree){
			return usi[i];
		}
	}
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
	$('#form_preview').hide();
}

function get_si(type, list){
	if(list === undefined) {
		list = false;
	}

	$.ajax({
		async: false,
		cache: false,
		type: 'POST',
		dataType: 'json',
		url: 'http://localhost:8080/its/satis/get_si/',
		data: {'p': 'used', 'type': type, 'list': list},
		success: function(resp) {
			whereShouldItGo(type, resp);
		},
		error: function(){
			console.log('error');
		}
	});
}

function whereShouldItGo(type, value){
	if(type == 'satis_group'){
		json_usgi = value;
	}
	else if(type =='satis_topics'){
		json_usti = value;
	}
	else{
		json_usci = value;
	}
}

function get_si_list(type, group, list) {
	//list is to store the items that already in use.
	if(list === undefined) {
		list = false;
	}

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'http://localhost:8080/its/satis/get_si_list/',
		data: {'p': 'unused', 'type': type, 'group': group, 'list': list},
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