<template>
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <kategori :active="active"></kategori>
                <cart :hasChange="hasChange" class="d-none d-md-inline"></cart>
            </div>
            <div class="col-12 col-md-9 mt-4">
                <form action="#" method="post" @submit.prevent="cart">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-5">
                            <img :src="'/img/barang/'+product.gambar" class="card-img border" style="width: 100%; height: 400px;">
                        </div>
                        <div class="col-md-7">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <h5 class="card-title">{{ product.nama }}</h5>
                                </div>
                                <div class="col-6 col-md-6 text-right">
                                    <span class="border h5 px-2 px-md-3 py-1 rounded bg-secondary text-white" id="jumlah-rp">
                                        Rp. {{ number_format(harga) }}
                                    </span>
                                </div>
                            </div>
                            <h6 class="card-title text-muted">{{product.kategori}}</h6>
                            <p class="card-title text-muted">
                                Stok {{ product.stok_kata }}
                            </p>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-5 col-6 col-form-label">Kode Barang</label>
                                <div class="col-sm-7 col-6">
                                    <input type="text" class="form-control" v-model="product.id" id="inputEmail3" readonly>
                                </div>
                            </div>

                            <div class="form-group row" v-for="(value, name) in product.stok" :key="name">
                                <label for="jml" class="col-sm-5 col-6">Beli per {{name}}</label>
                                <div class="col-sm-7 col-6">
                                    <input type="number" @keyup="cekHarga(form.detail)" @change="cekHarga(form.detail)" v-model="form.detail[name]" class="form-control" id="jml" min="0" :max="value">
                                </div>
                            </div>

                            <div class="input-group">
                                <button class="btn btn-outline-dark col-12">Tambah ke keranjang</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import number_format from '../../number_format';
import Cart from '../../components/Cart.vue';
export default {
  components: { Cart },
    data(){
        return{
            product: {},
            form: {
                id: '',
                detail: {},
            },
            active: '',
            number_format,
            hasChange: 0,
            harga: 0,
        }
    },
    mounted(){
        this.getProduct();
    },
    methods: {
        getProduct(){
            // this.number_format = number_format;
            axios.get(`/api/product/index/${this.$route.params.id}/show`).then((data) => {
                this.product = data.data.data;
                this.harga = this.product.harga;
                this.active = this.product.slug;
            });
        },
        async cart(){
            this.form.id = this.product.id;
            var response = await axios.post('/api/keranjang/make', this.form);
            this.hasChange++;
            this.$toasted.show(response.data.message, {
                type: response.data.type,
                duration: 2000
            });
        },
        cekHarga(detail){
            var rincian = this.product.rincian;
            var hasil = {};
            let result = 0;
            for( var value in detail){
                hasil[value] = detail[value] * rincian[value];
            }
            for(var key in hasil){
                result += hasil[key];
            }
            this.harga = this.product.harga * result;
        }
    }
}
</script>
