<template>
<div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-md-3">
                <cart></cart>
            </div>
            <div class="col-12 col-md-9">
                <form v-if="isThere" action="#" method="post" @submit.prevent="store">
                    <div class="row mt-3 mt-md-0">
                        <div class="col-12 col-md-6">
                            <div class="card border-info mb-2" id="form-buyer">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <div class="input-group">
                                            <input v-model="input.nama" type="text" class="form-control border-info" :readonly="isLogin" id="nama" autocomplete="off" >
                                        </div>
                                        <template v-if="hasErrors.nama">
                                            <div class="text-danger pl-1" v-for="error in hasErrors.nama" :key="error" v-text="error"></div>
                                        </template>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="input-group">
                                            <input v-model="input.email" type="email" class="form-control border-info" :readonly="isLogin" id="email" autocomplete="off">
                                        </div>
                                        <template v-if="hasErrors.email">
                                            <div class="text-danger pl-1" v-for="error in hasErrors.email" :key="error" v-text="error"></div>
                                        </template>
                                    </div>
                                    <div class="form-group">
                                        <label for="notel">No Telepon</label>
                                        <div class="input-group">
                                            <input v-model="input.notel" min="11" type="number" class="form-control border-info" :readonly="isLogin" id="notel" autocomplete="off">
                                        </div>
                                        <template v-if="hasErrors.notel">
                                            <div class="text-danger pl-1" v-for="error in hasErrors.notel" :key="error" v-text="error"></div>
                                        </template>
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan">Catatan:</label>
                                        <div class="input-group">
                                            <textarea v-model="input.catatan" type="text" class="form-control border-info" id="catatan" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 border-left">
                            <div class="card border-info">
                                <div class="collapse show" id="cekongkir">
                                    <div class="card-body ongkir">
                                        <div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <div class="input-group">
                                                    <input type="text" v-model="input.alamat" class="form-control border-info" id="alamat">
                                                </div>
                                                <template v-if="hasErrors.alamat">
                                                    <div class="text-danger pl-1" v-for="error in hasErrors.alamat" :key="error" v-text="error"></div>
                                                </template>
                                             </div>
                                        </div>
                                        <div>
                                            <label for="metode">Metode Pembayaran:</label>
                                            <select v-model="input.metode" id="metode" class="custom-select border-info">
                                                <option value="1">Di jemput sendiri</option>
                                                <option value="2">Bank BRI</option>
                                                <option value="3">Bank BCA</option>
                                                <option value="4">Bank Mandiri</option>
                                            </select>
                                            <template v-if="hasErrors.metode">
                                                <div class="text-danger pl-1" v-for="error in hasErrors.metode" :key="error" v-text="error"></div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mt-3 mt-md-3" id="btn-kirim">
                            <!-- <div class="card col-12 mb-3 border-info text-info text-center mt-1">
                                <div class="card-body py-2">Total item : <span id="total-item">{{}}</span> | Total berat : <span id="total-berat">{{$jumlah_berat}} kg</span> <br> Ongkir : <span id="ongkir"></span> | Total harga : Rp. <span id="total-harga">{{number_format($total_harga)}}</span></div>
                            </div> -->
                            <button class="col-12 text-center btn btn-outline-dark">Kirim ke keranjang</button>
                        </div>
                    </div>
                </form>
                <div v-else class="card mt-3 mt-md-0">
                    <div class="card-header h5 text-center alert-warning">Keranjang masih kosong, silahkan pilih dulu barang jika ingin berbelanja</div>
                </div>
                <div class="card text-white mt-3">
                    <div class="card-header bg-dark text-white h5 text-center">Cek Status Transaksi</div>
                    <div class="card-body">
                        <p class="card-text text-justify">
                            Apabila anda sudah melakukan pembayaran, dan ingin mengetahui barang yang anda beli sudah dikirim atau belum, silahkan cek status pengiriman dibawah ini dengan No Pesanan yang diberikan sewaktu belanja.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import cart from '../../components/Cart';
export default {
    data(){
        return{
            isThere: false,
            input: {
                nama: '',
                email: '',
                notel: '',
                catatan: '',
                alamat: '',
                metode: '',
                carts: {}
            },
            hasErrors: {},
            carts: {},
            isLogin: false
        }
    },
    watch: {
        cart: function () {
            this.getCarts;
        }
    },
    mounted(){
        this.getCarts();
        this.getUser();
    },
    methods:{
        getUser(){
            axios.get('/api/auth/init').then(user => {
                this.user = user.data.user;
                this.isLogin = user.data.isLogin;
                if (this.isLogin) {
                    this.input.nama = this.user.name;
                    this.input.email = this.user.email;
                    this.input.notel = this.user.telepon;
                }else{
                    this.input.nama = '';
                    this.input.email = '';
                    this.input.notel = '';
                }
            });
        },
        getCarts(){
            axios.get('/api/keranjang/get').then((data) => {
                this.number_format = number_format;
                this.count = data.data.count;
                if (data.data.count == 0) {
                    this.isThere = false;
                }else{
                    this.isThere = true;
                }
                this.carts = data.data.product;
            });
        },

        async store(){
            try{
                this.input.carts = this.carts;
                let respon = await axios.patch('/api/keranjang/store', this.input);
                this.hasErrors = [];
                this.input.nama = '';
                this.input.email = '';
                this.input.notel = '';
                this.input.alamat = '';
                this.input.catatan = '';
                this.input.metode = '';
                this.$toasted.show(respon.data.message, {
                    duration: 5000,
                    type: respon.data.type
                });
                this.$router.push('/belanja');
            }catch(e){
                this.hasErrors = e.response.data.errors;
            }
        }
    }
}
</script>

<style>

</style>
