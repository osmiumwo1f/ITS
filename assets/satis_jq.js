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
        console.log($(event.target).attr('class')+" "+$(event.target).attr('data-btnrole'));
        if($(event.target).attr('data-btnrole') == 'satis_group') {
        	$(event.target).parents('div.sgph').remove();
        	sort_sgph();
        }
        else if($(event.target).attr('data-btnrole') == 'satis_topics') {
        	$(event.target).parents('div.sti').remove();
        }
    })

    $('div#si_container').on('click', '.si', function(event){
        if(cls == 'add') {
        	if(role == 'satis_group') {
        		$('div#'+sgphid+'.sgph').append('<div id="'+event.target.id+'" class="sgi" data-scoretype="">'+event.target.innerHTML+'</div>');
        		$('div#'+sgphid+'.sgph').children('*[data-btnrole="satis_group"]').remove();
        		$('div#'+sgphid+'.sgph').children('div#'+event.target.id+'.sgi').append('<button class="edit" data-btnrole="satis_group">เปลี่ยนกลุ่ม</button><button class="del" data-btnrole="satis_group">ลบกลุ่ม</button>');
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
        		$('div#'+sgphid+'.sgph').find('div#'+event.target.id+'.sti').append('<button class="edit" data-btnrole="satis_topics">เปลี่ยนหัวข้อ</button><button class="del" data-btnrole="satis_topics">ลบหัวข้อ</button>');
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
        			$('div#'+sgphid+'.sgph').children('div.sgi').html(event.target.innerHTML+'<button class="edit" data-btnrole="satis_group">เปลี่ยนกลุ่ม</button><button class="del" data-btnrole="satis_group">ลบกลุ่ม</button>');
        			$('div#'+sgphid+'.sgph').children('div.stph').find('*').remove();
        			$('div#'+sgphid+'.sgph').children('div.stph').append('<button class="add" data-btnrole="satis_topics">เพิ่มหัวข้อ</button>');
        		}
        	}
        	else if(role == 'satis_topics') {
        	    //console.log(siphc);
        		$('div#'+id+'.sti').html(event.target.innerHTML+'<button class="edit" data-btnrole="satis_group">เปลี่ยนกลุ่ม</button><button class="del" data-btnrole="satis_group">ลบกลุ่ม</button>');
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
});

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