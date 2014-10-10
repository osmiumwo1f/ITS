var siphc;
var siphid;
var i = 1;
$(document).ready(function()
{

    $('body').on('click','button.add',function()
    {
        $('#modal').show();
        $('#shade').show();
        var cls = $(this).parent().attr('class');
        if(cls == 'sgph')
        {
            //get_si('satis_groups');
        }
        else if(cls == 'stph')
        {
            alert('satis_topic', '');
        }
        else if(cls == 'scph')
        {
            alert('sgph');
        }

        siphc = $(this).parent().attr('class');
        return siphid = parseInt($(this).parent().attr('id'));
    })

    $('button.close').click(close_modal);

    $('.si').click(function(event)
    {
        $('#' + siphid + '.sgph').append('<div id="' + event.target.id + '" class="sgi">' + event.target.innerHTML + '</div>');

        $('#' + siphid + '.sgph').children('button.add').remove();

        console.log($('#' + event.target.id + '.sgi').children('button.add').attr('class'));
        //var b = $('#' + event.target.id + '.sgi').chidren('button.add');
        //console.log(typeof(b));
        if(!b)
        {
            $('#' + event.target.id + '.sgi').append('<button id="add_sti" class="add">เพิ่มหัวข้อ</button>');
        }

        $('#' + siphid + '.sgph').parent().append('<div class="sgph" id="0" data-i="' + i + '"><button id="add_sgi" class="add" data-i="' + i + '">เพิ่มกลุ่ม</button></div>')
        i++;
        close_modal();
        sort_sgph();
    })
});

function sort_sgph()
{
    var e = $('.sgph');
    for(i = 0; i < e.length; i++)
    {
        e[i].id = i;
    }
}

function close_modal()
{
    $('#modal').hide();
    $('#shade').hide();
}

/*function get_si(type,id)
{
    $('.si_container').load(/satis/ajax,p,function(str){});
}*/