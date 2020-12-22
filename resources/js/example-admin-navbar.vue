<div id="page-top" v-if="true">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <sidebar></sidebar>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <topbar></topbar>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <router-view></router-view>

                </div>

            </div>
            <!-- End of Main content -->

            <!-- Footer -->
            <footer-admin></footer-admin>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</div>
