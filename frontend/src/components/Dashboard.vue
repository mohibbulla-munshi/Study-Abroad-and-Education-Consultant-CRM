<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router'; // Import useRouter
import axios from 'axios';

const router = useRouter(); // Get the router instance

const userName = ref('User'); // Replace with actual user data if available

const logout = async () => {
  try {
    await axios.post('http://localhost:8000/api/logout'); // Call the logout endpoint
    // Perform any necessary cleanup and redirect
    router.push('/'); // Redirect to the login page or home page
  } catch (error) {
    console.error('Logout failed:', error);
  }
};
</script>

<template>
  <div class="dashboard-container">
    <header class="dashboard-header">
      <h1 class="dashboard-title">Dashboard</h1>
      <button class="logout-button" @click="logout">Logout</button>
    </header>

    <main class="dashboard-content">
      <h2>Welcome, {{ userName }}</h2>
      <p>This is your dashboard. Here you can manage your profile and view information.</p>
      <!-- Add more dashboard features here -->
    </main>
  </div>
</template>

<style scoped>
.dashboard-container {
  font-family: 'Arial', sans-serif;
  background-color: #f9f9f9; /* Light background color for the dashboard */
  color: #333; /* Darker text for readability */
  min-height: 100vh;
  padding: 20px;
}

.dashboard-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #FF8C00; /* Dark Orange */
  color: white;
  padding: 20px;
  border-radius: 8px;
}

.dashboard-title {
  font-size: 2rem;
}

.logout-button {
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 4px;
  background-color: #FF6347; /* Tomato */
  color: white;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s;
}

.logout-button:hover {
  background-color: #FF4500; /* Red Orange */
}

.dashboard-content {
  margin-top: 20px;
  padding: 20px;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.dashboard-content h2 {
  margin-bottom: 10px;
}
</style>
