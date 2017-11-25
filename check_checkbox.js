
function doOutput()
{
        var obj=document.getElementsByName("checkbox");
        var len = obj.length;
        var checked = false;

        for (i = 0; i < len; i++)
        {
            if (obj[i].checked == true)
            {
                checked = true;
                break;
            }
        } 
	if(checked!=true){
		alert('你沒有勾選喔!!!');
		  return false;
	}
        
	
};
    
