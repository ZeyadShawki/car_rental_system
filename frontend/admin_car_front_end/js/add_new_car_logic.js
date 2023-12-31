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
    var formData = new FormData(this); // Use FormData to handle files
    console.log("Form Data:", formData);

    // Send the data using AJAX
    $.ajax({
      type: "POST",
      url: "http://localhost/final_db_admin/backend/admin_car_controller/add_new_car.php",
      data: formData,
      contentType: false, // Don't set contentType
      processData: false, // Don't process data (needed for FormData)
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


      $("#imageId").on("change", function () {
        var files = this.files;

        if (files.length > 0) {
          var imageUrl = URL.createObjectURL(files[0]);

          // Update the "carImage" source and set the new image
          $("#carImage").attr("src", imageUrl);

          // Update the previousImageUrl variable
          previousImageUrl = imageUrl;

          // Append the file to the FormData object
          formData.append("image", files[0]);
        }
      });
});

  // Function to open a file input dialog
function openFileInput() {
  var input = document.createElement("input");
  input.type = "file";
  input.name = "image"; // Make sure the name matches the expected key in your PHP script
  input.accept = "image/*";

  // Trigger a click event on the input
  input.click();

  // Listen for changes in the file input
  $(input).on("change", function () {
    var files = this.files;

    if (files.length > 0) {
      var imageUrl = URL.createObjectURL(files[0]);

      // Update the "carImage" source and set the new image
      $("#carImage").attr("src", imageUrl);

      // Update the previousImageUrl variable
      previousImageUrl = imageUrl;

      // Append the file to the FormData object
      formData.append("image", files[0]);
    }
  });
}


  // Attach the openFileInput function to a button click event
  // $("#selectImageButton").click(function () {
  //   openFileInput();

  //   // Disable form submission while changing the image
  //   $("#addCarForm").on("submit", function (e) {
  //     e.preventDefault();
  //   });
  // });

  // Change event for ImageUrl input

