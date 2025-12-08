document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("showtimeForm");
  const fields = document.getElementById("form-fields");
  const formContainer = document.getElementById("form-container");
  const buttons = document.querySelectorAll(".tab-button");
  const tabContents = document.querySelectorAll(".tab-content");

  function renderForm(type) {
    let html = "";
    let action = "";

    if (type === "add") {
      action = "add_showtime.php";
      html = `
        <label>Movie Name:</label><input type="text" name="moviename" required>
        <label>Auditorium Name:</label><input type="text" name="auditoriumname" required>
        <label>Format:</label><input type="text" name="format" required>
        <label>Start Time:</label><input type="datetime-local" name="start" required>
        <label>End Time:</label><input type="datetime-local" name="end" required>
      `;
    } else if (type === "delete") {
      action = "delete_showtime.php";
      html = `
        <label>Movie Name:</label><input type="text" name="moviename" required>
        <label>Auditorium Name:</label><input type="text" name="auditoriumname" required>
        <label>Start Time:</label><input type="datetime-local" name="start" required>
      `;
    } else if (type === "update") {
      action = "update_showtime.php";
      html = `
        <label>Movie Name:</label><input type="text" name="moviename" required>
        <label>Auditorium Name:</label><input type="text" name="auditoriumname" required>
        <label>New Format:</label><input type="text" name="format" required>
        <label>New Start Time:</label><input type="datetime-local" name="start" required>
        <label>New End Time:</label><input type="datetime-local" name="end" required>
      `;
    }

    form.action = action;
    fields.innerHTML = html;
  }

  // default form
  renderForm("add");

  // tab switching
  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      // remove active class from all buttons
      buttons.forEach(b => b.classList.remove("active"));
      btn.classList.add("active");

      // hide all tab contents
      tabContents.forEach(tc => tc.classList.remove("active"));

      // show the selected tab content
      const target = document.getElementById(btn.dataset.tab);
      if (target) target.classList.add("active");

      // hide form if Popular tab is clicked
      if (btn.dataset.tab === "popular-content") {
        formContainer.style.display = "none";
      } else {
        formContainer.style.display = "block";
        renderForm(btn.dataset.tab); // only render when not popular
      }
    });
  });
});