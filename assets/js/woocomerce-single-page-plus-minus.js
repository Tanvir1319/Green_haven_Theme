(function ($) {
	'use strict';

	$(document).on('click', '.gh-qty-plus, .gh-qty-minus', function (e) {
		e.preventDefault();

		var $button = $(this);
		var $qtyBox = $button.closest('.gh-qty-box');
		var $input  = $qtyBox.find('input.qty');

		if (!$input.length || $input.prop('disabled') || $input.prop('readonly')) {
			return;
		}

		var currentValue = parseFloat($input.val());
		var max          = parseFloat($input.attr('max'));
		var min          = parseFloat($input.attr('min'));
		var step         = parseFloat($input.attr('step'));

		if (isNaN(currentValue)) {
			currentValue = 0;
		}

		if (isNaN(min)) {
			min = 0;
		}

		if (isNaN(step) || step <= 0) {
			step = 1;
		}

		var newValue = currentValue;

		if ($button.hasClass('gh-qty-plus')) {
			newValue = currentValue + step;

			if (!isNaN(max) && max > 0 && newValue > max) {
				newValue = max;
			}
		}

		if ($button.hasClass('gh-qty-minus')) {
			newValue = currentValue - step;

			if (newValue < min) {
				newValue = min;
			}
		}

		$input.val(newValue).trigger('input').trigger('change');
	});

})(jQuery);