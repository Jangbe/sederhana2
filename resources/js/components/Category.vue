<template>
    <div class="col-md-3 d-none d-md-inline">
        <ul class="list-group">
            <li class="list-group-item bg-dark text-light text-center">
                <span class="h5">Kategori</span>
                <button type="button" class="close" data-target="#kategori" data-toggle="collapse">
                    <span aria-hidden="true"><i class="fas fa-plus text-white"></i></span>
                </button>
            </li>
            <div class="collapse show" id="kategori">
                <router-link class="list-group-item list-group-item-action list-group-item-dark" exact :to="{name: 'product'}">Semua</router-link>
                <router-link v-for="category in categories" :key="category.id" class="list-group-item list-group-item-action list-group-item-dark" :to="{name: 'product', params: {category: category.slug}}" v-text="category.nama_kategori"></router-link>
            </div>
        </ul>
    </div>
</template>

<script>
export default {
    props: [],
    data(){
        return {
            categories: []
        }
    },
    mounted(){
        axios.get('/api/kategori/index').then((response) => {
            this.categories = response.data;
        });
    }
}
</script>
