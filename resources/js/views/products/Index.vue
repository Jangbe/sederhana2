<template>
<div>
    <div class="container" id="body">
        <div class="row">
            <div class="col-md-3">
                <kategori :active="active"></kategori>
                <cart class="d-none d-md-inline"></cart>
            </div>
            <div class="col-12 col-md-9 mt-4">
                <div class="row">
                    <div class="col-6 col-md-3 mb-2" v-for="product in products" :key="product.id">
                        <router-link :to="{name: 'product.detail', params: {id: product.id, category: product.slug}}">
                            <div class="card border-dark">
                                <img :src="'/img/barang/'+product.gambar" class="card-img-top" style="width: 100%; height: 180px">
                                <div class="card-body bg-dark">
                                    <span class="text-light">{{product.nama}}</span>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Category from '../../components/Category.vue';
export default {
    props: ['category'],
    data(){
        return{
            products: {},
            active: '',
        }
    },
    watch:{
        category: function (){
            this.getProducts();
        }
    },
    mounted(){
        this.getProducts();
    },

    methods: {
        getProducts(){
            var category = this.category ? this.category : '';
            this.active = category;
            axios.get(`/api/product/index/${category}`).then((response) => {
                this.products = response.data.data;
                // console.log(this.category);
            });
        }
    }
}
</script>
