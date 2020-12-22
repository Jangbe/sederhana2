<template>
<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark shadow">
    <div class="container">
        <button class="navbar-toggler" id="menu-toggle">
            <span class="navbar-toggler-icon"></span>
        </button>

        <router-link class="navbar-brand " to="/"><img src="/img/icons/logo1.png" width="120" height="50"></router-link>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <router-link exact class="nav-link h4" to="/"><i class="fas fa-home"></i> Home</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link h4" to="/about"><i class="fas fa-cog"></i> About</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link h4" to="/belanja"><i class="fas fa-cart-plus"></i> Belanja</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link h4" to="/keranjang"><i class="fas fa-shopping-cart"></i> Keranjang</router-link>
                </li>
                <template v-if="!auth.isLogin">
                    <li class="nav-item">
                        <router-link class="nav-link h4" to="/auth/signup"><i class="fas fa-user-plus"></i> Daftar</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link h4" to="/auth/signin"><i class="fas fa-sign-in-alt"></i> Masuk</router-link>
                    </li>
                </template>
                <template v-else>
                    <li class="nav-item">
                        <router-link class="nav-link h4" to="/auth/profile"><i class="fas fa-user"></i> Profile</router-link>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link h4" @click="logout"><i class="fas fa-sign-out-alt"></i> Keluar</button>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</nav>
</template>

<script>
    export default {
        props: ['auth'],
        data(){
            return{
            }
        },
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
