<template>
<div>
    <div class="row" v-if="!id_buyer">
        <div class="col-md-8 col-12 mb-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active text-center">
                    Pesanan
                </a>
                <section v-for="(cart, index) in carts" :key="cart.id_buyer">
                <router-link
                            :to="{name: 'admin', params: {id_buyer: cart.id_buyer}}"
                            v-if="cart.kode_pesan !== 1"
                            :class="kelas[index]"
                            class="list-group-item list-group-item-action text-center d-flex justify-content-between">
                    {{ cart.nama}}
                    <span>Rp. {{ number_format(cart.total_harga) }}</span>
                </router-link>
                <span v-else :class="kelas[index]" class="list-group-item list-group-item-action text-center d-flex justify-content-between">
                    {{ cart.nama}}
                    <span>Rp. {{ number_format(cart.total_harga) }}</span>
                </span>
                </section>
            </div>
            <div class="col-4">

            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="list-group">
                <span class="list-group-item bg-primary text-white">Status Pesanan</span>
                <span class="list-group-item list-group-item-danger">Pesanan Belum Dibayar</span>
                <span class="list-group-item list-group-item-warning">Pesanan Sedang Dikerjakan</span>
                <span class="list-group-item list-group-item-primary">Pesanan Siap Diambil/antar</span>
                <span class="list-group-item list-group-item-success">Pesanan Sudah Sampai ke Pembeli</span>
            </div>
        </div>
    </div>
    <div class="row" v-if="id_buyer">
        <div class="col-12 col-md-7 border-info mb-3">
            <div class="collapse show" id="keranjang2">
                <li class="list-group-item bg-info text-white">
                    <h5><i class="fas fa-cart"></i> {{ carts.nama}}</h5>
                </li>
                <li class="list-group-item d-flex justify-content-between" v-for="v in carts.products" :key="v.id_buyer">
                    <span>
                        {{ v.jml_beli }} <b>{{ v.nama_barang }}</b> {{ ' ('+v.harga_barang+") "}}
                    </span>
                    <span class="h5">
                        Rp. {{number_format(v.jml_harga) }}
                    </span>
                </li>
                <li class="list-group-item bg-gray-300 d-flex justify-content-between">
                    <span>
                        Ongkir
                    </span>
                    <span class="h5">
                        Rp. {{number_format(carts.ongkir) }}
                    </span>
                </li>
                <li class="list-group-item bg-info text-white d-flex justify-content-between">
                    <span>
                        Total harga
                    </span>
                    <span class="h5">
                        Rp. {{number_format(carts.total_harga)}}
                    </span>
                </li>
            </div>
        </div>
        <div class="col-12 col-md-5 mb-3">
            <div class="collapse show">
                <li class="list-group-item bg-info text-white">Info pembeli</li>
                <li class="list-group-item">{{ carts.nama}}</li>
                <li class="list-group-item">{{ carts.email}}</li>
                <li class="list-group-item">{{ carts.telepon}}</li>
                <li class="list-group-item">{{ carts.alamat}}</li>
                <li class="list-group-item">{{ carts.catatan}}</li>
            </div>
        </div>
        <div class="col-12 col-md-7">
            <form action="#" method="post">
                <button class="btn btn-success col-12">Print Struk</button>
            </form>
        </div>
    </div>
</div>
</template>

<script>
import number_format from '../../number_format';
export default {
    props: ['id_buyer'],
    data(){
        return{
            carts: {},
            kelas: {},
            number_format
        }
    },
    watch: {
        id_buyer: function(){
            this.getCarts();
        }
    },
    mounted(){
        this.getCarts();
    },
    methods: {
        async getCarts(){
            var id_buyer = this.id_buyer ? this.id_buyer : '';
            var response = await axios.get(`/api/admin/getCarts/${id_buyer}`);
            this.carts = response.data.data;
            var kelas = ['list-group-item-danger', 'list-group-item-warning', 'list-group-item-primary' , 'list-group-item-success'];
            for(var key in this.carts){
                this.kelas[key] = kelas[this.carts[key].kode_pesan -1];
            }
        }
    }
}
</script>

<style>

</style>
