function disableForm()
{
    var f = document.getElementsByTagName("input");
    for (i = 0; i < f.length; i++)
    {
        if(f[i].type.toString() != "button")
        {
            if(f[i].disabled == true)
            {
                f[i].disabled = false;
                document.getElementById('db').value = 'ยกเลิก';
            }
            else
            {
                f[i].disabled = true;
                document.getElementById('db').value = 'แก้ไข';
            }
        }
    }

}