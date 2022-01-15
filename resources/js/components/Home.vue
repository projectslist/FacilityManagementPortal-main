<template>
<main>
<Header/>
    <LeftSideMenu/>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">




                    <router-view></router-view>
                    <vue-progress-bar></vue-progress-bar>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
<Footer/>
</main>
</template>

<script>
    import Footer from "./Footer";
    import Header from "./Header";
    import LeftSideMenu from "./LeftSideMenu";
    import Dashboard from "./Dashboard";
    export default {
        name: "Home",
        components:{
            Header,
            Footer,
            LeftSideMenu,
            Dashboard
        }
    }
</script>

<style scoped>

</style>
