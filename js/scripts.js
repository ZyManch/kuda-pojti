function selectedClick(el){
	var options = $(el).parent().children('.options').first();
	if(options.css('display')!='block') {
		options.slideDown();
		$(document.body).bind('mousedown',selectBody($(el).parent()));
	}
	return false;
}

function selectBody(select){
	var func = function(){
		$(select).children('.options').slideUp();
		$(document.body).unbind('mousedown',func);
	}
	return func;
}

function optionClick(func, el){
	var el = $(el);
	var options = el.parent();
	var selected = options.parent().children('.selected').first();
	options.children('.option').removeClass('checked');
	el.addClass('checked');
	selected.html(el.html());
	func(el.attr('key'))
}
