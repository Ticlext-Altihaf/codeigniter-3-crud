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


	//delete button logic
	$("#deleteTableButton").click(function () {
		//check if checkbox any is checked
		if (!checkbox.is(":checked")) {
			//trigger alert modal
			$("#alert-modal-title").html("Alert");
			$("#alert-modal-body").html("Please select at least one record to delete.");
			$("#alertModal").modal("show");
		}else{
			//get list of checked checkbox with value name
			const checkedCheckbox = [];
			checkbox.each(function () {
				if (this.checked) {
					checkedCheckbox.push($(this).closest("tr").find("name").text());
				}
			});
			$("#deleteTableModal-Body").html("Are you sure you want to delete " + checkedCheckbox.length + " record(s)?");
			$("#deleteTableModal").modal("show");

		}
	});
	checkbox.click(function () {
		if (!this.checked) {
			$("#selectAll").prop("checked", false);
		}
	});
});
