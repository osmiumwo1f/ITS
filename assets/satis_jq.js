var siphc;
var siphid;
var current_siphid;
var cls;
var role;
$(document).ready(function(){
    $('div.content').on('click', 'button.add,button.edit', function(event){
	    $('#modal').show();
		$('#shade').show();

        cls = $(event.target).attr('class');
		role = $(event.target).attr('data-btnrole');
		get_si(role,$(event.target).parent().siblings('div.sgi').attr('id'));

        //console.log($(event.target).parent().siblings('div.sgi').attr('id')+" "+$(event.target).parent().attr('class'))
		siphc = $(event.target).parent().attr('class');
        //current_siphid = parseInt($(event.target).parent('div.sgph').attr('id'));
		siphid = parseInt($(event.target).parents('div.sgph').attr('id'));
        console.log(siphc+" "+siphid);
	})

	$('button.close').click(close_modal);

    $('div.content').on('click', 'button.del', function(event){
        console.log($(event.target).attr('class')+" "+$(event.target).attr('data-btnrole'));
        if($(event.target).attr('data-btnrole') == 'satis_group'){
    	    $(event.target).parents('div.sgph').remove();
            sort_sgph();
        }
        else if($(event.target).attr('data-btnrole') == 'satis_topics'){
            $(event.target).parents('div.sti').remove();
        }
    })

	$('div#si_container').on('click', '.si', function(event){
	    if(cls == 'add'){
    	    if(role == 'satis_group'){
        	    $('div#'+siphid+'.sgph').append('<div id="'+event.target.id+'" class="sgi" data-scoretype="">'+event.target.innerHTML+'</div>');
        		$('div#'+siphid+'.sgph').children('*[data-btnrole="satis_group"]').remove();
                $('div#'+siphid+'.sgph').children('div#'+event.target.id+'.sgi').append('<button class="edit" data-btnrole="satis_group">เปลี่ยนกลุ่ม</button><button class="del" data-btnrole="satis_group">ลบกลุ่ม</button>');
                $('div#'+siphid+'.sgph').append('<div class="scph"></div>');
                $('div#'+siphid+'.sgph').children('div.scph').append('<button class="add" data-btnrole="score_type">เกณฑ์การให้คะแนน</button>');
                $('div#'+siphid+'.sgph').append('<div class="stph"></div>');
                $('div#'+siphid+'.sgph').children('div.stph').append('<button class="add" data-btnrole="satis_topics">เพิ่มหัวข้อ</button>');
        		$('div#'+siphid+'.sgph').parent().append('<div class="sgph" id="0"><button class="add" data-btnrole="satis_group">เพิ่มกลุ่ม</button></div>');
        		sort_sgph();
            }
            else if(role == 'satis_topics'){
                $('div#'+siphid+'.sgph').children('div.stph').append('<div id="'+event.target.id+'" class="sti">'+event.target.innerHTML+'</div>');
        		$('div#'+siphid+'.sgph').find('*[class="add"][data-btnrole="satis_topics"]').remove();
                $('div#'+siphid+'.sgph').find('div#'+event.target.id+'.sti').append('<button class="edit" data-btnrole="satis_topics">เปลี่ยนหัวข้อ</button><button class="del" data-btnrole="satis_topics">ลบหัวข้อ</button>');
                //$('#'+event.target.id+'.sti').append('<button class="add" data-btnrole="score_type">เกณฑ์การให้คะแนน</button>');
                $('div#'+siphid+'.sgph').children('div.stph').append('<button class="add" data-btnrole="satis_topics">เพิ่มหัวข้อ</button>');
            }
            else if(role == "score_type"){
                $('div#'+siphid+'.sgph').children('div.sgi').attr('data-scoretype', event.target.id);
                $('div#'+siphid+'.sgph').find('*[data-btnrole="score_type"]').remove();
                $('div#'+siphid+'.sgph').children('div.scph').append('<button class="edit" data-btnrole="score_type">เปลี่ยนเกณฑ์</button>');
            }
        }
        else if(cls == 'edit'){
            /*if(role == 'satis_group'){
        	    $('div#'+siphid+'.sgph').append('<div id="'+event.target.id+'" class="sgi" data-scoretype="">'+event.target.innerHTML+'</div>');
                $('div#'+siphid+'.sgph').append('<div class="scph"></div>');
                $('div#'+siphid+'.sgph').children('div.scph').append('<button class="add" data-btnrole="score_type">เกณฑ์การให้คะแนน</button>');
                $('div#'+siphid+'.sgph').append('<div class="stph"></div>');
                $('div#'+siphid+'.sgph').children('div.stph').append('<button class="add" data-btnrole="satis_topics">เพิ่มหัวข้อ</button>');
        		$('div#'+siphid+'.sgph').parent().append('<div class="sgph" id="0"><button class="add" data-btnrole="satis_group">เพิ่มกลุ่ม</button></div>');
        		sort_sgph();
            }
            else if(role == 'satis_topics'){
                $('div#'+siphid+'.sgph').children('div.stph').append('<div id="'+event.target.id+'" class="sti">'+event.target.innerHTML+'</div>');
        		$('div#'+siphid+'.sgph').find('*[class="add"][data-btnrole="satis_topics"]').remove();
                $('div#'+siphid+'.sgph').find('div#'+event.target.id+'.sti').append('<button class="edit" data-btnrole="satis_topics">เปลี่ยนหัวข้อ</button><button class="del" data-btnrole="satis_topics">ลบหัวข้อ</button>');
                //$('#'+event.target.id+'.sti').append('<button class="add" data-btnrole="score_type">เกณฑ์การให้คะแนน</button>');
                $('div#'+siphid+'.sgph').children('div.stph').append('<button class="add" data-btnrole="satis_topics">เพิ่มหัวข้อ</button>');
            }
            else if(role == "score_type"){
                $('div#'+siphid+'.sgph').children('div.sgi').attr('data-scoretype', event.target.id);
                $('div#'+siphid+'.sgph').find('*[data-btnrole="score_type"]').remove();
                $('div#'+siphid+'.sgph').children('div.scph').append('<button class="edit" data-btnrole="score_type">เปลี่ยนเกณฑ์</button>');
            }*/
        }
        close_modal();
	})
});

function sort_sgph(){
	var e = $('div.sgph');
	for(i = 0; i < e.length; i++){
		e[i].id = i;
	}
}

function close_modal(){
	$('#modal').hide();
	$('#shade').hide();
}

function get_si(type,id,list){
    if(list === undefined){
        list = false;
    }

	$.ajax({
        cache: false,
		type: 'POST',
		url: 'http://localhost:8080/its/index.php/satis/ajax/',
        data: {'type':type,'id': id,'list':list},
		success: function(resp){
		    $('div#si_container').html(resp);
		}
	});
}