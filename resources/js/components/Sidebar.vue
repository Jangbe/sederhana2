<template>
  <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Sederhana <sup>2</sup></div>
            </a>

            <!-- Heading -->
            <div class="sidebar-heading">
                Dashboard
            </div>

            <!-- Nav Item - Dashboard -->
            <router-link class="nav-item scroll-trigger" exact :to="{name: 'admin'}">
            <li class="nav-link">
                <i class="fas fa-fw fa-inbox"></i>
                <span>Pesanan</span>
            </li>
            </router-link>

            <!-- Nav Item - Dashboard -->
            <router-link class="nav-item scroll-trigger" to="/admin/struct">
            <li class="nav-link">
                <i class="fas fa-sticky-note"></i>
                <span>Buat Struk</span>
            </li>
            </router-link>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Produk
            </div>

            <!-- Nav Item - Dashboard -->
            <router-link class="nav-item scroll-trigger" to="/admin/category">
            <li class="nav-link">
                <i class="fas fa-fw fa-tags"></i>
                <span>Kategori</span>
            </li>
            </router-link>

            <!-- Nav Item - Charts -->
            <router-link class="nav-item scroll-trigger" to="/admin/add-product">
            <li class="nav-link">
                <i class="fas fa-fw fa-plus"></i>
                <span>Tambah Barang</span>
            </li>
            </router-link>

            <!-- Nav Item - Charts -->
            <router-link class="nav-item scroll-trigger" to="/admin/edit-product">
            <li class="nav-link">
                <i class="fas fa-fw fa-edit"></i>
                <span>Edit Barang</span>
            </li>
            </router-link>

            <!-- Nav Item - Charts -->
            <router-link class="nav-item scroll-trigger" to="/admin/add-stock">
            <li class="nav-link">
                <i class="fas fa-fw fa-plus-circle"></i>
                <span>Tambah Stok Barang</span>
            </li>
            </router-link>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Charts -->
            <router-link class="nav-item scroll-trigger" to="/profile">
            <li class="nav-link">
                <i class="fas fa-fw fa-user"></i>
                <span>Profile</span>
            </li>
            </router-link>

            <!-- Nav Item - Charts -->
            <li class="nav-item scroll-trigger">
                <button data-toggle="modal" data-target="#logoutModal" class="nav-link">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></button>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
</template>

<script>
export default {
    methods: {

    }
}
</script>

<style>

</style>
