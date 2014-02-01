function slideFilter(el, key) {
	filterConfig.selected[key] = $(el).hasClass('disabled');
	$(el).toggleClass('disabled');
	$(el).next().slideToggle();
}

function applyFilter(key, value, isSet, isArray) {
	if (isSet) {
		if (isArray) {
			filterConfig.values[key].push(value);
		} else {
			filterConfig.values[key] = value;
		}
	} else {
		if (isArray) {
			for (var i in filterConfig.values[key]) {
				if (filterConfig.values[key][i] == value) {
					filterConfig.values[key].splice(i, 1);
				}
			}
		} else {
			filterConfig.values[key] = null;
		}
	}
}

function submitFilter() {
	var path = filterConfig.path;
	for (var key in filterConfig.selected) {
		if (filterConfig.selected[key]) {
			var value = filterConfig.values[key];
			if (value != null) {
				path+= '/' + key + '/';
				if (value.join != undefined) {
					path += value.join(',');
				} else {
					path += value;
				}
			}
		}
	}
	location.href = path;
}

function findValues(el, url) {
	$.ajax({
		url: url + '/' + el.value.toLowerCase(),
		dataType: 'json',
		success: function(json) {
			var $parent = $(el).parent().find('.options'); 
			$parent.html('');
			var text;
			for (var id in json) {
				text = json[id];
				$parent.append('<div class="option" onclick="applyFind(this, \''+json[id]+'\')">' + 
					text + '</div>');
			}
			$parent.css('display','block').slideDown();
		}
	});
}

function applyFind(el, value) {
	var input = $(el).parent().parent().find('input'); 
	input.val(value);
	input.change();
	stopValues(input);
}

function stopValues(el) {
	$(el).parent().find('.options').slideUp(); 
}

function setWorkValue(key) {
	var year = $('#filter_year').val();
	var month = $('#filter_month').val();
	var day = $('#filter_day').val();
	var hour = $('#filter_hour').val();
	var minuts = $('#filter_minuts').val();
	var date = new Date(year, month - 1, day, hour, minuts, 0, 0);
	var dayOfWeek = (date.getDay() + 6)%7 + 1;
	var value = dayOfWeek + ',' + (hour*60 + minuts);
	applyFilter(key, value, true, false);
}