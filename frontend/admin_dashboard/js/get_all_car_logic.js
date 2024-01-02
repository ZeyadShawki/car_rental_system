$(document).ready(function () {
  // Fetch car data using AJAX
  $.ajax({
    type: "GET",
    url: "http://localhost/final_db_admin/backend/admin_dashboard_controller/admin_get_all_cars.php", // Replace with the actual file path
    dataType: "json",
    success: function (data) {
      // Populate the car table
      var carTableBody = $("#carTableBody");
      carTableBody.empty();
      $.each(data, function (index, car) {
        var editButton =
          '<button class="btn btn-primary" onclick="editCar(' +
          car.id +
          ')">Edit</button>';
        var deleteButton =
          '<button class="btn btn-danger" onclick="deleteCar(' +
          car.id +
          ')">Delete</button>';
        var row =
          "<tr><td>" +
          car.carname +
          "</td><td>" +
          car.brand +
          "</td><td>" +
          car.year +
          '</td><td><img src="' +
          car.imageUrl +
          '" alt="Car Image" style="max-width: 100px; max-height: 100px;"></td><td>' +
          car.carStatus +
          "</td><td>" +
          editButton +
          " " +
          deleteButton +
          "</td></tr>";
        carTableBody.append(row);
      });
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
      alert("Error loading cars: " + xhr.responseText);
    },
  });

  window.editCar = function (carId) {
    // Redirect to the edit car page with the car ID
    window.location.href =
      "../admin_car_front_end/edit_car.html?carId=" + carId;
  };

  // Function to handle deleting a car
  window.deleteCar = function (carId) {
    // Display SweetAlert2 confirmation dialog
    Swal.fire({
      title: "Are you sure?",
      text: "Once deleted, you won't be able to recover this car record!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        console.log('wwwww');
        // If user confirms, send AJAX request to delete the car
        $.ajax({
          type: "POST",
          url: "http://localhost/final_db_admin/backend/admin_car_controller/admin_delete_car.php", // Replace with the actual file path
          data: { carId: carId },
          success: function (response) {
            console.log(carId);
            console.log('ssssss');
            // Reload the table after successful deletion
            fetchCarData();
          },
          error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert("Error deleting car: " + xhr.responseText);
          },
        });
      }
    });
  };
 

  // Function to fetch car data
  function fetchCarData() {
    $.ajax({
      type: "GET",
      url: "http://localhost/final_db_admin/backend/admin_dashboard_controller/admin_get_all_cars.php", // Replace with the actual file path
      dataType: "json",
      success: function (data) {
        console.log('ssasdsd');
        // Populate the car table
        var carTableBody = $("#carTableBody");
        carTableBody.empty();
        $.each(data, function (index, car) {
          var editButton =
            '<button class="btn btn-primary" onclick="editCar(' +
            car.id +
            ')">Edit</button>';
          var deleteButton =
            '<button class="btn btn-danger" onclick="deleteCar(' +
            car.id +
            ')">Delete</button>';
          var row =
            "<tr><td>" +
            car.carname +
            "</td><td>" +
            car.brand +
            "</td><td>" +
            car.year +
            '</td><td><img src="' +
            car.imageUrl +
            '" alt="Car Image" style="max-width: 100px; max-height: 100px;"></td><td>' +
            car.carStatus +
            "</td><td>" +
            editButton +
            " " +
            deleteButton +
            "</td></tr>";
          carTableBody.append(row);
        });
      },
    });
  }

  // Initial fetch when the page loads
  $(document).ready(function () {
    fetchCarData();
  });
});
