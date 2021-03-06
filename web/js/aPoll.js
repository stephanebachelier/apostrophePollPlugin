function aPollSubmitForm(options) 
{
    $(options['form']).live('submit',function() {
        var container = $(options['container']);
        $.post(options['url'], $(this).serialize(), function(data) { 
            container.html(data);
        },
        'html'
        );
        return false;
    });
}


function aPollSubmitPollForm(options)
{
    // to remove iframes created by recaptcha
    var x = $('iframe').get(-1);
    if ( x ) {
        $(x).remove();
    }
        
    aPollSubmitForm(options);
}

function aPollPreviewPoll(options)
{
    $(options['button']).click(function () {
        
        var form = $(options['form']);
        var container = $(options['container']);
        
        $.post(options['url'],form.serialize(), function(data) {
            container.html(data);
        },
        'html'
        ); 
    });
    
    
    return false;
}

function aPollPreviewHideSubmitButton(options)
{
    var button = $(options['button']);
    button.remove();
}

