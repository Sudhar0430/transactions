import { initializeApp } from "firebase/app";
import { getAuth, GoogleAuthProvider } from "firebase/auth";

const firebaseConfig = {
  apiKey: "AIzaSyCkp6ZNegJ6ZDnZMYOR45OxYaT-bxz2XhM",
  authDomain: "fintrack-3ae79.firebaseapp.com",
  projectId: "fintrack-3ae79",
  storageBucket: "fintrack-3ae79.firebasetorage.app",
  messagingSenderId: "322492784895",
  appId: "1:322492784895:web:3aad5700a48ca88b62ecca"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const provider = new GoogleAuthProvider();

export { auth, provider };npm -v