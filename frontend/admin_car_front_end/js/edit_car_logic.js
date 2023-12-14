$(document).ready(function () {
  // Assume the server endpoint for fetching car data
  const fetchCarDataUrl =
    "http://localhost/final_db_admin/backend/admin_car_controller/admin_edit_car_request_car_details.php"; // Replace with the actual file path

  // Get the carId from the URL parameters
  const urlParams = new URLSearchParams(window.location.search);
  const carId = urlParams.get("carId");

  // Function to fetch car data using AJAX
  function fetchCarData() {
    $.ajax({
      type: "GET",
      url: fetchCarDataUrl, // Replace with the actual endpoint
      data: { carId: carId },
      dataType: "json",
      success: function (data) {
        // Unbind change event to prevent recursion
        // $("#OfficeCountry, #OfficeCity").off("change");

     populateDropdown(
       "#carStatus",
       ["active", "out of service", "rented"], // Assuming these are the possible values
       data.carData.carStatus
     );
        // Populate Office Country dropdown
        populateDropdownCountry(
          "#OfficeCountry",
          data.countries.map((e) => e.country),
          data.selectedCountry
        );

        // Populate Office City dropdown
        populateDropdownCity(
          "#OfficeCity",
          data.countries.map((e) => {
            if (e.country == data.selectedCountry) return e;
          }),
          data.carData.OfficeID
        );

        // Rebind change event after updating dropdown values
        $("#OfficeCountry, #OfficeCity").on("change", function () {
          // Handle change event
        });

        // Populate other input fields
        $("#Brand").val(data.carData.brand);
        $("#CarName").val(data.carData.carname);
        $("#Year").val(data.carData.Year);
        $("#rentValue").val(data.carData.rentvalue);
        $("#ImageUrl").val(data.carData.imageUrl);
        $("#carStatus").val(data.carData.carStatus);
      },
      error: function (xhr, status, error) {
        // console.log(xhr.responseText);
        // Handle error
      },
    });
  }


      function populateDropdown(selector, options, selectedValue) {
        var dropdown = $(selector);
        dropdown.empty();

        $.each(options, function (index, option) {
          var optionElement = $("<option></option>")
            .attr("value", option)
            .text(option);
          if (option === selectedValue) {
            optionElement.prop("selected", true);
          }
          dropdown.append(optionElement);
        });
      }

  function populateDropdownCity(selector, options, selectedValue) {
    // Filter out undefined values
    options = options.filter(function (option) {
      return option !== undefined;
    });
    // console.log(options);
    // Populate dropdown with filtered options
    var cityDropdown = $(selector);
    cityDropdown.empty();
    $.each(options, function (key, value) {
      // console.log(value);

      cityDropdown.append(
        '<option value="' + value.OfficeID + '">' + value.city + "</option>"
      );
    });

    // Set the selected value
    if (selectedValue) {
      // console.log(selectedValue);

      cityDropdown.val(selectedValue);
    }
  }

  $("#OfficeCountry").change(function () {
    // console.log("ddd");
    var selectedCountry = $(this).val();
    $.ajax({
      type: "GET",
      url:
        "http://localhost/final_db_admin/backend/office_controller/get_cities.php?country=" +
        selectedCountry,
      dataType: "json",
      success: function (data) {
        // Populate city dropdown
        var cityDropdown = $("#OfficeCity");
        cityDropdown.empty();
        $.each(data, function (key, value) {
          cityDropdown.append(
            '<option value="' + value.id + '">' + value.name + "</option>"
          );
        });
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
        alert("Error loading cities: " + xhr.responseText);
      },
    });
  });
function removeDuplicates(arr) {
  return [...new Set(arr)];
}
  // Function to populate a dropdown
  // Function to populate a dropdown
  // Function to populate a dropdown for countries
  function populateDropdownCountry(selector, options, selectedValue) {
    console.log(options);
    var dropdown = $(selector);
    dropdown.empty();

    // Filter out undefined values
    options = options.filter(function (option) {
      return option !== undefined;
    });

  options = removeDuplicates(options);
    // Populate dropdown with filtered options
    $.each(options, function (index, option) {
      dropdown.append(
        $("<option></option>")
          .attr("value", option)
          .text(option)
      );
    });

    // Set the selected value
    if (selectedValue) {
      dropdown.val(selectedValue);
    }
  }

  // Initial fetch when the page loads
  fetchCarData();


  $("#editCarForm").submit(function (e) {
    e.preventDefault(); // prevent the form from submitting traditionally

    // Check if any field is empty
    var isValid = true;
    $(this)
      .find("select, input, textarea")
      .each(function () {
        if (!$(this).val()) {
          isValid = false;
          $(this).addClass("is-invalid");
          $(this).next(".invalid-feedback").remove();
          $(this).after(
            '<div class="invalid-feedback">This field is required.</div>'
          );
        } else {
          $(this).removeClass("is-invalid");
          $(this).next(".invalid-feedback").remove();
        }
      });

    if (!isValid) {
      // If any field is empty, don't proceed with the AJAX request
      return;
    }

    // Get form data
    var formData = $(this).serialize();
    console.log(formData);

    // Get the carId from the URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const carId = urlParams.get("carId");

    // Send the data using AJAX
    $.ajax({
      type: "POST",
      url: "http://localhost/final_db_admin/backend/admin_car_controller/admin_edit_car.php", // Replace with the actual file path
      data: formData + "&carId=" + carId, // Include carId in the data
      success: function (response) {
        // Handle success
        console.log(response);
        alert("Record updated successfully");
      },
      error: function (xhr, status, error) {
        // Handle errors
        console.error(xhr.responseText);
        alert("Error: " + xhr.responseText);
      },
    });
  });

});
