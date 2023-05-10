<template>
    <AppLayout title="">
        <Create
            v-if="mostrar_componente_crear"
            @cierraModal="cerrandoModal"
        />
        <template>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Publicaciones
            </h2>
        </template>

        <div class="py-4 w-2/3 mx-auto top-0">
            <div class="mx-auto w-10/12 text-center shadow-lg bg-white mt-8 rounded-lg p-8">
                <section class="grid grid-cols-1 md:grid-cols-2">
                    <article class="col-span-2 text-right">
                        <span 
                            title="Agregar una nueva publicacion" 
                            class="border-2 border-green-300 bg-green-200 pt-[12px] pb-1 px-2 rounded-lg hover:bg-green-300 cursor-pointer"
                            @click="componenteCrear()"
                        >
                            <i class="fa-light fa-plus text-4xl text-gray-600 hover:text-gray-700"></i>
                        </span>
                    </article>
                </section>
                <section v-if="publicaciones === undefined">
                    <p>
                        Aun no hay publicaciones, se el primero!!
                    </p>
                </section>
                <section v-else-if="publicacion === undefined" v-for="publicacion in publicaciones" :key="publicacion" class="pt-3 grid grid-cols-1">
                    <article class="rounded-lg shadow-lg">
                        <div class="pt-2 font-bold">
                            {{ publicacion.user.name }}
                        </div>
                        <p class="my-2 text-xs italic text-gray-500 text-left ml-4 uppercase">
                            {{ publicacion.titulo }}
                        </p>
                        <p class="ml-4 text-right md:text-left px-8 mb-4">
                          {{ publicacion.contenido }}  
                        </p>
                        <br><br>
                        <p class="text-left text-md text-gray-400 ml-3 mb-3 inline-block float-left">
                            {{ publicacion.fecha_publicacion }}
                        </p>
                        <p 
                            class="text-right inline-block float-right text-md mr-3 mb-3 cursor-pointer hover:underline decoration-1 hover:font-bold"
                            @click="verComentario(publicacion.id)"    
                        >
                            Ver comentario
                        </p>
                    </article>
                </section>
                <section v-else class="pt-3 grid grid-cols-1">
                    <article class="rounded-lg shadow-lg">
                        <div class="pt-2 font-bold">
                            {{ publicacion.user.name }}
                        </div>
                        <p class="my-2 text-xs italic text-gray-500 text-left ml-4 uppercase">
                            {{ publicacion.titulo }}
                        </p>
                        <p class="ml-4 text-right md:text-left px-8 mb-4">
                          {{ publicacion.contenido }}  
                        </p>
                        <br><br>
                        <p class="text-left text-md text-gray-400 ml-3 mb-3 inline-block float-left">
                            {{ publicacion.fecha_publicacion }}
                        </p>
                    </article>
                    <section class="grid grid-cols-1">
                        <article class="mt-8 rounded-lg shadow-lg">
                            <textarea 
                                class="my-2 mx-2 shadow-lg bg-white rounded-lg w-[80%]" 
                                placeholder="    Deja tu comentario"
                                name="comentario" id="comentario" cols="30" rows="2"
                                v-model="comentario"
                            ></textarea>
                            <div 
                                class="border-2 border-blue-500 w-[80%] bg-blue-300 font-italic px-5 py-3 rounded-lg hover:bg-blue-400 cursor-pointer text-center mx-auto mb-3"
                                @click="guardarComentario()"    
                            >
                                Publicar
                            </div>
                        </article>
                    </section>
                    <section v-for="comentario in comentarios" :key="comentario" class="pt-3 grid grid-cols-1">
                        <article class="mt-8 rounded-lg shadow-lg">
                            <p class="my-2 text-xs italic text-gray-500 text-left ml-4 uppercase">
                                {{ comentario.user.name }}
                            </p>
                            <p class="ml-4 text-right md:text-left px-8 mb-4">
                                {{ comentario.contenido }}  
                            </p>
                            <p class="text-left text-md text-gray-400 ml-3 mb-3 inline-block float-left">
                                {{ comentario.fecha_publicacion }}
                            </p>
                        </article>
                    </section>
                </section>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';
import Create from './create.vue'

    export default{
        props: {
            publicacion : Object,
        },
        data(){
            return {
                mostrar_componente_crear: false,
                publicaciones: [],
                comentarios: [],
                comentario : ''
            }
        },
        components:{
            AppLayout,
            Create,
        },
        mounted(){
            this.lanzador();
        },
        methods: {
            lanzador(){
                if(this.publicacion === undefined){
                    this.getPublicaciones()
                }else{
                    this.getComentarios();
                }
            },
            async getPublicaciones(){
                if(this.publicacion === undefined){
                    const api = `/api/get-publicaciones`;
                    const data = await axios.get(api);
                    this.publicaciones = data.data;
                    this.publicaciones.forEach(publicacion => {
                        this.fechaBonita(publicacion);
                    });
                }else{
                    this.fechaBonita(this.publicacion);
                }
            },
            async getComentarios(){
                console.log(this.publicacion.id);
                const api = `/api/get-comentarios/${this.publicacion.id}`;
                const data = await axios.get(api);
                this.comentarios = data.data;
                this.comentarios.forEach(comentario => {
                    this.fechaBonita(comentario);
                });
            },
            async guardarComentario(){
                const data = {
                    contenido: this.comentario,
                    publicacion_id: this.publicacion.id
                }
                const api = `/api/comentario`;
                const response = await axios.post(api,data);
                console.log(response);
                this.comentario = '';
                this.getComentarios();
            },
            fechaBonita(publicacion){
                const fecha_texto = publicacion.fecha_publicacion;
                const fecha = new Date(fecha_texto);

                const opciones_fecha = { day: 'numeric', month: 'long', year: 'numeric' };
                const fecha_bonita = fecha.toLocaleDateString('es-ES', opciones_fecha);

                const opciones_hora = { hour: 'numeric', minute: 'numeric', second: 'numeric' };
                const hora_bonita = fecha.toLocaleTimeString('es-ES', opciones_hora);

                publicacion.fecha_publicacion = fecha_bonita + ' a las ' + hora_bonita;
            },
            // Para reenviar a solo ver una publicacion con sus comentarios
            verComentario(id){
                window.location.href = `/home/${id}`;
            },
            // Funciones de modal de crear
            componenteCrear(){
                this.mostrar_componente_crear = true;
            },
            cerrandoModal(e){
                this.mostrar_componente_crear = false;
                this.getPublicaciones();
            },

        }
    }    
</script>