<template>
  <main>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img
          src="/img/logo.png"
          alt="Logo"
          class="brand-image img-circle elevation-3"
          style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light">Admin Area</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel  -->
        <tr v-for="user in userDetails" :key="user.id">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img
                :src="'/img/' + user.profile_image"
                class="mx-auto img-fluid img-circle d-block"
                style="height: 50px; width: 50px"
                alt="avatar"
              />
            </div>
            <div class="info mt-3">
              <a href="#" class="d-block">
                {{ user.name }}
              </a>
            </div>
          </div>
        </tr>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <li class="nav-item">
              <router-link to="Dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt blue"></i>
                <p>Dashboard</p>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link to="Profile" class="nav-link">
                <i class="nav-icon fas fa-user green"></i>
                <p>Profile</p>
              </router-link>
            </li>

            <li class="nav-item">
              <a href="" @click="logout" class="nav-link">
                <i class="nav-icon fas fa-power-off red"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  </main>
</template>

<script>
export default {
  name: "LeftSideMenu",
  data() {
    return {
      userDetails: {},
    };
  },
  methods: {
    fetchUserDetails() {
      axios
        .get("userDetails")
        .then((response) => (this.userDetails = response.data));
    },
    logout() {
      window.location.href = "/logout";
    },
  },
  created() {
    this.fetchUserDetails();
    Fire.$on("ProfileUpdate", () => {
      this.fetchUserDetails();
    });
  },
};
</script>

<style scoped>
</style>
