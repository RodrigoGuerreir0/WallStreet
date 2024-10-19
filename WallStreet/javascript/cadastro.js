//mascara CPF
var cpf = document.querySelector("#cpf");

cpf.addEventListener("blur", function () {
  if (cpf.value)
    cpf.value = cpf.value
      .match(/.{1,3}/g)
      .join(".")
      .replace(/\.(?=[^.]*$)/, "-");
});

function mascara(i) {
  var v = i.value;

  if (isNaN(v[v.length - 1])) {
    // impede entrar outro caractere que não seja número
    i.value = v.substring(0, v.length - 1);
    return;
  }

  i.setAttribute("maxlength", "14");
  if (v.length == 3 || v.length == 7) i.value += ".";
  if (v.length == 11) i.value += "-";
}
//.

//Mascara telefone
function mask(o, f) {
  setTimeout(function () {
    var v = mphone(o.value);
    if (v != o.value) {
      o.value = v;
    }
  }, 1);
}

function mphone(v) {
  var r = v.replace(/\D/g, "");
  r = r.replace(/^0/, "");
  if (r.length > 10) {
    r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
  } else if (r.length > 5) {
    r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
  } else if (r.length > 2) {
    r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
  } else {
    r = r.replace(/^(\d*)/, "($1");
  }
  return r;
}

function togglePassword(id) {
  const passwordField = document.getElementById(id);
  const eyeIcon = passwordField.nextElementSibling;

  if (passwordField.type === "password") {
    passwordField.type = "text";
    eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
  } else {
    passwordField.type = "password";
    eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
  }
}
