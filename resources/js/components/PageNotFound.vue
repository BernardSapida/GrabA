<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <main>
        <Navigation />
        <div class="container">
            <div>
                <span class="title">404</span>
                <div class="line-breaker"></div>
                <p class="label">The page you requested was not found</p>
            </div>
        </div>
        <Footer />
    </main>
</template>

<script>
    import Navigation from './Navigation';
    import Footer from './Footer';

    export default {
        components: {
            Navigation,
            Footer
        },
    }
</script>

<style lang="scss" scoped>
    main {
        div.container {
            display: grid;
            align-items: center;
            height: 80vh;

            & div {
                text-align: center;
                color: rgba(159, 159, 159, 0.54);

                &.line-breaker {
                    margin: auto;
                    max-width: 300px;
                    height: 1px;
                    background-color: rgba(3, 3, 3, 0.172);
                }
            }

            & p.label {
                margin-top: 10px;
                font-weight: bolder;
                font-size: 16px;
            }

            & span.title {
                font-weight: bolder;
                font-size: 6rem;
                line-height: 1;
            }
        }
    }
</style>