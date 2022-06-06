$(document).ready(function() {
    $( document ).on( 'focus', ':input', function(){
        $( this ).attr( 'autocomplete', 'off' );
    });

    $('.text').keypress(function(e){
        let keyCode = e.which;

        /*
        8 - (backspace)
        32 - (space)
        97-122 - (a-z)text
        */
        if ( (keyCode != 8 ) && (keyCode < 97 || keyCode > 122) && (keyCode != 32) ) {
            return false;
        }
    });

    $('.float').keypress(function(e){
        let keyCode = e.which;
        
        /*
        46 - (dot)
        8 - (backspace)
        32 - (space)
        48-57 - (0-9)Numbers
        */
        if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 48 || keyCode > 57) && (keyCode != 46) ) {
            return false;
        }
    });

    $('.number').keypress(function(e){
        let keyCode = e.which;
        
        /*
        8 - (backspace)
        32 - (space)
        48-57 - (0-9)Numbers
        */
        if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 48 || keyCode > 57) ) {
            return false;
        }
    });
});