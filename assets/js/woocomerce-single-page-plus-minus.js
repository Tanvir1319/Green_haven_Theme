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





























jQuery(function ($) {
  "use strict";

  var ghCartUpdateTimer = null;
  var ghCartUpdating = false;

  function ghEnableUpdateButton() {
    var $updateButton = $('button[name="update_cart"]');

    if (!$updateButton.length) {
      return $();
    }

    $updateButton.prop("disabled", false);
    $updateButton.removeAttr("aria-disabled");

    return $updateButton;
  }

  function ghUpdateCartTotals() {
    if (ghCartUpdating) {
      return;
    }

    var $updateButton = ghEnableUpdateButton();

    if (!$updateButton.length) {
      return;
    }

    ghCartUpdating = true;
    $updateButton.trigger("click");

    setTimeout(function () {
      ghCartUpdating = false;
    }, 1200);
  }

  function ghScheduleCartUpdate() {
    window.clearTimeout(ghCartUpdateTimer);

    ghCartUpdateTimer = window.setTimeout(function () {
      ghUpdateCartTotals();
    }, 350);
  }

  $(document.body).on("click", ".gh-qty-minus, .gh-qty-plus", function () {
    window.setTimeout(function () {
      ghScheduleCartUpdate();
    }, 80);
  });

  $(document.body).on("change", ".woocommerce-cart-form input.qty", function () {
    ghScheduleCartUpdate();
  });

  $(document.body).on("updated_wc_div", function () {
    ghCartUpdating = false;
  });
});