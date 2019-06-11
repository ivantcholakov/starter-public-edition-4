$(function () {
	var $address = $('[name="address"]'),
		$parent = $('[name="parent"]');

	$address.kladr({
		oneString: true,
		change: function (obj) {
			log(obj);
		}
	});

	$parent.change(function () {
		changeParent($(this).val());
	});

	changeParent($('[name="parent"]:checked').val());

	function changeParent(value) {
		var parentType = null,
			parentId = null;

		switch (value) {
			case 'moscow':
				parentType = $.kladr.type.region;
				parentId = '7700000000000';
				break;

			case 'petersburg':
				parentType = $.kladr.type.region;
				parentId = '7800000000000';
				break;
		}

		$address.kladr({
			parentType: parentType,
			parentId: parentId
		});
	}

	function log(obj) {
		var $log, i;

		$('.js-log li').hide();

		for (i in obj) {
			$log = $('#' + i);

			if ($log.length) {
				$log.find('.value').text(obj[i]);
				$log.show();
			}
		}
	}
});
