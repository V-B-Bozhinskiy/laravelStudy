<template>
  <div>
  <h1>{{pageTitle}}</h1>

    <div class="row">
        <category-component 
            v-for="category in categories"
            :key="category.id"
            :category='category'
            :route-category="routeCategory"
            @buttonClicked='buttonClicked'
            >
        </category-component>
    </div>
  </div>
</template>

<script>
import CategoryComponent from'./CategoryComponent.vue'
export default {
    components: {CategoryComponent},
    props:['test', 'pageTitle', 'categories','routeCategory'], //то что было передано с названием переменной в kebab-case станет camelCase!
    methods:{
        buttonClicked(data){
            console.log(`Клик в дочернем компоненте (${data})`)
        }
    },
    mounted() {
            console.log('Categories Component mounted.')
            console.log(this.test)
        }
}
</script>

<style scoped>

</style>