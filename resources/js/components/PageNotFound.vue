<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div class="container">
        <div>
            <span class="title">404</span>
            <div class="line-breaker"></div>
            <p class="label">The page you requested was not found</p>
        </div>
        <Footer />
    </div>
</template>

<script>
    import Footer from './Footer';
    export default {
        components: {
            Footer
        },
    }
</script>

<style scoped>
    .container {
        display: grid;
        align-items: center;
        height: 100vh;
    }

    .container div {
        text-align: center;
        color: rgba(159, 159, 159, 0.54);
    }

    .container div span.title {
        font-weight: bolder;
        font-size: 6rem;
        line-height: 1;
    }

    .container div div.line-breaker {
        margin: auto;
        max-width: 300px;
        height: 1px;
        background-color: rgba(3, 3, 3, 0.172);
    }

    .container div p.label {
        margin-top: 10px;
        font-weight: bolder;
        font-size: 16px;
    }
</style>