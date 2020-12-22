<template>
  <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-30 p-b-30">
				<form class="login100-form validate-form" @submit.prevent="register" method="POST" action="">
					<span class="login100-form-title p-b-30">
                        Register
					</span>
                    <div class="wrap-input100 validate-input m-b-16" :class="{'alert-validate': isErrors.name}" :data-validate="hasErrors.name">
                        <input class="input100" @focus="hiddenAlert('name')" type="text" v-model="data.name" placeholder="Nama Lengkap">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-user"></span>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" :class="{'alert-validate': isErrors.email}" :data-validate="hasErrors.email">
                        <input class="input100" @focus="hiddenAlert('email')" type="text" v-model="data.email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-envelope"></span>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" :class="{'alert-validate': isErrors.telepon}" :data-validate="hasErrors.telepon">
                        <input class="input100" @focus="hiddenAlert('telepon')" type="text" v-model="data.telepon" placeholder="Nomer Telepon">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-phone"></span>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" :class="{'alert-validate': isErrors.pass}" :data-validate="hasErrors.pass">
                        <input class="input100" @focus="hiddenAlert('pass')" type="password" v-model="data.pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-lock"></span>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" :class="{'alert-validate': isErrors.confirm}" :data-validate="hasErrors.confirm">
                        <input class="input100" @focus="hiddenAlert('confirm')" type="password" v-model="data.confirm" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-lock"></span>
                        </span>
                    </div>

                    <div class="container-login100-form-btn p-t-25">
                        <button class="login100-form-btn">
                            Daftar
                        </button>
                    </div>

                    <div class="text-center w-full p-t-50">
                        <span class="txt1">
                            Sudah punya akun?
                        </span>

                        <router-link class="txt1 bo1 hov1" to="/auth/signin">
                            Silahkan masuk
                        </router-link>
                    </div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    props: ['auth'],
    data(){
        return {
            data: {
                name: '',
                email: '',
                telepon: '',
                pass: '',
                confirm: '',
            },
            isErrors: {
                name: false,
                email: false,
                telepon: false,
                pass: false,
                confirm: false,
            },
            hasErrors: {}
        }
    },
    methods: {
        async register(){
            try{
                let response = await axios.post('/api/auth/register', this.data);
                this.hasErrors = {};
                this.$toasted.show(response.data.message, {
                    duration: 2000,
                    type: 'success'
                });
                this.$router.push('/belanja');
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

        hiddenAlert(name){
            this.isErrors[name] = false;
        }
    }
}
</script>

<style>

</style>
