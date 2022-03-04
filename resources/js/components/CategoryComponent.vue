<template>
    <div class="card col-4">
        <img :src="`storage/${category.picture}`" class="card-img-top picture-size" alt="category.name">
            <div class="card-body">
                <h5 class="card-title">
                    {{category.name}}
                </h5>
                <p class="card-text">
                    {{category.description}}
                </p>
                <a  :href="`${routeCategory}/${category.id}`" class="btn btn-primary">Перейти</a>

                <button @click='buttonClicked' class="btn btn-link">Click!</button>
            </div>
        </div>
</template>

<script>
export default {
    props: ['category','routeCategory'],
    methods: {
        buttonClicked(){
           // console.log('clicked ' + this.category.id)
           this.$emit('buttonClicked', this.category.id)
        }
    }
}
</script>

<style scoped>
    .picture-size{
        width: 354px;
        height: 292px;
    }
</style>