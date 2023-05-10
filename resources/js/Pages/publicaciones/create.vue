<template>
    <div
        class="z-10 fixed top-0 h-full w-full text-center"
        style="background-color:rgba(50,50,50,0.5)"
    >
        <div class="mx-auto w-1/3 h-1/3 text-center shadow-lg bg-white mt-8 rounded-lg p-8">
            <p>
                <label for="" class="text-sm italic ml-4">
                    <input 
                        class="my-2 mx-2 shadow-lg bg-white rounded-lg w-2/3 "
                        type="text" v-model="titulo" 
                        placeholder="Titulo"
                    >
                </label>
                <label for="" class="text-sm italic ml-4">
                    <textarea 
                        class="my-2 mx-2 shadow-lg bg-white rounded-lg w-2/3" 
                        placeholder="¿Que esta pasando?"
                        name="contenido" id="contenido" cols="30" rows="5"
                        v-model="contenedor"
                    ></textarea>
                </label>
            </p>
            <p class="my-1">
                <span
                    class="mx-2 inline-block border-2 border-green-200 rounded-md cursor-pointer py-2 px-4 bg-green-100 hover:bg-green-300"
                    @click="guardarFormulario"
                >
                    Guardar
                </span>
                <span
                    class="mx-2 inline-block border-2 border-red-200 rounded-md cursor-pointer py-2 px-4 bg-red-100 hover:bg-red-300"
                    @click="emitCierraComponenteBoton"
                >
                    Cancelar
                </span>
            </p>
        </div>     
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';

export default {
    data(){
        return {
            titulo: '',
            contenedor: '',
        }
    },
    components:{
        AppLayout,
    },
    methods:{
            async guardarFormulario(){
                const data = {
                    titulo: this.titulo,
                    contenido: this.contenedor
                };
                const api = `/api/home`;
                const response = await axios.post(api, data);
                console.log(response);
                this.emitCierraComponente();
            },
            emitCierraComponenteBoton(){
                this.msg = {
                    estado: true,
                    boton:'error',
                    msg:'Operacion cancelada',
                };
                this.emitCierraComponente();
            },
            encodeImagen(){
                if(this.cupo <= 0) {                
                    this.$toast.error(`Valor no valido`);
                    this.ctrl = false;
                }else{
                    this.ctrl = true;
                }
            },
            emitCierraComponente(){
                this.$emit('cierraModal', this.msg);
            }
    }
}
</script>