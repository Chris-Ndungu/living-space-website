<script setup>
import { reactive } from 'vue'
import axios from 'axios'
import router from '@/router'

const form = reactive({
  name: '',
  email: '',
  password: '',
})

// handle submit and send the data to the database
const handleSubmit = async () => {
  const newUser = {
    name: form.name,
    email: form.email,
    password: form.password,
  }

  // send the mewuser data to the database
  try {
    const response = await axios.post('http://127.0.0.1:8000/api/register', newUser)
    router.push(`/register/${response.data.id}`)
  } catch (error) {
    console.log('Signup failed', error)
  }
}
</script>

<template>
  <main>
    <div>
      <h1>Sign up</h1>
      <!-- input fields; we can use a form -->
      <form @submit.prevent="handleSubmit">
        <!-- name -->
        <input
          v-model="form.name"
          type="text"
          name="username"
          id="username"
          placeholder="Your name"
        />
        <!-- email -->
        <input
          v-model="form.email"
          type="email"
          name="useremail"
          id="useremail"
          placeholder="Email"
        />
        <!-- password -->
        <input
          v-model="form.password"
          type="password"
          name="userpassword"
          id="userpassword"
          placeholder="Password"
        />
        <!-- confirm password -->
        <input type="password" name="" id="" placeholder="Confirm password" />

        <!-- Accept terms of service -->
        <input type="checkbox" name="termsofservice" id="termsofservice" />
        <label for="termsofservice"
          >Creating an account means you're okay with our Terms of Service, Privacy Policy and
          default Notification Settings.</label
        >
        <!-- Sign up button -->
        <button type="submit">Sign up</button>
      </form>
      <button>Sign up with Google</button>
      <button>Sign up with Facebook</button>
    </div>
  </main>
</template>
