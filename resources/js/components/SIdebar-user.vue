<template>
<!-- Sidebar -->
<div class="list-group-item-dark d-md-none" id="sidebar-wrapper">
    <div class="sidebar-heading">Sederhana </div>
    <div class="list-group list-group-flush">
        <router-link to="/" exact class="list-group-item list-group-item-action js-scroll-trigger list-group-item-dark"><i class="fas fa-home"></i> Home</router-link>
        <router-link to="/about" class="list-group-item list-group-item-action js-scroll-trigger list-group-item-dark"><i class="fas fa-cog"></i> About</router-link>
        <router-link to="/belanja" class="list-group-item list-group-item-action js-scroll-trigger list-group-item-dark"><i class="fas fa-cart-plus"></i> Belanja</router-link>
        <router-link to="/keranjang" class="list-group-item list-group-item-action js-scroll-trigger list-group-item-dark"><i class="fas fa-shopping-cart"></i> Keranjang</router-link>
        <template v-if="!auth.isLogin">
            <router-link to="/auth/signup" class="list-group-item list-group-item-action js-scroll-trigger list-group-item-dark"><i class="fas fa-user-plus"></i> Daftar</router-link>
            <router-link to="/auth/signin" class="list-group-item list-group-item-action js-scroll-trigger list-group-item-dark"><i class="fas fa-sign-in-alt"></i> Masuk</router-link>
        </template>
        <template v-else>
            <router-link to="/auth/signup" class="list-group-item list-group-item-action js-scroll-trigger list-group-item-dark"><i class="fas fa-user-plus"></i> Profile</router-link>
            <button class="list-group-item list-group-item-action js-scroll-trigger list-group-item-dark" @click.prevent="logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </template>
    </div>
</div>
<!-- /#sidebar-wrapper -->
</template>

<script>
export default {
    props: ['auth'],
    methods: {
        logout(){
            axios.get('/api/auth/logout').then(data => {
                this.$toasted.show(data.data.message, {
                    duration: 2000,
                    type: 'success'
                });
            });
            this.auth.isLogin = false;
            this.auth.isAdmin = false;
            this.auth.user = {};
            this.$router.push('/belanja');
        }
    }
}
</script>

<style>

</style>
