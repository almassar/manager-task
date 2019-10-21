<template>
    <div class="main" v-if="this.isShow">
        <span title="Удалить" class="remove-button" @click="removeNotification">
            <i class="fas fa-times"></i>
        </span>

        <div class="title">
            <slot name="title"></slot>
        </div>

        <a :href="this.link">
            <slot></slot>
       </a>
    </div>
</template>

<script>
    import axios from 'axios'
    import {baseUrl} from '../utilities'

    export default {
        props: {
            id: String,
            link: String,
        },

        data() {
            return {
                isShow: true
            }
        },

        methods:{
            removeNotification(){
                axios.get(baseUrl() + '/notification-mark-as-read/' + this.id).then(response => {
                    this.isShow = false;
                }).catch(e => {
                    console.log(e)
                })
            }
        },
    }
</script>

<style lang="scss" scoped>
    .main{
        padding: 4px;
        margin-bottom: 10px;
        background: white;
        font-size: 13px;
        overflow: hidden;
    }

    .title {
        font-size: 14px;
        overflow: hidden;
        font-weight: 500;

    }

    .remove-button {
        font-size: 15px;
        color: chocolate;
        float: right;
        cursor: pointer;
    }
</style>
