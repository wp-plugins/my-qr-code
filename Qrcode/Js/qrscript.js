function GetElement(value)
{
    var trid;
    switch(value)
    {
        case 'site':
            trid='2';
            break;
        case 'bkm':
            trid='1,2';
            break;
        case 'call':
            trid='3';
            break;
        case 'sms':
            trid='3,6';
            break;
        case 'mail':
            trid='4,5,6';
            break;
        case 'vcard':
            trid='7,8,9,10,11,12,13,15,16,17,18,20,21,23,24,25';
            break;
        case 'mecard':
            trid='9,11,15,16,19,21,22,25';
            break;
        case 'vevent':
            trid='26,27,28,29,30,31,32,33,34';
            break;
        case 'youtube':
            trid='37';
            break;
        case 'tweet':
            trid='39';
            break;
        case 'bbm':
            trid='40,9,11';
            break;
        case 'wifi':
            trid='41,42,43';
            break;
        case 'text':
            trid='44';
            break;
    }
    var j;
    var table = document.getElementById('qrTable');
    var rows = table.getElementsByTagName("tr");
    for(j = 0; j < rows.length; j++){
        if(rows[j].className=="qrshowele")
        {
            jQuery('#'+rows[j].id).removeClass('qrshowele');
            jQuery('#'+rows[j].id).addClass('qrhideele');
        }
    }
    var i;
    var splitarray=trid.split(',');
    for(i=0;i<splitarray.length;i++)
    {
        jQuery('#tr_'+splitarray[i]).removeClass('qrhideele');
        jQuery('#tr_'+splitarray[i]).addClass('qrshowele');
    }
}
function QrgetValue(){
    var action=document.getElementById('selTagaction').value;
    GetElement(action);
}



