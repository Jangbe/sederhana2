<template>
<div class="d-flex" id="wrapper">

    <sidebar :auth="auth"></sidebar>

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <navbar :auth="auth"></navbar>

      <router-view :auth="auth"></router-view>

    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
</template>

<script>
import sidebar from './components/Sidebar-user';
import navbar from './components/Navigation';
import topbar from './components/Topbar';
import footer from './components/Footer';
import number_format from './number_format';
export default {
    components: {
        'sidebar': sidebar,
        'topbar': topbar,
        'footer-admin': footer,
        navbar
    },
    data(){
      return {
        auth: {
          isLogin: false,
          isAdmin: false,
          user: {}
        }
      }
    },
    mounted(){
        axios.get('/api/auth/init').then(res => {
            this.auth.isLogin = res.data.isLogin;
            this.auth.user = res.data.user;
        });
    }
}
</script>

<style>

</style>
