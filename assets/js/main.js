$(document).ready(function () {
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function () {
		if (this.checked) {
			checkbox.each(function () {
				this.checked = true;
			});
		} else {
			checkbox.each(function () {
				this.checked = false;
			});
		}
	});

	//intercept modal
	$("#deleteTableModal").on("show.bs.modal", function (e) {
		//check if checkbox any is checked
		if (!checkbox.is(":checked")) {
			//abort
			e.preventDefault();
			//trigger alert modal
			$("#alertModal").modal("show");
		}
	});
	checkbox.click(function () {
		if (!this.checked) {
			$("#selectAll").prop("checked", false);
		}
	});
});
