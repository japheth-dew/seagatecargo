const btnn = document.getElementById("collect");
const input = document.querySelector("form");

btnn.addEventListener("click", () => {
  Email.send({
    Host: "smtp.mailtrap.io",
    Username: "db2858868c14eb",
    Password: "8e3e099e540472",
    To: "somewhere@gmail.com",
    From: input.elements["email"].value,
    Subject: "Sent Mail",
    Body:
      input.elements["message"].value +
      "<br>" +
      input.elements["name"].value +
      "<br>" +
      input.elements["telephone"].value,
  }).then((msg) => alert("Info received Successfully"));
});
