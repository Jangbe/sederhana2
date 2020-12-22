<template>
<div class="row">

    <div class="col-md-8 col-12">
        <div class="form-group">
            <input type="text" v-model="word" @keyup="search" placeholder="cari nama barang..." class="form-control mb-3">
        </div>
        <ul class="list-group mb-2 barang">
            <li class="list-group-item bg-secondary text-white d-flex justify-content-between">
                Nama Barang
                <span>Opsi</span>
            </li>
            <li class="list-group-item" v-for="product in products" :key="product.id">
                <form action="#" method="post" @submit.prevent="cart(product.id)">
                    <span class="d-md-inline-block d-none" v-text="product.nama"></span>
                    <span class="d-sm-inline-block d-md-none" v-text="product.singkatan"></span>
                    <button class="btn btn-secondary float-right ml-2" type="submit"><i class="fas fa-plus"></i></button>
                    <input v-for="(value, name) in product.stok" :key="name"
                            type="number"
                            class="form-control col-md-2 col-2 d-inline-block float-right"
                            v-model="form[product.id]['detail'][name]"
                            :placeholder="name">
                </form>
            </li>
        </ul>
        <nav>
            <ul class="pagination pagination-secondary">
                <li class="page-item">
                    <router-link v-if="link.prev" class="page-link" :to="{name: 'admin.struct', params: {page: (meta.current_page-1)}}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</router-link>
                    <a v-else class="page-link" aria-hidden="true" aria-disabled="true" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>

                <li class="page-item page-item-secondary" v-for="(v, i) in meta.last_page" :key="i" :class="{active: (i == meta.current_page -1)}">
                    <router-link class="page-link" :to="{name: 'admin.struct', params: {page: (i+1)}}" v-text="i+1"></router-link>
                </li>

                <li class="page-item">
                    <router-link v-if="link.next" class="page-link" :to="{name: 'admin.struct', params: {page: (meta.current_page+1)}}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</router-link>
                    <a v-else class="page-link disabled" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-12 col-md-4">
        <form action="#" method="post" @submit.prevent="make">
            <span class="text-danger text-small" v-if="hasError" v-text="hasError"></span>
            <input type="text" class="form-control" minlength="5" maxlength="20" v-model="nama.nama" placeholder="Nama...">
            <button class="btn btn-secondary mb-2 col-12">Tambahkan</button>
        </form>
        <cart :hasChange="hasChange"></cart>
    </div>
</div>
</template>

<script>
import Cart from '../../components/Cart.vue';
import number_format from '../../number_format';
export default {
    props: ['page'],
    data(){
        return {
            hasChange: 0,
            products: {},
            form: {},
            number_format,
            link: {},
            meta: {},
            word: '',
            nama: {
                nama: ''
            },
            hasError: ''
        }
    },
    mounted(){
        this.getProducts();
    },
    watch: {
        page: function(){
            this.getProducts(this.page);
        }
    },
    methods: {
        getProducts(page = this.page){
            axios.get(`/api/admin/struct?page=${page}`).then(data => {
                this.products = data.data.data;
                for(var i in this.products){
                    this.form[this.products[i].id] = { id: '', detail: {},};
                }
                this.link = data.data.links;
                this.meta = data.data.meta;
            });
            this.number_format = number_format;
        },
        async cart(id){
            this.form[id].id = id;
            var response = await axios.post('/api/keranjang/make', this.form[id]);
            this.form[id].detail = {};
            this.hasChange++;
            this.$toasted.show(response.data.message, {
                type: response.data.type,
                duration: 2000
            });
        },
        search(){
            axios.get(`/api/admin/struct/${this.word}`).then(data => {
                this.products = data.data.data;
                for(var i in this.products){
                    this.form[this.products[i].id] = { id: '', detail: {},};
                }
                this.link = data.data.links;
                this.meta = data.data.meta;
            });
        },
        async make(){
            try{
                var response = await axios.post('/api/admin/make', this.nama);
                this.hasError = '';
                this.nama.nama = '';
                this.$toasted.show(response.data.message, {
                    duration: 5000,
                    type: response.data.type
                });
            }catch(e){
                this.hasError = e.response.data.errors.nama[0];
                console.log(e.response.data.errors);
            }
        }
    }
}
</script>

<style>

</style>
