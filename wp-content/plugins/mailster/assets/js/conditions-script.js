jQuery(document).ready(function ($) {

	"use strict"

	var conditions = $('.mailster-conditions'),
		groups = $('.mailster-condition-group'),
		cond = $('.mailster-condition');

	groups.eq(0).appendTo($('.mailster-condition-container'));
	datepicker();

	$('.mailster-conditions-thickbox')
		// .on('change', '.mailster-list-operator', function () {
		// 	conditions.removeClass('mailster-condition-operator-is-and mailster-condition-operator-is-or').addClass('mailster-condition-operator-is-' + $(this).val().toLowerCase());
		// 	_trigger('updateCount');
		// })
		.on('click', '.add-condition', function () {
			var id = groups.length,
				clone = groups.eq(0).clone();

			clone.removeAttr('id').appendTo(conditions).data('id', id);
			$.each(clone.find('input, select'), function () {
				var _this = $(this),
					name = _this.attr('name');
				_this.attr('name', name.replace(/\[\d+\]/, '[' + id + ']')).prop('disabled', false);
			});
			clone.find('.condition-field').val('').focus();
			//clone.find('select.select2').select2();
			datepicker();
			groups = $('.mailster-condition-group');
			cond = $('.mailster-condition');
		})
		.on('click', '.add-or-condition', function () {
			var cont = $(this).parent(),
				id = cont.find('.mailster-condition').last().data('id'),
				clone = cond.eq(0).clone();

			clone.removeAttr('id').appendTo(cont).data('id', ++id);
			$.each(clone.find('input, select'), function () {
				var _this = $(this),
					name = _this.attr('name');
				_this.attr('name', name.replace(/\[\d+\]\[\d+\]/, '[' + cont.data('id') + '][' + id + ']')).prop('disabled', false);
			});
			clone.find('.condition-field').val('').focus();
			//clone.find('select.select2').select2();
			datepicker();
			cond = $('.mailster-condition');
		})
		.on('click', '.close', function () {
			tb_remove();
		});


	conditions
		.on('click', '.remove-condition', function () {
			var c = $(this).parent();
			if (c.parent().find('.mailster-condition').length == 1) {
				c = c.parent();
			}
			c.slideUp(100, function () {
				$(this).remove();
				_trigger('updateCount');
			});
		})
		.on('change', '.condition-field', function () {

			var condition = $(this).closest('.mailster-condition'),
				field = $(this).val();

			condition.find('div.mailster-conditions-value-field').removeClass('active').find('.condition-value').prop('disabled', true);
			condition.find('div.mailster-conditions-operator-field').removeClass('active').find('.condition-operator').prop('disabled', true);

			if (!condition.find('div.mailster-conditions-value-field[data-fields*=",' + field + ',"]').addClass('active').find('.condition-value').prop('disabled', false).length) {
				condition.find('div.mailster-conditions-value-field-default').addClass('active').find('.condition-value').prop('disabled', false);
			}
			if (!condition.find('div.mailster-conditions-operator-field[data-fields*=",' + field + ',"]').addClass('active').find('.condition-operator').prop('disabled', false).length) {
				condition.find('div.mailster-conditions-operator-field-default').addClass('active').find('.condition-operator').prop('disabled', false);
			}
			_trigger('updateCount');

		})
		.on('change', '.condition-operator', function () {
			_trigger('updateCount');
		})
		.on('change', '.condition-value', function () {
			_trigger('updateCount');
		})
		.on('click', '.mailster-condition-add-multiselect', function () {
			$(this).parent().clone().insertAfter($(this).parent()).find('.condition-value').select().focus();
		})
		.on('change', '.mailster-conditions-value-field-multiselect > .condition-value', function () {
			if (0 == $(this).val() && $(this).parent().parent().find('.condition-value').size() > 1) $(this).parent().remove();
		})
		.on('click', '.mailster-rating > span', function (event) {
			var _this = $(this),
				_prev = _this.prevAll(),
				_all = _this.siblings();
			_all.removeClass('enabled');
			_prev.add(_this).addClass('enabled');
			_this.parent().parent().find('.condition-value').val((_prev.length + 1) / 5).trigger('change');
		})
		.find('.condition-field').prop('disabled', false).trigger('change');

	_trigger('updateCount');

	// function serialize() {
	// 	var str = 'conditions=',
	// 		conditions = [],
	// 		groups = $('.mailster-conditions > .mailster-condition-group'),
	// 		i = 0;

	// 	$.each(groups, function () {
	// 		var c = $(this).find('.mailster-condition');
	// 		$.each(c, function () {
	// 			var _this = $(this),
	// 				value = null,
	// 				field = _this.find('.condition-field').val(),
	// 				operator = _this.find('.mailster-conditions-operator-field.active').find('.condition-operator').val();

	// 			if (!operator || !field) return;

	// 			value = _this.find('.mailster-conditions-value-field.active').find('.condition-value').map(function () {
	// 				return $(this).val();
	// 			}).toArray();
	// 			if (value.length == 1) {
	// 				value = value[0];
	// 			}
	// 			if (!conditions[i]) {
	// 				conditions[i] = [];
	// 			}
	// 			conditions[i].push([
	// 				field,
	// 				operator,
	// 				value,
	// 			]);
	// 		});
	// 		i++;
	// 	});

	// 	// $('.mailster-condition').each(function () {
	// 	// 	str += $(this).find('.condition-field').val();
	// 	// 	str += $(this).find('.condition-operator').val();
	// 	// 	str += $(this).find('.condition-value').val();
	// 	// 	str += '|';
	// 	// })

	// 	console.log(conditions,
	// 		JSON.stringify(conditions),
	// 		jQuery.param({
	// 			'conditions': conditions
	// 		}),
	// 	);

	// }

	function datepicker() {
		$('.mailster-conditions').find('.datepicker').datepicker({
			dateFormat: 'yy-mm-dd',
			firstDay: mailsterL10n.start_of_week,
			showWeek: true,
			dayNames: mailsterL10n.day_names,
			dayNamesMin: mailsterL10n.day_names_min,
			monthNames: mailsterL10n.month_names,
			prevText: mailsterL10n.prev,
			nextText: mailsterL10n.next,
			showAnim: 'fadeIn',
		});
	}


	function sprintf() {
		var a = Array.prototype.slice.call(arguments),
			str = a.shift(),
			total = a.length,
			reg;
		for (var i = 0; i < total; i++) {
			reg = new RegExp('%(' + (i + 1) + '\\$)?(s|d|f)');
			str = str.replace(reg, a[i]);
		}
		return str;
	}

	function _trigger() {
		if (!window.Mailster) return;
		var args = jQuery.makeArray(arguments);
		var triggerevent = args.shift();
		window.Mailster.trigger(triggerevent, args);
	}

	// window.tb_position = function () {
	// 	if (!window.TB_WIDTH || !window.TB_HEIGHT) return;
	// 	jQuery("#TB_window").css({
	// 		marginTop: '-' + parseInt((TB_HEIGHT / 2), 10) + 'px',
	// 		marginLeft: '-' + parseInt((TB_WIDTH / 2), 10) + 'px',
	// 		width: TB_WIDTH + 'px'
	// 	});
	// }


});