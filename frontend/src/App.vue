<template>
  <div class="app-container">
    <header class="header">
      <img 
        alt="Logo" 
        class="logo" 
        src="https://www.iiedu.co.uk/wp-content/uploads/2024/09/IIEL-Logo2.png" 
      />
      <h1 class="title">Welcome to Our Consultancy</h1>
    </header>

    <section class="main-content">
      <Home v-if="isLoggedIn" />
      <div v-else class="login-container">
        <h2 class="login-title">Login</h2>
        <form @submit.prevent="login" class="login-form">
          <input 
            type="email" 
            v-model="email" 
            placeholder="Email" 
            class="input" 
            required 
          />
          <input 
            type="password" 
            v-model="password" 
            placeholder="Password" 
            class="input" 
            required 
          />
          <button type="submit" class="login-button">Login</button>
          <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
        </form>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router'; // Import useRouter
import axios from 'axios';

const router = useRouter(); // Get the router instance

const isLoggedIn = ref(false);
const email = ref('');
const password = ref('');
const errorMessage = ref('');

const login = async () => {
  try {
    const response = await axios.post('http://localhost:8000/api/login', {
      email: email.value,
      password: password.value,
    });

    if (response.status === 200) {
      isLoggedIn.value = true;
      // Reset form
      email.value = '';
      password.value = '';
      errorMessage.value = '';
      // Redirect to dashboard
      router.push('/dashboard'); // Redirect to the dashboard route
    }
  } catch (error) {
    errorMessage.value = 'Invalid email or password'; // Set error message
  }
};
</script>

<style scoped>
.app-container {
  font-family: 'Arial', sans-serif;
  text-align: center;
  background-color: #FFD700; /* Bright Yellow */
  color: black; /* Black Font Color */
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  position: relative;
}

.header {
  margin-bottom: 2rem;
  padding: 2rem 0; /* Padding added to the header */
}

.logo {
  width: 150px; /* Increased logo size */
  height: auto; /* Maintain aspect ratio */
  border-radius: 10px; /* Added border radius */
  margin-bottom: 1rem; /* Margin between logo and title */
}

.title {
  font-size: 2.5rem;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
  padding: 0 20px; /* Added left and right padding */
}

.main-content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.login-container {
  background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white */
  border-radius: 8px;
  padding: 2rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
  max-width: 300px; /* Fixed width for the login box */
  width: 100%;
}

.login-title {
  font-size: 1.8rem;
  margin-bottom: 1rem;
}

.login-form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.input {
  padding: 0.8rem;
  margin: 0.5rem 0;
  border: 2px solid #000; /* Black border */
  border-radius: 4px;
  width: 100%;
}

.login-button {
  padding: 0.8rem 1.5rem;
  border: none;
  border-radius: 4px;
  background-color: #FF8C00; /* Dark Orange */
  color: white;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.3s;
}

.login-button:hover {
  background-color: #FFD700; /* Bright Yellow on hover */
  transform: scale(1.05); /* Slight scale effect */
}

.error-message {
  color: red; /* Error message color */
  margin-top: 1rem;
}
</style>
