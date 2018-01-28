$(document).ready(function() {
    for (var i = 2; i < 4; i++) {
		$('.' + 'timeType-' + i).hide();
    }

    $('.timeType-1').show();
});


$('input[type=radio][name=timeType]').change(function() {
    for (var i = 1; i < 4; i++) {
    	if (i != $(this).val()) {
    		$('.' + 'timeType-' + i).hide();
    	}
    }

    $('.' + 'timeType-' + $(this).val()).show();
});