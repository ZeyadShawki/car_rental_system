$(document).ready(function () {
function populateImage(imageUrl) {
  $("#carImage").attr("src", imageUrl);
}

function populateCarname() {
   var selectedBrand = $("#brand").val();

   // Make an AJAX request to fetch car names for the selected brand
   $.ajax({
     type: "GET",
     url: "http://localhost/final_db_admin/backend/admin_car_controller/admin_get_brand_from_car.php",
     data: { brand: selectedBrand },
     dataType: "json",
     success: function (data) {
       // Populate car name dropdown
       populateDropdown("#CarName", data.carNames, null);
     },
     error: function (xhr, status, error) {
       console.error(xhr.responseText);
       alert("Error loading car names: " + xhr.responseText);
     },
   });
}
  $("#brand").change(function () {
  populateCarname();
  });

$("#imageId").change(function () {
    // Assuming you want to preview the selected image
    var input = this;
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#carImage").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
});

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
        console.log(data);
        // Unbind change event to prevent recursion
        // $("#OfficeCountry, #OfficeCity").off("change");
            populateImage(data.carData.imageUrl);

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

        console.log(data.countries);
        populateDropdownCity(
          "#OfficeCity",
          data.countries.map((e) => {
            if (e.country == data.selectedCountry) return e;
          }),
          data.carData.OfficeID
        );

        // Populate Car Name dropdown
        populateDropdown("#CarName", data.allCarNames, data.carData.carname);

        // Populate Brand dropdown
        populateDropdown("#brand", data.allBrandNames, data.carData.brand);

          populateCarname();

        // Rebind change event after updating dropdown values
        $("#OfficeCountry").change(function () {
          var selectedCountry = $(this).val();

          // Make an AJAX request to fetch cities for the selected country
          $.ajax({
            type: "GET",
            url:
              "http://localhost/final_db_admin/backend/office_controller/get_cities.php?country=" +
              selectedCountry,
            dataType: "json",
            success: function (data) {
              console.log(data);
              // Populate city dropdown
              populateDropdownCity2("#OfficeCity", data, 0);
            },
            error: function (xhr, status, error) {
              console.error(xhr.responseText);
              alert("Error loading cities: " + xhr.responseText);
            },
          });
        });

        // Populate other input fields
        $("#Year").val(data.carData.Year);
        $("#rentValue").val(data.carData.rentvalue);
        $("#ImageUrl").val(data.carData.imageUrl);
        $("#carStatus").val(data.carData.carStatus);
      },
      error: function (xhr, status, error) {
        console.log(xhr);
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

  function populateDropdownCity2(selector, options, selectedValue) {
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
        '<option value="' + value.id + '">' + value.name + "</option>"
      );
    });

    // Set the selected value
    if (selectedValue) {
      // console.log(selectedValue);

      cityDropdown.val(selectedValue);
    }
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
        $("<option></option>").attr("value", option).text(option)
      );
    });

    // Set the selected value
    if (selectedValue) {
      dropdown.val(selectedValue);
    }
  }
  function removeDuplicates(array) {
    return array.filter((value, index, self) => self.indexOf(value) === index);
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
      if (!$(this).val() && $(this).attr("id") !== "imageId") {
        // Skip checking the imageId field
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
  var formData = new FormData();
  var input = document.getElementById("imageId");

  formData.append("carId", carId); // Replace 'yourCarIdValue' with the actual carId value
  formData.append("image", input.files[0]);

  // Add other form fields as needed
  formData.append("OfficeCity", $("#OfficeCity").val());
  formData.append("Year", $("#Year").val());
  formData.append("rentValue", $("#rentValue").val());
  formData.append("carStatus", $("#carStatus").val());
  formData.append("brand", $("#brand").val());
  formData.append("CarName", $("#CarName").val());

  $.ajax({
    url: "http://localhost/final_db_admin/backend/admin_car_controller/admin_edit_car.php",
    dataType: "text",
    cache: false,
    contentType: false,
    processData: false,
    data: formData,
    type: "post",
    success: function (php_script_response) {
      console.log(php_script_response);
      alert("Record updated successfully");
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
      alert("Error: " + xhr.responseText);
    },
  });
});

});
