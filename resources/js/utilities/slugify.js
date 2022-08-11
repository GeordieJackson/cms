// Create slug from title
$('#title').on('blur', function()
{
    var input = $(this).val();

    if($('#slug').val())
    {
        return;
    }

    input = input.trim();
    input=input.replace(/ +/g,"-");
    input=input.replace(/-+/g,"-");
    input=input.replace(/[;:?!',]/g,"");
    input=input.toLowerCase();
    $('#slug').val(input);
});