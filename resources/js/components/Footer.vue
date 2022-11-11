<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <footer class="text-white">
        <div class="main-footer p-3">
            <div>
                <img src="images/GRABA_LOGO.png" alt="GRABA LOGO"/>
                <p>GRABA is designed to provide a tracker of<br>construction materials inventory utilized on-site.</p>
            </div>
            <div>
                <p><strong>Authors:</strong></p>
                <p>Jennielle Ann P. Tafalla</p>
                <p>Nickerson C. Torres</p><br/>
    
                <p><strong>Developers:</strong></p>
                <p>Enrique B. Tañada III</p>
                <p>Bernard V. Sapida</p>
            </div>
            <div>
                <p><strong>Contact:</strong></p>
                <p><b-icon icon="wallet-fill"></b-icon> jennielleann27@gmail.com</p>
                <p><b-icon icon="wallet-fill"></b-icon> torresnickerson8@gmail.com</p><br/>
    
                <p><strong>Contact:</strong></p>
                <p><b-icon icon="wallet-fill"></b-icon> enriquetanada@gmail.com</p>
                <p><b-icon icon="wallet-fill"></b-icon> bernardsapida1706@gmail.com</p>
            </div>
        </div>
        <div class="bottom-footer bg-dark p-3">
            <p>CONSTRUCTION MATERIALS INVENTORY TRACKING WEBSITE</p>
            <p>Undergraduate Capstone</p>
            <p>BS Civil Engineering</p>
            <p>College of Engineering and Information Technology Cavite State University - Main Campu</p>
        </div>
    </footer>
</template>

<style lang="scss">
    footer {
        margin: 0;
        
        & .main-footer {
            background-color: hsl(220, 1%, 60%);
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-around;
            gap: 20px;

            & > div {
                & img {
                    margin-bottom: 20px;
                    max-width: 150px;
                    width: 100%;
                }

                & p {
                    margin: 0;
                }
            }
        }

        & .bottom-footer {
            & p {
                margin: 0;
                text-align: center;
                font-size: 10px;
            }
        }
    }

    @media screen and (max-width: 376px) {
        footer {
            & .main-footer {
                justify-content: flex-start;
            }
        }
    }
</style>