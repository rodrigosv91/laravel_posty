<script>
export default {
    methods: {
        //Fecha o modal quando usuário clicar no X      
        closeClick() {
            myModal.style.display = "none";
        },
        //Fecha o modal quando usuário clicar em qualquer lugar na janela do browser
        janelaClick(event) {
            if (event.target == myModal) {
                myModal.style.display = "none";
            }
        }
    },
    created: function() {
        window.addEventListener('click',this.janelaClick);
    },
    destroyed: function() {
        window.removeEventListener('click', this.janelaClick);
    } 
}
</script>

<template>
    <div>
        <div id="myModal" class="modal-win">
            <div class="modal-content ">
                <div>
                    <span class="close" @click="closeClick">×</span> <!-- @ == short vue for "v-on:click" (capture DOM events) -->
                    <p class="text-center">
                        <slot>Error message</slot>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    /* Janela Modal (background) */
    .modal-win {
        display: block; /* Exibida por padrao */
        position: fixed; /* Permanece na mesma posicao */
        z-index: 1; /* Sobrepoe os outros elementos */
        left: 0;
        top: 0;
        width: 100%; /* Largura total */
        height: 100%; /* Altura total */
        overflow: auto; /* Habilita o scroll caso necessario */
        background-color: rgb(0,0,0); /* Define cor Fallback */
        background-color: rgba(0,0,0,0.4); /* Define cor Preta/transparencia */
    }
 
    /* Conteudo da janela Modal */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% a partir do topo e centralizada */
        padding: 30px;
        border: 1px solid #888;
        width: 70%; /* Pode ser mais ou menos, dependendo do tamanho da tela */
    }
 
    /* Botao Fechar */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

</style>