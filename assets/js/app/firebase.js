// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-app.js";
import { getAuth } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-auth.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyD86vpf4NsXqROAECSOXnqGBzS4ay18JKA",
  authDomain: "login-firebase-225e1.firebaseapp.com",
  projectId: "login-firebase-225e1",
  storageBucket: "login-firebase-225e1.appspot.com",
  messagingSenderId: "336736901053",
  appId: "1:336736901053:web:97e3d80ecc5275710be4d4",
  measurementId: "G-K5W2D8S0EG"
};

// Initialize Firebase
export const app = initializeApp(firebaseConfig);
export const auth = getAuth(app);


