<template>
  <div class="container-login100">
    <div class="wrap-login100 p-l-50 p-r-50 p-t-30 p-b-30">
        <form class="login100-form validate-form" @submit.prevent="login" method="POST" action="">
            <span class="login100-form-title p-b-30">
                Login
            </span>
            <div class="wrap-input100 validate-input m-b-16" :class="{'alert-validate': isErrors.email}" :data-validate="hasErrors.email">
                <input class="input100" type="text" @focus="hideError('email')" v-model="data.email" placeholder="Email">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <span class="lnr lnr-envelope"></span>
                </span>
            </div>

            <div class="wrap-input100 validate-input m-b-16" :class="{'alert-validate': isErrors.password}" :data-validate="hasErrors.password">
                <input class="input100" type="password" @focus="hideError('password')" v-model="data.password" placeholder="Password">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <span class="lnr lnr-lock"></span>
                </span>
            </div>

            <div class="contact100-form-checkbox m-l-4">
                <input class="input-checkbox100" id="ckb1" type="checkbox" v-model="data.remember">
                <label class="label-checkbox100" for="ckb1">
                    Simpan sandi
                </label>
            </div>

            <div class="container-login100-form-btn p-t-25">
                <button class="login100-form-btn" type="submit">
                    Masuk
                </button>
            </div>

            <div class="text-center w-full p-t-90">
                <span class="txt1">
                    Bukan member?
                </span>

                <router-link class="txt1 bo1 hov1" to="signup">
                    Daftar sekarang juga
                </router-link>
            </div>
        </form>
    </div>
  </div>
</template>

<script>
export default {
    props: ['auth'],
    data(){
        return{
            data: {
                email: '',
                password: '',
                remember: null,
            },
            isErrors: {
                email: false,
                password: false,
            },
            hasErrors: {}
        }
    },
    methods: {
        async login(){
            try{
                var response = await axios.post('/api/auth/login', this.data);
                this.hasErrors = {};
                this.$toasted.show(response.data.message, {
                    duration: 2000,
                    type: response.data.type
                });
                if (response.data.type == 'success') {
                    this.auth.isLogin = true;
                    if (response.data.role == 1) {
                        this.auth.isAdmin = true;
                        this.$router.push('/admin/pesanan');
                    }else{
                        this.$router.push('/belanja');
                    }
                }
            }catch(e){
                this.hasErrors = e.response.data.errors;
                for(var index in this.isErrors){
                    if (this.hasErrors[index]) {
                        this.isErrors[index] = true;
                    }
                    else{
                        this.isErrors[index] = false;
                    }
                }
            }
        },

        hideError(name){
            this.isErrors[name] = false;
        }
    }
}
</script>

<style>

</style>
