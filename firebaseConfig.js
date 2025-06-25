// firebaseConfig.js
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.0.0/firebase-app.js";
import { getAuth, GoogleAuthProvider, signInWithPopup, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.0.0/firebase-auth.js";

const firebaseConfig = {
  apiKey: "AIzaSyCkp6ZNegJ6ZDnZMYOR45OxYaT-bxz2XhM",
  authDomain: "fintrack-3ae79.firebaseapp.com",
  projectId: "fintrack-3ae79",
  storageBucket: "fintrack-3ae79.appspot.com",
  messagingSenderId: "322492784895",
  appId: "1:322492784895:web:3aad5700a48ca88b62ecca"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const provider = new GoogleAuthProvider();

export function handleGoogleSignIn() {
  signInWithPopup(auth, provider)
    .then((result) => {
      window.location.href = "fin41.html"; // redirect on success
    })
    .catch((error) => {
      const errorDiv = document.getElementById("errorMessage");
      errorDiv.style.display = "block";
      errorDiv.textContent = "Login failed: " + error.message;
      console.error(error);
    });
}

// Auto-login redirect
onAuthStateChanged(auth, (user) => {
  if (user) {
    window.location.href = "fin41.html";
  }
});
