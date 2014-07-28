$(document).on('click', '.chosen-with-drop', function()
{
    var select = $(this).prev('select');
    if($(select).val() == 'same')
    {
        var index = $(select).parents('td').index();
        var row   = $(select).parents('tr').index();
        var table = $(select).parents('tr').parent();
        var value = '';
        for(i = row - 1; i >= 0; i--)
        {
            value = $(table).find('tr').eq(i).find('td').eq(index).find('select').val();
            if(value != 'same') break;
        }
        $(select).val(value);
        $(select).trigger("chosen:updated");
    }
})