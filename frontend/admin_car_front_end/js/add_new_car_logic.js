$(document).ready(function () {


function populateCarDropdowns() {
  // Fetch car categories
  $.ajax({
    type: "GET",
    url: "http://localhost/final_db_admin/backend/admin_car_controller/get_car_category.php",
    dataType: "json",
    success: function (data) {
      // console.log(data);
      // Populate brand dropdown
      var brandDropdown = $("#Brand");
      brandDropdown.empty();
      $.each(data, function (key, value) {
        brandDropdown.append(
          '<option value="' + value.brand + '">' + value.brand + "</option>"
        );
      });

      // Trigger change to load car names for the initial brand
      brandDropdown.trigger("change");
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
      alert("Error loading car categories: " + xhr.responseText);
    },
  });

  // Change event for brand dropdown
  $("#Brand").change(function () {
    var selectedBrand = $(this).val();
    $.ajax({
      type: "GET",
      url:
        "http://localhost/final_db_admin/backend/admin_car_controller/get_car_name_from_brand.php?brand=" +
        selectedBrand,
      dataType: "json",
      success: function (data) {
        console.log(data);
        // Populate car name dropdown
        var carNameDropdown = $("#carName");
        carNameDropdown.empty();
        $.each(data, function (key, value) {
          carNameDropdown.append(
            '<option value="' +
              value +
              '">' +
              value +
              "</option>"
          );
        });
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
        alert("Error loading car names: " + xhr.responseText);
      },
    });
  });
}

// Call the function to populate dropdowns on page load
$(document).ready(function () {
  populateCarDropdowns();
});






  $.ajax({
    type: "GET",
    url: "http://localhost/final_db_admin/backend/office_controller/get_countrys.php",
    dataType: "json",
    success: function (data) {
      // Populate country dropdown
      var countryDropdown = $("#OfficeCountry");
      countryDropdown.empty();
      $.each(data, function (key, value) {
        countryDropdown.append(
          '<option value="' + value + '">' + value + "</option>"
        );
      });

      // Trigger change to load city options for the initial country
      countryDropdown.trigger("change");
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
      alert("Error loading countries: " + xhr.responseText);
    },
  });

  $("#OfficeCountry").change(function () {
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

  // Form submission using AJAX
  $("#addCarForm").submit(function (e) {
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
    console.log('sdsds');
console.log(formData);
    // Send the data using AJAX
    $.ajax({
      type: "POST",
      url: "http://localhost/final_db_admin/backend/admin_car_controller/add_new_car.php", // Replace with the actual file path
      data: formData,
      success: function (response) {
        // Handle success
        console.log(response);
        alert("Record inserted successfully");
      },
      error: function (xhr, status, error) {
        // Handle errors
        console.error(xhr.responseText);
        alert("Error: " + xhr.responseText);
      },
    });
  });
});
