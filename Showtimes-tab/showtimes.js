document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("showtimeForm");
  const fields = document.getElementById("form-fields");

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
        <label>Showtime Name:</label><input type="text" name="showname" required>
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
  document.querySelectorAll(".tab-button").forEach(btn => {
    btn.addEventListener("click", () => {
      document.querySelectorAll(".tab-button").forEach(b => b.classList.remove("active"));
      btn.classList.add("active");
      renderForm(btn.dataset.tab);
    });
  });
});