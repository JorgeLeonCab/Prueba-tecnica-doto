<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { onMounted } from 'vue';

export default{
    data(){
            return {
                
            }
        },
        components:{
        },
        mounted(){
            window.location.replace(`/home`);
        },
        methods: {}
}
</script>

<template>
    redirecting...
</template>
