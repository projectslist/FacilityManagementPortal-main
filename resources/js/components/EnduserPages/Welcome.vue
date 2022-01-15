<template>
    <main>
        <Header/>
        <Dashboard/>
        <Footer/>
    </main>
</template>

<script>
    import Footer from "./Footer";
    import Header from "./Header";
    import Dashboard from "./Dashboard";

    export default {
        name: "Home",
        components:{
            Header,
            Footer,
            Dashboard
        }
    }
</script>

<style scoped>

</style>
