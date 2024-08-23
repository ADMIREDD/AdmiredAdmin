import { createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-auth.js";
import { sendPasswordResetEmail } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-auth.js";
import { signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-auth.js";
import { auth } from "../app/firebase.js";
import * as FunApp from "../app/functions.js";

/** Define constants */
const idInputPasswordRP = "repeatPassword";
const idInputPassword = "password";
const btnPasswordRP = document.getElementById("btn-passwordRP");
const btnPassword = document.getElementById("btn-password");
const objForm = document.getElementById("formUser");
const objFormPasswordRecover = document.getElementById("formPasswordRecover");
const objFormLogin = document.getElementById("formLogin");

if (btnPassword) {
  btnPassword.addEventListener("click", () => FunApp.viewText(idInputPassword));
}

if (btnPasswordRP) {
  btnPasswordRP.addEventListener("click", () => FunApp.viewText(idInputPasswordRP));
}

if (objForm) {
  objForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const jsonUser = FunApp.sendData(objForm.id);
    if (jsonUser.password && jsonUser.user) {
      try {
        const user = jsonUser.user.toLowerCase();
        const pass = jsonUser.password;
        await createUserWithEmailAndPassword(auth, user, pass);
        alert("User Created");
        FunApp.cleanForm(objForm);
        window.location.href = "/SENA/AdmiredAdmin/?c=pqr&m=pqr";
      } catch (error) {
        console.error("Error creating user:", error);
        alert("Validate the data entered");
      }
    } else {
      alert("Validate the data entered");
    }
  });
}

if (objFormPasswordRecover) {
  objFormPasswordRecover.addEventListener("submit", async (e) => {
    e.preventDefault();
    const jsonUser = FunApp.sendData(objFormPasswordRecover.id);
    if (jsonUser.user) {
      try {
        const user = jsonUser.user.toLowerCase();
        await sendPasswordResetEmail(auth, user);
        alert("Password reset email sent!");
        FunApp.cleanForm(objFormPasswordRecover);
      } catch (error) {
        console.error("Error sending password reset email:", error);
        alert("Validate the data entered");
      }
    } else {
      alert("Validate the data entered");
    }
  });
}

if (objFormLogin) {
  objFormLogin.addEventListener("submit", async (e) => {
    e.preventDefault();
    const jsonUser = FunApp.sendData(objFormLogin.id);
    if (jsonUser.password && jsonUser.user) {
      try {
        const user = jsonUser.user.toLowerCase();
        const pass = jsonUser.password;
        await signInWithEmailAndPassword(auth, user, pass);
        window.location.href = "/SENA/AdmiredAdmin/?c=pqr&m=pqr";
      } catch (error) {
        console.error("Error signing in:", error);
        alert("User does not exist");
      }
    } else {
      alert("Validate the data entered");
    }
  });
}
