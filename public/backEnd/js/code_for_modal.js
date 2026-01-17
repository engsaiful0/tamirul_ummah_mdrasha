(function ($) {
	'use strict';
});

var fileInput = document.getElementById('browseFile');
	if (fileInput) {
		fileInput.addEventListener('change', showFileName);
		function showFileName(event) {
			var fileInput = event.srcElement;
			var fileName = fileInput.files[0].name;
			document.getElementById('placeholderInput').placeholder = fileName;
		}
	}

	 var fileInput1 = document.getElementById('browseFile1');
	if (fileInput1) {
		fileInput1.addEventListener('change', showFileName1);
		function showFileName1(event) {
			var fileInput1 = event.srcElement;
			var fileName1 = fileInput1.files[0].name;
			document.getElementById('placeholderPhoto1').placeholder = fileName1;
		}
	}

	var fileInput2 = document.getElementById('browseFile2');
	if (fileInput2) {
		fileInput2.addEventListener('change', showFileName2);
		function showFileName2(event) {
			var fileInput2 = event.srcElement;
			var fileName2 = fileInput2.files[0].name;
			document.getElementById('placeholderPhoto2').placeholder = fileName2;
		}
	}

	if ($('.multipleSelect').length) {
		$('.multipleSelect').fastselect();
	}

/*-------------------------------------------------------------------------------
         Start Check Input is empty
	   -------------------------------------------------------------------------------*/
	$('.input-effect input').each(function () {
		if ($(this).val().length > 0) {
			$(this).addClass('read-only-input');
		} else {
			$(this).removeClass('read-only-input');
		}

		$(this).on('keyup', function () {
			if ($(this).val().length > 0) {
				$(this).siblings('.invalid-feedback').fadeOut('slow');
			} else {
				$(this).siblings('.invalid-feedback').fadeIn('slow');
			}
		});
	});

	$('.input-effect textarea').each(function () {
		if ($(this).val().length > 0) {
			$(this).addClass('read-only-input');
		} else {
			$(this).removeClass('read-only-input');
		}
	});

	/*-------------------------------------------------------------------------------
         End Check Input is empty
	   -------------------------------------------------------------------------------*/
	$(window).on('load', function () {
		$('.input-effect input, .input-effect textarea').focusout(function () {
			if ($(this).val() != '') {
				$(this).addClass('has-content');
			} else {
				$(this).removeClass('has-content');
			}
		});
	});


	/*-------------------------------------------------------------------------------
         End Input Field Effect
	   -------------------------------------------------------------------------------*/
	// Search icon
	$('#search-icon').on('click', function () {
		$('#search').focus();
	});

	$('#start-date-icon').on('click', function () {
		$('#startDate').focus();
	});

	$('#end-date-icon').on('click', function () {
		$('#endDate').focus();
	});
	$('.primary-input.date').datepicker({
		autoclose: true,
		setDate: new Date()
	});
	$('.primary-input.date').on('changeDate', function (ev) {
		// $(this).datepicker('hide');
		$(this).focus();
	});
	$('.primary-input.time').datetimepicker({
		format: 'LT'
	});

	/*-------------------------------------------------------------------------------
         Nice Select 
	   -------------------------------------------------------------------------------*/
/* 	if ($('.niceSelect').length) {
		$('.niceSelect').niceSelect();
	} */