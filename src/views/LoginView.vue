<template>
    <v-app>
        <main class="login">
      <v-card  width="300" class="mx-auto mt-5">
        <v-card-title>
          <h1>Login</h1>
        </v-card-title>
        <v-card-text>
          <v-form>
            <v-text-field 
              label="Username"
              prepend-icon="mdi-account-circle"
            />
            <v-text-field 
              :type="showPassword ? 'text' : 'password'" 
              label="Password"
              prepend-icon="mdi-lock"
              :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
              @click:append="showPassword = !showPassword"
            />
          </v-form>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-btn color="success">Register</v-btn>
          <v-spacer></v-spacer>
          <v-btn color="info">Login</v-btn>
        </v-card-actions>
      </v-card>
    </main>
    </v-app>
  </template>

<script>
export default {
  name: 'Login',
  data () {
    return {
      showPassword: false
    }
  }
}
</script>

<style scope>
.login{
  padding-top: 48px;
}

</style>