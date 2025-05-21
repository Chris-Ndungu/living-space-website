<script setup>
import router from '@/router'
import axios from 'axios'
import { reactive } from 'vue'

const form = reactive({
  email: '',
  password: '',
})

const handleSubmit = async () => {
  const credentials = {
    email: form.email,
    password: form.password,
  }

  try {
    const response = await axios.post('http://127.0.0.1:8000/api/login', credentials)
    localStorage.setItem('authToken', response.data.token)
    // Navigate to the dashboard
    router.push('/dashboard')
  } catch (error) {
    console.log('Login failed', error.response.data)
  }
}
</script>

<template>
  <main>
    <div>
      <h1>Log in</h1>

      <!-- input fields; we can use a form -->
      <form @submit.prevent="handleSubmit">
        <!-- email -->
        <input
          v-model="form.email"
          type="email"
          name="useremaiul"
          id="useremail"
          placeholder="Email address"
          required
        />
        <!-- password -->
        <input
          v-model="form.password"
          type="password"
          name="userpassword"
          id="userpassword"
          placeholder="Password"
          required
        />
        <!-- login button -->
        <button type="submit">Log in</button>
        <!-- signup with google -->
        <button>Sign up with Google</button>
        <!-- signup with Facebook -->
        <button>Sign up with Facebook</button>
      </form>
    </div>
  </main>
</template>
